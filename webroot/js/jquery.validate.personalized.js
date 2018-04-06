jQuery.validator.addMethod("numbersLatinLetters", function (value, element) {
    return this.optional(element) || /^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s-]+$/.test(value);
}, 'No se aceptan caracteres especiales');

jQuery.validator.addMethod("latinLetters", function (value, element) {
    return this.optional(element) || /^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+/.test(value);
}, 'No se aceptan caracteres especiales y números');
