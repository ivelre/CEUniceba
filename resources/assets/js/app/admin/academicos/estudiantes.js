/**
 * ============================================================================================
 * @fileOverview  Carga los estudiantes en el DataTable.
 *
 * @version       1.0
 * 
 * @author        Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
 * @copyright     APPSA México
 * ============================================================================================
 */

load_estudiantes();

/**
 * Realiza una peticion ajax y carga los estudiantes en el DataTable.
 *
 * @async
 * @function  load_estudiantes
 * @return    {null}
 */
function load_estudiantes(){
  var table = $('#table_estudiantes').DataTable({
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
    ajax: public_path+"admin/datatable/estudiantes",
    columns: [
        { data: 'matricula',  name: 'matricula' },
        { data: 'nombre',     name: 'nombre' },
        { data: 'grupo',      name: 'grupo' },
        { 
          data: 'email',
          render: function ( data, type, row, meta ) {
            
            var today = new Date();
            var birthday = new Date(row.fecha_nacimiento);
            var years = today.getFullYear() - birthday.getFullYear();
            birthday.setFullYear(today.getFullYear());
            if (today < birthday){ years--; }

            var data =
              row.direccion+`<br>`+
              row.telefono_personal+`<br>`+
              row.email+`<br>`+
              years+` años`;
            return data;
          }
        },
        {
          data: 'modalidad_estudiante',
          render: function ( data, type, row, meta ) {
            if(row.empresa_id == 1){
              var data =
                `<strong>Modalidad: </strong>`+row.modalidad_estudiante+`<br>`+
                `<strong>Enterado por: </strong>`+row.medio_enterado+`<br>`+
                `<strong>Trabajo: </strong>`+row.empresa+`<br>`;
            }else{
              var data =
                `<strong>Modalidad: </strong>`+row.modalidad_estudiante+`<br>`+
                `<strong>Enterado por: </strong>`+row.medio_enterado+`<br>`+
                `<strong>Trabajo: </strong>`+row.empresa+` (`+row.puesto+`)<br>`;  
            }
            return data;
          }
        },
        {
          data: 'estudiante_id',
          render: function ( data, type, row, meta ) {
            return `
              <a href="`+public_path+`admin/academicos/kardex?estudiante=`+data+`" 
                class="btn-floating btn-meddium waves-effect waves-light">
                <i class="material-icons circle yellow darken-4">format_list_numbered</i>
              </a>`;
          },
          orderable: false, 
          searchable: false
        },
        {
          data: 'estudiante_id',
          render: function ( data, type, row, meta ) {
            return `
              <a href="`+public_path+`admin/academicos/estudiantes/`+data+`/edit" 
                class="btn-floating btn-meddium waves-effect waves-light">
                <i class="material-icons circle green">mode_edit</i>
              </a>`;
          },
          orderable: false, 
          searchable: false
        }
    ]
  });
  $("select").val('10');
  $('select').material_select();
}