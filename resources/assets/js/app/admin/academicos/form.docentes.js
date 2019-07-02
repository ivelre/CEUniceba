/**
 * ==================================================================================================
 * @fileOverview  Valida los campos del formulario para agregar o editar un docente, ademas de cargar
 *                los municipios y localidades seleccionadas en los selects.
 *
 * @version       1.0
 *
 * @author        Julio Cesar Valle Rodríguez
 * @copyright     APPSA México
 * ==================================================================================================
 */

$('#municipio_id').select2();
$('#localidad_id').select2();


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
 * Carga los municipios del estado seleccionado.
 *
 * @async
 * @function  load_municipios.
 * @param     {integer} municipio_id - ID del municipcio seleccionado.
 * @param     {integer} localidad_id - ID de la localidad seleccionada.
 * @return    {null}
 */
function load_municipios (municipio_id,localidad_id){
  var estado_id = $('#estado_id').val();
  json = {
    estado_id: estado_id
  };
	$.get(public_path+'admin/select/municipios/', json, function(data) {
		$('#municipio_id').empty();
		for(i = 0; i < data.length; i++){
      if(municipio_id != undefined){
        if(municipio_id == data[i].id ){
          $('#municipio_id').append(`
            <option value="` + data[i].id + `" selected>`
              + data[i].municipio +
            `</option>`);
        }else{
          $('#municipio_id').append(`
            <option value="` + data[i].id + `">`
              + data[i].municipio +
            `</option>`);
        }
      }else{
        $('#municipio_id').append(`
          <option value="` + data[i].id + `">`
            + data[i].municipio +
          `</option>`);
      }
		}
		$('#municipio_id').select2();
		$('#municipio_id').material_select();
    load_localidades(localidad_id);
	})
	.fail(function() {
		swal("Error", "Ocurrio un error al cargar las especialidades.", "error");
	});
}

/**
 * Carga las localidades del municipio seleccionado.
 *
 * @async
 * @function  load_localidades
 * @param     {integer} localidad_id - ID de la localidad seleccionada.
 * @return    {null}
 */
function load_localidades (localidad_id){
  var municipio_id = $('#municipio_id').val();
  json = {
    municipio_id: municipio_id
  };
	$.get(public_path + 'admin/select/localidades/', json, function(data) {
		$('#localidad_id').empty();
		for(i = 0; i < data.length; i++){
      if (localidad_id != undefined) {
        if(localidad_id == data[i].id){
          $('#localidad_id').append(`
            <option value="` + data[i].id + `" selected>`
              + data[i].localidad +
            `</option>`);
        }else{
          $('#localidad_id').append(`
            <option value="` + data[i].id + `">`
              + data[i].localidad +
            `</option>`);
        }
      }else{
        $('#localidad_id').append(`
          <option value="` + data[i].id + `">`
            + data[i].localidad + 
          `</option>`);
      }
			
		}
		$('#localidad_id').select2();
		$('#localidad_id').material_select();
	})
	.fail(function() {
		swal("Error", "Ocurrio un error al cargar las especialidades.", "error");
	});
}

/**
 * Llama a la funcion para cargar los municipios del estado.
 * 
 * @event     change#estado_id
 * @type      {object}
 * @property  {event} change - Indica si el valor del select ha cambiado.
 */
$('#estado_id').change(function(event){
	load_municipios();
});

/**
 * Llama a la funcion para cargar las localidades del municipio.
 * 
 * @event     change#municipio_id
 * @type      {object}
 * @property  {event} change - Indica si el valor del select ha cambiado.
 */
$('#municipio_id').change(function(event){
	load_localidades();
});

/**
 * Valida los datos del formulario con la libreria JQuery Validation
 * 
 * @event     validate#form_docente
 * @type      {object}
 * @property  {event} validate - Valida los inputs del formulario.
 */
var validator = $("#form_docente").validate({
	rules: {
    nombre: {
      required: true
    },
    apaterno: {
      required: true
    },
    amaterno: {
      required: true
    },
    curp: {
      required: true
    },
    fecha_nacimiento: {
      required: true
    },
    estado_civil_id: {
      required: true,
      digits: true,
      min: 1
    },
    sexo: {
      required: true,
      range: ['F','M','O']
    },
    nacionalidad_id: {
      required: true,
      digits: true,
      min: 1
    },
    calle_numero: {
      required: true
    },
    colonia: {
      required: true
    },
    codigo_postal: {
      required: true,
      digits: true
    },
    localidad_id: {
      required: true,
      digits: true,
      min: 1
    },
    codigo: {
      required: true
    },
    rfc: {
      required: true
    },
    titulo_id: {
      required: true,
      digits: true,
      min: 1
    }
	},
	messages: {
		nombre: {
      required: "El nombre es requerido."
    },
    apaterno: {
      required: "El apellido paterno es requerido."
    },
    amaterno: {
      required: "El apellido materno es requerido."
    },
    curp: {
      required: "El CURP es requerido."
    },
    fecha_nacimiento: {
      required: "La fecha de nacimiento es requerido."
    },
    estado_civil_id: {
      required: "El estado civil es requerido.",
      digits: "El estado civil tiene que ser un número entero.",
      min: "El estado civil mínimo es 1."
    },
    sexo: {
      required: "El sexo es requerido.",
      range: "Los valores solo pueden ser ['F','M','O']."
    },
    nacionalidad_id: {
      required: "La nacionalidad es requerida.",
      digits: "La nacionalidad tiene que ser un número entero.",
      min: "La nacionalidad mínimo es 1."
    },
    calle_numero: {
      required: "La calle y número es requerida."
    },
    colonia: {
      required: "La colonia es requerida."
    },
    codigo_postal: {
      required: "El código postal es requerido.",
      digits: "El código postal tiene que ser un número."
    },
    localidad_id: {
      required: "La localidad es requerida.",
      digits: "La localidad tiene que ser un número entero.",
      min: "La localidad minima es 1."
    },
    codigo: {
      required: "El código es requerido."
    },
    rfc: {
      required: "El RFC es requerido."
    },
    titulo_id: {
      required: "El título es requerido.",
      digits: "El título tiene que ser un número entero.",
      min: "El título mínimo es 1."
    }
  }
});