$('#form-add-insumo').submit(function(e){
    e.preventDefault();
    removeClass('form-add-insumo');
    let data = $(this).serialize();
    $.ajax({
        'type': 'POST',
        'url': 'api/addInsumos',
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
                $('#form-add-insumo').trigger('reset');
                $('#parent-cod').html('');
                $('#parent-prod').html('');
                $('#parent-stock').html('');
                $('#insumo-cod').html('');
                $('#insumo-prod').html('');
                $('#insumo-stock').html('');
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
                case 0:
                    msjError('error', 'Error', 'Se perdio la conexión con el servidor, intente nuevamente');
                    break;
            }
            removeClassBtnEfectoLoad('load-form','load-button', 'btn-modal');
        }
    });
});