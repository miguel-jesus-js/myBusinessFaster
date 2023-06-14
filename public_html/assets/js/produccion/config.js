var insumos;
var productos;
$('#parent_id').change(function(){
    let dataProducto = productos.find(i => i.id == $(this).val());
    $('#parent-cod').html(dataProducto.cod_barra);
    $('#parent-prod').html(dataProducto.producto);
    $('#parent-stock').html(dataProducto.sucursales[0].pivot.stock);
    getInsumos($(this).val());
});
$('#id').change(function(){
    let dataInsumo = insumos.find(i => i.id == $(this).val());
    $('#insumo-cod').html(dataInsumo.cod_barra);
    $('#insumo-prod').html(dataInsumo.producto);
    $('#insumo-stock').html(dataInsumo.sucursales[0].pivot.stock);
})
function getInsumos(parentId) {
    $.ajax({
        'type': 'GET',
        'url': '/api/getInsumos/'+parentId,
        beforeSend: function () {
            $('#load-select-1').html('Cargando...');
        },
        success: function (response) {
            $('#load-select-1').html('Elige una opción');
            let data = JSON.parse(response);
            insumos = data;
            let option = '';
            $.each(data, function (index, valor) {
                option += `<option value="${valor.id}">${valor.producto}</option>`;
            });
            $('#id').append(option);
        }
    });
}
function getProductos() {
    let selectMarca = $('#parent_id');
    if (selectMarca[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': '/api/getProductosBySucursal/0',
            beforeSend: function () {
                $('#load-select').html('Cargando...');
            },
            success: function (response) {
                $('#load-select').html('Elige una opción');
                let data = JSON.parse(response);
                productos = data;
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}">${valor.producto}</option>`;
                });
                $('#parent_id').append(option);
            }
        });
    }
}
$('#cantidad_producto').keyup(function(){
    if($('#cantidad').val() != ''){
        $('#html-cantidad').html($(this).val() * $('#cantidad').val());
    }
});
$('#cantidad').keyup(function(){
    if($('#cantidad_producto').val() != ''){
        $('#html-cantidad').html($(this).val() * $('#cantidad_producto').val());
    }
});