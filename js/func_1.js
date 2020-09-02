/*  Wizard */
jQuery(function($) {
    "use strict";
    $('form#wrapped').attr('action', 'save.php');
    $("#wizard_container").wizard({
        stepsWrapper: "#wrapped",
        submit: ".submit",
        unidirectional: false,
        beforeSelect: function(event, state) {
            if ($('input#website').val().length != 0) {
                return false;
            }
            if (!state.isMovingForward)
                return true;
            var inputs = $(this).wizard('state').step.find(':input');
            return !inputs.length || !!inputs.valid();
        }
    }).validate({
        errorPlacement: function(error, element) {
            if (element.is(':radio') || element.is(':checkbox')){
                error.insertBefore(element.next());
            } else {
                error.insertAfter(element);
            }
        }
    });
    //  progress bar
    $("#progressbar").progressbar();
    $("#wizard_container").wizard({
        afterSelect: function(event, state) {
            $("#progressbar").progressbar("value", state.percentComplete);
            $("#location").text("" + state.stepsComplete + "  de " + state.stepsPossible + " completados");
        }
    });
});

$("#wizard_container").wizard({
    transitions: {
        branchtype: function($step, action) {
            var branch = $step.find(":checked").val();
            if (!branch) {
                $("form").valid();
            }
            return branch;
        }
    }
});

/* File upload validate size and file type - For details: https://github.com/snyderp/jquery.validate.file*/
$("form#wrapped")
    .validate({
        rules: {
            fileupload: {
                fileType: {
                    types: ["pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"]
                },
                maxFileSize: {
                    "unit": "KB",
                    "size": 20000
                },
                minFileSize: {
                    "unit": "KB",
                    "size": "2"
                }
            }
        }
    });

// Input name and email value
function getVals(formControl, controlType) {
    switch (controlType) {
        case 'iban_field':
            var value = $(formControl).val();
            $("#iban_field").text(value);
            break;
        case 'telefono_field':
            var value = $(formControl).val();
            $("#telefono_field").text(value);
            break;
    
        case 'profesion_field':
            var value = $(formControl).val();
            $("#profesion_field").text(value);
            break;
    }
}
var uid = localStorage.getItem('uid');

if(uid === null) {
    let timestamp = new Date().getTime();
    localStorage.setItem('uid', timestamp);
    uid = localStorage.getItem('uid');
}

console.log(uid);
var form = localStorage.getItem('form');
var data = {
    uid: uid,
    iban: '',
    profesion: '',
    tipo: '',
    actividad: '',
    antiguedad: '',
    situacion: '',
    telefono: '',
    ingresos: '',
    pagas: '',
    cuotas: '',
    gastos: '',
    dnidelantera: '',
    dnireverso: '',
    justificacion: '',
    compromisos: '',
    terms: '',
};

$(document).ready(function() {
    $('#uid').val(uid);
    if(!form) {
        localStorage.setItem('form', JSON.stringify(data));
        form = JSON.parse(localStorage.getItem('form'));
    } else {
        form = JSON.parse(form);
        $('input').each(function() {
            let name = $(this).attr('id');
                if(form[name] && form[name] != "") {
                    if( $(this).attr('type') != 'file') {
                        console.log( $(this).attr('type') )
                        $(this).val(form[name]);
                    }
                }
        })
    }
    $('input').change(function() {
        let input = $(this);
        let name = input.attr('id');
        form[name] = input.val();
        localStorage.setItem('form', JSON.stringify(form));
        console.log(form);

    });
});

$('#clearData').on('click', function() {
    localStorage.clear();
    $('input').each(function() {
        if($(this).attr('id') != 'terms' || $(this).attr('id') != 'website') {
            $(this).val("");
        }
    });
});