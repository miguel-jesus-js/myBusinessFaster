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
function getAlmacenes() {
    let selectMarca = $('#almacene_id');
    if (selectMarca[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getAlmacenes/2',
            beforeSend: function () {
                $('#load-select1').html('Cargando...');
            },
            success: function (response) {
                $('#load-select1').html('Elige una opción');
                let data = JSON.parse(response);
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}">${valor.nombre}</option>`;
                });
                $('#almacene_id').append(option);
            }
        });
    }
}
function getUnidadMedidas() {
    let selectUnidad = $('#unidad_medida_id');
    if (selectUnidad[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getUnidadMedidas/2',
            beforeSend: function () {
                $('#load-select2').html('Cargando...');
            },
            success: function (response) {
                $('#load-select2').html('Elige una opción');
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
function getProveedores() {
    let selectUnidad = $('#proveedore_id');
    if (selectUnidad[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getProveedores/2',
            beforeSend: function () {
                $('#load-select3').html('Cargando...');
            },
            success: function (response) {
                $('#load-select3').html('Elige una opción');
                let data = JSON.parse(response);
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}">${valor.nombres} ${valor.app} ${valor.apm} - (${valor.empresa == null ? '' : valor.empresa})</option>`;
                });
                $('#proveedore_id').append(option);
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
                $('#load-select4').html('Cargando...');
            },
            success: function (response) {
                $('#load-select4').html('Elige una opción');
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
    let contenedor =  $('#categorias');
    if(contenedor[0].children.length <= 1){
        $.ajax({
            'type': 'GET',
            'url': 'api/getCategorias/2',
            beforeSend: function () {
                addHtmlEfectoLoad('load-form1');
            },
            success: function (response) {
                let data = JSON.parse(response);
                let cat = '';
                $.each(data, function (index, valor) {
                    cat += `<label class="form-selectgroup-item mb-1">
                                <input type="checkbox" name="categoria_id[]" value="${valor.id}" class="form-selectgroup-input">
                                <span class="form-selectgroup-label">${valor.categoria}</span>
                            </label>`;
                });
                $('#categorias').html(cat);
            }
        });
    }
}