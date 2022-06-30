function filterGeneral(modulo, api, filtro){
    switch (modulo){
        case 'usuarios':
            getUsuarios(api, filtro);
            break;
        case 'marcas':
            getMarcas(api, filtro);
            break;
        case 'materiales':
            getMateriales(api, filtro);
            break;
    }
}
$("#search").keyup(function() {
    var modulo = $('#modulo').val();
    switch(modulo){
        case 'usuarios':
            if($(this).val() == ''){
                getUsuarios('api/getUsuarios/', 2);
            }else{
                getUsuarios('api/getUsuarios/', $(this).val());
            }
            break; 
        case 'marcas':
            if($(this).val() == ''){
                getMarcas('api/getMarcas/', 2);
            }else{
                getMarcas('api/getMarcas/', $(this).val());
            }
            break; 
        case 'materiales':
            if($(this).val() == ''){
                getMateriales('api/getMateriales/', 2);
            }else{
                getMateriales('api/getMateriales/', $(this).val());
            }
            break; 
    }
});