function getSaleByEmployees(sucursale_id, offset, limit){
    $.ajax({
        'type': 'GET',
        'url': 'api/saleByEmployees?sucursale_id='+sucursale_id,
        beforeSend: function(){
            $('#table-saleByEmployees tbody').empty();
            $('#table-saleByEmployees tbody').html('<tr id="load-users"><td colspan="8"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
        },
        success: function(response){
            let data = JSON.parse(response);
            var row = '';
            if(data.length > 0){

                $.each(data[0], function(index, value){
                    row += `
                            <tr class="">
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <img src="img/usuarios/${value.foto_perfil}" alt="user image" class="img-radius img-40 align-top m-r-15">
                                    <div class="d-inline-block">
                                        <h6>${value.nombres +' '+ value.app +' '+ value.apm}</h6>
                                        <p class="text-muted m-b-0">${value.sucursal.nombre}</p>
                                    </div>
                                </td>    
                                <td class="text-right">
                                    <h6 class="f-w-700">$<b class="count">${value.ventas_sum_total}</b></h6>
                                </td>
                            </tr>
                        `;
                });
                $('#table-saleByEmployees tbody').html(row);
                // let cantidad = Math.ceil(data[1] / 5);
                // offset = offset < 0 ? 0 : offset;
                // let paginacion = `<li class='page-item'><a class='page-link paginationInit ${offset == 0 ? 'disabled' : '' }' href='#' tabindex='-1' aria-disabled='true' onclick="getSaleByEmployees(1, ${offset - 5}, ${5}, '')">Anterior</a></li>`;
                // for(let i = 0; i < cantidad; i++){
                //     paginacion += `<li class='page-item'><button class='page-link paginationClick ${5 * i == offset ? 'active' : '' }' type="button" onclick="getSaleByEmployees(1, ${5 * i}, ${5}, '')">${i+1}</button></li>`;
                // }
                // paginacion += `<li class='page-item'><a class='page-link paginationEnd ${offset >= (cantidad * cantidad -1) ? 'disabled' : ''}' href='#' tabindex='-1' aria-disabled='true' onclick="getSaleByEmployees(1, ${offset >= (cantidad * cantidad -1) ? offset : offset + 5}, ${5}, '')">Siguiente</a></li>`;
                // $('#paginacion').html(paginacion);
            }else{
                $('#table-saleByEmployees tbody').html('<tr><td colspan="15" class="text-center">No hay registros</td></tr>');
            }
            counter();
        },
        error: function(){
            counter();
        }
    })
}
$('#sucursale_id').change(function(){
    getSaleByEmployees($(this).val(), 0, 5);
})