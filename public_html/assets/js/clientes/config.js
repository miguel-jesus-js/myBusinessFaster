//llenar select con los roles
function getTipoClientes() {
    let selectTipoCliente = $('#tipo_cliente_id');
    if (selectTipoCliente[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getTipoClientes/2',
            beforeSend: function () {
                $('#load-select').html('Cargando...');
            },
            success: function (response) {
                $('#load-select').html('Elige una opción');
                let data = JSON.parse(response);
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}">${valor.tipo_cliente}</option>`;
                });
                $('#tipo_cliente_id').append(option);
            }
        });
    }
}
$('#form-add-direcciones').submit(function(e){
    removeClass('form-add-direcciones');
    e.preventDefault();
    var data = $(this).serialize();
    var ciudad = $('#ciudad1').val();
    var estado = $('#estado1').val();
    var municipio = $('#municipio1').val();
    var cp =  $('#cp1').val();
    var colonia = $('#colonia1').val();
    var calle =  $('#calle1').val();
    var n_exterior = $('#n_exterior1').val();
    var n_interior = $('#n_interior1').val();
    $.ajax({
        'type': 'POST',
        'url': '/api/addDireccionesEntrega',
        'data': data,
        beforeSend: function(){
            addHtmlEfectoLoad('load-form1');
            addClassBtnEfectoLoad('load-button1', 'btn-modal1');
        },
        success: function(response){
            removeClassBtnEfectoLoad('load-form1','load-button1', 'btn-modal1');
            let row = `<tr>
                <td>
                    <input type="text" class="form-control input-table" readonly name="d-id[]" id="d-id[]" required autocomplete="off" maxlength="50" minlength="5">
                </td>
                <td>
                    <input type="text" class="form-control input-table" readonly name="ciudad[]" id="ciudad[]" required autocomplete="off" maxlength="50" minlength="5" value="${ciudad}">
                    <div class="invalid-feedback" id="error-ciudad[]"></div>
                </td>
                <td>
                    <input type="text" class="form-control input-table" readonly name="estado[]" id="estado[]" required autocomplete="off" maxlength="50" minlength="5" value="${estado}">
                    <div class="invalid-feedback" id="error-estado[]"></div>
                </td>
                <td>
                    <input type="text" class="form-control input-table" readonly name="municipio[]" id="municipio[]" required autocomplete="off" maxlength="50" minlength="5" value="${municipio}">
                    <div class="invalid-feedback" id="error-municipio[]"></div>
                </td>
                <td>
                    <input type="number" class="form-control input-table" readonly name="cp[]" id="cp[]" required autocomplete="off" maxlength="50" minlength="5" value="${cp}">
                    <div class="invalid-feedback" id="error-cp[]"></div>
                </td>
                <td>
                    <input type="text" class="form-control input-table" readonly name="colonia[]" id="colonia[]" required autocomplete="off" maxlength="50" minlength="5" value="${colonia}">
                    <div class="invalid-feedback" id="error-colonia[]"></div>
                </td>
                <td>
                    <input type="text" class="form-control input-table" readonly name="calle[]" id="calle[]" required autocomplete="off" maxlength="50" minlength="5" value="${calle}">
                    <div class="invalid-feedback" id="error-calle[]"></div>
                </td>
                <td>
                    <input type="number" class="form-control input-table" readonly name="n_exterior[]" id="n_exterior[]" required autocomplete="off" maxlength="50" minlength="5" value="${n_exterior}">
                    <div class="invalid-feedback" id="error-n_exterior[]"></div>
                </td>
                <td>
                    <input type="number" class="form-control input-table" readonly name="n_interior[]" id="n_interior[]" required autocomplete="off" maxlength="50" minlength="5" value="${n_interior}">
                    <div class="invalid-feedback" id="error-n_interior[]"></div>
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
            $('#table-clientes-direcciones tbody').append(row);
            $('#table-clientes-direcciones td:nth-child(1)').hide();//ocultamos la fila ID
            closeModal('modal-direcciones', 'form-add-direcciones');
        },
        error: function(request, status, error){
            switch (request.status) {
                case 422:
                    addValidacion(request.responseJSON.errors, false);
                    break;
                case 0:
                    msjError('error', 'Error', 'Se perdio la conexión con el servidor, intente nuevamente');
                    break;
                case 403:
                    msjError(request.responseJSON.icon, request.responseJSON.title, request.responseJSON.text);
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
        'url': '/api/addDireccionesEntregaTable',
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
                    msjError('error', 'Error', 'Se perdio la conexión con el servidor, intente nuevamente');
                    break;
            }
        }
    });
});

//seleccionar solo un checkbox
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