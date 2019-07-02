/**
 * ======================================================================================================
 * @fileOverview  Carga la plantilla de profesores de la institución y elimina a un docente seleccionado.
 *
 * @version       1.0
 * 
 * @author        Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
 * @copyright     APPSA México
 * ======================================================================================================
 */

load_docentes();

/**
 * Realiza una peticion ajax y carga la lista de profesores en el DataTables.
 *
 * @async
 * @function  load_docentes
 * @return    {null}
 */
function load_docentes(){
	var table = $('#table_docentes').DataTable({
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
    ajax: public_path+'admin/datatable/docentes',
    columns: [
        { data: 'codigo',			    name: 'codigo' },
        { data: 'nombre',	        name: 'nombre' },
        { data: 'apaterno',       name: 'apaterno' },
        { data: 'amaterno',       name: 'amaterno' },
        { data: 'edad',           name: 'edad' },
        { data: 'telefono_casa',  name: 'telefono_casa' },
        { data: 'rfc',            name: 'rfc' },
        { data: 'titulo',		       name: 'titulo' },
        {
          data: 'docente_id',
          render: function ( data, type, row, meta ) {
            return `
              <a href="`+public_path+`admin/academicos/docentes/`+data+`/edit" 
                class="btn-floating btn-meddium waves-effect waves-light">
                <i class="material-icons circle green">mode_edit</i>
              </a>`;
          },
          orderable: false, 
          searchable: false
        },
        {
          data: 'docente_id',
          render: function ( data, type, row, meta ) {
            return `
              <a class="btn-floating btn-meddium waves-effect waves-light delete-docente">
                <i class="material-icons circle red">close</i>
              </a>`;
          },
          orderable: false, 
          searchable: false
        }
    ]
  });
  $("select[name$='table_docentes_length']").val('10');
  $("select[name$='table_docentes_length']").material_select();
  delete_docente('#table_docentes tbody',table);
}

/**
 * Obtiene el ID del docente y pregunta con un sweet alert si desea eliminar al docente.
 *
 * @function  delete_docente
 * @param     {tbody} tbody - tbody del DataTable
 * @param     {DataTable} table - Instancia con la información del DataTable.
 * @return    {null}
 */
function delete_docente (tbody,table){
  $(tbody).on('click','a.delete-docente',function(){
    var data = table.row( $(this).parents('tr') ).data();
    swal({
      title: 'Desea eliminar el docente?',
      text: "Esta acción no se puede revertir",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si',
      cancelButtonText: 'Cancelar',
    }).then((result) => {
      if (result.value) {
        docente_id= data.docente_id;
        destroy_docente(docente_id);    
      }
    })
  });
}

/**
 * Realiza una petición ajax para detruir el docente.
 *
 * @async
 * @function  destroy_docente
 * @param     {integer} docente_id - ID del docente
 * @return    {null}
 */
function destroy_docente(docente_id){
  $.ajax({
    url: public_path+'admin/academicos/docentes/'+docente_id,
    type: 'DELETE',
    success: function(result) {
      load_docentes();
      swal({
        type: 'success',
        title: 'El docente ha sido eliminado',
        showConfirmButton: false,
        timer: 1500
      });
    },
    error: function (data) {
      swal({
        type: 'error',
        title: 'Error al eliminar el docente',
        text: 'El docente esta relacionado con uno o más datos'
      });  
    }
  });
}