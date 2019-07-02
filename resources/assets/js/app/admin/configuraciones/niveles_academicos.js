/**
 * ==================================================================================================
 * @fileOverview  Carga la tabla con los niveles académicos y las peticiones para agregar, actualizar
 *                y eliminar un nivel.
 *
 * @version       1.0
 *
 * @author        Julio Cesar Valle Rodriguez <jvalle@appsamx.com>
 * @copyright     APPSA México.
 */

load_niveles_academicos();

var new_nivel_academico = false;
var nivel_academico_id = null;

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
 * Realiza una petición ajax para obtener los niveles academicos y los carga en el DataTable.
 *
 * @async
 * @function  load_niveles_academicos
 * @return    {null}
 */
function load_niveles_academicos(){
	var table = $('#table_niveles_academicos').DataTable({
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
    ajax: public_path + 'admin/datatable/niveles_academicos',
    columns: [
        { data: 'nivel_academico',  name: 'nivel_academico' },
        { data: 'descripcion',      name: 'descripcion' },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `<a class="btn-floating btn-meddium waves-effect waves-light edit-nivel-academico"><i class="material-icons circle green">mode_edit</i></a>`;
          },
          orderable: false, 
          searchable: false
        },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `<a class="btn-floating btn-meddium waves-effect waves-light delete-nivel-academico"><i class="material-icons circle red">close</i></a>`;
          },
          orderable: false, 
          searchable: false
        }
    ]
  });
  $("select[name$='table_niveles_academicos_length']").val('10');
  $("select[name$='table_niveles_academicos_length']").material_select();
  edit_nivel_academico('#table_niveles_academicos tbody',table);
  delete_nivel_academico('#table_niveles_academicos tbody',table);
}

/**
 * Inicializa el modal para agregar un nuevo nivel académico.
 * 
 * @event     on:click#create_nivel_academico
 * @type      {object}
 * @property  {event} on:click - Detecta que se haga click en el botón para agregar un nuevo
 *                               nivel academico.
 */
$('#create_nivel_academico').on('click',function(){
	$('#nivel_academico').val('');
	$('#descripcion').val('');
  $("label[for='nivel_academico']").attr('data-error','');
  $('#nivel_academico').removeClass('invalid');
  Materialize.updateTextFields();
	new_nivel_academico = true;
  nivel_academico_id = null;
	$('#modal_nivel_academico').modal('open');
});

/**
 * Carga la información del nivel académico en el modal para ser editado.
 * 
 * @param  {tbody} tbody - tbody del DataTable.
 * @param  {DataTable} table - Instancia del DataTable.
 * @return {null}
 */
function edit_nivel_academico (tbody,table){
  $(tbody).on('click','a.edit-nivel-academico',function(){
    var data = table.row( $(this).parents('tr') ).data();
    nivel_academico_id = data.id;
    $("label[for='nivel_academico']").attr('data-error','');
    $('#nivel_academico').removeClass('invalid');
    $('#nivel_academico').val(data.nivel_academico);
    $('#descripcion').val(data.descripcion);
    $('#descripcion').trigger('autoresize');
    Materialize.updateTextFields();
    new_nivel_academico = false;
    $('#modal_nivel_academico').modal('open');
  });
}

/**
 * Valida los campos del form_nivel_academico con la libreria JQuery Validator
 * 
 * @event     validate#form_nivel_academico
 * @type      {object}
 * @property  {event} validate - Valida que los campos para agregar un nuevo nivel académico
 *                               sean correctos y realiza la peticion correspondiente.
 */
var validator = $("#form_nivel_academico").validate({
	rules: {
    nivel_academico: {
      required: true
    }
	},
	messages: {
		nivel_academico:{
			required: "El nivel académico es requerido."
    }
  },
  submitHandler: function(form) {
    if (new_nivel_academico) {
      json = {
        nivel_academico: $('#nivel_academico').val(),
        descripcion: $('#descripcion').val()
      }
      store_nivel_academico(json);
    }else{
      json = {
        id: nivel_academico_id,
        nivel_academico: $('#nivel_academico').val(),
        descripcion: $('#descripcion').val()
      }
      update_nivel_academico(json);
    }
  }
});

/**
 * Realiza una petición para agregar un nuevo nivel académico.
 *
 * @async
 * @function  store_nivel_academico
 * @param     {json} json - JSON con la información a agregar.
 * @return    {null}
 */
function store_nivel_academico(json){
	$.post(public_path + 'admin/configuraciones/niveles_academicos', json, function(data){
		$('#table_niveles_academicos').DataTable().ajax.reload();
		swal({
		  type: 'success',
		  title: 'El nivel académico ha sido guardado',
		  showConfirmButton: false,
		  timer: 1500
		});
    $('#modal_nivel_academico').modal('close');
	}).fail(function(data) {
    var errors = data.responseJSON.errors;
    for(var error in errors) {
      $("label[for='"+error+"']").attr('data-error',errors[error]);
      $("#"+error+"").addClass('invalid');
    }
	});
}

/**
 * Realiza una petición para actualizar un nivel académico.
 *
 * @async
 * @function  update_nivel_academico
 * @param     {json} json - JSON con la información a actualizar.
 * @return    {null}
 */
function update_nivel_academico(json){
  $.ajax({
    url: public_path + 'admin/configuraciones/niveles_academicos/'+nivel_academico_id,
    data: json,
    type: 'PUT',
    success: function(result) {
      $('#table_niveles_academicos').DataTable().ajax.reload();
      swal({
        type: 'success',
        title: 'El nivel académico ha sido actualizado',
        showConfirmButton: false,
        timer: 1500
      });
      $('#modal_nivel_academico').modal('close');    
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
 * Recupera el ID del nivel académico a eliminar.
 *
 * @function  delete_nivel_academico
 * @param     {tbody} tbody - tbody del DataTable.
 * @param     {DataTable} table - Instancia del DataTable.
 * @return    {null}
 */
function delete_nivel_academico (tbody,table){
  $(tbody).on('click','a.delete-nivel-academico',function(){
    var data = table.row( $(this).parents('tr') ).data();
    swal({
      title: 'Desea eliminar el nivel académico?',
      text: "Esta acción no se puede revertir",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'Cancelar',
    }).then((result) => {
      if (result.value) {
        nivel_academico_id= data.id;
        destroy_nivel_academico(nivel_academico_id);    
      }
    })
  });
}


/**
 * Realiza la petición ajax para eliminar el nivel académico.
 *
 * @async
 * @function  destroy_nivel_academico
 * @param     {integer} nivel_academico_id - ID del nivel académico.
 * @return    {null}
 */
function destroy_nivel_academico(nivel_academico_id){
  $.ajax({
    url: public_path + 'admin/configuraciones/niveles_academicos/'+nivel_academico_id,
    type: 'DELETE',
    success: function(result) {
      $('#table_niveles_academicos').DataTable().ajax.reload();
      swal({
        type: 'success',
        title: 'El nivel académico ha sido eliminado',
        showConfirmButton: false,
        timer: 1500
      });
    },
    error: function (data) {
      swal({
        type: 'error',
        title: 'Error al eliminar',
        text: 'El nivel académico esta relacionado con uno o más datos.'
      });  
    }
  });
}