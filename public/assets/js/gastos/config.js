var tipoGastoId = 0;
function getTipoGasto() {
    let selectUser = $('#tipo_gasto_id');
    if (selectUser[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getTipoGastos/2',
            beforeSend: function () {
                $('#load-select').html('Cargando...');
            },
            success: function (response) {
                $('#load-select').html('Elige una opción');
                let data = JSON.parse(response);
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}">${valor.tipo}</option>`;
                });
                $('#tipo_gasto_id').append(option);
            }
        });
    }
}