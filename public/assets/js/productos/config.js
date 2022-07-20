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
function getMateriales() {
    let selectMaterial = $('#materiale_id');
    if (selectMaterial[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getMateriales/2',
            beforeSend: function () {
                $('#load-select1').html('Cargando...');
            },
            success: function (response) {
                $('#load-select1').html('Elige una opción');
                let data = JSON.parse(response);
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}">${valor.material}</option>`;
                });
                $('#materiale_id').append(option);
            }
        });
    }
}
function getCategorias() {
    let selectCat = $('#categoria_id');
    if (selectCat[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getCategorias/2',
            beforeSend: function () {
                $('#load-select2').html('Cargando...');
            },
            success: function (response) {
                $('#load-select2').html('Elige una opción');
                let data = JSON.parse(response);
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}"}>${valor.categoria}</option>`;
                });
                $('#categoria_id').html(option);
            }
        });
        setTimeout(function(){
            $('#categoria_id').removeClass('form-select');
            $('#categoria_id').addClass('selectpicker');
            $('#categoria_id').prop('multiple', true);
            $('#categoria_id').selectpicker();
        }, 1000)
    }
}
function getUnidadMedidas() {
    let selectUnidad = $('#unidad_medida_id');
    if (selectUnidad[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getUnidadMedidas/2',
            beforeSend: function () {
                $('#load-select3').html('Cargando...');
            },
            success: function (response) {
                $('#load-select3').html('Elige una opción');
                let data = JSON.parse(response);
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}">${valor.unidad_medida}</option>`;
                });
                $('#unidad_medida_id').append(option);
            }
        });
    }
}
function onChangeCat(valor){
    debugger;
}