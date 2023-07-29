const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

function msjInfo(icon, title, html, showCancelButton, textBtnConfirm, nameFunction, data){
    Swal.fire({
        icon: icon,
        title: title,
        html: html,
        showCancelButton: showCancelButton,
        confirmButtonText: textBtnConfirm,
        cancelButtonText: `Cancelar`,
      }).then((result) => {
            if (result.isConfirmed) {
                nameFunction(data);
            }else{
                return false;
            }
        })
}

function msjError(icon, title, text){
    Swal.fire({
        icon: icon,
        title: title,
        text: text,
      })
}

function confirmDelete(id, info, api, modulo, prefijo){
    Swal.fire({
        title: '¿Esta seguro de eliminar '+prefijo+' '+modulo+' '+info+'?',
        icon: 'question',
        showDenyButton: true,
        confirmButtonText: 'Eliminar',
        denyButtonText: 'Cancelar',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({  
                type : 'DELETE',
                url  : api+id+'name='+info,
                contentType: false,
                cache: false,
                processData:false,
                success: function(response){
                    var jsonData = JSON.parse(response);
                    Toast.fire({
                        icon: jsonData.icon,
                        title: jsonData.title,
                        text: jsonData.text
                    });
                    if(jsonData.icon == 'success'){
                        switch(modulo){
                            case 'usuario':
                                getUsuarios(2, '');
                                break;
                            case 'marca':
                                getMarcas(2, '');
                                break;
                            case 'material':
                                getMateriales(2, '');
                                break;
                            case 'categoria':
                                getCategorias(2, '');
                                break;
                            case 'tipo de cliente':
                                getTipoClientes(2, '');
                                break;
                            case 'proveedor':
                                getProveedores(2, '');
                                break;
                            case 'unidad de medida':
                                getUnidadMedidas(2, '');
                                break;
                            case 'cliente':
                                getClientes(2, '');
                                break;
                            case 'producto':
                                getProductos(2, '');
                                break;
                            case 'almacen':
                                getAlmacenes(2, '');
                                break;
                            case 'turnos':
                                getTurnos(2, '');
                                break;
                            case 'sucursal':
                                getSucursales(2, '');
                                break;
                            case 'articulo':
                                getProductosSucursal(2, '');
                                break;
                            case 'tipo de gasto':
                                getTipoGastos(2, '');
                                break;
                            case 'gasto':
                                getGastos(2, '');
                                break;
                            case 'imagen':
                                closeModal('modal-producto', 'form-add-producto');
                                getProductos(2, '');
                                break;
                            case 'roles':
                                getRoles(2, '');
                                break;
                        }
                    }
                }
            });
        }
    })
}
