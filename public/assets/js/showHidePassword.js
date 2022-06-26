function showHidePassword(id_input, id_icono){
    let type = $('#'+id_input).prop('type');
    if(type == 'password'){
        $('#'+id_input).prop('type', 'text');
        $('#'+id_icono).removeClass('ti-eye');
        $('#'+id_icono).addClass('ti-eye-off');
    }else{
        $('#'+id_input).prop('type', 'password');
        $('#'+id_icono).removeClass('ti-eye-off');
        $('#'+id_icono).addClass('ti-eye');
    }
}