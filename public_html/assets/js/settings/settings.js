$('#form-settings').submit(function(e){
    e.preventDefault();
    let data = $(this).serialize();
    $.ajax({
        'type': 'PUT',
        'url': '/api/updateSettingsUser',
        'data': data,
        beforeSend: function(){
            
        },
        success: function(response){
            let respuesta = JSON.parse(response);
            Toast.fire({
                icon: respuesta.icon,
                title: respuesta.title,
                text: respuesta.text
            });
            if(respuesta.icon == 'success'){
                getSettings();
            }
        },
        error: function(request, status, error){

        }
    });
});
$('#form-general-settings').submit(function(e){
    e.preventDefault();
    let data = new FormData(this);
    data.append('_method', 'PUT');
    $.ajax({
        'type': 'POST',
        'url': 'api/updateSettings',
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
                getSettings();
            }
        },
        error: function(request, status, error){

        }
    });
});

function getSettings(){
    $.ajax({
        'type': 'GET',
        'url': '/api/settings',
        success: function(response){
            let data = JSON.parse(response);
            localStorage.setItem('navbar_color', data.settings.color);
            localStorage.setItem('mostrar_sidebar', data.info.mostrar_sidebar);
            localStorage.setItem('mostrar_banner', data.info.mostrar_banner);
            localStorage.setItem('mostrar_foto', data.info.mostrar_foto);
            getLocalSettings();
            $('#show-logotipo').attr('src', '../img/'+data.settings.logotipo);
            $('#razon_social').val(data.settings.razon_social);
            $('#iva').val(data.settings.iva);
            $('#nombre').val(data.sucursal.nombre);
            $('#telefono').val(data.sucursal.telefono);
            $('#correo').val(data.sucursal.correo);
            $('#rfc').val(data.sucursal.rfc);
            $('#direccion').val(data.sucursal.direccion);
            $('#facebook').val(data.sucursal.facebook);
            $('#twitter').val(data.sucursal.twitter);
            $('#instagram').val(data.sucursal.instagram);
            $('#tiktok').val(data.sucursal.tiktok);
            $('#whatsapp').val(data.sucursal.whatsapp);
        }
    })
}
function getLocalSettings(){
    let navbar_color    = localStorage.getItem('navbar_color');
    let mostrar_sidebar = localStorage.getItem('mostrar_sidebar');
    let mostrar_banner  = localStorage.getItem('mostrar_banner');
    let mostrar_foto    = localStorage.getItem('mostrar_foto');
    if(navbar_color == null || mostrar_sidebar == null || mostrar_banner == null || mostrar_foto == null){
        getSettings();
    }else{
        $('#navbar').attr('style', 'background-color: '+navbar_color);
        mostrar_sidebar == 0 ? $('#pcoded').attr("vertical-nav-type", 'offcanvas') : $('#pcoded').attr("vertical-nav-type", 'expanded');
        mostrar_banner  == 0 ? $('#page-header').addClass("d-none") : $('#page-header').removeClass("d-none");
        mostrar_foto    == 0 ? $('#page-header-menu').addClass("d-none") : $('#page-header-menu').removeClass("d-none");
        mostrar_sidebar == 1 ? $('#mostrar_sidebar').prop("checked", true) : $('#mostrar_sidebar').prop("checked", false);
        mostrar_banner  == 1 ? $('#mostrar_banner').prop("checked", true) : $('#mostrar_banner').prop("checked", false);
        mostrar_foto    == 1 ? $('#mostrar_foto').prop("checked", true) : $('#mostrar_foto').prop("checked", false);
        var rgb = hexToRgb(navbar_color);
        $(`<style>
            .pcoded[fream-type="theme1"] .main-menu .main-menu-header:before,
            .pcoded[fream-type="theme1"] .page-header:before {
                background: rgba(${rgb.r}, ${rgb.b}, ${rgb.b}, 0.5);
            }
        </style>`).appendTo("head");
        $('.form-colorinput-input').each(function(){
            if($(this).val() == navbar_color){
                $(this).prop('checked', true);
                return false;
            }
        });
        $('.data-item-color').each(function(){
            if($(this).hasClass('active')){
                $(this).children().css('background-color', navbar_color);
                return false;
            }
        });
        $('.data-item-color').hover(function(){
            let item = $(this).children()[0];
            $(item).css('background-color', navbar_color);
        }, function(){
            if($(this).children().parent().hasClass('active')){
                item = $(this).children()[0];
                $(item).css('background-color', navbar_color);
            }else{
                item = $(this).children()[0];
                $(item).css('background-color', 'transparent');
            }
        });
    }
}
function hexToRgb(hex) {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
      r: parseInt(result[1], 16),
      g: parseInt(result[2], 16),
      b: parseInt(result[3], 16)
    } : null;
}
$('#whatsapp').keyup(function(){
    if($(this).val() != ''){
        $('#div-mensaje').removeClass('d-none');
    }else{
        $('#div-mensaje').addClass('d-none');

    }
});