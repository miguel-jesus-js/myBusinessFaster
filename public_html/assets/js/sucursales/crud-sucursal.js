var idUser = 0;
$('#form-add-sucursal').submit(function(e){
    e.preventDefault();
    removeClass('form-add-sucursal');
    let data = $(this).serialize();
    var url = '';
    var tipo = '';
    if($('#id').val() == ''){
        url = 'api/addSucursales';
        tipo = 'POST';
    }else{
        url = 'api/updateSucursales';
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
                getSucursales(2, '');
                closeModal('modal-sucursal', 'form-add-sucursal');
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
$('#form-upload-sucursal').submit(function(e){
    e.preventDefault();
    removeClass('form-upload-sucursal');
    $.ajax({
        'type': 'POST',
        'url': 'api/uploadSucursal',
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
                getSucursales(2, '');
                closeModal('upload-sucursal', 'form-upload-sucursal');
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
function getSucursales(tipo, filtro){
    $.ajax({
        'type': 'GET',
        'url': '/api/getSucursales/'+tipo+'?filtro='+filtro,
        beforeSend: function(){
            $('#table-sucursal tbody').empty();
            $('#table-sucursal tbody').html('<tr id="load-almacenes"><td colspan="8"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
        },
        success: function(response){
            var data = JSON.parse(response);
            var elimnado = '';
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
                            <td>${valor.nombre}</td>
                            <td>${valor.responsable == null ? '' : valor.responsable.nombres +' '+ valor.responsable.app +' '+ valor.responsable.apm}</td>
                            <td>${valor.telefono}</td>}</td>
                            <td>${valor.correo}</td>}</td>
                            <td>${valor.rfc == null ? '' : valor.rfc}</td>
                            <td>
                                <a href="${valor.facebook}" target="_blank" class="btn btn-facebook p-1 btn-sm" aria-label="Button">
                                    <i class="ti ti-brand-facebook"></i>
                                </a>
                                <a href="${valor.twitter}" target="_blank" class="btn btn-twitter p-1 btn-sm" aria-label="Button">
                                    <i class="ti ti-brand-twitter"></i>
                                </a>
                                <a href="${valor.instagram}" target="_blank" class="btn btn-instagram p-1 btn-sm" aria-label="Button">
                                    <i class="ti ti-brand-instagram"></i>
                                </a>
                                <a href="${valor.tiktok}" target="_blank" class="btn bg-dark p-1 btn-sm" aria-label="Button">
                                    <i class="ti ti-brand-tiktok text-white"></i>
                                </a>
                                <a href="${valor.whatsapp}" target="_blank" class="btn bg-green p-1 btn-sm" aria-label="Button">
                                    <i class="ti ti-brand-whatsapp text-white"></i>
                                </a>
                            </td>
                            <td>
                                <a href="/api/showProducto/${valor.id}" class="btn p-0 border-0"><i class="ti ti-list-details icono text-dark"></i></a>
                            </td>
                            <td>
                                <button type="button" class="btn p-0 border-0" onclick="onChange(${valor.id}, ${valor.user_id}, '${valor.nombre}', '${valor.telefono}', '${valor.correo}', '${valor.rfc}', '${valor.ciudad}', '${valor.estado}', '${valor.municipio}', '${valor.colonia}', '${valor.calle}', '${valor.n_exterior}', '${valor.n_interior}', '${valor.cp}', '${valor.facebook}', '${valor.twitter}', '${valor.instagram}', '${valor.tiktok}', '${valor.whatsapp}', '${valor.mensaje}');"><i class="ti ti-edit icono text-primary"></i></button>
                            </td>
                            <td>
                                <button type="button" class="btn p-0 border-0" onclick="confirmDelete(${valor.id}, '${valor.nombre}', 'api/deleteSucursales/', 'sucursal', 'la');"><i class="ti ti-trash icono text-danger"></i></button>
                            </td>
    
                        </tr>
                    `;
                });
                $('#table-sucursal tbody').html(row);
                $("#table-sucursal").paginationTdA({
                    elemPerPage: 5
                });
                let pag = $('.paginationClick').parent()[0];
                pag.classList.add('active');
            }else{
                $('#table-sucursal tbody').html('<tr><td colspan="10" class="text-center">No hay registros</td></tr>');
            }
        }
    })
}
function onChange(id, user_id, nombre, telefono, correo, rfc, ciudad, estado, municipio, colonia, calle, n_exterior, n_interior, cp, facebook, twitter, instagram, tiktok, whatsapp, mensaje){
    idUser = user_id;
    $('#id').val(id);
    $('#user_id').val(user_id);
    $('#nombre').val(nombre);
    $('#telefono').val(telefono);
    $('#correo').val(correo);
    $('#rfc').val(rfc);
    $('#ciudad').val(ciudad);
    $('#estado').val(estado);
    $('#municipio').val(municipio);
    $('#colonia').val(colonia);
    $('#calle').val(calle);
    $('#n_exterior').val(n_exterior);
    $('#n_interior').val(n_interior);
    $('#cp').val(cp);
    $('#facebook').val(facebook == 'null' ? '' : facebook);
    $('#twitter').val(twitter == 'null' ? '' : twitter);
    $('#instagram').val(instagram == 'null' ? '' : instagram);
    $('#tiktok').val(tiktok == 'null' ? '' : tiktok);
    $('#whatsapp').val(whatsapp == 'null' ? '' : whatsapp);
    $('#mensaje').val(mensaje == null ? '' : mensaje);
    getUsers();
    openModal('modal-sucursal', 'sucursales', 1);
}