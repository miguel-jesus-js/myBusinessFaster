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

function msjInfo(icon, title, text){
    Swal.fire({
        title: 'Custom animation with Animate.css',
        showClass: {
          popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
          popup: 'animate__animated animate__fadeOutUp'
        }
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
                url  : api+id,
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
                                getUsuarios('api/getUsuarios/', 2);
                                break;
                            case 'marca':
                                getMarcas('api/getMarcas/', 2);
                                break;
                            case 'material':
                                getMateriales('api/getMateriales/', 2);
                                break;
                            case 'categoria':
                                getCategorias('api/getCategorias/', 2);
                                break;
                            case 'tipo de cliente':
                                getTipoClientes('api/getTipoClientes/', 2);
                                break;
                            case 'proveedor':
                                getProveedores('api/getProveedores/', 2);
                                break;
                            case 'unidad de medida':
                                getUnidadMedidas('api/getUnidadMedidas/', 2);
                                break;
                            case 'clientes':
                                getClientes('api/getClientes/', 2);
                                break;
                        }
                    }
                }
            });
        }
    })
}
