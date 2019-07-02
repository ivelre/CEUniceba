/**
 * @fileOverview  Carga la tabla con los estados de los estudiantes y las peticiones para agregar, 
 *                editar y eliminar un estado.
 *
 * @version       1.0
 *
 * @author        Julio Cesar Valle Rodriguez <jvalle@appsamx.com>
 * @copyright     APPSA México
 */

load_estados_estudiantes();

var new_estado_estudiante = false;
var estado_estudiante_id = null;

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
 * Realiza una petición para obtener los estados del los estudiantes y cargarlos en el DataTable.
 *
 * @async
 * @function  load_estados_estudiantes
 * @return    {null}
 */
function load_estados_estudiantes(){
	var table = $('#table_estados_estudiantes').DataTable({
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
    ajax: public_path+'admin/datatable/estados_estudiantes',
    columns: [
        { data: 'estado_estudiante',			name: 'estado_estudiante' },
        { data: 'descripcion',	name: 'descripcion' },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `
              <a class="btn-floating btn-meddium waves-effect waves-light edit-estado-estudiante">
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
              <a class="btn-floating btn-meddium waves-effect waves-light delete-estado-estudiante">
                <i class="material-icons circle red">close</i>
              </a>`;
          },
          orderable: false, 
          searchable: false
        }
    ]
  });
  $("select[name$='table_estados_estudiantes_length']").val('10');
  $("select[name$='table_estados_estudiantes_length']").material_select();
  edit_estado_estudiante('#table_estados_estudiantes tbody',table);
  delete_estado_estudiante('#table_estados_estudiantes tbody',table);
}

/**
 * Inicializa el modal para agregar un nuevo estado del estudiante.
 * 
 * @event     on:click#create_estado_estudiante
 * @type      {object}
 * @property  {event} on:click - Detecta si se presiono el botón para agregar un nuevo estado.
 */
$('#create_estado_estudiante').on('click',function(){
	$('#estado_estudiante').val('');
	$('#descripcion').val('');
  $("label[for='estado_estudiante']").attr('data-error','');
  $('#estado_estudiante').removeClass('invalid');
  Materialize.updateTextFields();
	new_estado_estudiante = true;
  estado_estudiante_id = null;
	$('#modal_estado_estudiante').modal('open');
});

/**
 * Carga el evento on:click en los botones para editar un estado del estudiante.
 *
 * @function  edit_estado_estudiante
 * @param     {tbody} tbody - tbody del DataTable
 * @param     {DataTable} table - Instancia del DataTable
 * @return    {null}
 */
function edit_estado_estudiante (tbody,table){
  $(tbody).on('click','a.edit-estado-estudiante',function(){
    var data = table.row( $(this).parents('tr') ).data();
    estado_estudiante_id = data.id;
    $("label[for='estado_estudiante']").attr('data-error','');
    $('#estado_estudiante').removeClass('invalid');
    $('#estado_estudiante').val(data.estado_estudiante);
    $('#descripcion').val(data.descripcion);
    $('#descripcion').trigger('autoresize');
    Materialize.updateTextFields();
    new_estado_estudiante = false;
    $('#modal_estado_estudiante').modal('open');
  });
}

/**
 * Valida la informacion del form_estado_estudiante mediante JQuery Validator, y manda llamar
 * a la funcion pertinente para su almacenamiento o actualizacion.
 * 
 * @event     validate#form_estado_estudiante
 * @type      {object}
 * @property  {event} validate - Valida que la información del formulario sea correcta.
 */
var validator = $("#form_estado_estudiante").validate({
	rules: {
    estado_estudiante: {
      required: true
    }
	},
	messages: {
		estado_estudiante:{
			required: "El estado del estudiante es requerido"
    }
  },
  submitHandler: function(form) {
    if (new_estado_estudiante) {
      json = {
        estado_estudiante: $('#estado_estudiante').val(),
        descripcion: $('#descripcion').val()
      }
      store_estado_estudiante(json);
    }else{
      json = {
        id: estado_estudiante_id,
        estado_estudiante: $('#estado_estudiante').val(),
        descripcion: $('#descripcion').val()
      }
      update_estado_estudiante(json);
    }
  }
});

/**
 * Realiza la petición ajax para agregar un nuevo estado del estudiante.
 *
 * @async
 * @function  store_estado_estudiante
 * @param     {json} json - JSON con la información a agregar.
 * @return    {null}
 */
function store_estado_estudiante(json){
	$.post(public_path + 'admin/configuraciones/estados_estudiantes', json, function(data){
		$('#table_estados_estudiantes').DataTable().ajax.reload();
		swal({
		  type: 'success',
		  title: 'El estado del estudiante ha sido guardado',
		  showConfirmButton: false,
		  timer: 1500
		});
    $('#modal_estado_estudiante').modal('close');
	}).fail(function(data) {
    var errors = data.responseJSON.errors;
    for(var error in errors) {
      $("label[for='"+error+"']").attr('data-error',errors[error]);
      $("#"+error+"").addClass('invalid');
    }
	});
}

/**
 * Realiza una petición ajax para actualizar un estado del estudiante.
 *
 * @async
 * @function  update_estado_estudiante
 * @param     {json} json - JSON con la información a actualizar.
 * @return    {null}
 */
function update_estado_estudiante(json){
  $.ajax({
    url: public_path + 'admin/configuraciones/estados_estudiantes/'+estado_estudiante_id,
    data: json,
    type: 'PUT',
    success: function(result) {
      $('#table_estados_estudiantes').DataTable().ajax.reload();
      swal({
        type: 'success',
        title: 'El estado del estudiante ha sido actualizado',
        showConfirmButton: false,
        timer: 1500
      });
      $('#modal_estado_estudiante').modal('close');    
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
 * Recupera el ID del estado del estudiante a eliminar.
 *
 * @function  delete_estado_estudiante
 * @param     {tbody} tbody - tobdy del DataTable.
 * @param     {DataTable} table - Instancia del DataTable.
 * @return    {null}
 */
function delete_estado_estudiante (tbody,table){
  $(tbody).on('click','a.delete-estado-estudiante',function(){
    var data = table.row( $(this).parents('tr') ).data();
    swal({
      title: 'Desea eliminar el estado?',
      text: "Esta acción no se puede revertir",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'Cancelar',
    }).then((result) => {
      if (result.value) {
        estado_estudiante_id= data.id;
        destroy_estado_estudiante(estado_estudiante_id);    
      }
    })
  });
}

/**
 * Realiza una petición ajax para eliminar el estado del estudiante.
 *
 * @async
 * @function  detroy_estado_estudiante
 * @param     {integer} estado_estudiante_id - ID del estado del estudiante.
 * @return    {null}
 */
function destroy_estado_estudiante(estado_estudiante_id){
  $.ajax({
    url: public_path + 'admin/configuraciones/estados_estudiantes/'+estado_estudiante_id,
    type: 'DELETE',
    success: function(result) {
      $('#table_estados_estudiantes').DataTable().ajax.reload();
      swal({
        type: 'success',
        title: 'El estado ha sido eliminado',
        showConfirmButton: false,
        timer: 1500
      });
    },
    error: function (data) {
      swal({
        type: 'error',
        title: 'Error al eliminar',
        text: 'El estado esta relacionado con uno o más datos.'
      });  
    }
  });
}