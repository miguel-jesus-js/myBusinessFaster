$('#form-add-producto').submit(function(e){
    e.preventDefault();
    var url = '';
    var tipo = '';
    if($('#id').val() == ''){
        url = 'api/addProductos';
        tipo = 'POST';
    }else{
        url = 'api/updateProductos';
        tipo = 'PUT';
    }
    $.ajax({
        'type': tipo,
        'url': url,
        'data': new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
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
                getProductos('api/getProductos/', 2);
                closeModal('modal-producto', 'form-add-producto');
            }
        }
    });
});
function getProductos(api, filtro){
    $.ajax({
        'type': 'get',
        'url': api+filtro,
        beforeSend: function(){
            $('#table-producto tbody').empty();
            $('#table-producto tbody').html('<tr id="load-productos"><td colspan="8"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
        },
        success: function(response){
            $('#load-productos').addClass('d-none');
            var data = JSON.parse(response);
            var elimnado = '';
            var row = '';
            var cat = '';
            $.each(data, function(index, valor){
                cat = '';
                for(var i=0; i<valor.categorias.length; i++){
                    cat += `${valor.categorias[i].categoria}, `;
                }
                cat = cat.substr(0, cat.length - 2);
                if(valor.deleted_at != null){ //validación para que los registros elimnados sean de color rojo
                    elimnado = 'table-danger';
                }else{
                    elimnado = '';
                }
                row += `
                    <tr class="${elimnado}">
                        <td>${valor.producto}</td>
                        <td>${valor.materiales.material}</td>
                        <td>${valor.unidad_medidas.unidad_medida}</td>
                        <td>${valor.marcas.marca}</td>
                        <td>${cat}</td>
                        <td>$${valor.pre_venta}</td>
                        <td>${valor.stock}</td>
                        <td>
                            <button type="button" class="btn p-0 border-0" onclick="onChange(${valor.id}, '${valor.marca}');"><i class="ti ti-edit icono text-primary"></i></button>
                        </td>
                        <td>
                            <button type="button" class="btn p-0 border-0" onclick="confirmDelete(${valor.id}, '${valor.marca}', 'api/deleteProductos/', 'producto', 'el');"><i class="ti ti-trash icono text-danger"></i></button>
                        </td>

                    </tr>
                `;
            });
            $('#table-producto tbody').html(row);
            $("#table-producto").paginationTdA({
                elemPerPage: 5
            });
        },
        error: function (request, status, error) {
            if(request.status == 0){
                msjInfo('error', 'Error', 'Se perdio la conexión con el servidor, intente nuevamente');
            }else{
                msjInfo('error', 'Error de servidor interno', 'No se puede establecer una conexión ya que el equipo de destino denegó expresamente dicha conexión');
            }
        }
    })
}
function onChange(id, categoria){
    $('#id').val(id);
    $('#categoria').val(categoria);
    openModal('modal-categoria', 'categorias', 1);
}