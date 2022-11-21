function addHtmlEfectoLoad(id){
    $('#'+id).html(`
    <div id="preloader6">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <b class="h3">Cargando</b>
`);
}
function addClassBtnEfectoLoad(boton, botonModal){
    $('#'+boton).removeClass('d-none');
    $('#'+botonModal).html('enviando');
}
function removeClassBtnEfectoLoad(load,boton, botonModal){
    $('#'+load).html('');
    $('#'+boton).addClass('d-none');
    $('#'+botonModal).html('Cargar');
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
    const catalogos = ['Marcas', 'Usuarios', 'Categorias', 'Tipo de clientes', 'Unidad de medidas', 'Proveedores', 'Clientes', 'Productos', 'Materiales'];
    const rutas = ['marcas', 'usuarios', 'categorias', 'tipo_clientes', 'unidad_medidas', 'proveedores', 'clientes', 'productos', 'materiales'];
    const iconos = ['ti ti-circles', 'ti ti-users', 'ti ti-award', 'ti ti-briefcase', 'ti ti-ruler-2', 'ti ti-truck', 'ti ti-friends', 'ti ti-cookie', 'ti ti-hammer'];
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
$("input:checkbox").on('click', function() {
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
