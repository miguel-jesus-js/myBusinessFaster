$('#form-add-cliente').submit(function(e){
    e.preventDefault();
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
                getClientes('api/getClientes/', 2);
                closeModal('modal-cliente', 'form-add-cliente');
            }
        }
    });
})
function getClientes(api, filtro){
    $.ajax({
        'type': 'get',
        'url': api+filtro,
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
                        <td>${valor.tipo_cliente_id}</td>
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
        }
    })
}
function onChange(id, tipo_cliente_id, nombres, app, apm, email, telefono, rfc, empresa, ciudad, estado, municipio, cp, colonia, calle, n_exterior, n_interior, direcciones){
    getTipoClientes();
    $('#id').val(id);
    $('#nombres').val(nombres);
    $('#app').val(app);
    $('#apm').val(apm);
    $('#email').val(email);
    $('#telefono').val(telefono);
    $('#rfc').val(rfc);
    $('#empresa').val(empresa);
    $('#ciudad').val(ciudad);
    $('#estado').val(estado);
    $('#municipio').val(municipio);
    $('#cp').val(cp);
    $('#colonia').val(colonia);
    $('#calle').val(calle);
    $('#n_exterior').val(n_exterior);
    $('#n_interior').val(n_interior);
    openModal('modal-cliente', 'clientes', 1);
    $('#tipo_cliente_id').val(tipo_cliente_id);
    //llenamos la tabla con los permisos
    var rowDirecciones = '';
    $.each(direcciones, function(index, valor){
        rowDirecciones += `
                    <tr>
                        <td>${valor.cliente_id}</td>
                        <td>${valor.ciudad}</td>
                        <td>${valor.estado}</td>
                        <td>${valor.municipio}</td>
                        <td>${valor.cp}</td>
                        <td>${valor.colonia}</td>
                        <td>${valor.calle}</td>
                        <td>${valor.n_exterior}</td>
                        <td>${valor.n_interior}</td>
                        <td>
                            <button type="button" class="btn p-0 border-0 borrar"><i class="ti ti-trash icono text-danger"></i></button>
                        </td>
                    </tr>     
        `;
    });
    $('#table-cliente-direcciones tbody').html(rowDirecciones);
    $('#table-cliente-direcciones td:nth-child(1)').hide();//ocultamos la fila ID
}