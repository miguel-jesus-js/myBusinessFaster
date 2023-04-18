$('#form-add-producto').submit(function(e){
    e.preventDefault();
    removeClass('form-add-producto');
    var url = '';
    var tipo = 'POST';
    var data = new FormData(this);
    if($('#id').val() == ''){
        url = 'api/addProductos';
    }else{
        data.append('_method', 'PUT');
        url = 'api/updateProductos';
        var arrTodo = new Array();
        $('input[name="categoria_id[]"]').each(function(element) {
            let item = {};
            item.id = this.value;
            item.status = this.checked;
            arrTodo.push(item);
        });
        var toPost = JSON.stringify(arrTodo);
        data.append('categorias', toPost);
    }
    $.ajax({
        'type': tipo,
        'url': url,
        'data': data,
        enctype: 'multipart/form-data',
        contentType: false,
        cache: false,
        processData:false,
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
                $('#input-imagenes').empty();
                $('#preview-imagenes').empty();
                getProductos(2, '');
                closeModal('modal-producto', 'form-add-producto');
            }
        },
        error: function(request, status, error){
            switch (request.status) {
                case 422:
                    addValidacion(request.responseJSON.errors, true);
                    break;
                case 0:
                    msjError('error', 'Error', 'Se perdio la conexión con el servidor, intente nuevamente');
                    break;
            }
            removeClassBtnEfectoLoad('load-form','load-button', 'btn-modal');
        }
    });
});
$('#form-upload-producto').submit(function(e){
    e.preventDefault();
    removeClass('form-upload-producto');
    let data = $(this).serialize();
    $.ajax({
        'type': 'POST',
        'url': 'api/uploadProducto',
        'data': new FormData(this),
        'contentType': false,
        'cache': false,
        'processData': false,
        beforeSend: function(){
            addHtmlEfectoLoad('load-form2');
            addClassBtnEfectoLoad('load-button2', 'btn-modal2');
        },
        success: function(response){
            let respuesta = JSON.parse(response);
            removeClassBtnEfectoLoad('load-form2','load-button2', 'btn-modal2');
            Toast.fire({
                icon: respuesta.icon,
                title: respuesta.title,
                text: respuesta.text
            });
            if(respuesta.icon == 'success'){
                getProductos(2, '');
                closeModal('upload-producto', 'form-upload-producto');
            }
        },
        error: function(request, status, error){
            switch (request.status) {
                case 422:
                    addValidacion(request.responseJSON.errors, false);
                    break;
                case 0:
                    msjError('error', 'Error', 'Se perdio la conexión con el servidor, intente nuevamente');
                    break;
            }
            removeClassBtnEfectoLoad('load-form2','load-button2', 'btn-modal2');
        }
    });
})
function getProductos(tipo, filtro){
    $.ajax({
        'type': 'get',
        'url': '/api/getProductos/'+tipo+'?'+filtro,
        beforeSend: function(){
            $('#table-producto tbody').empty();
            $('#table-producto tbody').html('<tr id="load-productos"><td colspan="10"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
        },
        success: function(response){
            $('#load-productos').addClass('d-none');
            var data = JSON.parse(response);
            const formatter = new Intl.NumberFormat('es-MX', {
                style: 'currency',
                currency: 'MXN',
                minimumFractionDigits: 2
            })
            var elimnado = '';
            var row = '';
            var caract = '';
            var cat = '';
            if(data.length > 0){
                $.each(data, function(index, valor){
                    caract = JSON.stringify(valor.caracteristicas);//hacemos la conversion para enviar el json
                    var regex = new RegExp("\"", "g");
                    var caracteristicas = caract.replace(regex, "'");//quitamos las comillas "" por '', de otro modo da error al pasarlo como parametro
                    cat = JSON.stringify(valor.categorias);//hacemos la conversion para enviar el json
                    var categorias = cat.replace(regex, "'");//quitamos las comillas "" por '', de otro modo da error al pasarlo como parametro
                    if(valor.deleted_at != null){ //validación para que los registros elimnados sean de color rojo
                        elimnado = 'table-danger';
                    }else{
                        elimnado = '';
                    }
                    row += `
                        <tr class="${elimnado}">
                            <td>${valor.cod_barra}</td>
                            <td>${valor.producto}</td>
                            <td>${valor.marcas == null ? '' : valor.marcas.marca}</td>
                            <td>${valor.almacenes == null ? '' : valor.almacenes.nombre}</td>
                            <td>${valor.unidad_medidas  == null ? '' : valor.unidad_medidas.unidad_medida}</td>
                            <td>${valor.proveedores == null ? '' : valor.proveedores.nombres + ' ('+valor.proveedores.empresa+')'}</td>
                            <td>${valor.materiales == null ? '' : valor.materiales.material}</td>
                            <td class="d-none oculto">${valor.stock_min}</td>
                            <td class="d-none oculto">${valor.cod_sat == null ? '' : valor.cod_sat}</td>
                            <td class="d-none oculto">${valor.caducidad == null ? '' : valor.caducidad}</td>
                            <td class="d-none oculto">${valor.color == null ? '' : valor.color}</td>
                            <td class="d-none oculto">${valor.talla == null ? '' : valor.talla}</td>
                            <td class="d-none oculto">${valor.modelo == null ? '' : valor.modelo}</td>
                            <td class="d-none oculto">${valor.peso_kg == null ? '' : valor.peso_kg}</td>
                            <td class="d-none oculto">${valor.meses_garantia == null ? '' : valor.meses_garantia}</td>
                            <td class="d-none oculto">${valor.es_produccion == 1 ? 'Si' : 'No'}</td>
                            <td class="d-none oculto">${valor.afecta_ventas == 1 ? 'Si' : 'No'}</td>
                            <td>
                                <button type="button" class="btn p-0 border-0" onclick="onChange(${valor.id}, ${valor.marca_id}, ${valor.almacene_id}, ${valor.unidad_medida_id}, ${valor.proveedore_id}, ${valor.materiale_id}, '${valor.cod_barra}', ${valor.cod_sat}, '${valor.producto}', ${valor.stock_min}, '${valor.caducidad}', '${valor.color}', '${valor.talla}', '${valor.modelo}', ${valor.meses_garantia}, '${valor.peso_kg}', '${valor.desc_detallada}', ${valor.es_produccion}, ${valor.afecta_ventas}, ${caracteristicas}, ${categorias});">
                                    <i class="ti ti-edit icono text-primary"></i>
                                </button>
                                <button type="button" class="btn p-0 border-0" onclick="confirmDelete(${valor.id}, '${valor.producto}', 'api/deleteProductos/', 'producto', 'el');">
                                    <i class="ti ti-trash icono text-danger"></i>
                                </button>
                                <button type="button" class="btn p-0 border-0 ver_mas" onclick="">
                                    <i class="ti ti-eye icono text-success">
                                </i></button>
                                <a href="/api/showProducto/${valor.id}" class="btn p-0 border-0"><i class="ti ti-list-details icono text-dark"></i></a>
                            </td>
               
    
                        </tr>
                    `;
                });
                $('#table-producto tbody').html(row);
                $("#table-producto").paginationTdA({
                    elemPerPage: 5
                });
                let pag = $('.paginationClick').parent()[0];
                pag.classList.add('active');
            }else{
                $('#table-producto tbody').html('<tr><td colspan="14" class="text-center">No hay registros</td></tr>');
            }
        },
    })
}
function onChange(id, marca_id, almacene_id, unidad_medida_id, proveedore_id, materiale_id, cod_barra, cod_sat, producto, stock_min, caducidad, color, talla, modelo, meses_garantia, peso_kg, desc_detallada, es_produccion, afecta_ventas, caracteristicas, categorias){
    $('#id').val(id);
    $('#cod_barra').val(cod_barra);
    $('#cod_sat').val(cod_sat);
    $('#producto').val(producto);
    $('#stock_min').val(stock_min);
    $('#caducidad').val(caducidad);
    $('#color').val(color == 'null' ? '' : color);
    $('#talla').val(talla == 'null' ? '' : talla);
    $('#modelo').val(modelo == 'null' ? '' : modelo);
    $('#meses_garantia').val(meses_garantia);
    $('#peso_kg').val(peso_kg);
    $('#desc_detallada').val(desc_detallada == 'null' ? '' : desc_detallada);
    $('#es_produccion').prop('checked', es_produccion == 1 ? true: false);
    $('#afecta_ventas').prop('checked', afecta_ventas == 1 ? true: false);
    openModal('modal-producto', 'productos', 1);
    getCategorias(categorias);
    $.when(getMarcas()).then($('#marca_id').val(marca_id));
    $.when(getAlmacenes()).then($('#almacene_id').val(almacene_id));
    $.when(getUnidadMedidas()).then($('#unidad_medida_id').val(unidad_medida_id));
    $.when(getProveedores()).then($('#proveedore_id').val(proveedore_id));
    $.when(getMateriales()).then($('#materiale_id').val(materiale_id));
    //llenamos la tabla con los permisos
    var rowCaracteristicas = '';
    $.each(caracteristicas, function(index, valor){
        rowCaracteristicas += `
                    <tr>
                        <td>
                        <input type="text" class="form-control input-table" readonly name="c-id[]" id="c-id[]" required autocomplete="off" maxlength="50" minlength="5" value="${valor.id}">
                        </td>
                        <td>
                            <input type="text" class="form-control input-table" readonly name="caracteristica[]" placeholder="Característica" autocomplete="off" required pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{5,50}" minlength="5" maxlength="100" value="${valor.caracteristica}">
                            <div class="invalid-feedback" id="error-caracteristica"></div>
                        </td>
                        <td>
                            <div class="" id="editar">
                                <button type="button" class="btn p-0 border-0 editar"><i class="ti ti-edit icono text-primary"></i></button>
                                <button type="button" class="btn p-0 border-0 borrar"><i class="ti ti-trash icono text-danger"></i></button>
                            </div>
                            <div class="d-none" id="guardar">
                                <button type="button" class="btn p-0 border-0 guardar"><i class="ti ti-device-floppy icono text-success"></i></button>
                            </div>
                        </td>
                    </tr>     
        `;
    });
    $('#table-caracteristicas tbody').html(rowCaracteristicas);
    $('#table-caracteristicas td:nth-child(1)').hide();//ocultamos la fila ID
}