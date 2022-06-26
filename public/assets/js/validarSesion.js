//agregar y actualizar
$("#formValidarSession").submit(function(e) {
    e.preventDefault();
    let data = $(this).serialize();
    $.ajax({  
        type : 'POST',
        url  : 'api/validarSession',
        data:  data,
        beforeSend: function(){
            $('#cargando').removeClass('d-none');
        },
        success: function(response){
            $('#cargando').addClass('d-none');
            var jsonData = JSON.parse(response);
            Toast.fire({
                icon: jsonData.type,
                title: jsonData.title,
                text: jsonData.msj
            })
            if(jsonData.type == 'success'){
                if(jsonData.user.verificado == 0){
                    window.location.href="/errorVerificacion";
                }else{
                    window.location.href="/dashboard";
                }                
            }
        }
    });
});