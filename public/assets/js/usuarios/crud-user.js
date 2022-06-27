$('#form-add-user').submit(function(e){
    e.preventDefault();
    let data = $(this).serialize();
    var i = 0;
    var modulo_id = []
    var c = [];
    var r = [];
    var u = [];
    var d = [];
    var table_modulo = $('#table-user-modulos tbody');
    table_modulo.find('tr').each(function (i, el) {
        var $tds = $(this).find('td');
        modulo_id.push($tds.eq(0).text());//obtiene el id del modulo
        c.push($tds.eq(2)[0].firstChild.checked); //obtiene el valor del check true o false
        r.push($tds.eq(3)[0].firstChild.checked);
        u.push($tds.eq(4)[0].firstChild.checked);
        d.push($tds.eq(5)[0].firstChild.checked);
    });
    var datos  = [];
    var objeto = {};
    for(var i= 0; i < modulo_id.length; i++) {//creamos la estructura json para poder enviarlo
       datos.push({ 
            "modulo_id": modulo_id[i],
            "c": c[i],
            "r": r[i] ,
            "u": u[i] ,
            "d": d[i] ,
        });
    }
    objeto = datos;
    let json = JSON.stringify(objeto); //lista de objetos en Json
    data = data + '&datos='+ json;
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
            $('#load-form').removeClass('d-none');
            $('#load-button').removeClass('d-none');
            $('#btn-modal').html('enviando');
        },
        success: function(response){
            let respuesta = JSON.parse(response);
            $('#load-form').addClass('d-none');
            $('#load-button').addClass('d-none');
            $('#btn-modal').html('Registrar');
            Toast.fire({
                icon: respuesta.icon,
                title: respuesta.title,
                text: respuesta.text
            });
            if(respuesta.icon == 'success'){
                getUsuarios('api/getUsuarios/', 2);
                closeModal('modal-user', 'form-add-user');
            }
        }
    });
})
function getUsuarios(api, filtro){
    $.ajax({
        'type': 'get',
        'url': api+filtro,
        beforeSend: function(){
            $('#table-user tbody').empty();
            $('#table-user tbody').html('<tr id="load-users"><td colspan="8"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
        },
        success: function(response){
            $('#load-users').addClass('d-none');
            var data = JSON.parse(response);
            var elimnado = '';
            var acceso = '';
            var row = '';
            $.each(data, function(index, valor){
                acceso = JSON.stringify(valor.accesos);//hacemos la conversion para enviar el json
                var regex = new RegExp("\"", "g");
                var accesoString = acceso.replace(regex, "'");//quitamos las comillas "" por '', de otro modo da error al pasarlo como parametro
                if(valor.deleted_at != null){ //validación para que los registros elimnados sean de color rojo
                    elimnado = 'table-danger';
                }else{
                    elimnado = '';
                }
                row += `
                    <tr class="${elimnado}">
                        <td><span class="avatar avatar-sm avatar-rounded" style="background-image: url(img/usuarios/${valor.foto_perfil})"></span></td>
                        <td>${valor.nombres} ${valor.app} ${valor.apm}</td>
                        <td>${valor.nom_user}</td>
                        <td>${valor.role.rol}</td>
                        <td>${valor.email}</td>
                        <td>${valor.telefono}</td>
                        <td>
                            <button type="button" class="btn p-0 border-0" onclick="onChange(${valor.id}, ${valor.role_id}, '${valor.nombres}', '${valor.app}', '${valor.apm}', '${valor.email}', '${valor.telefono}', '${valor.rfc}', '${valor.ciudad}', '${valor.estado}', '${valor.municipio}', ${valor.cp}, '${valor.colonia}', '${valor.calle}', ${valor.n_exterior}, ${valor.n_interior}, '${valor.nom_user}', ${accesoString});"><i class="ti ti-edit icono text-primary"></i></button>
                        </td>
                        <td>
                            <button type="button" class="btn p-0 border-0" onclick="confirmDelete(${valor.id}, '${valor.marca}', 'api/deleteUsuarios/', 'usuario', 'el');"><i class="ti ti-trash icono text-danger"></i></button>
                        </td>

                    </tr>
                `;
            });
            $('#table-user tbody').html(row);
            $("#table-user").paginationTdA({
                elemPerPage: 5
            });
        }
    })
}
function onChange(id, role_id, nombres, app, apm, email, telefono, rfc, ciudad, estado, municipio, cp, colonia, calle, n_exterior, n_interior, nom_user, acceso){
    getRoles();
    $('#id').val(id);
    $('#nombres').val(nombres);
    $('#app').val(app);
    $('#apm').val(apm);
    $('#email').val(email);
    $('#telefono').val(telefono);
    $('#rfc').val(rfc);
    $('#ciudad').val(ciudad);
    $('#estado').val(estado);
    $('#municipio').val(municipio);
    $('#cp').val(cp);
    $('#colonia').val(colonia);
    $('#calle').val(calle);
    $('#n_exterior').val(n_exterior);
    $('#n_interior').val(n_interior);
    $('#nom_user').val(nom_user);
    openModal('modal-user', 'usuarios', 1);
    $('#role_id').val(role_id);
    //llenamos la tabla con los permisos
    var rowModulos = '';
    $.each(acceso, function(index, valor){
        let c = '';
        let r = '';
        let u = '';
        let d = '';
        if(valor.c == 1){
            c = 'checked';
        }
        if(valor.r == 1){
            r = 'checked';
        }
        if(valor.u == 1){
            u = 'checked';
        }
        if(valor.d == 1){
            d = 'checked';
        }
        rowModulos += `
                    <tr>
                        <td>${valor.modulo_id}</td>
                        <td>${valor.modulo}</td>
                        <td><input class="form-check-input checar" type="checkbox" ${c}></td>
                        <td><input class="form-check-input checar" type="checkbox" ${r}></td>
                        <td><input class="form-check-input checar" type="checkbox" ${u}></td>
                        <td><input class="form-check-input checar" type="checkbox" ${d}></td>
                        <td>
                            <button type="button" class="btn p-0 border-0 borrar"><i class="ti ti-trash icono text-danger"></i></button>
                        </td>
                    </tr>     
        `;
    });
    $('#table-user-modulos tbody').html(rowModulos);
    $('#table-user-modulos td:nth-child(1)').hide();//ocultamos la fila ID
}