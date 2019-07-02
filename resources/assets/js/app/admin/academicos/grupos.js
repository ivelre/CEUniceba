/**
 * =================================================================================================
 * @fileOverview  Muetra la tabla con alumnos agregados a una clase, ademas de agregarlo o retirtarlo.
 *
 * @version       1.0
 *
 * @author        Julio Cesar Valle Rodriguez <jvalle@appsamx.com>
 * @copyright     APPSA México
 * =================================================================================================
 */

var save = false;
load_grupo();

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
 * Realiza una peticion ajax para cargar los alumnos agregados al grupo en un DataTable.
 *
 * @async
 * @function  load_grupo
 * @return    {null}
 */
function load_grupo(){
	var table = $('#table_grupo').DataTable({
  	language: {
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
    ajax: public_path + 'admin/datatable/grupos?clase='+$('#clase_id').val(),
    columns: [
        { data: 'matricula',    name: 'matricula' },
        { data: 'nombre',	      name: 'nombre' },
        { data: 'semestre',	    name: 'semestre' },
        { data: 'oportunidad',  name: 'oportunidad' },
        {
          data: 'grupo_id',
          render: function ( data, type, row, meta ) {
            return `
              <a class="btn-floating btn-meddium waves-effect waves-light delete-grupo">
                <i class="material-icons circle red">close</i>
              </a>`;
          },
          orderable: false, 
          searchable: false
        }
    ],
    order: [ 0, 'asc' ]
  });
  $("select[name$='table_grupo_length']").val('10');
  $("select[name$='table_grupo_length']").material_select();
  btn_delete_grupo('#table_grupo tbody',table);
}

/**
 * Reliza una petición ajax para buscar los datos el estudiante a agregar al grupo.
 * 
 * @event     bind:enterKey#matricula
 * @type      {object}
 * @property  {event} bind:enterKey - Detecta la tecla enter dentro del input #matricula.
 */
$('#matricula').bind("enterKey",function(event){
  if(!save){
    json = {
      requisitos: 1,
      matricula: $('#matricula').val(),
      especialidad_id: $('#especialidad_id').val(),
      clase_id: $('#clase_id').val()
    };
    $.get(public_path + 'admin/academicos/estudiante', json, function(data) {
      if (!data.error) {
        $('#estudiante_id').val(data.estudiante_id);
        $('#nombre').val(data.nombre);
        $('#semestre').val(data.semestre);
        $('#oportunidad').val(data.oportunidad);
        $('#oportunidad_id').val(data.oportunidad_id);
        Materialize.updateTextFields();
        save = true;
      }else{
        $('#nombre').val(data.error);
        $('#semestre').val(data.error);
        $('#oportunidad').val(data.error);
        $('#estudiante_id').val('');
        $('#oportunidad_id').val('');
        Materialize.updateTextFields();
      }
    })
    .fail(function(error) {
      console.log(error);
    });   
  }
  
});

/**
 * Detecta el evento de presionar una tecla y ejecuta una función.
 * 
 * @event     keyup#matricula
 * @type      {object}
 * @property  {event} keyup - Detecta la presión de cualquier tecla en el input.
 */
$('#matricula').keyup(function(event){
    if(event.keyCode == 13){
      $(this).trigger("enterKey");
    }
});

/**
 * Valida que los datos del form_grupo sean correctos con JQuery Validator.
 * 
 * @event     validate#form_grupo
 * @type      {object}
 * @property  {event} validate - Valida que los datos ingresado sean correctos.
 */
var validator = $("#form_grupo").validate({
  rules: {
    clase_id:{
      required: true,
      digits:true,
      min: 1
    },
    estudiante_id: {
      required: true,
      digits:true,
      min: 1
    },
    oportunidad_id:{
      required: true,
      digits:true,
      min: 1
    }
  },
  messages: {
    clase_id:{
      required: "La clase es requerida.",
      digits: "La clase tiene que ser un número entero.",
      min: "La clase mínima es 1."
    },
    estudiante_id: {
      required: "El estudiante es requerido.",
      digits: "El estudiante tiene que ser un número entero.",
      min: "El estudiante mínimos es 1."
    },
    oportunidad_id:{
      required: "La oportunidad es requerida.",
      digits: "La oportunidad tiene que ser un número entero.",
      min: "La oportunidad mínima es 1."
    }
  },
  submitHandler: function(form) {
    if (save){
      json = {
        requisitos: 1,
        clase_id: $('#clase_id').val(),
        estudiante_id: $('#estudiante_id').val(),
        oportunidad_id: $('#oportunidad_id').val()
      }
      store_grupo(json);
    }
  }
});

/**
 * Realiza una petición ajax para agregar un nuevo estudiante al grupo.
 *
 * @async
 * @function   store_grupo
 * @param      {json} json - JSON con los datos a almacenar.
 * @return     {null}
 */
function store_grupo(json){
  $.post(public_path + 'admin/academicos/grupos', json, function(data){
    $('#table_grupo').DataTable().ajax.reload();
    $('#matricula').val('');
    $('#nombre').val('');
    $('#semestre').val('');
    $('#oportunidad').val('');
    $('#estudiante_id').val('');
    $('#oportunidad_id').val('');
    Materialize.updateTextFields();
    swal({
      type: 'success',
      title: 'El alumno ha sido agregado',
      showConfirmButton: false,
      timer: 1500
    });
    save = false;
  }).fail(function(data) {
    if (data.responseJSON.errors != undefined) {
      var errors = data.responseJSON.errors;  
      for(var error in errors) {
        $("label[for='"+error+"']").attr('data-error',errors[error]);
        $("#"+error+"").addClass('invalid');
      }
      if (errors.requisitos) {
        swal({
          type: 'error',
          title: 'Error',
          text: errors.requisitos[0],
        });
      }

    }
  });
}

/**
 * Asignacion del evento on:click para eliminar un estudiante del grupo.
 *
 * @function  btn_delete_grupo
 * @param     {tbody} - tbody del DataTable.
 * @param     {DataTable} table - Datos del DataTable.
 * @return    {null}
 */
function btn_delete_grupo (tbody,table){
  $(tbody).on('click','a.delete-grupo',function(){
    var data = table.row( $(this).parents('tr') ).data();
    swal({
      title: 'Desea eliminar al estudiante del grupo?',
      text: "Esta acción no se puede revertir",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'Cancelar',
    }).then((result) => {
      if (result.value) {
        grupo_id = data.grupo_id;
        destroy_grupo(grupo_id);    
      }
    })
  });
}

/**
 * Realiza una petición ajax para elimiar un estudiante del grupo.
 *
 * @async
 * @function  destroy_grupo
 * @param     {integer} grupo_id - ID del registro del grupo a eliminar.
 * @return    {null}
 */
function destroy_grupo(grupo_id){
  $.ajax({
    url: public_path + 'admin/academicos/grupos/'+grupo_id,
    type: 'DELETE',
    success: function(result) {
      $('#table_grupo').DataTable().ajax.reload();
      swal({
        type: 'success',
        title: 'El estudiante ha sido eliminado',
        showConfirmButton: false,
        timer: 1500
      });
    },
    error: function (data) {
      swal({
        type: 'error',
        title: 'Error al eliminar el estudiante',
        text: 'El estudiante esta relacionado con uno o más datos'
      });  
    }
  });
}