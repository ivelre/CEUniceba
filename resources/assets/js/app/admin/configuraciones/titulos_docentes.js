/**
 * @fileOverview  Carga la tabla para mosta los títulos de los docentes, además de las petuciones para
 *                agregar, actualizar y eliminar un título.
 *
 * @version       1.0
 *
 * @author        Julio Cesar Valle Rodríguez
 * @copyright     APPSA México
 */

load_titulos_docentes();

var new_titulo_docente = false;
var titulo_id = null;

$.validator.setDefaults({
  errorClass: 'invalid',
  validClass: "valid",
  errorPlacement: function(error, element) {
    $(element)
      .closest("form")
      .find("label[for='" + element.attr("id") + "']")
      .attr('data-error', error.text());
  }
});

/**
 * Realiza una petición ajax para obtener los títulos de los docentes y cargarlas al DataTable.
 *
 * @async
 * @function  load_titulos_docentes
 * @return    {null}
 */
function load_titulos_docentes(){
	var table = $('#table_titulos_docentes').DataTable({
  	"language": {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    },
    destroy: true,
    processing: true,
    serverSide: true,
    scrollX: true,
    ajax: public_path + 'admin/datatable/titulos_docentes',
    columns: [
        { data: 'titulo',			name: 'titulo' },
        { data: 'descripcion',	name: 'descripcion' },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `
              <a class="btn-floating btn-meddium waves-effect waves-light edit-titulo-docente">
                <i class="material-icons circle green">mode_edit</i>
              </a>`;
          },
          orderable: false, 
          searchable: false
        },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `
              <a class="btn-floating btn-meddium waves-effect waves-light delete-titulo-docente">
                <i class="material-icons circle red">close</i>
              </a>`;
          },
          orderable: false, 
          searchable: false
        }
    ]
  });
  $("select[name$='table_titulos_docentes_length']").val('10');
  $("select[name$='table_titulos_docentes_length']").material_select();
  edit_titulo_docente('#table_titulos_docentes tbody',table);
  delete_titulo_docente('#table_titulos_docentes tbody',table);
}

/**
 * Inicializa el modal para agregar un nuevo título de docente.
 * 
 * @event     on:click#create_titulo_docente
 * @type      {object}
 * @property  {event} on:click - Detecta si se hizo click en el botón para agregar un nuevo titulo.
 */
$('#create_titulo_docente').on('click',function(){
	$('#titulo').val('');
	$('#descripcion').val('');
  $("label[for='titulo']").attr('data-error','');
  $('#titulo').removeClass('invalid');
  Materialize.updateTextFields();
	new_titulo_docente = true;
  titulo_id = null;
	$('#modal_titulo_docente').modal('open');
});

/**
 * Carga la información del título de docente a actualizar.
 *
 * @function  edit_titulo_docente
 * @param     {tbody} tbody - tbody del DataTable.
 * @param     {DataTable} table - Instancia dele DataTable.
 * @return    {null}
 */
function edit_titulo_docente (tbody,table){
  $(tbody).on('click','a.edit-titulo-docente',function(){
    var data = table.row( $(this).parents('tr') ).data();
    titulo_id = data.id;
    $("label[for='titulo']").attr('data-error','');
    $('#titulo').removeClass('invalid');
    $('#titulo').val(data.titulo);
    $('#descripcion').val(data.descripcion);
    $('#descripcion').trigger('autoresize');
    Materialize.updateTextFields();
    new_titulo_docente = false;
    $('#modal_titulo_docente').modal('open');
  });
}

/**
 * Valida la información del form_titulo_docente con la libreria JQuery Validator.
 * 
 * @event       validate#form_titulo_docente
 * @type        {object}
 * @property    {event} validate - Valida la información para agregar o actualiza un titulo
 *                                 del docente y llama a la función correspondiente.
 */
var validator = $("#form_titulo_docente").validate({
	rules: {
    titulo: {
      required: true
    }
	},
	messages: {
		titulo:{
			required: "El título es requerido."
    }
  },
  submitHandler: function(form) {
    if (new_titulo_docente) {
      json = {
        titulo: $('#titulo').val(),
        descripcion: $('#descripcion').val()
      }
      store_titulo_docente(json);
    }else{
      json = {
        id: titulo_id,
        titulo: $('#titulo').val(),
        descripcion: $('#descripcion').val()
      }
      update_titulo_docente(json);
    }
  }
});

/**
 * Realiza la petición para agregar un nuevo título de docente.
 *
 * @async
 * @function    store_titulo_docente
 * @param       {json} json - JSON con la información a agregar.
 * @return      {null}
 */
function store_titulo_docente(json){
	$.post(public_path + 'admin/configuraciones/titulos_docentes',json,function(data){
		$('#table_titulos_docentes').DataTable().ajax.reload();
		swal({
		  type: 'success',
		  title: 'El título ha sido guardado',
		  showConfirmButton: false,
		  timer: 1500
		});
    $('#modal_titulo_docente').modal('close');
	}).fail(function(data) {
    var errors = data.responseJSON.errors;
    for(var error in errors) {
      $("label[for='"+error+"']").attr('data-error',errors[error]);
      $("#"+error+"").addClass('invalid');
    }
	});
}

/**
 * Realiza la petición para actualiza el titulo de un docente.
 *
 * @async 
 * @function    update_titulo_docente
 * @param       {json} json - JSON con la información a actualizar.
 * @return      {null}
 */
function update_titulo_docente(json){
  $.ajax({
    url: public_path + 'admin/configuraciones/titulos_docentes/'+titulo_id,
    data: json,
    type: 'PUT',
    success: function(result) {
      $('#table_titulos_docentes').DataTable().ajax.reload();
      swal({
        type: 'success',
        title: 'El título ha sido actualizado',
        showConfirmButton: false,
        timer: 1500
      });
      $('#modal_titulo_docente').modal('close');    
    },
    error: function (data) {
      var errors = data.responseJSON.errors;
      for(var error in errors) {
        $("label[for='"+error+"']").attr('data-error',errors[error]);
        $("#"+error+"").addClass('invalid');
      }
    }
  });
}


/**
 * Recupera el ID del título a eliminar
 *
 * @function  delete_titulo_docente
 * @param     {tbody} tbody - tbody del DataTable.
 * @param     {DataTable} table - Instancia del DataTable.
 * @return    {null}
 */
function delete_titulo_docente (tbody,table){
  $(tbody).on('click','a.delete-titulo-docente',function(){
    var data = table.row( $(this).parents('tr') ).data();
    swal({
      title: 'Desea eliminar el título?',
      text: "Esta acción no se puede revertir",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'Cancelar',
    }).then((result) => {
      if (result.value) {
        titulo_id= data.id;
        destroy_titulo_docente(titulo_id);    
      }
    })
  });
}

/**
 * Realiza la petición para la eliminación del título del docente.
 *
 * @async
 * @function  destroy_titulo_docente
 * @param     {integer} titulo_id - ID del título del docente.
 * @return    {null}
 */
function destroy_titulo_docente(titulo_id){
  $.ajax({
    url: public_path + 'admin/configuraciones/titulos_docentes/'+titulo_id,
    type: 'DELETE',
    success: function(result) {
      $('#table_titulos_docentes').DataTable().ajax.reload();
      swal({
        type: 'success',
        title: 'El título ha sido eliminado',
        showConfirmButton: false,
        timer: 1500
      });
    },
    error: function (data) {
      swal({
        type: 'error',
        title: 'Error al eliminar',
        text: 'El título esta relacionado con uno o más datos.'
      });  
    }
  });
}