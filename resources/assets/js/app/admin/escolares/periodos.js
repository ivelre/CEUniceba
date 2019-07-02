/**
 * ==============================================================================================
 * @fileOverview  Carga la tabla de periodos y realiza las peticiones para elimianar un 
 *                periodo especifíco.
 *
 * @version       1.0
 *
 *
 * @author        Julio Cesar Valle Rodríguez
 * @copyright     APPSA México
 * ==============================================================================================
 */

load_periodos();

/**
 * Realiza una petición ajax para obtener los períodos y cargarlos en el DataTable.
 *
 * @async
 * @function  load_periodos
 * @return    {null}
 */
function load_periodos(){
	var table = $('#table_periodos').DataTable({
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
    ajax: public_path + 'admin/datatable/periodos',
    columns: [
        { data: 'periodo',			name: 'periodo' },
        { data: 'anio',	name: 'anio' },
        { data: 'reconocimiento_oficial',		name: 'reconocimiento_oficial' },
        { data: 'dges',   name: 'dges' },
        { data: 'fecha_reconocimiento',   name: 'fecha_reconocimiento' },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `
              <a href="` + public_path + `admin/escolares/periodos/fechas_examenes?periodo=`+data+`" 
                class="btn-floating btn-meddium waves-effect waves-light">
                <i class="material-icons circle blue">school</i>
              </a>`;
          },
          orderable: false, 
          searchable: false
        },
        {
          data: 'id',
          render: function ( data, type, row, meta ) {
            return `
              <a href="`+ public_path +`admin/escolares/periodos/`+data+`/edit" 
                class="btn-floating btn-meddium waves-effect waves-light">
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
              <a class="btn-floating btn-meddium waves-effect waves-light delete-periodo">
                <i class="material-icons circle red">close</i>
              </a>`;
          },
          orderable: false, 
          searchable: false
        }
    ],
    order: [ 1, 'desc' ]
  });
  delete_periodo('#table_periodos tbody',table);
  $("select[name$='table_periodos_length']").val('10');
  $("select[name$='table_periodos_length']").material_select();
}

/**
 * Recupera el ID de un período especifíco para ser eliminado.
 *
 * @function  delete_periodo
 * @param     {tbody} tbody - tbody del DataTable.
 * @param     {DataTable} table - Instancia del DataTable.
 * @return    {null}
 */
function delete_periodo (tbody,table){
  $(tbody).on('click','a.delete-periodo',function(){
    var data = table.row( $(this).parents('tr') ).data();
    swal({
      title: 'Desea eliminar el periodo?',
      text: "Esta acción no se puede revertir",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'Cancelar',
    }).then((result) => {
      if (result.value) {
        periodo_id= data.id;
        destroy_periodo(periodo_id);    
      }
    })
  });
}

/**
 * Realiza la petición para destruir un periodo
 *
 * @async
 * @function  destroy_periodo
 * @param     {integer} periodo_id - ID del Período
 * @return    {null}
 */
function destroy_periodo(periodo_id){
  $.ajax({
    url: public_path + 'admin/escolares/periodos/'+periodo_id,
    type: 'DELETE',
    success: function(result) {
      load_periodos();
      swal({
        type: 'success',
        title: 'El periodo ha sido eliminado',
        showConfirmButton: false,
        timer: 1500
      });
    },
    error: function (data) {
      swal({
        type: 'error',
        title: 'Error al eliminar el período',
        text: 'El período esta relacionado con uno o más datos'
      });  
    }
  });
}