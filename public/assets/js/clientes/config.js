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
    e.preventDefault();
    var ciudad = $('#ciudad1').val();
    var estado = $('#estado1').val();
    var municipio = $('#municipio1').val();
    var cp =  $('#cp1').val();
    var colonia = $('#colonia1').val();
    var calle =  $('#calle1').val();
    var n_exterior = $('#n_exterior1').val();
    var n_interior = $('#n_interior1').val();
    let row = `<tr><td></td><td>${ciudad}</td><td>${estado}</td><td>${municipio}</td><td>${cp}</td><td>${colonia}</td><td>${calle}</td><td>${n_exterior}</td><td>${n_interior}</td><td><button type="button" class="btn p-0 border-0 borrar"><i class="ti ti-trash icono text-danger"></i></button></td></tr>`;
    $('#table-clientes-direcciones tbody').append(row);
    $('#table-clientes-direcciones td:nth-child(1)').hide();//ocultamos la fila ID
    closeModal('modal-direcciones', 'form-add-direcciones');
})
//eliminar un acceso
$(document).on('click', '.borrar', function(event) {
    event.preventDefault();
    $(this).closest('tr').remove();
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