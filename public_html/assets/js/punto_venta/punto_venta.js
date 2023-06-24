var tipoVenta;
var dataCliente;
var idProveedor;
function reloj() {
    let fecha = new Date(); //Actualizar fecha.
    let hora = fecha.getHours(); //hora actual
    let minuto = fecha.getMinutes(); //minuto actual
    let segundo = fecha.getSeconds(); //segundo actual
    if(hora < 10) { //dos cifras para la hora
        hora = "0" + hora;
    }
    if(minuto < 10) { //dos cifras para el minuto
        minuto = "0" + minuto;
    }
    if(segundo < 10) { //dos cifras para el segundo
        segundo = "0" + segundo;
    }
    //devolver los datos:
    mireloj = hora+" : "+minuto+" : "+segundo;	
    $('#reloj').html(mireloj);
}
setInterval(reloj,1000); //iniciar temporizador

$('#form-search-producto').submit(function(e){
    e.preventDefault();
    let data = $(this).serialize();
    $.ajax({
        'type': 'POST',
        'url': 'api/searchProductForSale',
        'data': data,
        beforeSend: function(){

        },
        success: function(response){
            let respuesta = JSON.parse(response);
            let cantidad = parseInt($('#cantidad_pro').val());
            if(respuesta != null){
                if(cantidad > respuesta.sucursales[0].pivot.stock){
                    msjInfo('warning', 'STOCK INSUFICIENTE', '<p>¿Desa agregar el producto, esto puede causar problemas de inventario?</p> <p>Disponible: '+respuesta.sucursales[0].pivot.stock+'</p>', true, 'Aceptar', addProducto, respuesta);
                }else{
                    addProducto(respuesta);
                }
            }else{
                Toast.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Producto no encontrado'
                });
                $('#form-search-producto').trigger('reset');
            }
        },
        error: function(){

        }
    });
})
$('#form-add-venta').submit(function(e){
    e.preventDefault();
    let pagaCon = parseFloat($('#paga_con').val());
    let pago_inicial = parseFloat($('#pago_inicial').val());
    let total = parseFloat($('#total_pagar').attr('data-total'));
    if(tipoVenta == 3){
        if(pagaCon < pago_inicial){
            Toast.fire({
                icon: 'warning',
                title: 'Advertencia',
                text: 'El efectivo es menor al pago inicial'
            });
            return;
        }
    }else{
        if(pagaCon < total){
            Toast.fire({
                icon: 'warning',
                title: 'Advertencia',
                text: 'El efectivo es menor al total a pagar'
            });
            return;
        }
    }

    let data = $(this).serialize();
    if($('#tipo').val() == 1){
        debugger;
        data+= '&'+$('#proveedore_id').serialize();
    }
    let carrito = [];
    $('input[name="cod_barra[]"]').each(function(){
        let producto = {};
        var colId = $(this).parent().siblings()[0];
        var id_producto = $(colId).closest('td').find('input').val();
        let precio = $(this).parent().siblings()[3];
        let cantidad = $(this).parent().siblings()[4];
        let importe = $(this).parent().siblings()[5];
        producto.producto_id = parseInt(id_producto);
        producto.precio = parseFloat($(precio).find('input').val());
        producto.cantidad = parseInt($(cantidad).find('input').val());
        producto.importe = parseFloat($(importe).find('input').val());
        carrito.push(producto);
    });
    data = data+'&carrito='+JSON.stringify(carrito);
    $.ajax({
        'type': 'POST',
        'url': 'api/addVenta?tipo_venta='+tipoVenta,
        'data': data,
        beforeSend: function(){
        },
        success: function(response){
            let respuesta = JSON.parse(response);

            if(respuesta.icon == 'success'){
                if($('#tipo').val() == 1){
                    closeModal('modal-compra', 'form-add-compra');
                    getHistorial(2, 0, 5, '', 1);
                }
                let cambio = tipoVenta == 3 ? pagaCon - pago_inicial: pagaCon - total;
                msjInfo('success', 'VENTA EXITOSA', '<p><h3>¡¡¡ Felicidades !!!</h3></p> <p>Sigue incrementanto tus ventas</p> <h1>CAMBIO</h1> <h1>$'+cambio.toFixed(2)+'</h1>', false, 'Aceptar', resetForm, '');
                $('#pago-periodo').html('');
                let url = window.location;
                window.open(url.origin+'/api/ticket/'+respuesta.venta_id+'?isPrint=true','_blank')
            }else{
                Toast.fire({
                    icon: respuesta.icon,
                    title: respuesta.title,
                    text: respuesta.text
                });
            }
        },
        error: function(request, error, status){

        }
    })
})
function addProducto(data){
    let cantidad = parseInt($('#cantidad_pro').val());
    let tipos_de_precio = [parseFloat(data.sucursales[0].pivot.pre_venta), parseFloat(data.sucursales[0].pivot.pre_mayoreo), parseFloat(data.sucursales[0].pivot.pre_venta) + (parseFloat(data.sucursales[0].pivot.pre_venta) * parseFloat(data.sucursales[0].pivot.pre_credito))];
    let precio = tipos_de_precio[tipoVenta-1];
    let importe = cantidad * precio;
    let cod_barra = $('#cod_barra_search').val().replace(/\s/g, '');
    let existeProducto = false
    $('#form-search-producto').trigger('reset');
    $('input[name="cod_barra[]"]').each(function(){
        let input = $(this);
        if(cod_barra == input.val()){
            existeProducto = true;
            let columnas = input.parent().siblings();
            let disponible = $(columnas[1]).find('input');
            let cantidadActual = $(columnas[4]).find('input');
            function addAmount(){
                let importeActual = $(columnas[5]).find('input');
                let nuevaCantidad = parseInt(cantidadActual.val()) + parseInt(cantidad);
                importeActual.val(nuevaCantidad * precio);
                cantidadActual.val(nuevaCantidad);
                calculateTotals();
                return false;
            }
            if(parseInt(cantidadActual.val()) >= parseInt(disponible.val())){
                msjInfo('warning', 'STOCK INSUFICIENTE', '<p>¿Desa agregar el producto, esto puede causar problemas de inventario?</p> <p>Disponible: '+disponible.val()+'</p>', true, addAmount, '');
            }else{
                addAmount();
            }
        }
    });
    if(!existeProducto){
        let row = ` <tr>
                        <td class="d-none"><input type="number" class="form-control form-control-sm input-table" name="producto_id[]" value="${data.id}" readonly></td>
                        <td class="d-none"><input type="number" class="form-control form-control-sm input-table" name="cod_barra[]" value="${data.cod_barra}" readonly></td>
                        <td class="d-none"><input type="number" class="form-control form-control-sm input-table" name="disponible[]" value="${data.sucursales[0].pivot.stock}" readonly></td>
                        <td>${data.producto}</td>
                        <td>
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <i class="ti ti-currency-dollar"></i>
                                </span>
                                <input type="number" class="form-control form-control-sm input-table input-precio" name="pre_venta[]" value="${precio}" step="0.01" readonly>
                            </div>
                        </td>
                        <td>
                            <div class="row g-2">
                                <div class="col-auto ms-2">
                                    <span class="badge badge-pill bg-azure">
                                        <button class="border-0 bg-azure decreaseAmount">
                                            <i class="ti ti-minus text-white"></i>
                                        </button>
                                    </span>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control form-control-sm input-table text-center" name="cantidad[]" value="${cantidad}" readonly>
                                </div>
                                <div class="col-auto me-2">
                                    <span class="badge badge-pill bg-azure">
                                        <button class="border-0 bg-azure increaseAmount">
                                            <i class="ti ti-plus text-white"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <i class="ti ti-currency-dollar"></i>
                                </span>
                                <input type="text" class="form-control form-control-sm input-table" name="importe_pro[]" value="${importe}" readonly>
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="badge badge-pill bg-danger">
                                <button class="border-0 bg-danger deleteProducto">
                                    <i class="ti ti-trash text-white"></i>
                                </button>
                            </span>
                        </td>
                    </tr>`
        $('#carrito tbody').append(row);
        $('#total_productos').html($('#carrito tbody tr').length);
    }
    calculateTotals();
}
function calculateTotals(){
    let importe = 0;
    let iva;
    $('input[name="importe_pro[]"]').each(function(){
        importe += parseFloat($(this).val());
    });
    $('#check-iva').prop('checked') ? iva = importe * parseFloat($('#check-iva').attr('data-iva')) : iva = 0;
    let totalPagar = parseFloat(importe) + parseFloat(iva);
    $('#iva').val(iva.toFixed(2));
    $('#subtotal').val(importe);
    $('#total_pagar').attr('data-total', totalPagar.toFixed(2));
    if(tipoVenta != 3){
        $('#total_pagar').html('$' + totalPagar.toFixed(2));
    }
}
$(document).on('click', '.increaseAmount', function(){
    increaseincreaseAmount($(this), 'increase');
})
$(document).on('click', '.decreaseAmount', function(){
    increaseincreaseAmount($(this), 'decreas');
})
$(document).on('click', '.deleteProducto', function(){
    $(this).closest('tr').remove();
    $('#total_productos').html($('#carrito tbody tr').length);
    calculateTotals();
})
function increaseincreaseAmount(columna, tipo){
    let colDisponible = $(columna).closest('td').siblings()[2];
    let disponible = $(colDisponible).find('input');
    let cantidad = $(columna).closest('div').siblings().find('input');
    let colPrecio = $(columna).closest('td').siblings()[4];
    let precio = $(colPrecio).find('input');
    let colImporte = $(columna).closest('td').siblings()[5];
    let importe = $(colImporte).find('input');
    var newCantidad;
    if(tipo == 'increase'){
        if(parseInt(cantidad.val()) >= parseInt(disponible.val())){
            newCantidad =parseInt( cantidad.val());
            Swal.fire({
                icon: 'warning',
                title: 'STOCK INSUFICIENTE',
                html: '<p>¿Desa agregar el producto, esto puede causar problemas de inventario?</p> <p>Disponible: '+disponible.val()+'</p>',
                showCancelButton: true,
                confirmButtonText: 'Agregar',
                cancelButtonText: `Cancelar`,
              }).then((result) => {
                    if (result.isConfirmed) {
                        newCantidad = parseInt(cantidad.val()) + 1;
                        cantidad.val(newCantidad);
                        importe.val(newCantidad * parseFloat(precio.val()))
                        calculateTotals();
                    }
                })
        }else{
            newCantidad = parseInt(cantidad.val()) + 1;
        }
    }else{
        parseInt(cantidad.val()) == 1 ? newCantidad = 1 : newCantidad = parseInt(cantidad.val()) - 1;
    }
    cantidad.val(newCantidad);
    importe.val(newCantidad * parseFloat(precio.val()))
    calculateTotals();
}
function cleanCart(){
    $('#carrito tbody').empty();
    $('#total_productos').html($('#carrito tbody tr').length);
    calculateTotals();
}
function resetForm(){
    cleanCart();
    $('#form-add-venta').trigger('reset');
    setTimeout(() => {
        $('#cod_barra_search').focus();
    }, 500);
}
function getClientesSelect2(){
    $.ajax({
        url: 'api/getClientes/2',
        type: 'GET',
        beforeSend: function(){
            $('#cliente_id').html('<option value="">Cargando...</option>');
        },
        success: function(response) {
            let data = JSON.parse(response);
            dataCliente = data;
            // Llenar select2 con los datos recuperados
            $('#cliente_id').empty();
            $('#cliente_id').append('<option value="" disabled selected>Selecciona un cliente</option>');
            $.each(data, function(key, value) {
                $('#cliente_id').append(`<option data-dias="" value="${value.id}">${value.persona.nombres}</option>`);
            });
            // Actualizar select2
            //$('#cliente_id').trigger('change');
        }
    });
}
$('#reload-cliente').click(function(){
    getClientesSelect2();
})
$('#add-cliente').click(function(){
    openModal('modal-cliente','clientes', 0);
})
$('#check-iva').click(function(){
    calculateTotals();
})
$('#check-cliente').click(function(){
    if($(this).prop('checked')){
        getClientesSelect2();
        $('#div-cliente').removeClass('d-none');
        $('#cliente_id').prop('disabled', false);
        $('#cliente_id').select2({
            placeholder: 'Selecciona un cliente',
            theme: 'tabler',
        });
    }else{
        $('#div-cliente').addClass('d-none');
        $('#cliente_id').prop('disabled', true);
    }
});
$('#cliente_id').change(function(){
    let id = parseInt($(this).val());
    let cloneDataCliente = dataCliente.slice();
    let filterData = cloneDataCliente.filter(item => item.id == id);
    $('#dias_credito').val(filterData[0].dias_credito);
    $('#limite_credito').val(filterData[0].limite_credito);
})
$('#periodo_pagos').change(function(){
    let total = parseFloat($('#total_pagar').attr('data-total')) - parseFloat($('#pago_inicial').val());
    let periodo = parseFloat($(this).val());
    let periodo_pagos = {1: [7, 'Semanas'], 2: [15, 'Quincenas'], 3: [30, 'Meses']};
    let plazos = Math.round(parseInt($('#dias_credito').val()) / periodo_pagos[periodo][0]);
    let monto_periodo = total / plazos;
    let text = periodo_pagos[periodo][1]+' x $'+monto_periodo.toFixed(2);
    $('#pago-periodo').html(plazos+' '+text);
});
$('#pago_inicial').keyup(function(){
    $('#total_pagar').html('$'+$(this).val()+'.00');
    //$('#total_pagar').attr('data-total', $(this).val());
});
$(document).on('click', '.input-precio', function(){
    $(this).prop('readonly', false);
    $(this).removeClass('input-table');
});
$(document).on('keydown', '.input-precio', function(){
    if(event.keyCode == 13){
        $(this).prop('readonly', true);
        $(this).addClass('input-table');
        let col_cantidad = $(this).closest('tr').children()[5];
        let col_importe = $(this).closest('tr').children()[6];
        $(col_importe).find('input').val(parseFloat($(this).val()) * $(col_cantidad).find('input').val());
        calculateTotals();
    }
});
function getProveedores() {
    let selectUnidad = $('#proveedore_id');
    if (selectUnidad[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getProveedores/2',
            async: false,
            beforeSend: function () {
                $('#load-select3').html('Cargando...');
                $('#f-load-select3').html('Cargando...');
            },
            success: function (response) {
                $('#load-select3').html('Elige una opción');
                $('#f-load-select3').html('Elige una opción');
                let data = JSON.parse(response);
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}">${valor.persona.nombres} - (${valor.empresa == null ? '' : valor.empresa})</option>`;
                });
                $('#proveedore_id').append(option);
                $('#f-proveedore_id').append(option);
            }
        });
    }
}