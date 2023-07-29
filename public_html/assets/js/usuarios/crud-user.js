var idSucursal = 0;
var idRol = 0;
// $('#form-add-user').submit(function(e){
//     e.preventDefault();
//     removeClass('form-add-user');
//     let data = $(this).serialize();
//     var url = '';
//     var tipo = '';
//     if($('#id').val() == ''){
//         url = 'api/addUsuarios';
//         tipo = 'POST';
//     }else{
//         url = 'api/updateUsuarios';
//         tipo = 'PUT';
//     }
//     $.ajax({
//         'type': tipo,
//         'url': url,
//         'data': data,
//         beforeSend: function(){
//             addHtmlEfectoLoad('load-form');
//             addClassBtnEfectoLoad('load-button', 'btn-modal');
//         },
//         success: function(response){
//             let respuesta = JSON.parse(response);
//             removeClassBtnEfectoLoad('load-form','load-button', 'btn-modal');
//             Toast.fire({
//                 icon: respuesta.icon,
//                 title: respuesta.title,
//                 text: respuesta.text
//             });
//             if(respuesta.icon == 'success'){
//                 getUsuarios(2, '');
//                 closeModal('modal-user', 'form-add-user');
//             }
//         },
//         error: function(request, status, error){
//             switch (request.status) {
//                 case 422:
//                     addValidacion(request.responseJSON.errors, true);
//                     break;
//                 case 0:
//                     msjError('error', 'Error', 'Se perdio la conexión con el servidor, intente nuevamente');
//                     break;
//             }
//             removeClassBtnEfectoLoad('load-form','load-button', 'btn-modal');
//         }
//     });
// })
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
                        <td><span class="avatar avatar-sm avatar-rounded" style="background-image: url(img/usuarios/${valor.persona.foto_perfil})"></span></td>
                        <td>${valor.persona.nombres}</td>
                        <td>${valor.sucursal.nombre}</td>
                        <td>${valor.nom_user}</td>
                        <td>${valor.roles[0].name}</td>
                        <td>${valor.persona.email}</td>
                        <td>${valor.persona.telefono}</td>
                        <td>
                        <button type="button" class="btn p-0 border-0" onclick="onChangeUser(${valor.persona_id}, ${valor.id}, ${valor.role_id}, ${valor.sucursale_id}, '${valor.persona.nombres}', '${valor.persona.email}', '${valor.persona.telefono}', '${valor.persona.rfc}', '${valor.nom_user}', ${direccionesString});"><i class="ti ti-edit icono text-primary"></i></button>
                        </td>
                        <td>
                            <button type="button" class="btn p-0 border-0" onclick="confirmDelete(${valor.id}, '${valor.persona.nombres}', 'api/deleteUsuarios/', 'usuario', 'el');"><i class="ti ti-trash icono text-danger"></i></button>
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
function onChangeUser(id, cliente_id, role_id, sucursale_id, nombres, email, telefono, rfc, nom_user, direcciones){
    debugger;
    idSucursal = sucursale_id;
    idRol = role_id;
    $('#id').val(id);
    $('#cliente_id').val(cliente_id);
    $('#role_id').val(role_id);
    $('#sucursale_id').val(sucursale_id);
    $('#nombres').val(nombres);
    $('#email').val(email);
    $('#telefono').val(telefono);
    $('#rfc').val(rfc == 'null' ? '' : rfc);
    $('#nom_user').val(nom_user);
    getRoles();
    getSucursales();
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
    openModal('modal-cliente', 'usuarios', 1);
}