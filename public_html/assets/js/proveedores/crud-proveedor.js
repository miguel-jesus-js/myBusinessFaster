$('#form-add-proveedor').submit(function(e){
    e.preventDefault();
    removeClass('form-add-proveedor');
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
                closeModal('modal-proveedor', 'form-add-proveedor');
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
            var acceso = '';
            var row = '';
            if(data.length > 0){
                $.each(data, function(index, valor){
                    if(valor.deleted_at != null){ //validación para que los registros elimnados sean de color rojo
                        elimnado = 'table-danger';
                    }else{
                        elimnado = '';
                    }
                    row += `
                        <tr class="${elimnado}">
                            <td>${valor.clave}</td>
                            <td>${valor.nombres} ${valor.app} ${valor.apm}</td>
                            <td>${valor.empresa == null ? '' : valor.empresa}</td>
                            <td>${valor.email}</td>
                            <td>${valor.telefono}</td>
                            <td>
                                <button type="button" class="btn p-0 border-0" onclick="details('${valor.clave}', '${valor.nombres}', '${valor.app}', '${valor.apm}', '${valor.email}', '${valor.telefono}', '${valor.rfc}', '${valor.empresa}', '${valor.ciudad}', '${valor.estado}', '${valor.municipio}', ${valor.cp}, '${valor.colonia}', '${valor.calle}', ${valor.n_exterior}, ${valor.n_interior}, '${valor.created_at}', '${valor.updated_at}', '${valor.deleted_at}');"><i class="ti ti-eye icono text-success"></i></button>
                            </td>
                            <td>
                                <button type="button" class="btn p-0 border-0" onclick="onChange(${valor.id}, '${valor.clave}', '${valor.nombres}', '${valor.app}', '${valor.apm}', '${valor.email}', '${valor.telefono}', '${valor.rfc}', '${valor.empresa}', '${valor.ciudad}', '${valor.estado}', '${valor.municipio}', ${valor.cp}, '${valor.colonia}', '${valor.calle}', ${valor.n_exterior}, ${valor.n_interior});"><i class="ti ti-edit icono text-primary"></i></button>
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
function onChange(id, clave, nombres, app, apm, email, telefono, rfc, empresa, ciudad, estado, municipio, cp, colonia, calle, n_exterior, n_interior){
    $('#id').val(id);
    $('#clave').val(clave);
    $('#nombres').val(nombres);
    $('#app').val(app);
    $('#apm').val(apm);
    $('#email').val(email);
    $('#telefono').val(telefono);
    $('#rfc').val(rfc == 'null' ? '' : rfc);
    $('#empresa').val(empresa == 'null' ? '': empresa);
    $('#ciudad').val(ciudad);
    $('#estado').val(estado);
    $('#municipio').val(municipio);
    $('#cp').val(cp);
    $('#colonia').val(colonia);
    $('#calle').val(calle);
    $('#n_exterior').val(n_exterior);
    $('#n_interior').val(n_interior);
    openModal('modal-proveedor', 'proveedores', 1);
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
