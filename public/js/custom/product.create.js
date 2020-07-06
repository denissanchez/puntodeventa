$(function () {
    let selects = $('.selectable');

    selects.select2({
        tags: true,
        allowClear: true,
        placeholder: 'Seleccionar',
        language: {
            "noResults": function () {
                return "No encontrado";
            }
        }
    });
});
