function getHistorial(tipo, offset, limit, filtro, ventaCompra){
    $.ajax({
        'type': 'GET',
        'url': '/api/getVentas/'+tipo+'?offset='+offset+'&limit='+limit+'&tipo='+ventaCompra+'&'+filtro,
        beforeSend: function(){
            $('#table-historial tbody').empty();
            $('#table-historial tbody').html('<tr id="load-almacenes"><td colspan="15"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
        },
        success: function(response){
            offset;
            var data = JSON.parse(response);
            var elimnado = '';
            var row = '';
            const formatter = new Intl.NumberFormat('es-MX', {
                style: 'currency',
                currency: 'MXN',
                minimumFractionDigits: 2
            })
            if(data.length > 0){
                $.each(data[0], function(index, valor){
                    if(valor.deleted_at != null){ //validación para que los registros elimnados sean de color rojo
                        elimnado = 'table-danger';
                    }else{
                        elimnado = '';
                    }
                    row += `
                        <tr class="${elimnado}">
                            <td>${valor.folio}</td>
                            <td>${valor.sucursal.nombre}</td>
                            <td>${valor.cliente_id == null ? 'Publico en general' : valor.cliente.persona.nombres}</td>}</td>
                            <td>${valor.empleado.persona.nombres}</td>}</td>
                            <td>${valor.fecha}</td>
                            <td>${formatter.format(valor.importe)}</td>
                            <td>${formatter.format(valor.iva)}</td>
                            <td>${formatter.format(valor.descuento)}</td>
                            <td>${formatter.format(valor.total)}</td>
                            <td>${valor.paga_con == null ? '': formatter.format(valor.paga_con)}</td>
                            <td>${valor.pago_inicial == null ? '': formatter.format(valor.pago_inicial)}</td>
                            <td><i class="${valor.tipo_pago == 0 ? 'ti ti-brand-cashapp icono' : 'ti ti-brand-visa icono'}"></i>  ${valor.tipo_pago == 0 ? 'Efectivo' : 'Tarjeta'}</td>
                            <td>${valor.estado == 0 ? '<span class="badge bg-green-lt">Pagado</span>' : '<span class="badge bg-orange-lt">Pendiente</span>'}</td>
                            <td>${valor.tipo_venta == 1 ? 'Menudeo' : valor.tipo_venta == 2 ? 'Mayoreo' : 'Crédito'}</td>
                            <td>${valor.tipo_venta_pago == 0 ? 'Contado' : 'Crédito'}</td>

                            <td>
                                <a href="/detalle/${valor.id}" class="btn p-0 border-0"><i class="ti ti-list-details icono text-dark"></i></a>
                            </td>
                            <td>
                                <button type="button" class="btn p-0 border-0" onclick="confirmDelete(${valor.id}, 'con folio: ${valor.folio}', 'api/deleteSucursales/', 'historial', 'el');"><i class="ti ti-trash icono text-danger"></i></button>
                            </td>
    
                        </tr>
                    `;
                });
                $('#table-historial tbody').html(row);
                let cantidad = Math.ceil(data[1] / 5);
                offset = offset < 0 ? 0 : offset;
                let paginacion = `<li class='page-item'><a class='page-link paginationInit ${offset == 0 ? 'disabled' : '' }' href='#' tabindex='-1' aria-disabled='true' onclick="getHistorial(2, ${offset - 5}, ${5}, '')">Anterior</a></li>`;
                for(let i = 0; i < cantidad; i++){
                    paginacion += `<li class='page-item'><button class='page-link paginationClick ${5 * i == offset ? 'active' : '' }' type="button" onclick="getHistorial(2, ${5 * i}, ${5}, '')">${i+1}</button></li>`;
                }
                paginacion += `<li class='page-item'><a class='page-link paginationEnd ${offset >= (cantidad * cantidad -1) ? 'disabled' : ''}' href='#' tabindex='-1' aria-disabled='true' onclick="getHistorial(2, ${offset >= (cantidad * cantidad -1) ? offset : offset + 5}, ${5}, '')">Siguiente</a></li>`;
                $('#paginacion').html(paginacion);
            }else{
                $('#table-historial tbody').html('<tr><td colspan="15" class="text-center">No hay registros</td></tr>');
            }
        }
    })
}
function getSucursales() {
    let selectUser = $('#sucursale_id');
    if (selectUser[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getSucursales/2',
            beforeSend: function () {
                $('#load-select').html('Cargando...');
            },
            success: function (response) {
                $('#load-select').html('Elige una opción');
                let data = JSON.parse(response);
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}">${valor.nombre}</option>`;
                });
                $('#sucursale_id').append(option);
            }
        });
    }
}
function getUsers() {
    let selectUser = $('#user_id');
    if (selectUser[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getUsuarios/2',
            beforeSend: function () {
                $('#load-select-1').html('Cargando...');
            },
            success: function (response) {
                $('#load-select-1').html('Elige una opción');
                let data = JSON.parse(response);
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}">${valor.persona.nombres}</option>`;
                });
                $('#user_id').append(option);
            }
        });
    }
}
function getClientes() {
    let selectUser = $('#cliente_id');
    if (selectUser[0].children.length <= 1) {
        $.ajax({
            'type': 'GET',
            'url': 'api/getClientes/2',
            beforeSend: function () {
                $('#load-select-2').html('Cargando...');
            },
            success: function (response) {
                $('#load-select-2').html('Elige una opción');
                let data = JSON.parse(response);
                let option = '';
                $.each(data, function (index, valor) {
                    option += `<option value="${valor.id}">${valor.persona.nombres}</option>`;
                });
                $('#cliente_id').append(option);
            }
        });
    }
}
var filtro = '';
var producto = '';
$('#form-filter').submit(function(e){
    e.preventDefault();
    filtro = $(this).serialize();
    producto = $("#search").val();
    let modulo = $('#modulo').val();
    if(modulo == 'cuentas_por_cobrar'){
        filtro += '&estado=1';
    }
    getHistorial(tipoFiltro, 0, 5, filtro);
    $('#closeCanvas').trigger('click');
});