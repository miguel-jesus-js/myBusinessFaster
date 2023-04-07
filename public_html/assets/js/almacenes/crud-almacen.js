var idSucursal = 0;
$('#form-add-almacen').submit(function(e){
    e.preventDefault();
    removeClass('form-add-almacen');
    let data = $(this).serialize();
    var url = '';
    var tipo = '';
    if($('#id').val() == ''){
        url = 'api/addAlmacenes';
        tipo = 'POST';
    }else{
        url = 'api/updateAlmacenes';
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
                getAlmacenes(2, '');
                closeModal('modal-almacen', 'form-add-almacen');
            }
        },
        error: function(request, status, error){
            switch (request.status) {
                case 422:
                    addValidacion(request.responseJSON.errors);
                    break;
                default:
                    msjInfo('error', 'Error', 'Se perdio la conexión con el servidor, intente nuevamente');
                    break;
            }
            removeClassBtnEfectoLoad('load-form','load-button', 'btn-modal');
        }
    });
})
$('#form-upload-almacen').submit(function(e){
    e.preventDefault();
    removeClass('form-upload-almacen');
    $.ajax({
        'type': 'POST',
        'url': 'api/uploadAlmacen',
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
                getAlmacenes(2, '');
                closeModal('upload-almacen', 'form-upload-almacen');
            }
        },
        error: function(request, status, error){
            switch (request.status) {
                case 422:
                    addValidacion(request.responseJSON.errors);
                    break;
                default:
                    msjInfo('error', 'Error', 'Se perdio la conexión con el servidor, intente nuevamente');
                    break;
            }
            removeClassBtnEfectoLoad('load-form1','load-button1', 'btn-modal1');
        }
    });
})
function getAlmacenes(tipo, filtro){
    $.ajax({
        'type': 'GET',
        'url': '/api/getAlmacenes/'+tipo+'?filtro='+filtro+'&sucursal='+$('#sucursale_id1').val(),
        beforeSend: function(){
            $('#table-almacen tbody').empty();
            $('#table-almacen tbody').html('<tr id="load-almacenes"><td colspan="8"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
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
                            <td>${valor.sucursal.nombre}</td>
                            <td>${valor.desc}</td>
                            <td>
                                <button type="button" class="btn p-0 border-0"  aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detalles" onclick="details('${valor.nombre}', '${valor.desc}', '${valor.created_at}', '${valor.updated_at}', '${valor.deleted_at}');"><i class="ti ti-eye icono text-success"></i></button>
                            </td>
                            <td>
                                <button type="button" class="btn p-0 border-0" onclick="onChange(${valor.id}, ${valor.sucursale_id}, '${valor.nombre}', '${valor.desc}');"><i class="ti ti-edit icono text-primary"></i></button>
                            </td>
                            <td>
                                <button type="button" class="btn p-0 border-0" onclick="confirmDelete(${valor.id}, '${valor.nombre}', 'api/deleteAlmacenes/', 'almacen', 'el');"><i class="ti ti-trash icono text-danger"></i></button>
                            </td>
    
                        </tr>
                    `;
                });
                $('#table-almacen tbody').html(row);
                $("#table-almacen").paginationTdA({
                    elemPerPage: 5
                });
                let pag = $('.paginationClick').parent()[0];
                pag.classList.add('active');
            }else{
                $('#table-almacen tbody').html('<tr><td colspan="4" class="text-center">No hay registros</td></tr>');
            }
        }
    })
}
function onChange(id, sucursale_id, nombre, desc){
    idSucursal = sucursale_id;
    $('#id').val(id);
    $('#sucursale_id').val(sucursale_id);
    $('#nombre').val(nombre);
    $('#desc').val(desc);
    getSucursales();
    openModal('modal-almacen', 'almacenes', 1);
}
function details(nombre, desc, created_at, updated_at, deleted_at){
    const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    $('#nom-nombre').html(nombre);
    $('#nom-desc').html(desc);
    let creacion = new Date(created_at);
    let actualizacion = new Date(updated_at);
    let eliminacion = new Date(deleted_at);
    $('#creacion').html(creacion.getDate()+' de '+meses[creacion.getMonth()]+' de '+creacion.getFullYear());
    $('#actualizacion').html(actualizacion.getDate()+' de '+meses[actualizacion.getMonth()]+' de '+actualizacion.getFullYear());
    if(eliminacion.getDate().toString() != 'NaN'){
    $('#eliminacion').html(eliminacion.getDate()+' de '+meses[eliminacion.getMonth()]+' de '+eliminacion.getFullYear());
    }
    openModal('modal-detalle-almacen', 'almacenes', '2');

}