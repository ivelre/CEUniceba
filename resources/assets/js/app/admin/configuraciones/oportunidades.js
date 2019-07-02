/**
 * @fileOverview  Carga la tabla que muestra las oportunidades de las clases y las peticiones para 
 *                agregar, actualizar y eliminar una oportunidad.
 *
 * @version       1.0
 *
 * @author        Julio Cesar Valle Rodríguez
 * @copyright     APPSA México
 */

load_oportunidades();

var new_oportunidad = false;
var oportunidad_id = null;

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
 * Realiza una petición ajax para obtener las oportunidades y cargarlas al DataTable.
 *
 * @async
 * @function  load_oportunidades
 * @return    {null}
 */
function load_oportunidades(){
	var table = $('#table_oportunidades').DataTable({
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
    ajax: public_path + 'admin/datatable/oportunidades',
    columns: [
        { data: 'oportunidad',  name: 'oportunidad' },
        { data: 'descripcion',	name: 'descripcion' },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `
              <a class="btn-floating btn-meddium waves-effect waves-light edit-oportunidad">
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
              <a class="btn-floating btn-meddium waves-effect waves-light delete-oportunidad">
                <i class="material-icons circle red">close</i>
              </a>`;
          },
          orderable: false, 
          searchable: false
        }
    ]
  });
  $("select[name$='table_oportunidades_length']").val('10');
  $("select[name$='table_oportunidades_length']").material_select();
  edit_oportunidad('#table_oportunidades tbody',table);
  delete_oportunidad('#table_oportunidades tbody',table);
}

/**
 * Inicializa el modal para agregar una nueva oportunidad.
 * 
 * @event     on:click#create_oportunidad
 * @type      {object}
 * @property  {event} on:click - Detecta si se hizo click en el botón para agregar una nueva 
 *                               oportunidad.
 */
$('#create_oportunidad').on('click',function(){
	$('#oportunidad').val('');
	$('#descripcion').val('');
  $("label[for='oportunidad']").attr('data-error','');
  $('#oportunidad').removeClass('invalid');
  Materialize.updateTextFields();
	new_oportunidad = true;
  oportunidad_id = null;
	$('#modal_oportunidad').modal('open');
});

/**
 * Carga la información de la oportunidad a editar.
 *
 * @function  edit_oportunidad
 * @param     {tbody} tbody - tbody del DataTable.
 * @param     {DataTable} table - Instancia del DataTable.
 * @return    {null}
 */
function edit_oportunidad (tbody,table){
  $(tbody).on('click','a.edit-oportunidad',function(){
    var data = table.row( $(this).parents('tr') ).data();
    oportunidad_id = data.id;
    $("label[for='oportunidad']").attr('data-error','');
    $('#oportunidad').removeClass('invalid');
    $('#oportunidad').val(data.oportunidad);
    $('#descripcion').val(data.descripcion);
    $('#descripcion').trigger('autoresize');
    Materialize.updateTextFields();
    new_oportunidad = false;
    $('#modal_oportunidad').modal('open');
  });
}

/**
 * Valida los datos del form_oportunidad con la libreria JQuery Validator.
 * 
 * @event     validate#form_oportunidad
 * @type      {object}
 * @property  {event} validate - Valida los datos para agregar o actualizar una oportunidad.
 */
var validator = $("#form_oportunidad").validate({
	rules: {
    oportunidad: {
      required: true
    }
	},
	messages: {
		oportunidad:{
			required: "La oportunidad es requerida."
    }
  },
  submitHandler: function(form) {
    if (new_oportunidad) {
      json = {
        oportunidad: $('#oportunidad').val(),
        descripcion: $('#descripcion').val()
      }
      store_oportunidad(json);
    }else{
      json = {
        id: oportunidad_id,
        oportunidad: $('#oportunidad').val(),
        descripcion: $('#descripcion').val()
      }
      update_oportunidad(json);
    }
  }
});

/**
 * Realiza la petición para agregar una nueva oportunidad.
 *
 * @async
 * @function  store_oportunidad
 * @param     {json} json - JSON son la información a agregar.
 * @return    {null}
 */
function store_oportunidad(json){
	$.post(public_path + 'admin/configuraciones/oportunidades', json, function(data){
		$('#table_oportunidades').DataTable().ajax.reload();
		swal({
		  type: 'success',
		  title: 'La oportunidad ha sido guardada',
		  showConfirmButton: false,
		  timer: 1500
		});
    $('#modal_oportunidad').modal('close');
	}).fail(function(data) {
    var errors = data.responseJSON.errors;
    for(var error in errors) {
      $("label[for='"+error+"']").attr('data-error',errors[error]);
      $("#"+error+"").addClass('invalid');
    }
	});
}

/**
 * Realiza una petición para actualizar una oportunidad.
 *
 * @async
 * @function  update_oportunidad
 * @param     {json} json - JSON con la información a actualizar.
 * @return    {null}
 */
function update_oportunidad(json){
  $.ajax({
    url: public_path + 'admin/configuraciones/oportunidades/'+oportunidad_id,
    data: json,
    type: 'PUT',
    success: function(result) {
      $('#table_oportunidades').DataTable().ajax.reload();
      swal({
        type: 'success',
        title: 'La oportunidad ha sido actualizada',
        showConfirmButton: false,
        timer: 1500
      });
      $('#modal_oportunidad').modal('close');    
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
 * Recupera el ID de la oportunidad a eliminar.
 *
 * @function  delete_oportunidad
 * @param     {tbody} tbody - tbody del DataTable.
 * @param     {DataTable} table - Instancia del  DataTable.
 * @return    {null}
 */
function delete_oportunidad (tbody,table){
  $(tbody).on('click','a.delete-oportunidad',function(){
    var data = table.row( $(this).parents('tr') ).data();
    swal({
      title: 'Desea eliminar la oportunidad?',
      text: "Esta acción no se puede revertir",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'Cancelar',
    }).then((result) => {
      if (result.value) {
        oportunidad_id= data.id;
        destroy_oportunidad(oportunidad_id);    
      }
    })
  });
}

/**
 * Petición para eliminar una oportunidad específica.
 *
 * @async
 * @function  destroy_oportunidad
 * @param     {integer} oportunidad_id - ID de la oportunidad.
 * @return    {null}
 */
function destroy_oportunidad(oportunidad_id){
  $.ajax({
    url: public_path + 'admin/configuraciones/oportunidades/'+oportunidad_id,
    type: 'DELETE',
    success: function(result) {
      $('#table_oportunidades').DataTable().ajax.reload();
      swal({
        type: 'success',
        title: 'La oportunidad ha sido eliminada',
        showConfirmButton: false,
        timer: 1500
      });
    },
    error: function (data) {
      swal({
        type: 'error',
        title: 'Error al eliminar',
        text: 'La oportunidad esta relacionada con uno o más datos.'
      });  
    }
  });
}