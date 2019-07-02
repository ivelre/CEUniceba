/**
 * ================================================================================================
 * @fileOverview  Carga el kardex del los alumnos registrados.
 *
 * @version       1.0
 *
 * @author        Julio Cesar Valle Rodríguez
 * @copyright     APPSA México
 * ================================================================================================
 */

load_kardex();

/**
 * Realiza una peticion ajax para obtener el karde de un alumno particula y lo carga en el DataTable.
 *
 * @async
 * @function  load_kardex
 * @return    {null}
 */
function load_kardex(){
	var table = $('#table_kardex').DataTable({
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
    ajax: public_path + 'admin/datatable/kardex?estudiante_id=' + $('#estudiante_id').val(),
    columns: [
        { data: 'codigo',  name: 'codigo' },
        { data: 'asignatura',	name: 'asignatura' },
        { data: 'calificacion',	name: 'calificacion' },
        { data: 'oportunidad',  name: 'oportunidad' },
        { data: 'semestre',  name: 'semestre' },
        { data: 'periodo',  name: 'periodo' },
        { data: 'anio',  name: 'anio' }        
    ],
    order: [ 4, 'asc' ]
  });
  $("select[name$='table_kardex_length']").val('10');
  $("select[name$='table_kardex_length']").material_select();
}