function getSucursales() {
    let selectUser = $('#sucursale_id');
    if (selectUser[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getSucursales/2',
            beforeSend: function () {
                $('#load-select').html('Cargando...');
                $('#load-select1').html('Cargando...');
            },
            success: function (response) {
                $('#load-select').html('Elige una opción');
                let data = JSON.parse(response);
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}">${valor.nombre}</option>`;
                });
                $('#sucursale_id').append(option);
                $('#sucursale_id1').append(option);
            }
        });
    }
}
$('#sucursale_id1').change(function(){
    getAlmacenes(2, '');
})