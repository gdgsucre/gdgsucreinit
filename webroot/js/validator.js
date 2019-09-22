function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

function isAlphabetsKey(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 8) {
        return true;
    }

    patron = /[A-Za-zñÑáéíóúÁÉÍÓÚâêîôûàèìòùäëïöü.\s]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function isPhoneKey(e) {

    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 8) {
        return true;
    }

    patron = /[0-9()+-.]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

var band = true;
var oldVal = "";
$.validator.addMethod('unique', function (value, element) {
    if(band){
        oldVal = value;
        band = false;
    }
    if(oldVal == value){
        return false;
    }else{
        return true;
    }
}, "El valor ya existe")

function validForm(nameObjects, res) {
    band = true;
    oldVal = "";
    $.each(res.errors, function (ix, val) {

        if (!nameObjects.includes(ix)) {

            var validData = ix.replace(/_/g, "-");
            if ('_empty' in val) {
                $("#" + validData).rules("add", {
                    required: true,
                    messages: {
                        required: val._empty
                    }
                });
            }
            if ('_required' in val) {
                $("#" + validData).rules("add", {
                    required: true,
                    messages: {
                        required: val._required
                    }
                });
            }
            if ('integer' in val) {
                $("#" + validData).rules("add", {
                    required: true,
                    messages: {
                        required: val.integer
                    }
                });
            }
            if ('_isUnique' in val) {
                $("#" + validData).rules("add", {
                    unique: true,
                    messages: {
                        unique: val._isUnique
                    }
                });
            }

        } else {
            var nameObj = ix.replace(/_/g, "-");

            $.each(val, function (key, value) {
                var validData = key.replace(/_/g, "-");
                if ('_empty' in value) {
                    $("#" + nameObj + "-" + validData).rules("add", {
                        required: true,
                        messages: {
                            required: value._empty
                        }
                    });
                }
                if ('_required' in value) {
                    $("#" + nameObj + "-" + validData).rules("add", {
                        required: true,
                        messages: {
                            required: value._required
                        }
                    });
                }
                if ('integer' in value) {
                    $("#" + nameObj + "-" + validData).rules("add", {
                        required: true,
                        messages: {
                            required: value.integer
                        }
                    });
                }
                if ('_isUnique' in value) {
                    $("#" + nameObj + "-" + validData).rules("add", {
                        unique: true,
                        messages: {
                            unique: value._isUnique
                        }
                    });
                }

            });
        }
    });
}