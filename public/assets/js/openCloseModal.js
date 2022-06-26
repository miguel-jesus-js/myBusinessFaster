// 0 agregar
// 1 editar
// 2 vista detalles 
function openModal(id_modal, modulo, tipo){
    switch(modulo){
        case 'usuarios':
            $(".role_id").hide();//ocultamos la columna ID de la tabla, esto porque necesitamos el id para enviarlo al servidor
            $('#table-user-modulos tbody').empty();
            $('#table-modulos tbody').empty();
            if(tipo == 0){
                $('#modal-title').html('Agregar usuarios');
                $('#btn-modal').html('Registrar');
                $('#password').prop('disabled', false);
            }else if(tipo == 1){
                $('#modal-title').html('Editar usuario');
                $('#btn-modal').html('Actualizar');
                $('#password').prop('disabled', true);
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