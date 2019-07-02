/**
 * ========================================================================================
 * @fileOverview  Carga la tabla con las asignaturas regristradas en la institución, además
 *                de realizar las peticiones para agregar y actualizar una asignatura.
 *
 * @version       1.0
 *
 * @author        Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
 * @copyright     APPSA México
 * ========================================================================================
 */

load_asignaturas();

var new_asignatura = false;
var asignatura_id = null;


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
 * Realiza una petición ajax para obtener todas las asignaturas y cargarlas al DataTable.
 *
 * @async
 * @function  load_asignaturas
 * @return    {null}
 */
function load_asignaturas(){
	var table = $('#table_asignaturas').DataTable({
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
    ajax: public_path + 'admin/datatable/asignaturas',
    columns: [
        { data: 'codigo',			name: 'codigo' },
        { data: 'asignatura',	name: 'asignatura' },
        { data: 'creditos',		name: 'creditos' },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `
              <a class="btn-floating btn-meddium waves-effect waves-light edit-asignatura">
                <i class="material-icons circle green">mode_edit</i>
              </a>`;
          },
          orderable: false, 
          searchable: false
        }
    ]
  });
  $("select[name$='table_asignaturas_length']").val('10');
  $("select[name$='table_asignaturas_length']").material_select();
  edit_asignatura('#table_asignaturas tbody',table);
}

/**
 * Inicializa el modal para agregar una nueva asignatura.
 * 
 * @event     on:click#create_asignatura
 * @type      {object}
 * @property  {event} on:click - Detecta cuando se hace click en el botón para crear una 
 *                               nueva asignatura.
 */
$('#create_asignatura').on('click',function(){
	$('#asignatura').val('');
	$('#codigo').val('');
	$('#creditos').val('1');

  $("label[for='asignatura']").attr('data-error','');
  $("label[for='codigo']").attr('data-error','');
  $("label[for='creditos']").attr('data-error','');

  $('#asignatura').removeClass('invalid');
  $('#codigo').removeClass('invalid');
  $('#creditos').removeClass('invalid');

  Materialize.updateTextFields();
	new_asignatura = true;
  asignatura_id = null;
	$('#modal_asignatura').modal('open');
});

/**
 * Recupera la información para editar una asignatura
 *
 * @function  edit_asignatura
 * @param     {tbody} tbody - tbody del DataTable.
 * @param     {DataTable} table - Instancia del DataTable.
 * @return    {null}
 */
function edit_asignatura (tbody,table){
  $(tbody).on('click','a.edit-asignatura',function(){
    var data = table.row( $(this).parents('tr') ).data();
    asignatura_id = data.id;

    $("label[for='asignatura']").attr('data-error','');
    $("label[for='codigo']").attr('data-error','');
    $("label[for='creditos']").attr('data-error','');

    $('#asignatura').removeClass('invalid');
    $('#codigo').removeClass('invalid');
    $('#creditos').removeClass('invalid');

    $('#asignatura').val(data.asignatura);
    $('#codigo').val(data.codigo);
    $('#creditos').val(data.creditos);
    Materialize.updateTextFields();
    new_asignatura = false;
    $('#modal_asignatura').modal('open');
  });
}

/**
 * Valida los datos de form_asignatura con la libreria JQuery Validator
 * 
 * @event     validate#form_asignatura
 * @type      {object}
 * @property  {event} validate - Valida los datos para crear o actualiza una asignatura y
 *                               realiza la peticion correspondiente.
 */
var validator = $("#form_asignatura").validate({
	rules: {
    asignatura: {
      required: true
    },
    codigo: {
    	required: true
    },
    creditos: {
    	required: true,
    	digits:true,
    	min: 1
    }
	},
	messages: {
		asignatura:{
			required: "La asignatura es requerida"
    },
    codigo: {
     	required: "El código es requerido"
    },
    creditos:{
    	required: "El número de creditos es requerido",
    	digits: "El número de creditos tiene que ser un número entero",
    	min: "El número de creditos mínimos es 1"
    }
  },
  submitHandler: function(form) {
    if (new_asignatura) {
      json = {
        asignatura: $('#asignatura').val(),
        codigo: $('#codigo').val(),
        creditos: $('#creditos').val()
      }
      store_asignatura(json);
    }else{
      json = {
        id: asignatura_id,
        asignatura: $('#asignatura').val(),
        codigo: $('#codigo').val(),
        creditos: $('#creditos').val()
      }
      update_asignatura(json);
    }
  }
});

/**
 * Realiza la petición para almacenar una nueva asignatura.
 *
 * @async
 * @function  store_asignatura
 * @param     {json} json - JSON con la información a agregar.
 * @return    {null}
 */
function store_asignatura(json){
	$.post(public_path + 'admin/escolares/asignaturas',json,function(data){
		$('#table_asignaturas').DataTable().ajax.reload();
		swal({
		  type: 'success',
		  title: 'La asignatura ha sido guardada',
		  showConfirmButton: false,
		  timer: 1500
		});
    $('#modal_asignatura').modal('close');
	}).fail(function(data) {
    var errors = data.responseJSON.errors;
    for(var error in errors) {
      $("label[for='"+error+"']").attr('data-error',errors[error]);
      $("#"+error+"").addClass('invalid');
    }
	});
}

/**
 * Realiza la petición para actualizar una asignatura.
 *
 * @async
 * @function  update_asignatura
 * @param     {json} json - JSON con la información a actualizar
 * @return    {null}
 */
function update_asignatura(json){
  $.ajax({
    url: public_path + 'admin/escolares/asignaturas/'+asignatura_id,
    data: json,
    type: 'PUT',
    success: function(result) {
      $('#table_asignaturas').DataTable().ajax.reload();
      swal({
        type: 'success',
        title: 'La asignatura ha sido actualizada',
        showConfirmButton: false,
        timer: 1500
      });
      $('#modal_asignatura').modal('close');    
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