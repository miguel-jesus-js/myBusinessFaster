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
                    option += `<option value="${valor.id}">${valor.rol}</option>`;
                });
                $('#role_id').append(option);
            }
        });
    }
}
//llenar tabla con los modulos
function getModulos() {
    let table = $('#table-modulos tbody tr');
    if(table.length <= 1){
        $.ajax({
            'type': 'GET',
            'url': 'api/getModulos',
            beforeSend: function () {
                $('#table-modulos tbody').empty();
                $('#table-modulos tbody').html('<tr id="load-modulos"><td colspan="4"><center><h5>Cargando<span class="animated-dots"></span></h5></center></td></tr>');
            },
            success: function (response) {
                $('#load-modulos').addClass('d-none');
                let data = JSON.parse(response);
                let row = '';
                $.each(data, function (index, valor) {
                    if (valor.es_catalogo == 1) {
                        valor.es_catalogo = 'Si';
                    } else {
                        valor.es_catalogo = 'No';
                    }
                    row += `
                            <tr>
                                <td><input class="form-check-input checar" type="checkbox"></td>
                                <td class="id-hide">${valor.id}</td>
                                <td>${valor.modulo}</td>
                                <td>${valor.es_catalogo}</td>
                            </tr>
                            `;
                });
                $('#table-modulos tbody').html(row);
                $('td:nth-child(2)').hide();//ocultamos la fila ID
                // $("#table-modulos").paginationTdA({
                //     elemPerPage: 5
                // });
                // let padre = $('.pagination').parent();
                // padre[0].colSpan = 3;
            }
        });
    }
}
// Si se hace click sobre el input de tipo checkbox con id checkb
$('#checkTodo').click(function () {
    // Si esta seleccionado (si la propiedad checked es igual a true)
    if ($(this).prop('checked')) {
        // Selecciona cada input que tenga la clase .checar
        $('.checar').prop('checked', true);
    } else {
        // Deselecciona cada input que tenga la clase .checar
        $('.checar').prop('checked', false);
    }
});
//Buscar modulos
$("#search-modulo").keyup(function () {
    const tableReg = document.getElementById('table-modulos');
    const searchText = document.getElementById('search-modulo').value.toLowerCase();
    let total = 0;
    // Recorremos todas las filas con contenido de la tabla
    for (let i = 1; i < tableReg.rows.length; i++) {
        // Si el td tiene la clase "noSearch" no se busca en su cntenido

        if (tableReg.rows[i].classList.contains("noSearch")) {
            continue;
        }
        let found = false;
        const cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
        // Recorremos todas las celdas
        for (let j = 0; j < cellsOfRow.length && !found; j++) {
            const compareWith = cellsOfRow[j].innerHTML.toLowerCase();
            // Buscamos el texto en el contenido de la celda
            if (searchText.length == 0 || compareWith.indexOf(searchText) > -1) {
                found = true;
                total++;
            }
        }
        if (found) {
            tableReg.rows[i].style.display = '';
        } else {
            // si no ha encontrado ninguna coincidencia, esconde la
            // fila de la tabla
            tableReg.rows[i].style.display = 'none';
        }
    }
    // mostramos las coincidencias
    const lastTR = tableReg.rows[tableReg.rows.length - 1];
    const td = lastTR.querySelector("td");
    lastTR.classList.remove("hide", "red");
    if (searchText == "") {
        lastTR.classList.add("hide");

    } else if (total) {
        td.innerHTML = "Se ha encontrado " + total + " coincidencia" + ((total > 1) ? "s" : "");
    } else {
        lastTR.classList.add("red");
        td.innerHTML = "No se han encontrado coincidencias";
    }
});
function addModulo(){
    $('#pasar-modulos').removeClass('d-none');
    var arrayRole_id        = [];
    var arrayModulo         = [];
    var arrayEs_catalogo   = [];
    // para cada checkbox "chequeado"
    $("#table-modulos tbody tr input[type=checkbox]:checked").each(function(){
        var result = [];
        var i = 0;
        // buscamos el td más cercano en el DOM hacia "arriba"
        // luego encontramos los td adyacentes a este
        $(this).closest('td').siblings().each(function(){
            // obtenemos el texto del td
            if(i == 0){
                arrayRole_id.push($(this).text());//obtiene el id del modulo
            }else if(i == 1){
                arrayModulo.push($(this).text());//obtiene el nombre del modulo
            }
            ++i;
        });
    });
    var datos  = [];
    var objeto = {};
    for(var i= 0; i < arrayRole_id.length; i++) {
       datos.push({ 
            "role_id"       : arrayRole_id[i],
            "modulo"        : arrayModulo[i],
        });
    }
    objeto.datos = datos;
    let json = JSON.stringify(objeto); //lista de objetos en Json
    var obj = JSON.parse(json); //Parsea el Json al objeto anterior.
    var rowModulos = '';
    $.each(obj.datos, function(index, valor){//pasamos los datos a la tabla
        rowModulos += `
                    <tr>
                        <td>${valor.role_id}</td>
                        <td>${valor.modulo}</td>
                        <td><input class="form-check-input checar" type="checkbox"></td>
                        <td><input class="form-check-input checar" type="checkbox"></td>
                        <td><input class="form-check-input checar" type="checkbox"></td>
                        <td><input class="form-check-input checar" type="checkbox"></td>
                        <td>
                            <button type="button" class="btn p-0 border-0 borrar"><i class="ti ti-trash icono text-danger"></i></button>
                        </td>
                    </tr>     
        `;
    });
    $('#pasar-modulos').addClass('d-none');
    $('#table-user-modulos tbody').html(rowModulos);
    $('#table-user-modulos td:nth-child(1)').hide();//ocultamos la fila ID
    $('#modal-modulos').modal('hide');
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