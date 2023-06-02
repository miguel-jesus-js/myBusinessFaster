function getSucursales() {
    let selectUser = $('#sucursale_id');
    if (selectUser[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getSucursales/2',
            beforeSend: function () {
                $('#load-select').html('Cargando...');
                $('#load-select1').html('Cargando...');
            },
            success: function (response) {
                $('#load-select').html('Elige una opción');
                let data = JSON.parse(response);
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}">${valor.nombre}</option>`;
                });
                $('#sucursale_id').append(option);
                $('#sucursale_id1').append(option);
            }
        });
    }
}
$('#sucursale_id').change(function(){
    getProductos($(this).val());
});
$('#sucursale_id1').change(function(){
    getProductosSucursal(2, '');
})
function getProductos(sucursal_id){
    $.ajax({
        'type': 'get',
        'url': '/api/getProductosSucursalExist/'+sucursal_id,
        beforeSend: function(){
            $('#table-productos tbody').empty();
            $('#table-productos tbody').html('<tr id="load-productos"><td colspan="10"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
        },
        success: function(response){
            $('#load-productos').addClass('d-none');
            var data = JSON.parse(response);
            const formatter = new Intl.NumberFormat('es-MX', {
                style: 'currency',
                currency: 'MXN',
                minimumFractionDigits: 2
            })
            var elimnado = '';
            var row = '';
            var caract = '';
            var cat = '';
            if(data.length > 0){
                $.each(data, function(index, valor){
                    if(valor.deleted_at != null){ //validación para que los registros elimnados sean de color rojo
                        elimnado = 'table-danger';
                    }else{
                        elimnado = '';
                    }
                    row += `
                        <tr class="${elimnado}">
                            <td><input type="checkbox" class="form-check-input checkbox" name="marcar"></td>
                            <td class="d-none">${valor.id}</td>
                            <td>${valor.cod_barra}</td>
                            <td>${valor.producto}</td>
                            <td>
                                <input type="number" class="form-control" name="pre_compra[]" placeholder="Precio de compra" autocomplete="off" min="1" max="100000" minlength="1" maxlength="7" step=0.01>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="pre_venta[]" placeholder="Precio de venta" autocomplete="off" min="1" max="100000" minlength="1" maxlength="7" step=0.01>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="pre_mayoreo[]" placeholder="Precio por mayoreo" autocomplete="off" min="1" max="100000" minlength="1" maxlength="7" step=0.01>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="pre_credito[]" placeholder="Precio por crédito" autocomplete="off" min="1" max="100" minlength="1" maxlength="3" step=0.01>
                            </td>
                            <td><input type="number" class="form-control" name="stock=[]" placeholder="Stock" autocomplete="off" min="1" max="100000" minlength="1" maxlength="7"></td>
                        </tr>
                    `;
                });
                $('#table-productos tbody').html(row);
                $("#table-productos").paginationTdA({
                    elemPerPage: 5
                });
                let pag = $('.paginationClick').parent()[0];
                pag.classList.add('active');
            }else{
                $('#table-productos tbody').html('<tr><td colspan="14" class="text-center">No hay registros</td></tr>');
            }
        },
    })
}
$('#search-productos').keyup(function(){
    var list = $('#lista-productos');
    var filter = $(this).val().toLowerCase();
    list.find('td').filter(function(){
        return $(this).text().toLowerCase().indexOf(filter) === -1;
    }).closest('tr').hide();
    list.find('td').filter(function(){
        return $(this).text().toLowerCase().indexOf(filter) !== -1;
    }).closest('tr').show();
    
})
$('#marcar_todos').click(function(){
    $('.checkbox').prop('checked', $(this).prop('checked'));
    $('.checkbox').each(function(index, value){
        let input = $(this).closest('tr').find('input[type="number"]');
        if($(this).prop('checked')){
            $(input).prop('required', true);
        }else{
            $(input).prop('required', false);
        }
    })
});
$(document).on('click', '.checkbox', function(event){
    let input = $(this).closest('tr').find('input[type="number"]');
    if(!$(this).prop('checked')){
        $('#marcar_todos').prop('checked', false);
        $(input).prop('required', false);
    }else{
        $(input).prop('required', true);
    }
})