// 0 agregar
// 1 editar
// 2 vista detalles 
function openModal(id_modal, modulo, tipo){
    if(tipo == 0){
        $('#btn-modal').html('Registrar');
    }else if(tipo == 1){
        $('#btn-modal').html('Actualizar');
    }
    switch(modulo){
        case 'usuarios':
            $(".role_id").hide();//ocultamos la columna ID de la tabla, esto porque necesitamos el id para enviarlo al servidor
            $('#table-user-modulos tbody').empty();
            $('#table-modulos tbody').empty();
            if(tipo == 0){
                $('#modal-title').html('Agregar usuario');
                $('#password').prop('disabled', false);
            }else if(tipo == 1){
                $('#modal-title').html('Editar usuario');
                $('#password').prop('disabled', true);
            }
            $('#tipo_cliente_id').closest('div').addClass('d-none');
            $('#empresa').closest('div').addClass('d-none');
            $('#clave').closest('div').addClass('d-none');
            $('#item-credito').addClass('d-none');
            $('#tipo_cliente_id').prop('disabled', true);
            $('#empresa').prop('disabled', true);
            $('#limite_credito').prop('disabled', true);
            $('#dias_credito').prop('disabled', true);
            $('#clave').prop('disabled', true);
            break;
        case 'marcas':
            if(tipo == 0){
                $('#modal-title').html('Agregar marca');
            }else if(tipo == 1){
                $('#modal-title').html('Editar marca');
            }
            removeClass('form-add-marca');
            break;
        case 'materiales':
            if(tipo == 0){
                $('#modal-title').html('Agregar material');
            }else if(tipo == 1){
                $('#modal-title').html('Editar material');
            }
            break;
        case 'categorias':
            if(tipo == 0){
                $('#modal-title').html('Agregar categoría');
            }else if(tipo == 1){
                $('#modal-title').html('Editar categoría');
            }
            break;
        case 'tipo_clientes':
            if(tipo == 0){
                $('#modal-title').html('Agregar tipo de cliente');
            }else if(tipo == 1){
                $('#modal-title').html('Editar tipo de cliente');
            }
            break;
        case 'proveedores':
            if(tipo == 0){
                $('#modal-title').html('Agregar proveedor');
            }else if(tipo == 1){
                $('#modal-title').html('Editar proveedor');
            }
            $('#tipo_cliente_id').closest('div').addClass('d-none');
            $('#item-credito').addClass('d-none');
            $('#tipo_cliente_id').prop('disabled', true);
            $('#limite_credito').prop('disabled', true);
            $('#dias_credito').prop('disabled', true);
            $('#sucursale_id').prop('disabled', true);
            $('#nom_user').prop('disabled', true);
            $('#password').prop('disabled', true);
            $('#role_id').prop('disabled', true);
            $('#sucursale_id').closest('div').addClass('d-none');
            $('#nom_user').closest('div').addClass('d-none');
            $('#password').closest('div .col-sm-6').addClass('d-none');
            $('#item-permisos').addClass('d-none');
            break;
        case 'unidad_medidas':
            if(tipo == 0){
                $('#modal-title').html('Agregar unidad de medida');
            }else if(tipo == 1){
                $('#modal-title').html('Editar unidad de medida');
            }
            break;
        case 'clientes':
            if(tipo == 0){
                $('#modal-title').html('Agregar cliente');
                $(".cliente_id").hide();//ocultamos la columna ID de la tabla, esto porque necesitamos el id para enviarlo al servidor
                $('#table-direcciones tbody').empty();
            }else if(tipo == 1){
                $('#modal-title').html('Editar cliente');
                $(".cliente_id").hide();//ocultamos la columna ID de la tabla, esto porque necesitamos el id para enviarlo al servidor
                $('#table-direcciones tbody').empty();
            }
            $('#sucursale_id').prop('disabled', true);
            $('#nom_user').prop('disabled', true);
            $('#password').prop('disabled', true);
            $('#role_id').prop('disabled', true);
            $('#clave').prop('disabled', true);
            $('#sucursale_id').closest('div').addClass('d-none');
            $('#nom_user').closest('div').addClass('d-none');
            $('#clave').closest('div').addClass('d-none');
            $('#password').closest('div .col-sm-6').addClass('d-none');
            $('#item-permisos').addClass('d-none');
            break;
        case 'productos':
            if(tipo == 0){
                $('#modal-title').html('Agregar producto');
                $(".caracteristica_id").hide();//ocultamos la columna ID de la tabla, esto porque necesitamos el id para enviarlo al servidor
                $('#table-caracteristicas tbody').empty();
                $('#categorias').empty();
                $('#preview-img1').addClass('d-none');
                $('#preview-img2').addClass('d-none');
                $('#preview-img3').addClass('d-none');
            }else if(tipo == 1){
                $('#modal-title').html('Editar producto');
                $(".caracteristica_id").hide();//ocultamos la columna ID de la tabla, esto porque necesitamos el id para enviarlo al servidor
                $('#table-caracteristicas tbody').empty();
                $('#categorias').empty();
                $('#preview-img1').addClass('d-none');
                $('#preview-img2').addClass('d-none');
                $('#preview-img3').addClass('d-none');
            }
            $('#input-imagenes').empty();
            $('#preview-imagenes').empty();
            break;
        case 'almacenes':
            if(tipo == 0){
                $('#modal-title').html('Agregar almacén');
            }else if(tipo == 1){
                $('#modal-title').html('Editar almacén');
            }
            break;
        case 'turnos':
            if(tipo == 0){
                $('#modal-title').html('Agregar turno');
            }else if(tipo == 1){
                $('#modal-title').html('Editar turno');
            }
            break;
        case 'sucursales':
            if(tipo == 0){
                $('#modal-title').html('Agregar sucursal');
            }else if(tipo == 1){
                $('#modal-title').html('Editar sucursal');
            }
            break;
        case 'productos_sucursal':
            if(tipo == 0){
                $('#modal-title').html('Agregar productos a sucursal');
                $('#table-productos tbody').empty();
            }else if(tipo == 1){
                $('#modal-title').html('Editar producto de sucursal');
                //$('#table-productos tbody').empty();
            }
            break;
        case 'tipo_gastos':
            if(tipo == 0){
                $('#modal-title').html('Agregar tipo de gasto');
            }else if(tipo == 1){
                $('#modal-title').html('Editar tipo de gasto');
            }
            break;
        case 'gastos':
            if(tipo == 0){
                $('#modal-title').html('Agregar gasto');
                $('#preview-comprobante').addClass('d-none');
            }else if(tipo == 1){
                $('#modal-title').html('Editar gasto');
            }
            break;
        case 'perfil':
            if(tipo == 1){
                $('#modal-title-perfil').html('Editar perfil');
            }
            break;
        case 'compras':
            if(tipo == 0){
                $('#modal-title').html('Agregar compra');
            }else if(tipo == 1){
                $('#modal-title').html('Editar compra');
            }
            break;
        case 'roles':
            if(tipo == 0){
                $('#modal-title').html('Agregar rol');
            }else if(tipo == 1){
                $('#modal-title').html('Editar rol');
            }
            break;
        case 'cotizacion_venta':
            if(tipo == 0){
                $('#modal-title').html('Agregar cotización de venta');
            }else if(tipo == 1){
                $('#modal-title').html('Editar cotización de venta');
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
    removeClass(id_form);
    $('#'+id_form).trigger('reset');
    $('#'+id_modal).modal('hide');
}