$('#form-add-cliente').submit(function(e){
    e.preventDefault();
    removeClass('form-add-cliente');
    let data = $(this).serialize();
    var url = '';
    var tipo = '';
    if($('#id').val() == ''){
        url = 'api/addProveedores';
        tipo = 'POST';
    }else{
        url = 'api/updateProveedores';
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
                getProveedores(2, '');
                closeModal('modal-cliente', 'form-add-cliente');
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
})
$('#form-upload-proveedor').submit(function(e){
    e.preventDefault();
    removeClass('form-upload-proveedor');
    let data = $(this).serialize();
    $.ajax({
        'type': 'POST',
        'url': 'api/uploadProveedor',
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
                getProveedores(2, '');
                closeModal('upload-proveedor', 'form-upload-proveedor');
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
            removeClassBtnEfectoLoad('load-form1','load-button1', 'btn-modal1');
        }
    });
})
function getProveedores(tipo, filtro){
    $.ajax({
        'type': 'get',
        'url': '/api/getProveedores/'+tipo+'?filtro='+filtro,
        beforeSend: function(){
            $('#table-proveedor tbody').empty();
            $('#table-proveedor tbody').html('<tr id="load-proveedores"><td colspan="8"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
        },
        success: function(response){
            var data = JSON.parse(response);
            var elimnado = '';
            var row = '';
            if(data.length > 0){
                $.each(data, function(index, valor){
                    var direcciones = JSON.stringify(valor.persona.direcciones);//hacemos la conversion para enviar el json
                    var regex = new RegExp("\"", "g");
                    var direccionesString = direcciones.replace(regex, "'");//quitamos las comillas "" por '', de otro modo da error al pasarlo como parametro
                    if(valor.deleted_at != null){ //validación para que los registros elimnados sean de color rojo
                        elimnado = 'table-danger';
                    }else{
                        elimnado = '';
                    }
                    row += `
                        <tr class="${elimnado}">
                            <td>${valor.clave}</td>
                            <td>${valor.persona.nombres}</td>
                            <td>${valor.empresa == null ? '' : valor.empresa}</td>
                            <td>${valor.persona.email}</td>
                            <td>${valor.persona.telefono}</td>
                            <td>
                                <button type="button" class="btn p-0 border-0" onclick="details('${valor.clave}', '${valor.nombres}', '${valor.app}', '${valor.apm}', '${valor.email}', '${valor.telefono}', '${valor.rfc}', '${valor.empresa}', '${valor.ciudad}', '${valor.estado}', '${valor.municipio}', ${valor.cp}, '${valor.colonia}', '${valor.calle}', ${valor.n_exterior}, ${valor.n_interior}, '${valor.created_at}', '${valor.updated_at}', '${valor.deleted_at}');"><i class="ti ti-eye icono text-success"></i></button>
                            </td>
                            <td>
                                <button type="button" class="btn p-0 border-0" onclick="onChange(${valor.persona_id}, ${valor.id}, '${valor.clave}', '${valor.persona.nombres}', '${valor.persona.email}', '${valor.persona.telefono}', '${valor.persona.rfc}', '${valor.empresa}', '${direccionesString}');"><i class="ti ti-edit icono text-primary"></i></button>
                            </td>
                            <td>
                                <button type="button" class="btn p-0 border-0" onclick="confirmDelete(${valor.id}, '${valor.nombres}', 'api/deleteProveedores/', 'proveedor', 'el');"><i class="ti ti-trash icono text-danger"></i></button>
                            </td>
    
                        </tr>
                    `;
                });
                $('#table-proveedor tbody').html(row);
                $("#table-proveedor").paginationTdA({
                    elemPerPage: 5
                });
                let pag = $('.paginationClick').parent()[0];
                pag.classList.add('active');
            }else{
                $('#table-proveedor tbody').html('<tr><td colspan="8" class="text-center">No hay registros</td></tr>');
            }
        }
    })
}
function onChange(id, proveedore_id, clave, nombres, email, telefono, rfc, empresa, direcciones){
    $('#id').val(id);
    $('#cliente_id').val(proveedore_id);
    $('#clave').val(clave);
    $('#nombres').val(nombres);
    $('#email').val(email);
    $('#telefono').val(telefono);
    $('#rfc').val(rfc == 'null' ? '' : rfc);
    $('#empresa').val(empresa == 'null' ? '': empresa);
    openModal('modal-cliente', 'proveedores', 1);
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
function details(clave, nombres, app, apm, email, telefono, rfc, empresa, ciudad, estado, municipio, cp, colonia, calle, n_exterior, n_interior, created_at, updated_at, deleted_at){
    $('#d-clave').html(clave);
    $('#d-nombres').html(nombres);
    $('#d-app').html(app);
    $('#d-apm').html(apm);
    $('#d-email').html(email);
    $('#d-telefono').html(telefono);
    $('#d-rfc').html(rfc);
    $('#d-empresa').html(empresa);
    $('#d-ciudad').html(ciudad);
    $('#d-estado').html(estado);
    $('#d-municipio').html(municipio);
    $('#d-cp').html(cp);
    $('#d-colonia').html(colonia);
    $('#d-calle').html(calle);
    $('#d-n_exterior').html(n_exterior);
    $('#d-n_interior').html(n_interior);
    const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    let creacion = new Date(created_at);
    let actualizacion = new Date(updated_at);
    let eliminacion = new Date(deleted_at);
    $('#creacion').html(creacion.getDate()+' de '+meses[creacion.getMonth()]+' de '+creacion.getFullYear());
    $('#actualizacion').html(actualizacion.getDate()+' de '+meses[actualizacion.getMonth()]+' de '+actualizacion.getFullYear());
    if(eliminacion.getDate().toString() != 'NaN'){
        $('#eliminacion').html(eliminacion.getDate()+' de '+meses[eliminacion.getMonth()]+' de '+eliminacion.getFullYear());
    }
    openModal('modal-detalle-proveedor', 'proveedores', 2);
}
