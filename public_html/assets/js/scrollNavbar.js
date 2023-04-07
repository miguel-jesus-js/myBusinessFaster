//efecto scrolll navbar
$(document).on("scroll", function(){
    //sacamos el desplazamiento actual de la página
    var desplazamientoActual = $(document).scrollTop();
    if (desplazamientoActual > 90){
        $('#menu').addClass('bg-dark fixed-top');
        $('#activar').removeClass('text-azure');
        $('#activar').addClass('bg-azure text-white');
    }else{
        $('#menu').removeClass('bg-dark fixed-top');
        $('#activar').removeClass('bg-azure text-white');
        $('#activar').addClass('text-azure');
    }
});