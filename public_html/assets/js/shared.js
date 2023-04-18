$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function addHtmlEfectoLoad(id){
    $('#'+id).html(`
    <div id="preloader6">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <b class="h5">Cargando</b>
`);
}
function addClassBtnEfectoLoad(boton, botonModal){
    $('#'+boton).removeClass('d-none');
    $('#'+botonModal).html('enviando');
}
function removeClassBtnEfectoLoad(load,boton, botonModal){
    $('#'+load).html('');
    $('#'+boton).addClass('d-none');
    $('#'+botonModal).html('Agregar');
}
function addValidacion(datos, hasTab){
    $.each(datos, function(index, value){
        //debugger;
        $('#'+index).addClass('is-invalid');
        $('#error-'+index).html(value);
        if(hasTab){
            var errorCampo = $('#'+index);
            errorCampo.closest('div .tab-pane').removeClass('active');
            errorCampo.closest('div .tab-pane').removeClass('show');
            $('.tab-content').children().each(function(index, value){
                if($(this).hasClass('active')){
                    $(this).removeClass('active show');
                    return false;
                }
            })
            $('#list-tab').children().each(function(index, value){
                let href = $(this).children().prop('href').split('#');
                if(href[1] == errorCampo.closest('div .tab-pane').prop('id')){
                    $(this).children().addClass('active');
                    $(this).children().attr('aria-selected', true);
                    errorCampo.closest('div .tab-pane').addClass('active show');
                }else{
                    $(this).children().removeClass('active');
                    $(this).children().attr('aria-selected', false);
                }
            });
        }
    });
}
function removeClass(id){
    $('#'+id).find(':input').each(function(){
        $(this).removeClass('is-invalid');
    })
}

function readCatalogos(){
    const catalogos = ['Marcas', 'Empleados', 'Categorias', 'Tipo de clientes', 'Unidad de medidas', 'Proveedores', 'Clientes', 'Productos', 'Materiales', 'Almacenes', 'Turnos', 'Sucursales', 'Tipo de gastos'];
    const rutas = ['marcas', 'empleados', 'categorias', 'tipo_clientes', 'unidad_medidas', 'proveedores', 'clientes', 'productos', 'materiales', 'almacenes', 'turnos', 'sucursales', 'tipo_gastos'];
    const iconos = ['ti ti-circles', 'ti ti-users', 'ti ti-award', 'ti ti-briefcase', 'ti ti-ruler-2', 'ti ti-truck', 'ti ti-friends', 'ti ti-cookie', 'ti ti-hammer', 'ti ti-package', 'ti ti-clock', 'ti ti ti-building', 'ti ti-cash'];
    var row = '';
    for(var i = 0; i < catalogos.length; i++)
    {
        row += `<div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/${rutas[i]}">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                <div class="col-auto">
                                    <i class="${iconos[i]} icon"></i>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        ${catalogos[i]}
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>`;
    }
    $('#lista-catalogos').html(row);
}
$("input[name='filter']").on('click', function() {
    // in the handler, 'this' refers to the box clicked on
    var $box = $(this);
    if ($box.is(":checked")) {
      var group = "input:checkbox[name='" + $box.attr("name") + "']";
      $(group).prop("checked", false);
      $box.prop("checked", true);
    } else {
      $box.prop("checked", false);
    }
});

function preview(){
    let input = $('#input-imagenes input').last();
    let extencion = $(input).val().split(".").pop().toLowerCase();
    if( $(input).val() != "" ){
        if( extencion != "jpeg" && extencion != "png" && extencion != "jpg"){
            $(input).replaceWith($(input).val('').clone(true));
            Toast.fire({
                icon: "warning",
                title: "Advertencia",
                text: "Tipo de archivo no permitido"
            });
        }
    }
    let html = `
            <div class="col-md-3">
                <button class="btn btn-danger btn-remove" type="button">
                    <i class="ti ti-trash-x"></i>
                </button>
                <div class="card card-sm">
                    <img id="view" src="" class="card-img-top img-preview" style="max-height: 200px !important;">
                    <div class="card-body">
                        Nombre:<small>${$(input)[0].files[0].name}</small>
                        <br>
                        Tamaño:<small class="text-muted">${Math.round($(input)[0].files[0].size / 1000) +' KB'}</small>
                    </div>
                </div>
            </div>
        `;
        $('#preview-imagenes').append(html);
        let div = $(".card-sm").last();
        let img = div.children()[0];
        let reader = new FileReader();
        reader.onload = (e) => {
            $(img).prop('src', e.target.result);
        }
        reader.readAsDataURL($(input)[0].files[0]);
}
$(document).on('click', '.btn-remove',function(){
    let name = $(this).siblings().find('small').html();
    $('#input-imagenes input').each(function(index, value){
        let ruta = $(this).val().split('\\');
        if(ruta[2] == name){
            $(this).remove();
        }
    });
    $(this).parent().remove();

});
function removeImg(idImagen){
    $('#'+idImagen).val('');
    $('#preview-'+idImagen).addClass('d-none');
}
$(document).on('click', '.editar', function(event) {
    event.preventDefault();
    $(this).parent().addClass('d-none');
    $(this).parent().siblings().removeClass('d-none');
    let fila = $(this).closest('tr');
    $.each(fila.children(), function(index, valor){
        $(this).children().removeClass('input-table');
        $(this).children().removeAttr('readonly');
    })
});
$(document).on('click', '.borrar', function(event) {
    event.preventDefault();
    let filaHijos = $(this).closest('tr').children();
    let fila = $(this).closest('tr');
    if(filaHijos[0].children[0].value == ''){
        fila.remove();
    }else{
        $.ajax({
            'type': 'delete',
            'url': 'api/deleteCaract/'+filaHijos[0].children[0].value,
            beforeSend: function () {
            },
            success: function (response) {
                let respuesta = JSON.parse(response);
                Toast.fire({
                    icon: respuesta.icon,
                    title: respuesta.title,
                    text: respuesta.text
                });
                if(respuesta.icon == 'success'){
                    fila.remove();
                }
            }
        });
    }
});
$(document).on('click', '.ver_mas', function(event) {
    if($(this).children().hasClass('ti-eye')){
        $(this).children().removeClass('ti-eye');
        $(this).children().addClass('ti-eye-off');
    }else{
        $(this).children().removeClass('ti-eye-off');
        $(this).children().addClass('ti-eye');
    }
    var oculto = $('.oculto').map(function(){
        if($(this).hasClass('d-none')){
            $(this).removeClass('d-none');
        }else{
            $(this).addClass('d-none');
        }
    });
});
$(document).ajaxComplete(function(event, xhr, settings) {
    switch(settings.url){
        case 'api/getUsuarios/2':
            $('#user_id').val(idUser);
            break;
        case 'api/getSucursales/2':
            $('#sucursale_id').val(idSucursal);
            break;
        case 'api/getTipoGastos/2':
            $('#tipo_gasto_id').val(tipoGastoId);
            break;
        case 'api/getRoles':
            $('#role_id').val(idRol);
            break;
    }

});
$('#search-catalog').keyup(function(){
    var list = $('#lista-catalogos');
    var filter = $(this).val().toLowerCase();
    list.find('div .font-weight-medium').filter(function(){
        return $(this).text().toLowerCase().indexOf(filter) === -1;
    }).closest('div .col-lg-3').hide();
    list.find('div .font-weight-medium').filter(function(){
        return $(this).text().toLowerCase().indexOf(filter) !== -1;
    }).closest('div .col-lg-3').show();
})
$('#form-perfil').submit(function(e){
    e.preventDefault();
    removeClass('form-perfil');
    if($('#password').val() != $('#password-repeat').val()){
        Toast.fire({
            icon: 'warning',
            title: 'Advertencia',
            text: 'Las contraseñas no coinciden'
        });
        return false;
    }
    var data = new FormData(this);
    data.append('_method', 'PUT');
    $.ajax({
        'type': 'POST',
        'url': '/api/updateUsuarios',
        'data': data,
        enctype: 'multipart/form-data',
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
            addHtmlEfectoLoad('load-form-perfil');
            addClassBtnEfectoLoad('load-button-perfil', 'btn-modal-perfil');
        },
        success: function(response){
            let respuesta = JSON.parse(response);
            removeClassBtnEfectoLoad('load-form-perfil','load-button-perfil', 'btn-modal-perfil');
            Toast.fire({
                icon: respuesta.icon,
                title: respuesta.title,
                text: respuesta.text
            });
            if(respuesta.icon == 'success'){
                location.reload();
            }
        },
        error: function(request, status, error){
            switch (request.status) {
                case 422:
                    addValidacion(request.responseJSON.errors, false);
                    break;
                case 0:
                    msjError('error', 'Error', 'Se perdio la conexión con el servidor, intente nuevamente');
                    break;
            }
            removeClassBtnEfectoLoad('load-form-perfil','load-button-perfil', 'btn-modal-perfil');
        }
    });
});
$('#password').keyup(function(){
    if($(this).val() != ''){
        $('#password-repeat').prop('required', true);
    }else{
        $('#password-repeat').prop('required', false);

    }
})