$('#form-add-marca').submit(function(e){
    e.preventDefault();
    removeClass('form-add-marca');
    let data = $(this).serialize();
    var url = '';
    var tipo = '';
    if($('#id').val() == ''){
        url = 'api/addMarcas';
        tipo = 'POST';
    }else{
        url = 'api/updateMarcas';
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
                getMarcas(2, '');
                closeModal('modal-marca', 'form-add-marca');
            }
        },
        error: function(request, status, error){
            switch (request.status) {
                case 422:
                    addValidacion(Object.keys(request.responseJSON.errors), request.responseJSON.message);
                    break;
            
                default:
                    break;
            }
            removeClassBtnEfectoLoad('load-form1','load-button1', 'btn-modal1');
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
                    addValidacion(Object.keys(request.responseJSON.errors), request.responseJSON.message);
                    break;
                default:
                    break;
            }
            removeClassBtnEfectoLoad('load-form1','load-button1', 'btn-modal1');
        }
    });
})
function getMarcas(tipo, filtro){
    $.ajax({
        'type': 'get',
        'url': '/api/getMarcas/'+tipo+'?filtro='+filtro,
        beforeSend: function(){
            $('#table-marca tbody').empty();
            $('#table-marca tbody').html('<tr id="load-marcas"><td colspan="8"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
        },
        success: function(response){
            $('#load-marcas').addClass('d-none');
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
                        <td>${valor.marca}</td>
                        <td>
                            <button type="button" class="btn p-0 border-0"  aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detalles" onclick="details('${valor.marca}', '${valor.created_at}', '${valor.updated_at}', '${valor.deleted_at}');"><i class="ti ti-eye icono text-success"></i></button>
                        </td>
                        <td>
                            <button type="button" class="btn p-0 border-0"  aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Editar" onclick="onChange(${valor.id}, '${valor.marca}');"><i class="ti ti-edit icono text-primary"></i></button>
                        </td>
                        <td>
                            <button type="button" class="btn p-0 border-0"  aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Eliminar" onclick="confirmDelete(${valor.id}, '${valor.marca}', 'api/deleteMarcas/', 'marca', 'la');"><i class="ti ti-trash icono text-danger"></i></button>
                        </td>

                    </tr>
                `;
            });
            $('#table-marca tbody').html(row);
            $("#table-marca").paginationTdA({
                elemPerPage: 5
            });
            let pag = $('.paginationClick').parent()[0];
            pag.classList.add('active');
        }
    })
}
function onChange(id, marca){
    $('#id').val(id);
    $('#marca').val(marca);
    openModal('modal-marca', 'marcas', 1);
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