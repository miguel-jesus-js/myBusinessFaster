$('#form-login').submit(function(e){
    e.preventDefault();
    removeClass('form-login');
    $('#icono-email').removeClass('border-top border-bottom border-start border-danger');
    $('#email').removeClass('border-end border-danger');
    $('#icono-password').removeClass('border-top border-bottom border-start border-danger');
    $('#icono-showHide').removeClass('border-top border-bottom border-end border-danger');
    let data = $(this).serialize();
    $.ajax({
        'type': 'POST',
        'url': '/api/session',
        'data': data,
        beforeSend: function(){
            $('#btn-enviar').html('Enviando<span class="animated-dots"></span>');
        },
        success: function(response){
            $('#btn-enviar').html('ACCEDER');
            let respuesta = JSON.parse(response);
            Toast.fire({
                icon: respuesta.icon,
                title: respuesta.title,
                text: respuesta.text
            });
            if(respuesta.icon == 'success'){
                window.location.href = '/dashboard';
            }
        },
        error: function(request, status, error){
            let indices = Object.keys(request.responseJSON.errors);
            if(indices[0] == 'email'){
                $('#icono-email').addClass('border-top border-bottom border-start border-danger');
                $('#email').addClass('border-end border-danger');
            }
            if(indices[0] == 'password' || indices[1] == 'password'){
                $('#icono-password').addClass('border-top border-bottom border-start border-danger');
                $('#icono-showHide').addClass('border-top border-bottom border-end border-danger');
            }
            switch (request.status) {
                case 422:
                    addValidacion(request.responseJSON.errors);
                    break;
                default:
                    msjInfo('error', 'Error', 'Se perdio la conexión con el servidor, intente nuevamente');
                    break;
            }
            $('#btn-enviar').html('ACCEDER');
        }
    });
});

function showHidePassword(idIcono){
    if($('#password').attr('type') == 'password'){
        $('#password').attr('type', 'text');
        $('#'+idIcono).removeClass('ti-eye');
        $('#'+idIcono).addClass('ti-eye-off');
    }else{
        $('#password').attr('type', 'password');
        $('#'+idIcono).removeClass('ti-eye-off');
        $('#'+idIcono).addClass('ti-eye');
    }
}