$('#form-add-tipo_cliente').submit(function(e){
    e.preventDefault();
    let data = $(this).serialize();
    var url = '';
    var tipo = '';
    if($('#id').val() == ''){
        url = 'api/addTipoClientes';
        tipo = 'POST';
    }else{
        url = 'api/updateTipoClientes';
        tipo = 'PUT';
    }
    $.ajax({
        'type': tipo,
        'url': url,
        'data': data,
        beforeSend: function(){
            $('#load-form').removeClass('d-none');
            $('#load-button').removeClass('d-none');
            $('#btn-modal').html('enviando');
        },
        success: function(response){
            let respuesta = JSON.parse(response);
            $('#load-form').addClass('d-none');
            $('#load-button').addClass('d-none');
            $('#btn-modal').html('Registrar');
            Toast.fire({
                icon: respuesta.icon,
                title: respuesta.title,
                text: respuesta.text
            });
            if(respuesta.icon == 'success'){
                getTipoClientes('api/getTipoClientes/', 2);
                closeModal('modal-tipo_cliente', 'form-add-tipo_cliente');
            }
        }
    });
})
function getTipoClientes(api, filtro){
    $.ajax({
        'type': 'get',
        'url': api+filtro,
        beforeSend: function(){
            $('#table-tipo_cliente tbody').empty();
            $('#table-tipo_cliente tbody').html('<tr id="load-tipo_clientes"><td colspan="8"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
        },
        success: function(response){
            $('#load-tipo_clientes').addClass('d-none');
            var data = JSON.parse(response);
            var elimnado = '';
            var row = '';
            $.each(data, function(index, valor){
                if(valor.deleted_at != null){ //validación para que los registros elimnados sean de color rojo
                    elimnado = 'table-danger';
                }else{
                    elimnado = '';
                }
                row += `
                    <tr class="${elimnado}">
                        <td>${valor.tipo_cliente}</td>
                        <td>
                            <button type="button" class="btn p-0 border-0" onclick="onChange(${valor.id}, '${valor.tipo_cliente}');"><i class="ti ti-edit icono text-primary"></i></button>
                        </td>
                        <td>
                            <button type="button" class="btn p-0 border-0" onclick="confirmDelete(${valor.id}, '${valor.tipo_cliente}', 'api/deleteTipoClientes/', 'tipo de cliente', 'el');"><i class="ti ti-trash icono text-danger"></i></button>
                        </td>

                    </tr>
                `;
            });
            $('#table-tipo_cliente tbody').html(row);
            $("#table-tipo_cliente").paginationTdA({
                elemPerPage: 5
            });
        }
    })
}
function onChange(id, tipo_cliente){
    $('#id').val(id);
    $('#tipo_cliente').val(tipo_cliente);
    openModal('modal-tipo_cliente', 'tipo_clientes', 1);
}