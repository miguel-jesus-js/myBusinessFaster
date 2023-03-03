function getUsers() {
    let selectUser = $('#user_id');
    if (selectUser[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getUsuarios/2',
            beforeSend: function () {
                $('#load-select').html('Cargando...');
            },
            success: function (response) {
                $('#load-select').html('Elige una opción');
                let data = JSON.parse(response);
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}">${valor.nombres +' '+valor.app +' '+ valor.apm}</option>`;
                });
                $('#user_id').append(option);
            }
        });
    }
}
