function getMarcas() {
    let selectMarca = $('#marca_id');
    if (selectMarca[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getMarcas/2',
            beforeSend: function () {
                $('#load-select').html('Cargando...');
            },
            success: function (response) {
                $('#load-select').html('Elige una opción');
                let data = JSON.parse(response);
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}">${valor.marca}</option>`;
                });
                $('#marca_id').append(option);
            }
        });
    }
}
