/**
 * ============================================================================================
 * @fileOverview  Carga las clases filtradas por periodos, niveles academicos y especialidades,
 *                además de eliminar la clase seleccionada.
 *
 * @version       1.0
 * 
 * @author        Julio Cesar Valle Rodriguez <jvalle@appsamx.com>
 * @copyright     APPSA México
 * ============================================================================================
 */

carga_especialidades();
var table = null;

/**
 * Carga las especialidades del nivel academico seleccionado, y posteriormente las clases en
 * el DataTable.
 * 
 * @async
 * @function  carga_especialidades
 * @return    {null}
 */
function carga_especialidades (){
  var nivel_academico_id = $('#nivel_academico_id').val();
  json = { nivel_academico_id: nivel_academico_id };
	$.get(public_path+'admin/select/especialidades_nivel/',json,function(data) {
		$('#especialidad_id').empty();
		for(i = 0; i < data.length; i++){
      if(i==0){
        $('#especialidad_id').append(`
          <option value="` + data[i].id + `" selected>` 
            + data[i].especialidad + ` (` + data[i].clave +
          `)</option>`);
      }else{
        $('#especialidad_id').append(`
          <option value="` + data[i].id + `">` 
            + data[i].especialidad + ` (` + data[i].clave +
          `)</option>`);  
      }
			
		}
		$('#especialidad_id').material_select();
    carga_clases();
    create_clase();
	})
	.fail(function() {
    swal("Error", "No existen especialidades", "error");

	});
}

/**
 * Llama una funcion para cambiar los valores del select con las las especialidades del 
 * nivel académico seleccionado.
 *
 * @event     change#nivel_academico_id
 * @type      {object}
 * @property  {event} change - Indica sí el valor del select ha cambiado.
 */
$('#nivel_academico_id').change(function(event){
  carga_especialidades();
});

/**
 * Llama las funciones para cargar las clases asignadas a la especialidad seleccionada en el
 * periodo indicado.
 * 
 * @event     change#especialidad_id
 * @type      {object}
 * @property  {event} change - Indica sí el valor del select ha cambiado.
 */
$('#especialidad_id').change(function(event){
  carga_clases();
  create_clase();
});

/**
 * Llama las funciones para cargar las clases asignadas en el periodo seleccionado de las 
 * especialidades cargadas.
 * 
 * @event     change#periodo_id
 * @type      {object}
 * @property  {event} change - Indica sí el valor del select ha cambiado.
 */
$('#periodo_id').change(function(){
  carga_clases();
  create_clase();
});


/**
 * Carga las clases de las especialidades en el periodo indicado a través de una peticion ajax y
 * son cargado en el DataTable.
 *
 * @async
 * @function  carga_clases
 * @return    {null}
 */
function carga_clases(){
  table = $('#table_clases').DataTable({
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
    ajax: public_path+'admin/datatable/clases?periodo_id='+$('#periodo_id').val()+'&especialidad_id='+$('#especialidad_id').val(),
    columns: [
        { data: 'codigo',     name: 'codigo' },
        { data: 'clase',      name: 'clase' },
        { data: 'asignatura', name: 'asignatura' },
        { data: 'docente',    name: 'docente' },
        {
          data: 'clase_id',
          render: function ( data, type, row, meta ) {
            return `
              <a href="`+public_path+`admin/academicos/grupos?clase=`+data+`" 
                class="btn-floating btn-meddium waves-effect waves-light">
                <i class="material-icons circle teal">group</i>
              </a>`;
          },
          orderable: false, 
          searchable: false
        },
        {
          data: 'clase_id',
          render: function ( data, type, row, meta ) {
            return `
              <a href="`+public_path+`admin/academicos/clases/`+data+`/edit" 
                class="btn-floating btn-meddium waves-effect waves-light">
                <i class="material-icons circle green">mode_edit</i>
              </a>`;
          },
          orderable: false, 
          searchable: false
        },
        {
          data: 'clase_id',
          render: function ( data, type, row, meta ) {
            return `
              <a class="btn-floating btn-meddium waves-effect waves-light delete-clase">
                <i class="material-icons circle red">close</i>
              </a>`;
          },
          orderable: false, 
          searchable: false
        }
    ]
  });
  $("select[name$='table_clases_length']").val('10');
  $("select[name$='table_clases_length']").material_select();
}

/**
 * Obtiene el ID de la clase para eliminarla.
 * 
 * @event     click#delete-clase
 * @type      {object}
 * @property  {event} click - Detecta si el botón fue presionado.
 */
$('#table_clases tbody').on('click','a.delete-clase',function(){
  var data = table.row( $(this).parents('tr') ).data();
  elimina_clase(data.clase_id);
});

/**
 * Muestra un sweet alert para confirmar eliminar la clase e invoca a la función para destruirla.
 *
 * @function  elimina_clase
 * @param     {integer} clase_id - ID de la clase a eliminar.
 * @return    {null}
 */
function elimina_clase(clase_id){
  swal({
    title: 'Desea eliminar la clase?',
    text: "Esta acción no se puede revertir",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si',
    cancelButtonText: 'Cancelar',
  }).then((result) => {
    if (result.value) {
      destroy_clase(clase_id);    
    }
  })
}

/**
 * Realiza una petición ajax para destruir la clase seleccionada. 
 *
 * @async
 * @function  destroy_clase
 * @param     {integer} clase_id - ID de la clase a eliminar.
 * @return    {null}
 */
function destroy_clase(clase_id){
  $.ajax({
    url: public_path+'admin/academicos/clases/'+clase_id,
    type: 'DELETE',
    success: function(result) {
      carga_clases();
      swal({
        type: 'success',
        title: 'La clase ha sido eliminada',
        showConfirmButton: false,
        timer: 1500
      });
    },
    error: function (data) {
      swal({
        type: 'error',
        title: 'Error al eliminar la clase',
        text: 'La clase esta relacionado con uno o más datos.'
      });  
    }
  });
}

/**
 * Modifica la URI del boton para crear un nueva clase.
 *
 * @function  create_clase
 * @return    {null}
 */
function create_clase(){
  $('#create_clase').attr('href',public_path+'admin/academicos/clases/create?periodo_id='+$('#periodo_id').val()+'&especialidad_id='+$('#especialidad_id').val());
}