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
        case 'categorias':
            getCategorias(api, filtro);
            break;
        case 'tipo_clientes':
            getTipoClientes(api, filtro);
            break;
        case 'proveedores':
            getProveedores(api, filtro);
            break;
        case 'unidad_medidas':
            getUnidadMedidas(api, filtro);
            break;
        case 'clientes':
            getClientes(api, filtro);
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
        case 'categorias':
            if($(this).val() == ''){
                getCategorias('api/getCategorias/', 2);
            }else{
                getCategorias('api/getCategorias/', $(this).val());
            }
            break; 
        case 'tipo_clientes':
            if($(this).val() == ''){
                getTipoClientes('api/getTipoClientes/', 2);
            }else{
                getTipoClientes('api/getTipoClientes/', $(this).val());
            }
            break;
        case 'proveedores':
            if($(this).val() == ''){
                getProveedores('api/getProveedores/', 2);
            }else{
                getProveedores('api/getProveedores/', $(this).val());
            }
            break;
        case 'unidad_medidas':
            if($(this).val() == ''){
                getUnidadMedidas('api/getUnidadMedidas/', 2);
            }else{
                getUnidadMedidas('api/getUnidadMedidas/', $(this).val());
            }
            break;
        case 'clientes':
            if($(this).val() == ''){
                getClientes('api/getClientes/', 2);
            }else{
                getClientes('api/getClientes/', $(this).val());
            }
            break;
    }
});