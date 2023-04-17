function getMarcas() {
    let selectMarca = $('#marca_id');
    if (selectMarca[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getMarcas/2',
            //async: false,
            beforeSend: function () {
                $('#load-select').html('Cargando...');
                $('#f-load-select').html('Cargando...');
            },
            success: function (response) {
                $('#load-select').html('Elige una opción');
                $('#f-load-select').html('Elige una opción');
                let data = JSON.parse(response);
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}">${valor.marca}</option>`;
                });
                $('#marca_id').append(option);
                $('#f-marca_id').append(option);
            }
        });
    }
}
function getAlmacenes() {
    let selectMarca = $('#almacene_id');
    if (selectMarca[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getAlmacenes/2',
            //async: false,
            beforeSend: function () {
                $('#load-select1').html('Cargando...');
                $('#f-load-select1').html('Cargando...');
            },
            success: function (response) {
                $('#load-select1').html('Elige una opción');
                $('#f-load-select1').html('Elige una opción');
                let data = JSON.parse(response);
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}">${valor.nombre}</option>`;
                });
                $('#almacene_id').append(option);
                $('#f-almacene_id').append(option);
            }
        });
    }
}
function getUnidadMedidas() {
    let selectUnidad = $('#unidad_medida_id');
    if (selectUnidad[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getUnidadMedidas/2',
            //async: false,
            beforeSend: function () {
                $('#load-select2').html('Cargando...');
                $('#f-load-select2').html('Cargando...');
            },
            success: function (response) {
                $('#load-select2').html('Elige una opción');
                $('#f-load-select2').html('Elige una opción');
                let data = JSON.parse(response);
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}">${valor.unidad_medida}</option>`;
                });
                $('#unidad_medida_id').append(option);
                $('#f-unidad_medida_id').append(option);
            }
        });
    }
}
function getProveedores() {
    let selectUnidad = $('#proveedore_id');
    if (selectUnidad[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getProveedores/2',
            async: false,
            beforeSend: function () {
                $('#load-select3').html('Cargando...');
                $('#f-load-select3').html('Cargando...');
            },
            success: function (response) {
                $('#load-select3').html('Elige una opción');
                $('#f-load-select3').html('Elige una opción');
                let data = JSON.parse(response);
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}">${valor.nombres} ${valor.app} ${valor.apm} - (${valor.empresa == null ? '' : valor.empresa})</option>`;
                });
                $('#proveedore_id').append(option);
                $('#f-proveedore_id').append(option);
            }
        });
    }
}
function getMateriales() {
    let selectMaterial = $('#materiale_id');
    if (selectMaterial[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getMateriales/2',
            //async: false,
            beforeSend: function () {
                $('#load-select4').html('Cargando...');
                $('#f-load-select4').html('Cargando...');
            },
            success: function (response) {
                $('#load-select4').html('Elige una opción');
                $('#f-load-select4').html('Elige una opción');
                let data = JSON.parse(response);
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}">${valor.material}</option>`;
                });
                $('#materiale_id').append(option);
                $('#f-materiale_id').append(option);
            }
        });
    }
}
function getCategorias(productosCat) {
    let contenedor =  $('#categorias');
    if(contenedor[0].children.length <= 1){
        $.ajax({
            'type': 'GET',
            'url': 'api/getCategorias/2',
            async: false,
            beforeSend: function () {
                addHtmlEfectoLoad('load-form2');
            },
            success: function (response) {
                let data = JSON.parse(response);
                let cat = '';
                productosCat;
                $.each(data, function (index, valor) {
                    var existe;  
                    var idCat = '';
                    if(productosCat != ''){
                        $.each(productosCat, function(key, value){
                            //debugger;
                            if(valor.id == value.pivot.categoria_id){
                                idCat = value.pivot.id;
                                existe = true;
                                return false;
                            }else{
                                existe = false;
                            }
                        });
                    }
                    cat += `
                            ${idCat == '' ? '' : '<input type="number" class="d-none" name="cat-id[]" value="'+idCat+'">'}
                            <label class="form-selectgroup-item mb-1">
                                <input type="checkbox" name="categoria_id[]" value="${valor.id}" class="form-selectgroup-input" ${existe == true ? 'checked' : ''}>
                                <span class="form-selectgroup-label">${valor.categoria}</span>
                            </label>`;
                    idCat = '';
                });
                $('#categorias').html(cat);
            }
        });
    }else{
        var cat = $('#categorias').children();
        $.each(cat, function(index, valor){
            var inputCat = $(this);
            $.each(productosCat, function(index, valor){
                if(inputCat.children().val() == valor.id){
                    inputCat.children().attr('checked', true);
                    return false;
                }
            })
        })
    }
}
function getCodBarraOrSat(tipo) {
    let url;
    tipo == 0 ? url = 'api/generateCodBarra' : url = 'api/generateCodSat';
    $.ajax({
        'type': 'GET',
        'url': url,
        beforeSend: function () {
        },
        success: function (response) {
            tipo == 0 ? $('#cod_barra').val(response) : $('#cod_sat').val(response);
        }
    });
}
$('#form-add-caracteristica').submit(function(e){
    removeClass('form-add-caracteristica');
    e.preventDefault();
    var data = $(this).serialize();
    var caracteristica = $('#caracteristica').val();
    $.ajax({
        'type': 'POST',
        'url': '/api/addCaracteristicas',
        'data': data,
        beforeSend: function(){
            addHtmlEfectoLoad('load-form1');
            addClassBtnEfectoLoad('load-button1', 'btn-modal1');
        },
        success: function(response){
            removeClassBtnEfectoLoad('load-form1','load-button1', 'btn-modal1');
            let row = `<tr>
                            <td>
                                <input type="text" class="form-control input-table" readonly name="c-id[]" id="c-id[]" required autocomplete="off" maxlength="50" minlength="5">
                            </td>
                            <td>
                                <input type="text" class="form-control input-table" readonly name="caracteristica[]" placeholder="Característica" autocomplete="off" required pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{5,50}" minlength="5" maxlength="100" value="${caracteristica}">
                                <div class="invalid-feedback" id="error-caracteristica"></div>
                            </td>
                            <td>
                                <div class="" id="editar">
                                    <button type="button" class="btn p-0 border-0 editar"><i class="ti ti-edit icono text-primary"></i></button>
                                    <button type="button" class="btn p-0 border-0 borrar"><i class="ti ti-trash icono text-danger"></i></button>
                                </div>
                                <div class="d-none" id="guardar">
                                    <button type="button" class="btn p-0 border-0 guardar"><i class="ti ti-device-floppy icono text-success"></i></button>
                                </div>
                            </td>
            }           </tr>`;
            $('#table-caracteristicas tbody').append(row);
            $('#table-caracteristicas td:nth-child(1)').hide();//ocultamos la fila ID
            closeModal('modal-caracteristica', 'form-add-caracteristica');
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
            removeClassBtnEfectoLoad('load-form1','load-button1', 'btn-modal1');
        }
    });
})
$(document).on('click', '.guardar', function(event) {
    event.preventDefault();
    let fila = $(this).closest('tr');
    var btnGuardar = $(this).parent();
    var btnEditar = $(this).parent().siblings();
    var data = '';
    $.each(fila.children(), function(index, valor){
        data += $(this).children().serialize() + '&';
        $(this).children().removeClass('is-invalid');
    });
    $.ajax({
        'type': 'POST',
        'url': '/api/addCaracteristicasTable',
        'data': data,
        beforeSend: function(){
        },
        success: function(response){
            $.each(fila.children(), function(index, valor){
                $(this).children().addClass('input-table');
                $(this).children().attr('readonly', true);
            });
            btnEditar.removeClass('d-none');
            btnGuardar.addClass('d-none');
        },
        error: function(request, status, error){
            switch (request.status) {
                case 422:
                    $.each(request.responseJSON.errors, function(index, valor){
                        var arrayName = index.substring(0, index.length -2)+'[]';
                        $.each(fila.children(), function(key, value){
                            let inputName = $(this).children()[0].name;
                            if(arrayName == inputName){
                                $(this).children().addClass('is-invalid');
                                $(this).children()[1].innerHTML = valor;
                            }
                        });
                    });
                    break;
                case 0:
                    msmsjErrorjInfo('error', 'Error', 'Se perdio la conexión con el servidor, intente nuevamente');
                    break;
            }
        }
    });
});
function aplyFilter(campo){
    $('#filtro-campo').html('Buscar por: '+campo);
}
var filtro = '';
var producto = '';
$('#form-filter').submit(function(e){
    e.preventDefault();
    filtro = $(this).serialize();
    producto = $("#search").val();
    getProductos(tipoFiltro, filtro+'&producto='+producto);
    $('#closeCanvas').trigger('click');
});
$('#form-campos').submit(function(e){
    e.preventDefault();
    let formato = $('#formato').val();
    let datos = $(this).serialize();
    if(formato == 'pdf'){
        window.location = 'api/exportarPdfProducto?'+filtro+'&producto='+producto+'&campos='+datos;
    }else{
        window.location = 'api/exportarExcelProducto?'+filtro+'&producto='+producto+'&campos='+datos;
    }

});
// Si se hace click sobre el input de tipo checkbox con id checkb
$('#checkTodo').click(function () {
    // Si esta seleccionado (si la propiedad checked es igual a true)
    if ($(this).prop('checked')) {
        // Selecciona cada input que tenga la clase .checar
        $('.checar').prop('checked', true);
    } else {
        // Deselecciona cada input que tenga la clase .checar
        $('.checar').prop('checked', false);
    }
});

$('#btn-add-imagenes').click(function(){
    $('#input-imagenes').append(`<input type="file" class="form-control d-none" name="img[]" accept="image/jpeg,image/jpg,image/png">`);
    let input = $('#input-imagenes input').last();
    input.trigger('click');
    input.change(function(){
        preview();
    })
});

  