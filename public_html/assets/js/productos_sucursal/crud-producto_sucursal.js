var idSucursal = 0;
$('#form-add-producto_sucursal').submit(function(e){
    e.preventDefault();
    removeClass('form-add-producto_sucursal');
    let data = $(this).serialize();
    let productos = [];
    var url = '';
    var tipo = '';
    if($('#id').val() == ''){
        url = 'api/addProductosSucursal';
        tipo = 'POST';
        $('input[name="marcar"]').each(function(){
            let fila = $(this).closest('tr').children();
            if($(this).prop('checked')){
                let item = {
                    producto_id: fila[1].textContent,
                    pre_venta: parseInt($(fila[9]).find('input').val()),
                    pre_compra: parseInt($(fila[10]).find('input').val()),
                    pre_mayoreo: parseInt($(fila[11]).find('input').val()),
                    stock: parseInt($(fila[12]).find('input').val()),
                };
                productos.push(item);
            }   
        });
    }else{
        url = 'api/updateProductosSucursal';
        tipo = 'PUT';
        $('#table-productos tbody tr').each(function(){
            let fila = $(this).children();
            let item = {
                producto_id: fila[1].textContent,
                pre_venta: parseInt($(fila[9]).find('input').val()),
                pre_compra: parseInt($(fila[10]).find('input').val()),
                pre_mayoreo: parseInt($(fila[11]).find('input').val()),
                stock: parseInt($(fila[12]).find('input').val()),
            };
            productos.push(item); 
        });
    }
    data = data+'&productos='+JSON.stringify(productos);
    $.ajax({
        'type': tipo,
        'url': url,
        'data': data,
        beforeSend: function(){
            addHtmlEfectoLoad('load-form');
            addClassBtnEfectoLoad('load-button', 'btn-modal');
        },
        success: function(response){
            let respuesta = JSON.parse(response);
            removeClassBtnEfectoLoad('load-form','load-button', 'btn-modal');
            Toast.fire({
                icon: respuesta.icon,
                title: respuesta.title,
                text: respuesta.text
            });
            if(respuesta.icon == 'success'){
                getProductosSucursal(2, '');
                closeModal('modal-add-producto_sucursal', 'form-add-producto_sucursal');
            }
        },
        error: function(request, status, error){
            switch (request.status) {
                case 422:
                    addValidacion(request.responseJSON.errors);
                    Toast.fire({
                        icon: 'warning',
                        title: 'Error de validaciones',
                        text: 'Algunos campos tienen errores'
                    });
                    break;
                case 0:
                    msjError('error', 'Error', 'Se perdio la conexión con el servidor, intente nuevamente');
                    break;
            }
            removeClassBtnEfectoLoad('load-form','load-button', 'btn-modal');
        }
    });
})
$('#form-upload-producto_sucursal').submit(function(e){
    e.preventDefault();
    removeClass('form-upload-producto_sucursal');
    $.ajax({
        'type': 'POST',
        'url': 'api/uploadProductosSucursal',
        'data': new FormData(this),
        'contentType': false,
        'cache': false,
        'processData': false,
        beforeSend: function(){
            addHtmlEfectoLoad('load-form1');
            addClassBtnEfectoLoad('load-button1', 'btn-modal1');
        },
        success: function(response){
            let respuesta = JSON.parse(response);
            removeClassBtnEfectoLoad('load-form1','load-button1', 'btn-modal1');
            Toast.fire({
                icon: respuesta.icon,
                title: respuesta.title,
                text: respuesta.text
            });
            if(respuesta.icon == 'success'){
                getProductosSucursal(2, '');
                closeModal('upload-producto_sucursal', 'form-upload-producto_sucursal');
            }
        },
        error: function(request, status, error){
            switch (request.status) {
                case 422:
                    addValidacion(request.responseJSON.errors);
                    break;
                case 0:
                    msjError('error', 'Error', 'Se perdio la conexión con el servidor, intente nuevamente');
                    break;
            }
            removeClassBtnEfectoLoad('load-form1','load-button1', 'btn-modal1');
        }
    });
})
function getProductosSucursal(tipo, filtro){
    $.ajax({
        'type': 'GET',
        'url': '/api/getProductosSucursal/'+tipo+'?filtro='+filtro+'&sucursal='+$('#sucursale_id1').val(),
        beforeSend: function(){
            $('#table-producto_sucursal tbody').empty();
            $('#table-producto_sucursal tbody').html('<tr id="load-almacenes"><td colspan="8"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
        },
        success: function(response){
            var data = JSON.parse(response);
            var elimnado = '';
            var row = '';
            const formatter = new Intl.NumberFormat('es-MX', {
                style: 'currency',
                currency: 'MXN',
                minimumFractionDigits: 2
            })
            if(data.length > 0){
                $.each(data, function(index, valor){
                    if(valor.deleted_at != null){ //validación para que los registros elimnados sean de color rojo
                        elimnado = 'table-danger';
                    }else{
                        elimnado = '';
                    }
                    row += `
                        <tr class="${elimnado}">
                            <td>${valor.sucursales.nombre}</td>
                            <td>${valor.productos.producto}</td>
                            <td>${formatter.format(valor.pre_compra)}</td>
                            <td>${formatter.format(valor.pre_venta)}</td>
                            <td>${formatter.format(valor.pre_mayoreo)}</td>
                            <td>${valor.stock}</td>
                            <td>
                                <button type="button" class="btn p-0 border-0"  aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detalles" onclick="details('${valor.sucursales.nombre}', '${valor.productos.producto}', '${valor.pre_compra}', '${valor.pre_venta}', '${valor.pre_mayoreo}', '${valor.stock}', '${valor.created_at}', '${valor.updated_at}', '${valor.deleted_at}');"><i class="ti ti-eye icono text-success"></i></button>
                            </td>
                            <td>
                                <button type="button" class="btn p-0 border-0" onclick="onChange(${valor.id}, ${valor.sucursales.id}, ${valor.productos.id}, '${valor.productos.cod_barra}', '${valor.productos.producto}', '${valor.pre_compra}', '${valor.pre_venta}', '${valor.pre_mayoreo}', '${valor.stock}');"><i class="ti ti-edit icono text-primary"></i></button>
                            </td>
                            <td>
                                <button type="button" class="btn p-0 border-0" onclick="confirmDelete(${valor.id}, '${valor.productos.producto +' de la sucursal'+ valor.sucursales.nombre}', 'api/deleteProductosSucursal/', 'articulo', 'el');"><i class="ti ti-trash icono text-danger"></i></button>
                            </td>
                        </tr>
                    `;
                });
                $('#table-producto_sucursal tbody').html(row);
                $("#table-producto_sucursal").paginationTdA({
                    elemPerPage: 5
                });
                let pag = $('.paginationClick').parent()[0];
                pag.classList.add('active');
            }else{
                $('#table-producto_sucursal tbody').html('<tr><td colspan="4" class="text-center">No hay registros</td></tr>');
            }
        }
    })
}
function onChange(id, sucursale_id, producto_id, cod_barra, producto, pre_compra, pre_venta, pre_mayoreo, stock){
    idSucursal = sucursale_id;
    $('#id').val(id);
    $('#sucursale_id').val(sucursale_id);
    let row = `    
            <tr>
                <td></td>
                <td  class="d-none">${producto_id}</td>
                <td>${cod_barra}</td>
                <td>${producto}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <input type="number" class="form-control" name="pre_compra[]" placeholder="Precio de compra" autocomplete="off" required min="1" max="100000" minlength="1" maxlength="7" step=0.01 value="${pre_compra}">
                </td>
                <td>
                    <input type="number" class="form-control" name="pre_venta[]" placeholder="Precio de venta" autocomplete="off" required min="1" max="100000" minlength="1" maxlength="7" step=0.01 value="${pre_venta}">
                </td>
                <td>
                    <input type="number" class="form-control" name="pre_mayoreo[]" placeholder="Precio por mayoreo" autocomplete="off" required min="1" max="100000" minlength="1" maxlength="7" step=0.01 value="${pre_mayoreo}">
                </td>
                <td><input type="number" class="form-control" name="stock=[]" placeholder="Stock" autocomplete="off" min="1" max="100000" minlength="1" maxlength="7" value="${stock}"></td>
            </tr>
            `;
    $('#table-productos tbody').html(row);
    getSucursales();
    openModal('modal-add-producto_sucursal', 'productos_sucursal', 1);
}
function details(sucursal, producto, pre_compra, pre_venta, pre_mayoreo, stock, created_at, updated_at, deleted_at){
    const formatter = new Intl.NumberFormat('es-MX', {
        style: 'currency',
        currency: 'MXN',
        minimumFractionDigits: 2
    })
    const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    $('#nom-sucursal').html(sucursal);
    $('#nom-producto').html(producto);
    $('#nom-pre_compra').html(formatter.format(pre_compra));
    $('#nom-pre_venta').html(formatter.format(pre_venta));
    $('#nom-pre_mayoreo').html(formatter.format(pre_mayoreo));
    $('#nom-stock').html(stock);
    let creacion = new Date(created_at);
    let actualizacion = new Date(updated_at);
    let eliminacion = new Date(deleted_at);
    $('#creacion').html(creacion.getDate()+' de '+meses[creacion.getMonth()]+' de '+creacion.getFullYear());
    $('#actualizacion').html(actualizacion.getDate()+' de '+meses[actualizacion.getMonth()]+' de '+actualizacion.getFullYear());
    if(eliminacion.getDate().toString() != 'NaN'){
    $('#eliminacion').html(eliminacion.getDate()+' de '+meses[eliminacion.getMonth()]+' de '+eliminacion.getFullYear());
    }
    openModal('modal-detalle-producto_sucursal', 'productos_sucursal', '2');

}