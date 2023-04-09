$('#form-add-gasto').submit(function(e){
    e.preventDefault();
    removeClass('form-add-gasto');
    var data = new FormData(this);
    var url = '';
    if($('#id').val() == ''){
        url = 'api/addGastos';
    }else{
        url = 'api/updateGastos';
        data.append('_method', 'PUT');
    }
    $.ajax({
        'type': 'POST',
        'url': url,
        'data': data,
        enctype: 'multipart/form-data',
        contentType: false,
        cache: false,
        processData:false,
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
                getGastos(2, '');
                closeModal('modal-gasto', 'form-add-gasto');
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
            }
            removeClassBtnEfectoLoad('load-form','load-button', 'btn-modal');
        }
    });
});
$('#form-upload-marca').submit(function(e){
    e.preventDefault();
    removeClass('form-upload-marca');
    let data = $(this).serialize();
    $.ajax({
        'type': 'POST',
        'url': 'api/uploadMarca',
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
                getMarcas(2, '');
                closeModal('upload-marca', 'form-upload-marca');
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
function getGastos(tipo, filtro){
    $.ajax({
        'type': 'get',
        'url': '/api/getGastos/'+tipo+'?filtro='+filtro,
        beforeSend: function(){
            $('#table-gasto tbody').empty();
            $('#table-gasto tbody').html('<tr><td colspan="8"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
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
                            <td>${valor.user.nombres + ' ' + valor.user.app + ' ' + valor.user.apm}</td>
                            <td>${valor.tipo_gasto.tipo}</td>
                            <td>${valor.fecha_hora}</td>
                            <td>${valor.monto}</td>
                            <td>${valor.desc}</td>
                            <td>
                                <a href="/api/detalle_gasto/${valor.id}" class="btn p-0 border-0"><i class="ti ti-list-details icono text-dark"></i></a>
                            </td>
                            <td>
                                <button type="button" class="btn p-0 border-0"  aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Editar" onclick="onChange(${valor.id}, ${valor.tipo_gasto_id}, '${valor.monto}', '${valor.desc}', '${valor.comprobante}');"><i class="ti ti-edit icono text-primary"></i></button>
                            </td>
                            <td>
                                <button type="button" class="btn p-0 border-0"  aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Eliminar" onclick="confirmDelete(${valor.id}, '', 'api/deleteGastos/', 'gasto', 'el');"><i class="ti ti-trash icono text-danger"></i></button>
                            </td>
    
                        </tr>
                    `;
                });
                $('#table-gasto tbody').html(row);
                $("#table-gasto").paginationTdA({
                    elemPerPage: 5
                });
                let pag = $('.paginationClick').parent()[0];
                pag.classList.add('active');
            }else{
                $('#table-gasto tbody').html('<tr><td colspan="7" class="text-center">No hay registros</td></tr>');
            }
        }
    })
}
function onChange(id, tipo_gasto_id, monto, desc, comprobante){
    $('#id').val(id);
    tipoGastoId = tipo_gasto_id;
    $('#tipo_gasto_id').val(tipo_gasto_id);
    $('#monto').val(monto);
    $('#desc').val(desc);
    getTipoGasto(2, '');
    if(comprobante != 'null'){
        $("#view-comprobante").attr('src', '/img/comprobantes/'+comprobante);
        $("#name-comprobante").html(comprobante);
        $('#preview-comprobante').removeClass('d-none');
    }
    openModal('modal-gasto', 'gastos', 1);
}
function details(marca, created_at, updated_at, deleted_at){
    const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    $('#nom-marca').html(marca);
    let creacion = new Date(created_at);
    let actualizacion = new Date(updated_at);
    let eliminacion = new Date(deleted_at);
    $('#creacion').html(creacion.getDate()+' de '+meses[creacion.getMonth()]+' de '+creacion.getFullYear());
    $('#actualizacion').html(actualizacion.getDate()+' de '+meses[actualizacion.getMonth()]+' de '+actualizacion.getFullYear());
    if(eliminacion.getDate().toString() != 'NaN'){
    $('#eliminacion').html(eliminacion.getDate()+' de '+meses[eliminacion.getMonth()]+' de '+eliminacion.getFullYear());
    }
    openModal('modal-detalle-marca', 'marcas', '2');

}