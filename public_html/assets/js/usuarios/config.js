//llenar select con los roles
function getRoles() {
    let selectRol = $('#role_id');
    if (selectRol[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getRoles',
            beforeSend: function () {
                $('#load-select').html('Cargando...');
            },
            success: function (response) {
                $('#load-select').html('Elige una opción');
                let data = JSON.parse(response);
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}">${valor.name}</option>`;
                });
                $('#role_id').append(option);
            }
        });
    }
}
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
$('#sucursale_id1').change(function(){
    getUsuarios(2, '');
})