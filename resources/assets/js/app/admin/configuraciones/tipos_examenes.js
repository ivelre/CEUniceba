/**
 * ================================================================================================
 * @fileOverview  Carga la tabla con los tipos de examénes de los periodos, además de realizar las
 *                peticiones para agregar, actualizar y eliminar un tipo de examen.
 *
 * @version       1.0
 *
 * @author        Julio Cesar Valle Rodriguez <jvalle@appsamx.com>
 * @copyright     APPSA México
 * ================================================================================================
 */

load_tipos_examenes();

var new_tipo_examen = false;
var tipo_examen_id = null;

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
 * Realiza una petición ajax para obtener los tipos de examenes y cargarlos en el DataTable.
 *
 * @async
 * @function  load_tipos_examenes
 * @return    {null}
 */
function load_tipos_examenes(){
	var table = $('#table_tipos_examenes').DataTable({
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
    ajax: public_path + 'admin/datatable/tipos_examenes',
    columns: [
        { data: 'tipo_examen',			name: 'tipo_examen' },
        { data: 'descripcion',	name: 'descripcion' },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `
              <a class="btn-floating btn-meddium waves-effect waves-light edit-tipo-examen">
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
              <a class="btn-floating btn-meddium waves-effect waves-light delete-tipo-examen">
                <i class="material-icons circle red">close</i>
              </a>`;
          },
          orderable: false, 
          searchable: false
        }
    ]
  });
  $("select[name$='table_tipos_examenes_length']").val('10');
  $("select[name$='table_tipos_examenes_length']").material_select();
  edit_tipo_examen('#table_tipos_examenes tbody',table);
  delete_tipo_examen('#table_tipos_examenes tbody',table);
}

/**
 * Inicializa el modal para agregar un nuevo tipo de examen.
 *
 * @event       on:click#create_tipo_examen
 * @type        {object}
 * @property    {event} on:click - Detecta si se hizo click en el botón para agregar un nuevo 
 *                                 tipo de examen.
 */
$('#create_tipo_examen').on('click',function(){
	$('#tipo_examen').val('');
	$('#descripcion').val('');
  $("label[for='tipo_examen']").attr('data-error','');
  $('#tipo_examen').removeClass('invalid');
  Materialize.updateTextFields();
	new_tipo_examen = true;
  tipo_examen_id = null;
	$('#modal_tipo_examen').modal('open');
});

/**
 * Carga la información del tipo de examen a editar.
 *
 * @function  edit_tipo_examen
 * @param     {tbody} tbody - tbody del DataTable.
 * @param     {DataTable} table - Instancia del DataTable.
 * @return    {null}
 */
function edit_tipo_examen (tbody,table){
  $(tbody).on('click','a.edit-tipo-examen',function(){
    var data = table.row( $(this).parents('tr') ).data();
    tipo_examen_id = data.id;
    $("label[for='tipo_examen']").attr('data-error','');
    $('#tipo_examen').removeClass('invalid');
    $('#tipo_examen').val(data.tipo_examen);
    $('#descripcion').val(data.descripcion);
    $('#descripcion').trigger('autoresize');
    Materialize.updateTextFields();
    new_tipo_examen = false;
    $('#modal_tipo_examen').modal('open');
  });
}

/**
 * Valida los datos del form_tipo_examen con la libreria JQuery Validator.
 * 
 * @event       validate#form_tipo_examen
 * @type        {object}
 * @property    {event} validate - Valida que los para agregar o actualizar un tipo de examen.
 */
var validator = $("#form_tipo_examen").validate({
	rules: {
    tipo_examen: {
      required: true
    }
	},
	messages: {
		tipo_examen:{
			required: "El tipo es requerido."
    }
  },
  submitHandler: function(form) {
    if (new_tipo_examen) {
      json = {
        tipo_examen: $('#tipo_examen').val(),
        descripcion: $('#descripcion').val()
      }
      store_tipo_examen(json);
    }else{
      json = {
        id: tipo_examen_id,
        tipo_examen: $('#tipo_examen').val(),
        descripcion: $('#descripcion').val()
      }
      update_tipo_examen(json);
    }
  }
});

/**
 * Realiza la petición para agrega un nuevo tipo de examen.
 *
 * @async
 * @function  store_tipo_examen
 * @param     {json} json - JSON con la información a agregar.
 * @return    {null}
 */
function store_tipo_examen(json){
	$.post(public_path + 'admin/configuraciones/tipos_examenes', json, function(data){
		$('#table_tipos_examenes').DataTable().ajax.reload();
		swal({
		  type: 'success',
		  title: 'El tipo de examen ha sido guardado',
		  showConfirmButton: false,
		  timer: 1500
		});
    $('#modal_tipo_examen').modal('close');
	}).fail(function(data) {
    var errors = data.responseJSON.errors;
    for(var error in errors) {
      $("label[for='"+error+"']").attr('data-error',errors[error]);
      $("#"+error+"").addClass('invalid');
    }
	});
}

/**
 * Realiza la petición para actualizar un tipo de examen.
 *
 * @async
 * @function  update_tipo_examen
 * @param     {json} json - JSON con la información a actualizar.
 * @return    {null}
 */
function update_tipo_examen(json){
  $.ajax({
    url: public_path + 'admin/configuraciones/tipos_examenes/'+tipo_examen_id,
    data: json,
    type: 'PUT',
    success: function(result) {
      $('#table_tipos_examenes').DataTable().ajax.reload();
      swal({
        type: 'success',
        title: 'El tipo de examen ha sido actualizado',
        showConfirmButton: false,
        timer: 1500
      });
      $('#modal_tipo_examen').modal('close');    
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
 * Recupera el ID del tipo de examen a eliminar.
 *
 * @function  delete_tipo_examen
 * @param     {tbody} tbody - tbody DataTable.
 * @param     {DataTable} table - Instancia del DataTable.
 * @return    {null}
 */
function delete_tipo_examen (tbody,table){
  $(tbody).on('click','a.delete-tipo-examen',function(){
    var data = table.row( $(this).parents('tr') ).data();
    swal({
      title: 'Desea eliminar el tipo de examen?',
      text: "Esta acción no se puede revertir",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'Cancelar',
    }).then((result) => {
      if (result.value) {
        tipo_examen_id= data.id;
        destroy_tipo_examen(tipo_examen_id);    
      }
    })
  });
}

/**
 * Realiza la petición para eliminar un tipo de examen.
 *
 * @async
 * @function  destroy_tipo_examen
 * @param     {int} tipo_examen_id - ID del tipo de examen.
 * @return    {null}
 */
function destroy_tipo_examen(tipo_examen_id){
  $.ajax({
    url: public_path + 'admin/configuraciones/tipos_examenes/'+tipo_examen_id,
    type: 'DELETE',
    success: function(result) {
      $('#table_tipos_examenes').DataTable().ajax.reload();
      swal({
        type: 'success',
        title: 'El tipo de examen ha sido eliminado',
        showConfirmButton: false,
        timer: 1500
      });
    },
    error: function (data) {
      swal({
        type: 'error',
        title: 'Error al eliminar',
        text: 'El tipo de examen esta relacionado con uno o más datos.'
      });  
    }
  });
}