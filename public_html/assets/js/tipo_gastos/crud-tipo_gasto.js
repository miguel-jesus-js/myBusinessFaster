$('#form-add-tipo_gasto').submit(function(e){
    e.preventDefault();
    removeClass('form-add-tipo_gasto');
    let data = $(this).serialize();
    var url = '';
    var tipo = '';
    if($('#id').val() == ''){
        url = 'api/addTipoGastos';
        tipo = 'POST';
    }else{
        url = 'api/updateTipoGastos';
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
                getTipoGastos(2, '');
                closeModal('modal-tipo_gasto', 'form-add-tipo_gasto');
            }
        },
        error: function(request, status, error){
            switch (request.status) {
                case 422:
                    addValidacion(request.responseJSON.errors, false);
                    Toast.fire({
                        icon: 'warning',
                        title: 'Error de validaciones',
                        text: 'Algunos campos tienen errores'
                    });
                    break;
                case 0:
                    msjError('error', 'Error', 'Se perdio la conexión con el servidor, intente nuevamente');
                    break;
                case 403:
                    msjError(request.responseJSON.icon, request.responseJSON.title, request.responseJSON.text);
                    break;
            }
            removeClassBtnEfectoLoad('load-form1','load-button1', 'btn-modal1');
        }
    });
});
$('#form-upload-tipo_gasto').submit(function(e){
    e.preventDefault();
    removeClass('form-upload-tipo_gasto');
    let data = $(this).serialize();
    $.ajax({
        'type': 'POST',
        'url': 'api/uploadTipoGastos',
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
                getTipoGastos(2, '');
                closeModal('upload-tipo_gasto', 'form-upload-tipo_gasto');
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
                case 403:
                    msjError(request.responseJSON.icon, request.responseJSON.title, request.responseJSON.text);
                    break;
            }
            removeClassBtnEfectoLoad('load-form1','load-button1', 'btn-modal1');
        }
    });
})
function getTipoGastos(tipo, filtro){
    $.ajax({
        'type': 'get',
        'url': '/api/getTipoGastos/'+tipo+'?filtro='+filtro,
        beforeSend: function(){
            $('#table-tipo_gasto tbody').empty();
            $('#table-tipo_gasto tbody').html('<tr><td colspan="8"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
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
                            <td>${valor.tipo}</td>
                            <td>
                                <button type="button" class="btn p-0 border-0"  aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detalles" onclick="details('${valor.tipo}', '${valor.created_at}', '${valor.updated_at}', '${valor.deleted_at}');"><i class="ti ti-eye icono text-success"></i></button>
                            </td>
                            <td>
                                <button type="button" class="btn p-0 border-0"  aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Editar" onclick="onChange(${valor.id}, '${valor.tipo}');"><i class="ti ti-edit icono text-primary"></i></button>
                            </td>
                            <td>
                                <button type="button" class="btn p-0 border-0"  aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Eliminar" onclick="confirmDelete(${valor.id}, '${valor.tipo}', 'api/deleteTipoGastos/', 'tipo de gasto', 'el');"><i class="ti ti-trash icono text-danger"></i></button>
                            </td>
    
                        </tr>
                    `;
                });
                $('#table-tipo_gasto tbody').html(row);
                $("#table-tipo_gasto").paginationTdA({
                    elemPerPage: 5
                });
                let pag = $('.paginationClick').parent()[0];
                pag.classList.add('active');
            }else{
                $('#table-tipo_gasto tbody').html('<tr><td colspan="4" class="text-center">No hay registros</td></tr>');
            }
        }
    })
}
function onChange(id, tipo){
    $('#id').val(id);
    $('#tipo').val(tipo);
    openModal('modal-tipo_gasto', 'tipo_gastos', 1);
}
function details(tipo, created_at, updated_at, deleted_at){
    const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    $('#nom-tipo_gasto').html(tipo);
    let creacion = new Date(created_at);
    let actualizacion = new Date(updated_at);
    let eliminacion = new Date(deleted_at);
    $('#creacion').html(creacion.getDate()+' de '+meses[creacion.getMonth()]+' de '+creacion.getFullYear());
    $('#actualizacion').html(actualizacion.getDate()+' de '+meses[actualizacion.getMonth()]+' de '+actualizacion.getFullYear());
    if(eliminacion.getDate().toString() != 'NaN'){
    $('#eliminacion').html(eliminacion.getDate()+' de '+meses[eliminacion.getMonth()]+' de '+eliminacion.getFullYear());
    }
    openModal('modal-detalle-tipo_gasto', 'tipo_gasto', '2');

}