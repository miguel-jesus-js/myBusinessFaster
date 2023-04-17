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
    let total = parseFloat($('#total_pagar').attr('data-total'));
    if(pagaCon < total){
        Toast.fire({
            icon: 'warning',
            title: 'Advertencia',
            text: 'El efectivo es menor al total a pagar'
        });
        return;
    }

    let data = $(this).serialize();
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
        'url': 'api/addVenta',
        'data': data,
        beforeSend: function(){
        },
        success: function(response){
            let respuesta = JSON.parse(response);

            if(respuesta.icon == 'success'){
                let cambio = pagaCon - total;
                msjInfo('success', 'VENTA EXITOSA', '<p><h3>¡¡¡ Felicidades !!!</h3></p> <p>Sigue incrementanto tus ventas</p> <h1>CAMBIO</h1> <h1>$'+cambio.toFixed(2)+'</h1>', false, 'Aceptar', resetForm, '');
                let url = window.location;
                window.open(url.origin+'/api/print/'+respuesta.venta_id,'_blank')
                //generateTicket(respuesta);
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
    var cantidad = parseInt($('#cantidad_pro').val());
    var importe = cantidad * parseFloat(data.sucursales[0].pivot.pre_venta
);
    var cod_barra = $('#cod_barra_search').val().replace(/\s/g, '');
    var existeProducto = false
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
                importeActual.val(nuevaCantidad * parseFloat(data.sucursales[0].pivot.pre_venta
));
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
                                <input type="text" class="form-control form-control-sm input-table" name="pre_venta[]" value="${data.sucursales[0].pivot.pre_venta
}" readonly>
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
    $('#total_pagar').html('$' + totalPagar.toFixed(2));
    $('#total_pagar').attr('data-total', totalPagar.toFixed(2));
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
            // Llenar select2 con los datos recuperados
            $('#cliente_id').empty();
            $.each(data, function(key, value) {
                $('#cliente_id').append('<option value="' + value.id + '">' + value.persona.nombres + '</option>');
            });
            // Actualizar select2
            $('#cliente_id').trigger('change');
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
            placeholder: 'Seleccionar opción',
            theme: 'tabler',
        });
    }else{
        $('#div-cliente').addClass('d-none');
        $('#cliente_id').prop('disabled', true);
    }
})