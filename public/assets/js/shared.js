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
function addValidacion(datos){
    $.each(datos, function(index, value){
        //debugger;
        $('#'+index).addClass('is-invalid');
        $('#error-'+index).html(value);
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

function preview(idImagen, idVista){
    let input = $('#'+idImagen);
    let extencion = input.val().split(".").pop().toLowerCase();
    if( input.val() != "" ){
        if( extencion != "jpeg" && extencion != "png" && extencion != "jpg"){
                input.replaceWith(input.val('').clone(true));
                Toast.fire({
                icon: "warning",
                title: "Advertencia",
                text: "Tipo de archivo no permitido"
                });
        }
    }
    let reader = new FileReader();
    reader.onload = (e) => {
        $("#"+idVista).attr('src', e.target.result);
    }
    $('#preview-'+idImagen).removeClass('d-none');
    $('#name-'+idImagen).html(input[0].files[0].name);
    $('#peso-'+idImagen).html(Math.round(input[0].files[0].size / 1000) +' KB');
    reader.readAsDataURL(input[0].files[0]);
}
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