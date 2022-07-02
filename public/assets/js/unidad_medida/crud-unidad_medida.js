$('#form-add-unidad_medida').submit(function(e){
    e.preventDefault();
    let data = $(this).serialize();
    var url = '';
    var tipo = '';
    if($('#id').val() == ''){
        url = 'api/addUnidadMedidas';
        tipo = 'POST';
    }else{
        url = 'api/updateUnidadMedidas';
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
                getUnidadMedidas('api/getUnidadMedidas/', 2);
                closeModal('modal-unidad_medida', 'form-add-unidad_medida');
            }
        }
    });
})
function getUnidadMedidas(api, filtro){
    $.ajax({
        'type': 'get',
        'url': api+filtro,
        beforeSend: function(){
            $('#table-unidad_medida tbody').empty();
            $('#table-unidad_medida tbody').html('<tr id="load-unidad_medidas"><td colspan="8"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
        },
        success: function(response){
            $('#load-unidad_medidas').addClass('d-none');
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
                        <td>${valor.unidad_medida}</td>
                        <td>
                            <button type="button" class="btn p-0 border-0" onclick="onChange(${valor.id}, '${valor.unidad_medida}');"><i class="ti ti-edit icono text-primary"></i></button>
                        </td>
                        <td>
                            <button type="button" class="btn p-0 border-0" onclick="confirmDelete(${valor.id}, '${valor.unidad_medida}', 'api/deleteUnidadMedidas/', 'unidad de medida', 'la');"><i class="ti ti-trash icono text-danger"></i></button>
                        </td>

                    </tr>
                `;
            });
            $('#table-unidad_medida tbody').html(row);
            $("#table-unidad_medida").paginationTdA({
                elemPerPage: 5
            });
        }
    })
}
function onChange(id, unidad_medida){
    $('#id').val(id);
    $('#unidad_medida').val(unidad_medida);
    openModal('modal-unidad_medida', 'unidad_medidas', 1);
}