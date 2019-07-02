
/**
 * ============================================================================
 * @fileoverview  Carga las inicializaciones de los componentes MaterializeCSS.
 * 
 * @version       1.0
 *
 * @author        Julio Cesar Valle Rodríguez <jvalle@appsamx.com>
 * @copyright     APPSA México
 * ============================================================================
 */

$(document).ready(function(){

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
	
	$('.dropdown-button').dropdown({
    inDuration: 300,
    outDuration: 225,
    constrainWidth: false, // Does not change width of dropdown to that of the activator
    gutter: 0, // Spacing from edge
    belowOrigin: true, // Displays dropdown below the button
    alignment: 'right', // Displays dropdown with edge aligned to the left of button
    stopPropagation: false // Stops event propagation
  });

  $('.tooltipped').tooltip({delay: 50});
  $(".button-collapse").sideNav();
  $('.collapsible').collapsible();
  $('.parallax').parallax();
  $('select').material_select();


  $('.fixed-action-btn').openFAB();
	$('.fixed-action-btn').closeFAB();

	$('.datepicker').pickadate({
		formatSubmit: 'yyyy-mm-dd',
		selectMonths: true,
		selectYears: 30,
		today: 'Hoy',
    clear: 'Limpiar',
    close: 'Ok',
	});

	$('.modal').modal();

  $('ul.tabs').tabs('select_tab', 'tab_id', {swipeable: true});

  $('.js-example-basic-single').select2();

  var dropify = $('.dropify').dropify({
    messages: {
        'default': 'Arrastra y suelta una imagen aquí o haz clic',
        'replace': 'Arrastra y suelta o haz clic para reemplazar',
        'remove':  'Quitar',
        'error':   'Oops, algo malo pasó.'
    },
    error: {
        'fileSize': 'El tamaño del archivo es demasiado grande ({{ value }} max).',
        'minWidth': 'El ancho de la imagen es demasiado pequeño ({{ value }}}px min).',
        'maxWidth': 'El ancho de la imagen es demasiado grande ({{ value }}}px max).',
        'minHeight': 'La altura de la imagen es demasiado pequeña ({{ value }}}px min).',
        'maxHeight': 'La altura de la imagen es muy grande ({{ value }}px max).',
        'imageFormat': 'El formato de imagen no está permitido ({{ value }} unicamente).'
    },
    tpl: {
        wrap:            '<div class="dropify-wrapper"></div>',
        loader:          '<div class="dropify-loader"></div>',
        message:         '<div class="dropify-message"><span class="file-icon" /> <p style="text-align: center;">{{ default }}</p></div>',
        preview:         '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">{{ replace }}</p></div></div></div>',
        filename:        '<p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>',
        clearButton:     '<button type="button" class="dropify-clear">{{ remove }}</button>',
        errorLine:       '<p class="dropify-error">{{ error }}</p>',
        errorsContainer: '<div class="dropify-errors-container"><ul></ul></div>'
    }
  });

  $('.timepicker').pickatime({
    default: '07:00', // Set default time: 'now', '1:30AM', '16:30'
    fromnow: 0, // set default time to * milliseconds from now (using with default = 'now')
    twelvehour: false, // Use AM/PM or 24-hour format
    donetext: 'OK', // text for done-button
    cleartext: 'Limpiar', // text for clear-button
    canceltext: 'Cancelar', // Text for cancel-button,
    container: 'body', // ex. 'body' will append picker to body
    autoclose: false, // automatic close timepicker
    //ampmclickable: true, // make AM PM clickable
    aftershow: function(){} //Function for after opening timepicker
  });

  $('.chips').material_chip();

});
