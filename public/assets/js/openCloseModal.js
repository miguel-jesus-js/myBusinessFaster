// 0 agregar
// 1 editar
// 2 vista detalles 
function openModal(id_modal, modulo, tipo){
    // debugger;
    // if(tipo == 0){
    //     $('#id').prop('disabled', true);
    // }else if(tipo == 1){
    //     $('#id').prop('disabled', false);
    // }
    switch(modulo){
        case 'usuarios':
            $(".role_id").hide();//ocultamos la columna ID de la tabla, esto porque necesitamos el id para enviarlo al servidor
            $('#table-user-modulos tbody').empty();
            $('#table-modulos tbody').empty();
            if(tipo == 0){
                $('#modal-title').html('Agregar usuario');
                $('#btn-modal').html('Registrar');
                $('#password').prop('disabled', false);
            }else if(tipo == 1){
                $('#modal-title').html('Editar usuario');
                $('#btn-modal').html('Actualizar');
                $('#password').prop('disabled', true);
            }
            break;
        case 'marcas':
            if(tipo == 0){
                $('#modal-title').html('Agregar marca');
                $('#btn-modal').html('Registrar');
            }else if(tipo == 1){
                $('#modal-title').html('Editar marca');
                $('#btn-modal').html('Actualizar');
            }
            break;
        case 'materiales':
            if(tipo == 0){
                $('#modal-title').html('Agregar material');
                $('#btn-modal').html('Registrar');
            }else if(tipo == 1){
                $('#modal-title').html('Editar material');
                $('#btn-modal').html('Actualizar');
            }
            break;
    }
    $('#'+id_modal).modal({backdrop: 'static', keyboard: false});
    if(tipo == 3){
        //$('#'+id_modal).addClass=('z-index-2')
    }
    $('#'+id_modal).modal('show');
}
function closeModal(id_modal, id_form,){
    $('#'+id_form).trigger('reset');
    $('#'+id_modal).modal('hide');
}