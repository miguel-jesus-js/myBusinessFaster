$('#form-add-proveedor').submit(function(e){
    e.preventDefault();
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
                getProveedores('api/getProveedores/', 2);
                closeModal('modal-proveedor', 'form-add-proveedor');
            }
        }
    });
})
function getProveedores(api, filtro){
    $.ajax({
        'type': 'get',
        'url': api+filtro,
        beforeSend: function(){
            $('#table-proveedor tbody').empty();
            $('#table-proveedor tbody').html('<tr id="load-proveedores"><td colspan="8"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
        },
        success: function(response){
            $('#load-proveedores').addClass('d-none');
            var data = JSON.parse(response);
            var elimnado = '';
            var acceso = '';
            var row = '';
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
                        <td>${valor.empresa}</td>
                        <td>${valor.email}</td>
                        <td>${valor.telefono}</td>
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
    openModal('modal-proveedor', 'proveedores', 1);
}