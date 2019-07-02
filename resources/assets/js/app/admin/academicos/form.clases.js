/**
 * ==========================================================================================
 * @fileOverview  Carga y valida los campos input del formulario para crear una nueva clase.
 *
 * @version       1.0
 *
 * @author        Julio Cesar Valle Rodriguez <jvalle@appsamx.com>
 * @copyright     APPSA México
 * ==========================================================================================
 */

$('#asignatura_id').select2();
$('#docente_id').select2();
checked_dia();
inputs_horarios();

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
 * Carga el evento on:click en los chekbox de los horarios para habilitar los timepicker
 *
 * @function  checked_dia
 * @return    {null}
 */
function checked_dia(){ 
	for (var i = 0; i < 6; i++) {
		$('#dia_'+i+'').on("click",function(event){
			if($(this).is(':checked')){
				var index = $(this).attr('index');
				$('#hora_entrada_'+index).prop("disabled", false);
				$('#hora_salida_'+index).prop("disabled", false);
			}else{
				var index = $(this).attr('index');
				$('#hora_entrada_'+index).val('');
				$('#hora_salida_'+index).val('');
				$('#hora_entrada_'+index).prop("disabled", true);
				$('#hora_salida_'+index).prop("disabled", true);
				$('#hora_entrada_'+index).removeClass("invalid");
				$('#hora_salida_'+index).removeClass("invalid");
			}
		});
	}
}

/**
 * Carga el evento change en los inputs timepicker para eliminar la clase invalid.
 *
 * @function inputs_horarios
 * @return {null}
 */
function inputs_horarios(){ 
	for (var i = 0; i < 6; i++) {
		$('#hora_entrada_'+i+'').change(function(event){
			$(this).removeClass('invalid');
		});
		$('#hora_salida_'+i+'').change(function(event){
			$(this).removeClass('invalid');
		});
	}
}

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
 * Valida los datos del formulario con la libreria JQuery Validation
 *
 * @event validate
 * @property {event} validate - Valida los campos input del formulario.
 * @type {object}
 */
var validator = $("#form_clase").validate({
	rules: {
    clase: {
      required: true
    },
    periodo_id: {
      required: true,
      digits: true,
      min: 1
    },
    especialidad_id: {
      required: true,
      digits: true,
      min: 1
    },
    asignatura_id: {
      required: true,
      digits: true,
      min: 1
    },
    docente_id: {
      required: true,
      digits: true,
      min: 1
    }
	},
	messages: {
		clase: {
      required: "La clase es requerida."
    },
    periodo_id: {
      required: "El período es requerido.",
      digits: "El período tiene que ser un número entero.",
      min: "El período mínimo es 1."
    },
    especialidad_id: {
      required: "La especialidad es requerida.",
      digits: "La especialidad tiene que ser un número entero.",
      min: "La especialidad mínima es 1."
    },
    asignatura_id: {
      required: "La asignatura es requerida.",
      digits: "La asignatura tiene que ser un número entero.",
      min: "La asignatura mínima es 1."
    },
    docente_id: {
      required: "El docente es requerido.",
      digits: "El docente tiene que ser un número entero.",
      min: "El docente mínimo es 1."
    }
  }
});