$('#form-add-cliente').submit(function(e){
    e.preventDefault();
    removeClass('form-add-cliente');
    let data = $(this).serialize();
    var url = '';
    var tipo = '';
    if($('#id').val() == ''){
        url = 'api/addClientes';
        tipo = 'POST';
    }else{
        url = 'api/updateClientes';
        tipo = 'PUT';
    }
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
                getClientes(2, '');
                closeModal('modal-cliente', 'form-add-cliente');
            }
        },
        error: function(request, status, error){
            switch (request.status) {
                case 422:
                    addValidacion(request.responseJSON.errors);
                    break;
                default:
                    msjInfo('error', 'Error', 'Se perdio la conexión con el servidor, intente nuevamente');
                    break;
            }
            removeClassBtnEfectoLoad('load-form','load-button', 'btn-modal');
        }
    });
})
$('#form-upload-cliente').submit(function(e){
    e.preventDefault();
    removeClass('form-upload-cliente');
    $.ajax({
        'type': 'POST',
        'url': 'api/uploadCliente',
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
                getClientes(2, '');
                closeModal('upload-cliente', 'form-upload-cliente');
            }
        },
        error: function(request, status, error){
            switch (request.status) {
                case 422:
                    addValidacion(request.responseJSON.errors);
                    break;
                default:
                    msjInfo('error', 'Error', 'Se perdio la conexión con el servidor, intente nuevamente');
                    break;
            }
            removeClassBtnEfectoLoad('load-form1','load-button1', 'btn-modal1');
        }
    });
})
function getClientes(tipo, filtro){
    $.ajax({
        'type': 'get',
        'url': '/api/getClientes/'+tipo+'?filtro='+filtro,
        beforeSend: function(){
            $('#table-cliente tbody').empty();
            $('#table-cliente tbody').html('<tr id="load-clientes"><td colspan="8"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
        },
        success: function(response){
            $('#load-clientes').addClass('d-none');
            var data = JSON.parse(response);
            var elimnado = '';
            var direcciones = '';
            var row = '';
            if(data.length > 0){
                $.each(data, function(index, valor){
                    direcciones = JSON.stringify(valor.direcciones);//hacemos la conversion para enviar el json
                    var regex = new RegExp("\"", "g");
                    var direccionesString = direcciones.replace(regex, "'");//quitamos las comillas "" por '', de otro modo da error al pasarlo como parametro
                    if(valor.deleted_at != null){ //validación para que los registros elimnados sean de color rojo
                        elimnado = 'table-danger';
                    }else{
                        elimnado = '';
                    }
    
                    row += `
                        <tr class="${elimnado}">
                            <td>${valor.nombres} ${valor.app} ${valor.apm}</td>
                            <td>${valor.tipo_cliente.tipo_cliente}</td>
                            <td>${valor.email}</td>
                            <td>${valor.telefono}</td>
                            <td>
                                <button type="button" class="btn p-0 border-0" onclick="onChange(${valor.id}, ${valor.tipo_cliente_id}, '${valor.nombres}', '${valor.app}', '${valor.apm}', '${valor.email}', '${valor.telefono}', '${valor.rfc}', '${valor.empresa}', '${valor.ciudad}', '${valor.estado}', '${valor.municipio}', ${valor.cp}, '${valor.colonia}', '${valor.calle}', ${valor.n_exterior}, ${valor.n_interior}, ${direccionesString});"><i class="ti ti-edit icono text-primary"></i></button>
                            </td>
                            <td>
                                <button type="button" class="btn p-0 border-0" onclick="confirmDelete(${valor.id}, '${valor.nombres}', 'api/deleteClientes/', 'cliente', 'el');"><i class="ti ti-trash icono text-danger"></i></button>
                            </td>
    
                        </tr>
                    `;
                });
                $('#table-cliente tbody').html(row);
                $("#table-cliente").paginationTdA({
                    elemPerPage: 5
                });
                let pag = $('.paginationClick').parent()[0];
                pag.classList.add('active');
            }else{
                $('#table-cliente tbody').html('<tr><td colspan="7" class="text-center">No hay registros</td></tr>');
            }
        }
    })
}
function onChange(id, tipo_cliente_id, nombres, app, apm, email, telefono, rfc, empresa, ciudad, estado, municipio, cp, colonia, calle, n_exterior, n_interior, direcciones){
    $.when(getTipoClientes()).then($('#tipo_cliente_id').val(tipo_cliente_id));
    $('#id').val(id);
    $('#nombres').val(nombres);
    $('#app').val(app);
    $('#apm').val(apm);
    $('#email').val(email);
    $('#telefono').val(telefono);
    $('#rfc').val(rfc == 'null' ? '': empresa);
    $('#empresa').val(empresa == 'null' ? '' : empresa);
    $('#ciudad').val(ciudad);
    $('#estado').val(estado);
    $('#municipio').val(municipio);
    $('#cp').val(cp);
    $('#colonia').val(colonia);
    $('#calle').val(calle);
    $('#n_exterior').val(n_exterior);
    $('#n_interior').val(n_interior);
    openModal('modal-cliente', 'clientes', 1);
    
    //llenamos la tabla con los permisos
    var rowDirecciones = '';
    $.each(direcciones, function(index, valor){
        if(valor.n_interior == null){
            valor.n_interior = '';
        }
        rowDirecciones += `
                    <tr>
                        <td>
                            <input type="text" class="form-control input-table" readonly name="d-id[]" id="d-id[]" required autocomplete="off" maxlength="50" minlength="5" value="${valor.id}">
                            <div class="invalid-feedback" id="error-d-id[]"></div>
                        </td>
                        <td>
                            <input type="text" class="form-control input-table" readonly name="d-ciudad[]" id="d-ciudad[]" required autocomplete="off" maxlength="50" minlength="5" value="${valor['d-ciudad']}">
                            <div class="invalid-feedback" id="error-d-ciudad[]"></div>
                        </td>
                        <td>
                            <input type="text" class="form-control input-table" readonly name="d-estado[]" id="d-estado[]" required autocomplete="off" maxlength="50" minlength="5" value="${valor['d-estado']}">
                            <div class="invalid-feedback" id="error-d-estado[]"></div>
                        </td>
                        <td>
                            <input type="text" class="form-control input-table" readonly name="d-municipio[]" id="d-municipio[]" required autocomplete="off" maxlength="50" minlength="5" value="${valor['d-municipio']}">
                            <div class="invalid-feedback" id="error-d-municipio[]"></div>
                        </td>
                        <td>
                            <input type="number" class="form-control input-table" readonly name="d-cp[]" id="d-cp[]" required autocomplete="off" maxlength="50" minlength="5" value="${valor['d-cp']}">
                            <div class="invalid-feedback" id="error-d-cp[]"></div>
                        </td>
                        <td>
                            <input type="text" class="form-control input-table" readonly name="d-colonia[]" id="d-colonia[]" required autocomplete="off" maxlength="50" minlength="5" value="${valor['d-colonia']}">
                            <div class="invalid-feedback" id="error-d-colonia[]"></div>
                        </td>
                        <td>
                            <input type="text" class="form-control input-table" readonly name="d-calle[]" id="d-calle[]" required autocomplete="off" maxlength="50" minlength="5" value="${valor['d-calle']}">
                            <div class="invalid-feedback" id="error-d-calle[]"></div>
                        </td>
                        <td>
                            <input type="number" class="form-control input-table" readonly name="d-n_exterior[]" id="d-n_exterior[]" required autocomplete="off" maxlength="50" minlength="5" value="${valor['d-n_exterior'] == null ? 0 : valor['d-n_exterior']}">
                            <div class="invalid-feedback" id="error-d-n_exterior[]"></div>
                        </td>
                        <td>
                            <input type="number" class="form-control input-table" readonly name="d-n_interior[]" id="d-n_interior[]" required autocomplete="off" maxlength="50" minlength="5" value="${valor['d-n_interior'] == null ? 0 : valor['d-n_interior']}">
                            <div class="invalid-feedback" id="error-d-n_interior[]"></div>
                        </td>
                        <td>
                            <div class="" id="editar">
                                <button type="button" class="btn p-0 border-0 editar"><i class="ti ti-edit icono text-primary"></i></button>
                            </div>
                            <div class="d-none" id="guardar">
                                <button type="button" class="btn p-0 border-0 guardar"><i class="ti ti-device-floppy icono text-success"></i></button>
                            </div>
                        </td>
                    </tr>     
        `;
    });
    $('#table-clientes-direcciones tbody').html(rowDirecciones);
    $('#table-clientes-direcciones td:nth-child(1)').hide();//ocultamos la fila ID
}