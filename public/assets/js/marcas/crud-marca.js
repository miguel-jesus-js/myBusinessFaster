$('#form-add-marca').submit(function(e){
    e.preventDefault();
    let data = $(this).serialize();
    var url = '';
    var tipo = '';
    if($('#id').val() == ''){
        url = 'api/addMarcas';
        tipo = 'POST';
    }else{
        url = 'api/updateMarcas';
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
                getMarcas('api/getMarcas/', 2);
                closeModal('modal-marca', 'form-add-marca');
            }
        }
    });
})
function getMarcas(api, filtro){
    $.ajax({
        'type': 'get',
        'url': api+filtro,
        beforeSend: function(){
            $('#table-marca tbody').empty();
            $('#table-marca tbody').html('<tr id="load-marcas"><td colspan="8"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
        },
        success: function(response){
            $('#load-marcas').addClass('d-none');
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
                        <td>${valor.marca}</td>
                        <td>
                            <button type="button" class="btn p-0 border-0" onclick="onChange(${valor.id}, '${valor.marca}');"><i class="ti ti-edit icono text-primary"></i></button>
                        </td>
                        <td>
                            <button type="button" class="btn p-0 border-0" onclick="confirmDelete(${valor.id}, '${valor.marca}', 'api/deleteMarcas/', 'marca', 'la');"><i class="ti ti-trash icono text-danger"></i></button>
                        </td>

                    </tr>
                `;
            });
            $('#table-marca tbody').html(row);
            $("#table-marca").paginationTdA({
                elemPerPage: 5
            });
        }
    })
}
function onChange(id, marca){
    $('#id').val(id);
    $('#marca').val(marca);
    openModal('modal-marca', 'marcas', 1);
}