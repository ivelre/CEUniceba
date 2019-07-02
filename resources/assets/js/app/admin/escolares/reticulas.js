/**
 * =================================================================================================
 * @fileOverview  Carga las reticulas de un plan de estudios especifico, adema de sus requisitos y 
 *                permitir agregar nuevas materias a la reticula y dependencias.
 *
 * @version        1.0
 *
 * @author        Julio Cesar Valle Rodríguez
 * @copyright     APPSA México
 * =================================================================================================
 */
load_especialidades();

var periodo_reticula = null;
var plan_especialidad_id = null;
var asignatura_id = null;
var reticula_id = null;
var requisito_id = null;

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
 * Carga las especialidades del nivel académico seleccionado.
 * 
 * @event     on:click#btn_tab_reticulas
 * @type      {object}
 * @property  {event} on:click - Detecta sí se hizo click en el tab para cambiar del tab.
 */
$('#btn_tab_reticulas').on('click',function(event){
  load_especialidades();
});


/**
 * Realiza una petición ajax para obtener las especialidades de un nivel académico especifico
 * y cargarlos a un select
 *
 * @async
 * @function  load_especialidades 
 * @return    {null}
 */
function load_especialidades (){
  json = {
    nivel_academico_id: $('#nivel_academico').val()
  }
	$.get(public_path + 'admin/select/especialidades_nivel', json, function(data) {
		$('#especialidad_id').empty();
		for(i = 0; i < data.length; i++){
			$('#especialidad_id').append('<option value="' + data[i].id + '">' + data[i].especialidad + ' (' + data[i].clave +')</option>');
		}
		$('#especialidad_id').material_select();
		load_planes();
	})
	.fail(function() {
    $('#name_reticula').text('');
		$('#section_reticula').empty();
    swal("Error", "No existen especialidades", "error");

	});
}

/**
 * Realiza una petición ajax para obtener los planes de estudio de las especialidades y cargarlos
 * en un select.
 *
 * @async
 * @function  load_planes
 * @return    {null}
 */
function load_planes (){
  json = {
    especialidad_id: $('#especialidad_id').val()
  };
  $.get(public_path + 'admin/select/planes_especialidades',json,function(data) {
    $('#plan_especialidad_id').empty();
    for(i = 0; i < data.length; i++){
      $('#plan_especialidad_id').append('<option value="' + data[i].id + '">' + data[i].plan_especialidad + '</option>');
    }
    $('#plan_especialidad_id').material_select();
    load_reticula ();
  })
  .fail(function() {
    $('#name_reticula').text('');
    $('#section_reticula').empty();
    swal("Error", "No existen planes de estudio", "error");
  });
}

/**
 * Llama a la función para cargar las especialidaes.
 * 
 * @event     change#nivel_academico
 * @type      {object}
 * @property  {event} change - Detecta el cambio en el nivel académico
 */
$('#nivel_academico').change(function(){
	load_especialidades();
});

/**
 * Llama a la funcíón para vargar los planes de estudio.
 * 
 * @event     change#especialidad_id
 * @type      {object}
 * @property  {event} change - Detecta el cambio en la especialidad.
 */
$('#especialidad_id').change(function(){
	load_planes();
});

/**
 * Llama a la función para cargar la reticula del plan de estudios.
 * 
 * @event     change#plan_especialidad_id
 * @type      {object}
 * @property  {event} change - Detecta el cambio en plan de estudios.
 */
$('#plan_especialidad_id').change(function(){
  load_reticula();
});

/**
 * Realiza una petición ajax para obtener los datos del plan de estudios y cargar toda
 * la reticula.
 * 
 * @async
 * @function  load_reticula
 * @return    {null}
 */
function load_reticula (){
	plan_especialidad_id = $('#plan_especialidad_id').val();
	$.get(public_path + 'admin/escolares/planes_especialidades/' + plan_especialidad_id,function(data){
		var plan_especialidad = data;		
		$('#section_reticula').empty();
		for (var i = 1; i <= plan_especialidad.periodos; i++) {
			$('#section_reticula').append(`
				<div class="row">
					<h5>Período `+i+`:</h5>
					<div class="divider"></div><br>
					<div class="row">
						<div id="periodo_`+i+`" class="col s12">
						</div>
					</div>
				</div>
			`);
			asignaturas_periodo(i);
		}
		$('#name_reticula').text('Retícula de '+ $('#nivel_academico :selected').text() + ' en ' + $('#especialidad_id :selected').text()+' ('+$('#plan_especialidad_id :selected').text()+')');
	}).fail(function() {
    $('#name_reticula').text('');
    $('#section_reticula').empty();
		swal("Error", "No existen un plan de estudio", "error");
	});
}

/**
 * Realiza una petición ajax para recuperar las asignaturas de un período especifíco de la retícula,
 * y cargarlas en el DOM.
 * 
 * @param  {integer} periodo - Periodo que se quiere cargar.
 * @return {string} - El HTML con las asignaturas por período
 */
function asignaturas_periodo (periodo){
	json = {
		plan_especialidad_id: plan_especialidad_id,
		periodo_reticula: periodo
	};
	$('#periodo_'+periodo+'').empty();
	var asignaturas_periodo = ``;
	$.get(public_path + 'admin/escolares/reticulas/asignaturas',json,function(data){
		var asignaturas = data;
		for (var i = 0; i < asignaturas.length; i++) {
			var asignatura = asignaturas[i];
			asignaturas_periodo += print_card_reticula(asignatura,periodo);
		}
		asignaturas_periodo += new_card_reticula(periodo);
		$('#periodo_'+periodo+'').append(asignaturas_periodo);
		btn_add_reticula(periodo);
		for (var i = 0; i < asignaturas.length; i++) {
			var asignatura = asignaturas[i];
			btn_delete_reticula(asignatura.reticula);
      if(periodo>1){
        btn_requisito_asignatura(asignatura.reticula);
      }
		}
	}).fail(function() {
		swal("Error", "Ocurrio un error al cargar las asignaturas.", "error");
	});
}

/**
 * Imprimer un string con la estructura de una CARD para agregar al DOM.
 * 
 * @param  {asignatura} asignatura  - JSON con los datos de la asignatura.
 * @param  {integer} periodo        - Período al que pertenece
 * @return {string}                 - String con el HTML par agregar al DOM.
 */
function print_card_reticula(asignatura,periodo){
  var card =``; 
  if (periodo>1){
    card = `<div class="col s12 m6 l4 xl3">
      <div class="card xsmall">
        <div class="card-content">
          <strong>`+asignatura.asignatura+`</strong>
          <div class="divider"></div>
          Código: `+asignatura.codigo+`<br>
          Créditos: `+asignatura.creditos+`<br>
          <a 
            id="delete_reticula_`+asignatura.reticula+`"
            class="btn-floating halfway-fab waves-effect waves-light red delete-asignatura"  
            style="position: absolute; left:94%; top:-10%;"
            reticula="`+asignatura.reticula+`"
            periodo_reticula="`+periodo+`"
            asignatura="`+asignatura.asignatura+`"
          ><i class="material-icons">close</i></a>
          <a
            id="requisito_reticula_`+asignatura.reticula+`"
            class="btn-floating halfway-fab waves-effect waves-light blue delete-asignatura" 
            style="position: absolute; left:78%; top:-10%;"
            reticula="`+asignatura.reticula+`"
            asignatura="`+asignatura.asignatura+`"
          ><i class="material-icons">timeline</i></a>
        </div>
       </div>
    </div>`;  
  }else{
    card = `<div class="col s12 m6 l4 xl3">
      <div class="card xsmall">
        <div class="card-content">
          <strong>`+asignatura.asignatura+`</strong>
          <div class="divider"></div>
          Código: `+asignatura.codigo+`<br>
          Créditos: `+asignatura.creditos+`<br>
          <a 
            id="delete_reticula_`+asignatura.reticula+`"
            class="btn-floating halfway-fab waves-effect waves-light red delete-asignatura"  
            style="position: absolute; left:94%; top:-10%;"
            reticula="`+asignatura.reticula+`"
            periodo_reticula="`+periodo+`"
            asignatura="`+asignatura.asignatura+`"
          ><i class="material-icons">close</i></a>
        </div>
       </div>
    </div>`;  
  }
  return card;
}

/**
 * Imprime un string con la estructura de una CARD para agregar una nueva asignatura a la 
 * retícula.
 * 
 * @param  {integer} periodo - Período al que pertenece
 * @return {string}          - String con el HTML para agregar al DOM
 */
function new_card_reticula(periodo){
	var card = 
	`<div class="col s12 m6 l4 xl3">
		<div class="card xsmall valign-wrapper">
			<div class="card-content" style="width: 100%;">
        <div class="valign-wrapper">
				  <h5 class="center-align" style="width: 100%;">Nueva Asignatura</h5>
				</div>
				<a 
					id="add_reticula_`+periodo+`"
					class="btn-floating halfway-fab waves-effect waves-light green" 
					style="position: absolute; left:78%; top:-10%;"
					periodo_reticula="`+periodo+`" >
					<i class="material-icons">add</i>
				</a>
      </div>
     </div>
  </div>`;
  return card;
}

/**
 * Función para inicializar el botón para agregar una asignatura a la reticula.
 *
 * @function  btn_add_reticula
 * @param     {integer} periodo - Período al que se va a agregar.
 * @return    {null}
 */
function btn_add_reticula(periodo){
	$('#add_reticula_'+periodo).on('click', function(event) {
		periodo_reticula = $(this).attr('periodo_reticula');
		create_reticula();
	});
}

/**
 * Función para inicializar el botón para eliminar una asignatura de la reticula.
 *
 * @function  btn_delete_reticula
 * @param     {reticula} reticula - Asignatura de la reticula
 * @return    {null}
 */
function btn_delete_reticula(reticula){
  $(`#delete_reticula_`+reticula+``).on('click', function() {
    periodo_reticula = $(this).attr('periodo_reticula');
    reticula_id = $(this).attr('reticula');
    asignatura = $(this).attr('asignatura');
    delete_reticula(asignatura);
  });
}

/**
 * Función para inicializar el botón para agregar un requisito a la reticula
 *
 * @function  btn_requisito_asignatura
 * @param     {reticula} reticula - Asignatura de la reticula
 * @return    {null}
 */
function btn_requisito_asignatura(reticula){
  $(`#requisito_reticula_`+reticula+``).on('click', function() {
    reticula_id = $(this).attr('reticula');
    asignatura = $(this).attr('asignatura');
    create_requisito(asignatura);
  });
}

/**
 * Carga las asignaturas que se pueden agregar a la reticula e inicializa el modal.
 *
 * @function  create_reticula
 * @return    {null}
 */
function create_reticula(){
  load_asignaturas_reticula();
  $('#title_modal_reticula').text('Agregar asignatura al período '+periodo_reticula);
  $('#modal_reticula').modal('open');
}

/**
 * Realiza una petición ajax para obtener las asignaturas que se pueden agregar a la reticula 
 * y las carga en un select2.
 *
 * @function  load_asignaturas_reticula
 * @return    {null}
 */
function load_asignaturas_reticula(){
  json = {
    plan_especialidad_id: plan_especialidad_id
  };
  $.get(public_path + 'admin/select/asignaturas_reticula', json, function(data) {
    $('#select_asignaturas').empty();
    for(i = 0; i < data.length; i++){
      $('#select_asignaturas').append('<option value="' + data[i].id + '">' + data[i].asignatura + ' (' + data[i].codigo +')</option>');
    }
    $('#select_asignaturas').select2();
    $("#select_asignaturas").material_select();
  })
  .fail(function() {
    swal("Error", "Ocurrio un error al cargar las asignaturas.", "error");
  });
}

/**
 * Valida los datos del form_reticula usando la libreria JQuery Validator y llama el la función para
 * almacenarla.
 * 
 * @event     validate#form_reticula
 * @type      {object}
 * @property  {event} validate - Valida los datos para agregar una nueva asignatura a la reticula.
 */
var validator = $("#form_reticula").validate({
	rules: {
    select_asignaturas: {
      required: true,
      digits: true,
    	min: 1
    }
	},
	messages: {
    select_asignaturas:{
    	required:  "La asginatura es requerida",
    	digits: "La asignatura tiene que ser un número entero",
    	min: "La asignatura tiene que ser mínimo 1"
    }
  },
  submitHandler: function(form) {
    json = {
      asignatura_id: $('#select_asignaturas').val(),
      plan_especialidad_id: plan_especialidad_id,
      periodo_reticula: periodo_reticula
    }
    store_reticula(json);
  }
});

/**
 * Realiza una petición para almacenar una asignatura en la reticula.
 *
 * @async
 * @function  store_reticula
 * @param     {json} json - JSON con la información a almacenar,
 * @return    {null}
 */
function store_reticula(json){
  $.post(public_path + 'admin/escolares/reticulas', json, function(data){
  	asignaturas_periodo(periodo_reticula);
    periodo_reticula = null;
    asignatura_id = null;
  	$('#modal_reticula').modal('close');
    swal({
      type: 'success',
      title: 'La asignatura ha sido agregada',
      showConfirmButton: false,
      timer: 1500
    });
  }).fail(function(data) {
    var errors = data.responseJSON.errors;
    for(var error in errors) {
      $("label[for='"+error+"']").attr('data-error',errors[error]);
      $("#"+error+"").addClass('invalid');
    }
  });
}

/**
 * Verifica si desea eliminar la asignatura de la reticula e invoca a la función para hacerlo.
 *
 * @function  delete_reticula
 * @param     {string} asignatura - Nombre de la asignatura
 * @return    {null}
 */
function delete_reticula(asignatura){
  swal({
    title: 'Desea eliminar '+asignatura+'',
    text: "Esta acción no se puede revertir",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si',
    cancelButtonText: 'Cancelar',
  }).then((result) => {
    if (result.value) {
      destroy_reticula();
    }
  });
}

/**
 * Realiza una petición para eliminar la asignatura de la reticula.
 *
 * @async
 * @function  destroy_reticula 
 * @return    {null}
 */
function destroy_reticula(){
  $.ajax({
    url: public_path + 'admin/escolares/reticulas/'+reticula_id,
    type: 'DELETE',
    success: function(result) {      
      asignaturas_periodo(periodo_reticula);
      swal({
        type: 'success',
        title: 'La asignatura ha sido eliminada',
        showConfirmButton: false,
        timer: 1500
      });
      periodo_reticula = null;
      reticula_id = null;
    },
    error: function (data) {
      swal({
        type: 'error',
        title: 'Error al eliminar la asignatura',
        text: 'La asignatura debe tener dependencias o clases asignadas'
      });  
    }
  });
}

//Requisitos

/**
 * Llama la función que carga las materias que pueden agregarse como requisitos e inicializa
 * el modal.
 *
 * @function  create_requisito
 * @param     {asignatura} asignatura - Nombre de la asignatura.
 * @return    {null}
 */
function create_requisito(asignatura){
  load_asignaturas_requisito();
  $('#title_modal_requisito').text('Requisitos para '+asignatura);
  $('#modal_requisito').modal('open');
}

/**
 * Realiza una peticion ajax para cargar las asignaturas que pueden ser requisitos en un select2.
 *
 * @async
 * @function  load_asignaturas_requisito 
 * @return    {null}
 */
function load_asignaturas_requisito(){
  json = {
    reticula_id: reticula_id
  };
  $.get(public_path + 'admin/select/asignaturas_requisito',json,function(data) {
    $('#select_requisitos').empty();
    for(i = 0; i < data.length; i++){
      $('#select_requisitos').append('<option value="' + data[i].reticula + '">' + data[i].asignatura + ' (' + data[i].codigo +')</option>');
    }
    $('#select_requisitos').select2();
    $("#select_requisitos").material_select();
  })
  .fail(function() {
    swal("Error", "Ocurrio un error al cargar las asignaturas.", "error");
  });
  asignaturas_requisito();
}

/**
 * Realiza una petición ajax para cargar las asignaturas que son requisitos de la 
 * asignatura seleccionada
 *
 * @async
 * @function  asignaturas_requisito
 * @return    {[type]} [description]
 */
function asignaturas_requisito (){
  $('#requisitos_reticula').empty();
  var asignaturas_requisito = ``;
  $.get(public_path + 'admin/escolares/reticulas/asignaturas_requisito/' + reticula_id, function(data){
    var asignaturas = data;
    for (var i = 0; i < asignaturas.length; i++) {
      var asignatura = asignaturas[i];
      asignaturas_requisito += print_card_requisito(asignatura);
    }
    $('#requisitos_reticula').append(asignaturas_requisito);
    for (var i = 0; i < asignaturas.length; i++) {
      var asignatura = asignaturas[i];
      btn_delete_requisito(asignatura.requisito);
    }
  }).fail(function() {
    swal("Error", "Ocurrio un error al cargar las asignaturas.", "error");
  });

}

/**
 * Genera un string con la estructura de una CARD para agregar al DOM con la información de 
 * la asignatura requisito.
 * 
 * @param  {asignatura} asignatura - Asignatura requisito.
 * @return {string} - String con la estructura CARD.
 */
function print_card_requisito(asignatura){
  var card = 
  `<div class="col s12 l6">
    <div class="card xsmall">
      <div class="card-content">
        <strong>`+asignatura.asignatura+`</strong>
        <div class="divider"></div>
        Código: `+asignatura.codigo+`<br>
        Créditos: `+asignatura.creditos+`<br>
        Periodo: `+asignatura.periodo_reticula+`<br>
        <a 
          id="delete_requisito_`+asignatura.requisito+`"
          class="btn-floating halfway-fab waves-effect waves-light red delete-asignatura"  
          style="position: absolute; left:94%; top:-10%;"
          requisito="`+asignatura.requisito+`"
          asignatura="`+asignatura.asignatura+`"
        ><i class="material-icons">close</i></a>
      </div>
     </div>
  </div>`;
  return card;
}


/**
 * Función para inicializa el botón para eliminar una asignatura requisito.
 * 
 * @param  {integer} requisito - ID del requisito.
 * @return {null}
 */
function btn_delete_requisito(requisito){
  $(`#delete_requisito_`+requisito+``).on('click', function() {
    requisito_id = $(this).attr('requisito');
    asignatura = $(this).attr('asignatura');
    delete_requisito(asignatura);
  });
}

/**
 * Valida el form_requisito con la libreria JQuery Validator y llama a la función para
 * almacenarlo.
 * 
 * @event     validate#form_requisito
 * @type      {object}
 * @property  {event} validate - Valida los datos al agregar un requisito a la asignatura
 */
var validator = $("#form_requisito").validate({
  rules: {
    select_requisitos: {
      required: true,
      digits: true,
      min: 1
    }
  },
  messages: {
    select_requisitos:{
      required:  "La asginatura es requerida",
      digits: "La asignatura tiene que ser un número entero",
      min: "La asignatura tiene que ser mínimo 1"
    }
  },
  submitHandler: function(form) {
    json = {
      reticula_id: reticula_id,
      reticula_requisito_id: $('#select_requisitos').val()
    }
    store_requisito(json);
  }
});

/**
 * Reliza una petición para almacenar un nuevo requisito
 *
 * @async
 * @function  store_requisito
 * @param     {json} json - JSON con la información a almacenar.
 * @return    {null}
 */
function store_requisito(json){
  $.post(public_path + 'admin/escolares/requisitos_reticulas', json, function(data){
    load_asignaturas_requisito();
    swal({
      type: 'success',
      title: 'La asignatura ha sido agregada',
      showConfirmButton: false,
      timer: 1500
    });
  }).fail(function(data) {
    var errors = data.responseJSON.errors;
    for(var error in errors) {
      $("label[for='"+error+"']").attr('data-error',errors[error]);
      $("#"+error+"").addClass('invalid');
    }
  });
}

/**
 * Confirmación para eliminar un requisito de la asignatura.
 *
 * @function  delete_requisito
 * @param     {string} asignatura - Nombre de la asignatura.
 * @return    {null}
 */
function delete_requisito(asignatura){
  swal({
    title: 'Desea eliminar ' + asignatura + '',
    text: "Esta acción no se puede revertir",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si',
    cancelButtonText: 'Cancelar',
  }).then((result) => {
    if (result.value) {
      destroy_requisito();
    }
  });
}

/**
 * Realiza una petición para destruir un requisito de una asignatura.
 *
 * @async
 * @function  destroy_requisito
 * @return    {null}
 */
function destroy_requisito(){
  $.ajax({
    url: public_path + 'admin/escolares/requisitos_reticulas/' + requisito_id,
    type: 'DELETE',
    success: function(result) {      
      load_asignaturas_requisito();
      swal({
        type: 'success',
        title: 'La asignatura ha sido eliminada',
        showConfirmButton: false,
        timer: 1500
      });
      requisito_id = null;
    },
    error: function (data) {
      swal({
        type: 'error',
        title: 'Error al eliminar la asignatura',
        text: 'La asignatura debe tener dependencias o clases asignadas'
      });  
    }
  });
}