var tipoFiltro = 2;
function filterGeneral(modulo, tipo){
    let textFiltro;
    switch(tipo){
        case 0:
            tipoFiltro = 0;
            textFiltro = 'Todos';
            break;
        case 1:
            tipoFiltro = 1;
            textFiltro = 'Eliminados';
            break;
        default:
            tipoFiltro = 2;
            textFiltro = 'No eliminados';
            break;
    }
    $('#filtro-select').html('Filtro: '+textFiltro);
    switch (modulo){
        case 'usuarios':
            getUsuarios(api, filtro);
            break;
        case 'marcas':
            getMarcas(tipoFiltro, '');
            break;
        case 'materiales':
            getMateriales(tipoFiltro, '');
            break;
        case 'categorias':
            getCategorias(tipoFiltro, '');
            break;
        case 'tipo_clientes':
            getTipoClientes(tipoFiltro, '');
            break;
        case 'proveedores':
            getProveedores(tipoFiltro, '');
            break;
        case 'unidad_medidas':
            getUnidadMedidas(tipoFiltro, '');
            break;
        case 'clientes':
            getClientes(tipoFiltro, '');
            break;
        case 'productos':
            getProductos(tipoFiltro, '');
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
            getMarcas(tipoFiltro, $(this).val());
            break; 
        case 'materiales':
            getMateriales(tipoFiltro, $(this).val());
            break; 
        case 'categorias':
            getCategorias(tipoFiltro, $(this).val());
            break; 
        case 'tipo_clientes':
            getTipoClientes(tipoFiltro, $(this).val());
            break;
        case 'proveedores':
            getProveedores(tipoFiltro, $(this).val());
            break;
        case 'unidad_medidas':
            getUnidadMedidas(tipoFiltro, $(this).val());
            break;
        case 'clientes':
            getClientes(tipoFiltro, $(this).val());
            break;
        case 'productos':
            getProductos(tipoFiltro, $(this).val());
            break;
    }
});