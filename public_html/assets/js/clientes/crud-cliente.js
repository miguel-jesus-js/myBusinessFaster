$('#form-add-cliente').submit(function(e){
    e.preventDefault();
    removeClass('form-add-cliente');
    let data = $(this).serialize();
    var modulo = $('#modulo').val();
    var url = '';
    var tipo = '';
    if($('#id').val() == ''){
        if(modulo == 'usuarios'){
            url = 'api/addUsuarios';
        }else{
            url = 'api/addClientes';
        }
        tipo = 'POST';
    }else{
        if(modulo == 'usuarios'){
            url = 'api/updateUsuarios';
        }else{
            url = 'api/updateClientes';
        }
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
                modulo == 'usuarios' ? getUsuarios(2, '')  :getClientes(2, '');
                closeModal('modal-cliente', 'form-add-cliente');
            }
        },
        error: function(request, status, error){
            switch (request.status) {
                case 422:
                    addValidacion(request.responseJSON.errors, true);
                    Toast.fire({
                        icon: 'warning',
                        title: 'Error de validaciones',
                        text: 'Algunos campos tienen errores'
                    });
                    break;
                case 0:
                    msjError('error', 'Error', 'Se perdio la conexión con el servidor, intente nuevamente');
                    break;
                case 403:
                    msjError(request.responseJSON.icon, request.responseJSON.title, request.responseJSON.text);
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
                    addValidacion(request.responseJSON.errors, false);
                    break;
                case 0:
                    msjError('error', 'Error', 'Se perdio la conexión con el servidor, intente nuevamente');
                    break;
                case 403:
                    msjError(request.responseJSON.icon, request.responseJSON.title, request.responseJSON.text);
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
            var data = JSON.parse(response);
            var elimnado = '';
            var direcciones = '';
            var row = '';
            if(data.length > 0){
                $.each(data, function(index, valor){
                    direcciones = JSON.stringify(valor.persona.direcciones);//hacemos la conversion para enviar el json
                    var regex = new RegExp("\"", "g");
                    var direccionesString = direcciones.replace(regex, "'");//quitamos las comillas "" por '', de otro modo da error al pasarlo como parametro
                    if(valor.deleted_at != null){ //validación para que los registros elimnados sean de color rojo
                        elimnado = 'table-danger';
                    }else{
                        elimnado = '';
                    }
                    row += `
                        <tr class="${elimnado}">
                            <td>${valor.persona.nombres}</td>
                            <td>${valor.tipo_cliente.tipo_cliente}</td>
                            <td>${valor.persona.email}</td>
                            <td>${valor.persona.telefono}</td>
                            <td>
                                <button type="button" class="btn p-0 border-0" onclick="onChange(${valor.persona_id}, ${valor.id}, ${valor.tipo_cliente_id}, '${valor.persona.nombres}', '${valor.persona.email}', '${valor.persona.telefono}', '${valor.persona.rfc}', '${valor.empresa}', ${valor.limite_credito}, ${valor.dias_credito}, ${direccionesString});"><i class="ti ti-edit icono text-primary"></i></button>
                            </td>
                            <td>
                                <button type="button" class="btn p-0 border-0" onclick="confirmDelete(${valor.id}, '${valor.persona.nombres}', 'api/deleteClientes/', 'cliente', 'el');"><i class="ti ti-trash icono text-danger"></i></button>
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
function onChange(id, cliente_id, tipo_cliente_id, nombres, email, telefono, rfc, empresa, limite_credito, dias_credito, direcciones){
    $.when(getTipoClientes()).then($('#tipo_cliente_id').val(tipo_cliente_id));
    $('#id').val(id);
    $('#cliente_id').val(cliente_id);
    $('#nombres').val(nombres);
    $('#email').val(email);
    $('#telefono').val(telefono);
    $('#rfc').val(rfc == 'null' ? '': empresa);
    $('#empresa').val(empresa == 'null' ? '' : empresa);
    $('#limite_credito').val(limite_credito);
    $('#dias_credito').val(dias_credito);

    openModal('modal-cliente', 'clientes', 1);
    
    //llenamos la tabla con los direcciones
    var rowDirecciones = '';
    $.each(direcciones, function(index, valor){
        rowDirecciones += `
                    <tr>
                        <td>
                            <input type="text" class="form-control input-table" readonly name="d-id[]" id="d-id[]" required autocomplete="off" maxlength="50" minlength="5" value="${valor.id}">
                            <div class="invalid-feedback" id="error-id[]"></div>
                        </td>
                        <td>
                            <input type="text" class="form-control input-table" readonly name="ciudad[]" id="ciudad[]" required autocomplete="off" maxlength="50" minlength="5" value="${valor['ciudad']}">
                            <div class="invalid-feedback" id="error-ciudad[]"></div>
                        </td>
                        <td>
                            <input type="text" class="form-control input-table" readonly name="estado[]" id="estado[]" required autocomplete="off" maxlength="50" minlength="5" value="${valor['estado']}">
                            <div class="invalid-feedback" id="error-estado[]"></div>
                        </td>
                        <td>
                            <input type="text" class="form-control input-table" readonly name="municipio[]" id="municipio[]" required autocomplete="off" maxlength="50" minlength="5" value="${valor['municipio']}">
                            <div class="invalid-feedback" id="error-municipio[]"></div>
                        </td>
                        <td>
                            <input type="number" class="form-control input-table" readonly name="cp[]" id="cp[]" required autocomplete="off" maxlength="50" minlength="5" value="${valor['cp']}">
                            <div class="invalid-feedback" id="error-cp[]"></div>
                        </td>
                        <td>
                            <input type="text" class="form-control input-table" readonly name="colonia[]" id="colonia[]" required autocomplete="off" maxlength="50" minlength="5" value="${valor['colonia']}">
                            <div class="invalid-feedback" id="error-colonia[]"></div>
                        </td>
                        <td>
                            <input type="text" class="form-control input-table" readonly name="calle[]" id="calle[]" required autocomplete="off" maxlength="50" minlength="5" value="${valor['calle']}">
                            <div class="invalid-feedback" id="error-calle[]"></div>
                        </td>
                        <td>
                            <input type="number" class="form-control input-table" readonly name="n_exterior[]" id="n_exterior[]" required autocomplete="off" maxlength="50" minlength="5" value="${valor['n_exterior'] == null ? 0 : valor['n_exterior']}">
                            <div class="invalid-feedback" id="error-n_exterior[]"></div>
                        </td>
                        <td>
                            <input type="number" class="form-control input-table" readonly name="n_interior[]" id="n_interior[]" required autocomplete="off" maxlength="50" minlength="5" value="${valor['n_interior'] == null ? 0 : valor['n_interior']}">
                            <div class="invalid-feedback" id="error-n_interior[]"></div>
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