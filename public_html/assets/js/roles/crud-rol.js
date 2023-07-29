$('#form-add-rol').submit(function(e){
    e.preventDefault();
    removeClass('form-add-rol');
    let data = $(this).serialize();
    let url = '';
    let tipo = '';
    let permisos = [];
    $('#table-modulos tbody tr').each(function(){
        const checkbox = $(this).find('.checkbox');
        checkbox.each(function(){
            if($(this).prop('checked')) permisos.push($(this).val());
        });
    });
    data = data + '&permisos=' + permisos;
    if($('#id').val() == ''){
        url = 'api/addRoles';
        tipo = 'POST';
    }else{
        url = 'api/updateRoles';
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
                getRoles(2, '');
                closeModal('modal-rol', 'form-add-rol');
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
function getRoles(tipo, filtro){
    $.ajax({
        'type': 'get',
        'url': '/api/getRoles/'+'?filtro='+filtro,
        beforeSend: function(){
            $('#table-rol tbody').empty();
            $('#table-rol tbody').html('<tr><td colspan="8"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
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
                            <td>${valor.name}</td>
                            <td></td>
                            <td>
                                <button type="button" class="btn p-0 border-0"  aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detalles" onclick="details('${valor.material}', '${valor.created_at}', '${valor.updated_at}', '${valor.deleted_at}');"><i class="ti ti-eye icono text-success"></i></button>
                            </td>
                            <td>
                                <button type="button" class="btn p-0 border-0" onclick="onChange(${valor.id}, '${valor.name}');"><i class="ti ti-edit icono text-primary"></i></button>
                            </td>
                            <td>
                                <button type="button" class="btn p-0 border-0" onclick="confirmDelete(${valor.id}, '${valor.name}', 'api/deleteMateriales/', 'material', 'el');"><i class="ti ti-trash icono text-danger"></i></button>
                            </td>
    
                        </tr>
                    `;
                });
                $('#table-rol tbody').html(row);
                $("#table-rol").paginationTdA({
                    elemPerPage: 5
                });
                let pag = $('.paginationClick').parent()[0];
                pag.classList.add('active');
            }else{
                $('#table-rol tbody').html('<tr><td colspan="4" class="text-center">No hay registros</td></tr>');
            }
        }
    })
}
//llenar tabla con los modulos
function getModulos() {
    let table = $('#table-modulos tbody tr');
    if(table.length <= 1){
        $.ajax({
            'type': 'GET',
            'url': 'api/getModulos',
            beforeSend: function () {
                $('#table-modulos tbody').empty();
                $('#table-modulos tbody').html('<tr><td colspan="8"><center><h5>Cargando<span class="animated-dots"></span></h5></center></td></tr>');
            },
            success: function (response) {
                $('#load-modulos').addClass('d-none');
                let data = JSON.parse(response);
                let row = '';
                $.each(data, function (index, valor) {
                    if (valor.es_catalogo == 1) {
                        valor.es_catalogo = 'Si';
                    } else {
                        valor.es_catalogo = 'No';
                    }
                    row += 
                    `<tr>
                        <td><input class="form-check-input selectRow" type="checkbox"></td>
                        <td class="id-hide">${valor.id}</td>
                        <td>${valor.modulo}</td>
                        ${valor.permisos.map((permiso) => `<td><input class="form-check-input checkbox" name="permission_id" value="${permiso.id}" type="checkbox"></td>`)}
                    </tr>
                    `;
                });
                $('#table-modulos tbody').html(row);
                $('td:nth-child(2)').hide();//ocultamos la fila ID
                // $("#table-modulos").paginationTdA({
                //     elemPerPage: 5
                // });
                // let padre = $('.pagination').parent();
                // padre[0].colSpan = 3;
            }
        });
    }
}
// Si se hace click sobre el input de tipo checkbox con id checkb
$(document).on('click', '.selectRow', function(){
    let bandera;
    $(this).prop('checked') ? bandera = true : bandera = false;
    let td = $(this).closest('td').siblings();
    td.each(function(index, valor){
        if(index > 1){
            $(this).find('input').prop('checked', bandera);
        }
    })
    
})