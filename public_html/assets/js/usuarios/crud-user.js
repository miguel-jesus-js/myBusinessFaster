var idSucursal = 0;
$('#form-add-user').submit(function(e){
    e.preventDefault();
    removeClass('form-add-user');
    let data = $(this).serialize();
    var url = '';
    var tipo = '';
    if($('#id').val() == ''){
        url = 'api/addUsuarios';
        tipo = 'POST';
    }else{
        url = 'api/updateUsuarios';
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
                getUsuarios(2, '');
                closeModal('modal-user', 'form-add-user');
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
            removeClassBtnEfectoLoad('load-form','load-button', 'btn-modal');
        }
    });
})
$('#form-upload-usuario').submit(function(e){
    e.preventDefault();
    removeClass('form-upload-usuario');
    let data = $(this).serialize();
    $.ajax({
        'type': 'POST',
        'url': 'api/uploadUsuario',
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
                getUsuarios(2, '');
                closeModal('upload-usuario', 'form-upload-usuario');
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
function getUsuarios(tipo, filtro){
    $.ajax({
        'type': 'get',
        'url': '/api/getUsuarios/'+tipo+'?filtro='+filtro+'&sucursal='+$('#sucursale_id1').val(),
        beforeSend: function(){
            $('#table-user tbody').empty();
            $('#table-user tbody').html('<tr id="load-users"><td colspan="8"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
        },
        success: function(response){
            var data = JSON.parse(response);
            var elimnado = '';
            var row = '';
            $.each(data, function(index, valor){
                if(valor.deleted_at != null){ //validación para que los registros elimnados sean de color rojo
                    elimnado = 'table-danger';
                }else{
                    elimnado = '';
                }
                row += `
                    <tr class="${elimnado}">
                        <td><span class="avatar avatar-sm avatar-rounded" style="background-image: url(img/usuarios/${valor.foto_perfil})"></span></td>
                        <td>${valor.nombres} ${valor.app} ${valor.apm}</td>
                        <td>${valor.sucursal.nombre}</td>
                        <td>${valor.nom_user}</td>
                        <td></td>
                        <td>${valor.email}</td>
                        <td>${valor.telefono}</td>
                        <td>
                            <button type="button" class="btn p-0 border-0" onclick="onChange(${valor.id}, ${valor.role_id}, ${valor.sucursale_id}, '${valor.nombres}', '${valor.app}', '${valor.apm}', '${valor.email}', '${valor.telefono}', '${valor.rfc}', '${valor.ciudad}', '${valor.estado}', '${valor.municipio}', ${valor.cp}, '${valor.colonia}', '${valor.calle}', ${valor.n_exterior}, ${valor.n_interior}, '${valor.nom_user}');"><i class="ti ti-edit icono text-primary"></i></button>
                        </td>
                        <td>
                            <button type="button" class="btn p-0 border-0" onclick="confirmDelete(${valor.id}, '${valor.nombres}', 'api/deleteUsuarios/', 'usuario', 'el');"><i class="ti ti-trash icono text-danger"></i></button>
                        </td>

                    </tr>
                `;
            });
            $('#table-user tbody').html(row);
            $("#table-user").paginationTdA({
                elemPerPage: 5
            });
            let pag = $('.paginationClick').parent()[0];
            pag.classList.add('active');
        }
    })
}
function onChange(id, role_id, sucursale_id, nombres, app, apm, email, telefono, rfc, ciudad, estado, municipio, cp, colonia, calle, n_exterior, n_interior, nom_user){
    idSucursal = sucursale_id;
    debugger;
    $('#id').val(id);
    $('#role_id').val(role_id);
    $('#sucursale_id').val(sucursale_id);
    $('#nombres').val(nombres);
    $('#app').val(app);
    $('#apm').val(apm);
    $('#email').val(email);
    $('#telefono').val(telefono);
    $('#rfc').val(rfc == 'null' ? '' : rfc);
    $('#ciudad').val(ciudad);
    $('#estado').val(estado);
    $('#municipio').val(municipio);
    $('#cp').val(cp);
    $('#colonia').val(colonia);
    $('#calle').val(calle);
    $('#n_exterior').val(n_exterior);
    $('#n_interior').val(n_interior);
    $('#nom_user').val(nom_user);
    getRoles();
    getSucursales();
    openModal('modal-user', 'usuarios', 1);
}