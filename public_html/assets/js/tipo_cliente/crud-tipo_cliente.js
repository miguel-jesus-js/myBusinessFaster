$('#form-add-tipo_cliente').submit(function(e){
    e.preventDefault();
    removeClass('form-add-tipo_cliente');
    let data = $(this).serialize();
    var url = '';
    var tipo = '';
    if($('#id').val() == ''){
        url = 'api/addTipoClientes';
        tipo = 'POST';
    }else{
        url = 'api/updateTipoClientes';
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
                getTipoClientes(2, '');
                closeModal('modal-tipo_cliente', 'form-add-tipo_cliente');
            }
        },
        error: function(request, status, error){
            switch (request.status) {
                case 422:
                    addValidacion(request.responseJSON.message, false);
                    break;
            
                default:
                    break;
            }
            removeClassBtnEfectoLoad('load-form','load-button', 'btn-modal');
        }
    });
})
$('#form-upload-tipo-cliente').submit(function(e){
    e.preventDefault();
    removeClass('form-upload-tipo-cliente');
    $.ajax({
        'type': 'POST',
        'url': 'api/uploadTipoCliente',
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
                getTipoClientes(2, '');
                closeModal('upload-tipo-cliente', 'form-upload-tipo-cliente');
            }
        },
        error: function(request, status, error){
            switch (request.status) {
                case 422:
                    addValidacion(request.responseJSON.errors, false);
                    break;
                default:
                    break;
            }
            removeClassBtnEfectoLoad('load-form1','load-button1', 'btn-modal1');
        }
    });
})
function getTipoClientes(tipo, filtro){
    $.ajax({
        'type': 'get',
        'url': '/api/getTipoClientes/'+tipo+'?filtro='+filtro,
        beforeSend: function(){
            $('#table-tipo_cliente tbody').empty();
            $('#table-tipo_cliente tbody').html('<tr id="load-tipo_clientes"><td colspan="8"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
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
                            <td>${valor.tipo_cliente}</td>
                            <td>
                                <button type="button" class="btn p-0 border-0"  aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detalles" onclick="details('${valor.tipo_cliente}', '${valor.created_at}', '${valor.updated_at}', '${valor.deleted_at}');"><i class="ti ti-eye icono text-success"></i></button>
                            </td>
                            <td>
                                <button type="button" class="btn p-0 border-0" onclick="onChange(${valor.id}, '${valor.tipo_cliente}');"><i class="ti ti-edit icono text-primary"></i></button>
                            </td>
                            <td>
                                <button type="button" class="btn p-0 border-0" onclick="confirmDelete(${valor.id}, '${valor.tipo_cliente}', 'api/deleteTipoClientes/', 'tipo de cliente', 'el');"><i class="ti ti-trash icono text-danger"></i></button>
                            </td>
    
                        </tr>
                    `;
                });
                $('#table-tipo_cliente tbody').html(row);
                $("#table-tipo_cliente").paginationTdA({
                    elemPerPage: 5
                });
                let pag = $('.paginationClick').parent()[0];
                pag.classList.add('active');
            }else{
                $('#table-tipo_cliente tbody').html('<tr><td colspan="4" class="text-center">No hay registros</td></tr>');
            }
        }
    })
}
function onChange(id, tipo_cliente){
    $('#id').val(id);
    $('#tipo_cliente').val(tipo_cliente);
    openModal('modal-tipo_cliente', 'tipo_clientes', 1);
}
function details(tipo_cliente, created_at, updated_at, deleted_at){
    const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    $('#nom-tipo_cliente').html(tipo_cliente);
    let creacion = new Date(created_at);
    let actualizacion = new Date(updated_at);
    let eliminacion = new Date(deleted_at);
    $('#creacion').html(creacion.getDate()+' de '+meses[creacion.getMonth()]+' de '+creacion.getFullYear());
    $('#actualizacion').html(actualizacion.getDate()+' de '+meses[actualizacion.getMonth()]+' de '+actualizacion.getFullYear());
    if(eliminacion.getDate().toString() != 'NaN'){
    $('#eliminacion').html(eliminacion.getDate()+' de '+meses[eliminacion.getMonth()]+' de '+eliminacion.getFullYear());
    }
    openModal('modal-detalle-tipo_cliente', 'tipo_clientes', '2');

}