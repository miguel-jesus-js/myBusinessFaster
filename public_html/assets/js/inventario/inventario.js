function getinventario(tipo, inventario, filtro){
    $.ajax({
        'type': 'get',
        'url': '/api/getInventario/'+tipo+'/'+ inventario +'/?filtro='+filtro,
        beforeSend: function(){
            $('#table-inventario tbody').empty();
            $('#table-inventario tbody').html('<tr><td colspan="8"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td></tr>');
        },
        success: function(response){
            var data = JSON.parse(response);
            var elimnado = '';
            var row = '';
            if(data.length > 0){
                $.each(data, function(index, valor){
                    if(valor.deleted_at != null){ //validación para que los registros elimnados sean de color rojo
                        elimnado = 'table-danger';
                    }else{
                        elimnado = '';
                    }
                    if(inventario == 2){
                        row += `
                        <tr class="${elimnado}">
                            <td>${valor.producto.producto}</td>
                            <td>${valor.entradas}</td>
                            <td>${valor.salidas}</td>
                            <td>${valor.entradas - valor.salidas}</td>
                        </tr>`;
                    }else{
                        row += `
                        <tr class="${elimnado}">
                            <td>${valor.sucursal.nombre}</td>
                            <td>${valor.user.persona.nombres}</td>
                            <td></td>
                            <td>${valor.producto.producto}</td>
                            <td>${valor.cantidad}</td>
                            <td>${valor.fecha}</td>
                        </tr>`;
                    }
                });
                $('#table-inventario tbody').html(row);
                $("#table-inventario").paginationTdA({
                    elemPerPage: 5
                });
                let pag = $('.paginationClick').parent()[0];
                pag.classList.add('active');
            }else{
                $('#table-inventario tbody').html('<tr><td colspan="8" class="text-center">No hay registros</td></tr>');
            }
        }
    })
}