$('#form-search-venta').submit(function(e){
    e.preventDefault();
    let folio = $('#folio').val();
    $.ajax({
        'type': 'GET',
        'url': 'api/searchVenta/'+folio,
        beforeSend: function(){
            $('#venta-detalle').html(placeholderDetalleVenta);
        },
        success: function(response){
            let respuesta = JSON.parse(response);
            let venta = respuesta[0];
            let setting = respuesta[1];
            var pagos = '';
            if(respuesta != null){
              $.each(venta.pagos, function(index, value){
                let fecha_estimada = new Date(value.fecha_estimada);
                let fecha_hora = new Date(value.fecha_hora);
                pagos += `
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-1">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-${value.id}" aria-expanded="false">
                          <div class="row">
                            <div class="col-auto">
                              <span class="avatar">${index + 1}</span>
                            </div>
                            <div class="col">
                              <div class="text-truncate">
                                Fecha estimada de pago: ${fecha_estimada.getDate()+' de '+meses[fecha_estimada.getMonth()]+' de '+fecha_estimada.getFullYear()}
                              </div>
                              <div class="text-muted">${value.estado == 1 ? '<span class="badge bg-teal">Pagado</span>' : value.estado == 2 ? '<span class="badge bg-yellow">Pendiente</span>' : '<span class="badge bg-red">Cancelado</span>'}</div>
                            </div>
                          </div>
                    </h2>
                    <div id="collapse-${value.id}" class="accordion-collapse collapse" data-bs-parent="#accordion-example" style="">
                        <div class="accordion-body pt-0">
                          <div class="row">
                            <div class="col-6">
                              <small><strong class="datagrid-title class-name h6">Fecha estimada de pago: </strong> ${fecha_estimada.getDate()+' de '+meses[fecha_estimada.getMonth()]+' de '+fecha_estimada.getFullYear()}</small>
                              <br>
                              <small><strong class="datagrid-title class-name h6">Fecha de pago: </strong> ${fecha_hora.getDate()+' de '+meses[fecha_hora.getMonth()]+' de '+fecha_hora.getFullYear()}</small>
                              <br>
                              <small><strong class="datagrid-title class-name h6">Le atendio: </strong> Miguel López</small>
                              <br>
                              <small><strong class="datagrid-title class-name h6">Estado: </strong> ${value.estado == 1 ? '<span class="badge bg-teal">Pagado</span>' : value.estado == 2 ? '<span class="badge bg-yellow">Pendiente</span>' : '<span class="badge bg-red">Cancelado</span>'}</small>
                            </div>
                            ${value.estado == 1 ?'' : value.estado == 2  ? 
                            `<div class="col-6 d-flex justify-content-end">
                              <form id="form-add-pago" class="form-add-pago">
                                <input type="hidden" class="form-control form-control-lg" name="id" id="id" autocomplete="off" required value="${value.id}">
                                <input type="hidden" class="form-control form-control-lg" name="total_pagar" id="total_pagar" autocomplete="off" required value="${value.monto - value.anticipo}">
                                <div class="row mb-2">
                                  <label class="form-label required">Monto</label>
                                  <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ti ti-currency-dollar"></i>
                                    </span>
                                    <input type="number" class="form-control form-control-lg" name="monto" id="monto" placeholder="0.00" autocomplete="off" required min="1" step=0.01 value="${value.monto}" disabled>
                                  </div>
                                  <label class="form-label required">Anticipo</label>
                                  <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ti ti-currency-dollar"></i>
                                    </span>
                                    <input type="number" class="form-control form-control-lg" name="anticipo" id="anticipo" placeholder="0.00" autocomplete="off" required min="0" step=0.01 value="${value.anticipo}" disabled>
                                  </div>
                                  <label class="form-label required">Efectivo</label>
                                  <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ti ti-currency-dollar"></i>
                                    </span>
                                    <input type="number" class="form-control form-control-lg" name="paga_con" id="paga_con" placeholder="0.00" autocomplete="off" required min="1" step=0.01>
                                  </div>

                                  <button class="btn btn-primary btn-lg" type="submit">PAPGAR $${value.monto - value.anticipo}</button>
                                </div>
                              </form>
                            </div>` : '' }
                          </div>
                        </div>
                    </div>
                  </div>`;
              });
              let fecha = new Date(venta.fecha);
              let htmlDetalleVenta = `
              <div class="row">
              <div class="col-md-10">
                <img src="img/${setting.logotipo}" class="logo logo-icons logo-suffix" alt="Logotipo">
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-6">
                <small><strong class="datagrid-title class-name h6">Nombre o razón social: </strong> ${setting.razon_social}</small>
                <br>
                <small><strong class="datagrid-title class-name h6">Número de identificación fiscal: </strong> ${venta.sucursal.rfc == null ? '' : venta.sucursal.rfc}</small>
                <br>
                <small>
                  <address>
                    <strong class="datagrid-title class-name h6">Dirección: </strong>
                      ${venta.sucursal.calle +' '+ venta.sucursal.n_exterior == null ? '' : venta.sucursal.n_exterior}
                      <br>
                      ${venta.sucursal.colonia +' '+ venta.sucursal.cp}
                      <br>
                      ${venta.sucursal.municipio +' '+venta.sucursal.estado +' '+ venta.sucursal.ciudad}
                      <br>
                  </address>
                </small>
                <small><strong class="datagrid-title class-name h6">Teléfono: </strong> ${venta.sucursal.telefono}</small>
                <br>
                <small><strong class="datagrid-title class-name h6">Correo electrónico: </strong> ${venta.sucursal.correo}</small>
              </div>
              ${venta.cliente_id == null ? 
                  `<div class="col-6 text-justify">
                      <small><strong class="datagrid-title class-name h6">Venta al publico en general</strong></small>
                  </div>` 
                  : 
                  `<div class="col-6 text-justify">
                      <small><strong class="datagrid-title class-name h6">Nombre o razón social: </strong> ${venta.cliente.persona.nombres}</small>
                      <br>
                      <small><strong class="datagrid-title class-name h6">Número de identificación fiscal: </strong> ${venta.cliente.persona.rfc == null ? '' : venta.cliente.persona.rfc}</small>
                      <br>
                      <small>
                      <address>
                          <strong class="datagrid-title class-name h6">Dirección: </strong>
                          ${venta?.direccion?.calle ?? 'Sin dirección'} ${venta?.direccion?.n_exterior ?? ''}
                          <br>
                          ${venta?.direccion?.colonia ?? ''} ${venta?.direccion?.cp ?? ''}
                          <br>
                          ${venta?.direccion?.municipio ?? ''} ${venta?.direccion?.estado ?? ''} ${venta?.direccion?.ciudad ?? ''}
                          <br>
                      </address>
                      </small>
                      <small><strong class="datagrid-title class-name h6">Teléfono: </strong> ${venta.cliente.persona.telefono}</small>
                      <br>
                      <small><strong class="datagrid-title class-name h6">Correo electrónico: </strong> ${venta.cliente.persona.email}</small>
                  </div>`}
              <div class="col-12 my-3">
                <small><strong class="datagrid-title class-name h6">Número de folio: </strong> ${venta.folio}</small>
                <br>
                <small><strong class="datagrid-title class-name h6">Fecha y hora: </strong> ${fecha}</small>
                <br>
                <small><strong class="datagrid-title class-name h6">Tipo de venta: </strong> ${venta.tipo_venta == 0 ? 'Venta a menudeo' : 'Venta a mayoreo'}</small>
                <br>
                <small><strong class="datagrid-title class-name h6">Vendedor: </strong> ${venta.empleado.persona.nombres}</small>
                <br>
              </div>
            </div>
            <div class="datagrid-title"> Descripción de los productos o servicios</div>
            <div class="table-responsive">
              <table class="table bg-white table-bordered table-sm">
                <thead class="disable-selection">
                  <tr>
                    <th></th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="4" class="p-1 strong text-end">Subtotal:</td>
                    <td class="p-1 text-end">${venta.importe}</td>
                  </tr>
                  <tr>
                    <td colspan="4" class="p-1 strong text-end">IVA (${setting.iva}%):</td>
                    <td class="p-1 text-end">${venta.iva}</td>
                  </tr>
                  <tr>
                    <td colspan="4" class="p-1 strong text-end">Descuento:</td>
                    <td class="p-1 text-end">${venta.descuento}</td>
                  </tr>
                  <tr>
                    <td colspan="4" class="p-1 strong text-end">Total:</td>
                    <td class="p-1 text-end">${venta.total}</td>
                  </tr>
                  ${venta.tipo_venta_pago == 0 ? 
                      `<tr>
                          <td colspan="4" class="p-1 strong text-end">Efectivo:</td>
                          <td class="p-1 text-end">${venta.paga_con}</td>
                      </tr>
                      <tr>
                          <td colspan="4" class="p-1 strong text-end">Cambio:</td>
                          <td class="p-1 text-end">${venta.paga_con - venta.total}</td>
                      </tr>` 
                      : 
                      `<tr>
                          <td colspan="4" class="p-1 strong text-end">Pago inicial:</td>
                          <td class="p-1 text-end">${venta.pago_inicial}</td>
                      </tr>`}
                </tbody>
              </table>
            </div>
            <br><br>
            <div class="row">
              <div class="col-md-5">
                <table class="table bg-white table-bordered">
                  <thead class="disable-selection">
                    <tr>
                      <th>Información de pago</th>
                    </tr>
                    <tbody>
                      <tr>
                        <td class="p-1">
                            Modalidad: ${venta.tipo_venta_pago == 0 ? 'Venta de contado' : 'Venta a crédito'}
                        </td>
                      </tr>
                      <tr>
                          <td class="p-1">Tipo de Pago: <i class="${venta.tipo_pago == 0 ? 'ti ti-brand-cashapp' : 'ti ti-brand-visa'}"></i>
                              ${venta.tipo_pago == 0 ? 'Efectivo' : 'Tarjeta'}
                          </td>
                      </tr>
                      <tr>
                          <td class="p-1">Estado: ${venta.estado == 0 ? 'Pagado' : 'Pagos pendientes'}</td>
                      </tr>
                      ${venta.tipo_venta_pago ? 
                          `<tr>
                              <td class="p-1">
                                  Periodo de pagos: ${venta.periodo_pagos == 1 ? 'Semanal' : venta.periodo_pagos == 2 ? 'Quincenal' : 'Mensual'}
                              </td>
                          </tr>` 
                          : 
                          ``}
                    </tbody>
                  </thead>
                </table>
              </div>
            </div>
            <p class="text-muted text-center mt-3">Muchas gracias por hacer negocios con nosotros. ¡Esperamos trabajar con usted nuevamente!</p>
              `;
              $('#form-search-producto').trigger('reset');
              $('#reporte').html(pagos);
              $('#venta-detalle').html(htmlDetalleVenta);
              addPago();
            }else{
              Toast.fire({
                  icon: 'error',
                  title: 'Error',
                  text: 'Venta no encontrada'
              });
              $('#form-search-producto').trigger('reset');
            }
        },
        error: function(){

        }
    });
});
function addPago(){
  $('.form-add-pago').submit(function(e){
    e.preventDefault();
    let efectivo = parseFloat($('#paga_con').val());
    let total_pagar = parseFloat($('#total_pagar').val());
    if(efectivo < total_pagar){
      Toast.fire({
        icon: 'warning',
        title: 'Advertencia',
        text: 'El efectivo es menor al total a pagar'
      });
      return;
    }
    let data = $(this).serialize();
    $.ajax({
        'type': 'PUT',
        'url': 'api/add-pago',
        'data': data,
        beforeSend: function(){
  
        },
        success: function(response){
          let respuesta = JSON.parse(response);
          Toast.fire({
            icon: respuesta.icon,
            title: respuesta.title,
            text: respuesta.text
          });
          if(respuesta.icon == 'success'){
            let url = window.location;
            window.open(url.origin+'/api/ticket-pago/'+respuesta.id,'_blank')
            $('#form-search-venta').trigger('submit');
          }
        },
        error: function(){
  
        }
    });
  });
}
var placeholderDetalleVenta = `
    <ul class="list-group list-group-flush placeholder-glow">
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-1">
                <div class="ratio ratio-1x1 card-img-start placeholder"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                <div class="placeholder placeholder-xs col-4"></div>
                </div>
                <div class="col-12">
                <div class="placeholder placeholder-xs col-4"></div>
                </div>
                <div class="col-12">
                <span class="placeholder col-4 placeholder-lg"></span>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                <div class="placeholder placeholder-xs col-4"></div>
                </div>
                <div class="col-12">
                <div class="placeholder placeholder-xs col-4"></div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                <div class="placeholder placeholder-xs col-4"></div>
                </div>
                <div class="col-12">
                <div class="placeholder placeholder-xs col-4"></div>
                </div>
                <div class="col-12">
                <div class="placeholder placeholder-xs col-4"></div>
                </div>
                <div class="col-12">
                <div class="placeholder placeholder-xs col-4"></div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                <div class="placeholder placeholder-xs col-12"></div>
                <div class="placeholder placeholder-xs col-12"></div>
                <div class="placeholder placeholder-xs col-12"></div>
                <div class="placeholder placeholder-xs col-12"></div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                <div class="placeholder placeholder-xs col-4"></div>
                </div>
                <div class="col-12">
                <div class="placeholder placeholder-xs col-4"></div>
                </div>
                <div class="col-12">
                <div class="placeholder placeholder-xs col-4"></div>
                </div>
                <div class="col-12">
                <div class="placeholder placeholder-xs col-4"></div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                <div class="placeholder placeholder-xs col-4"></div>
                </div>
                <div class="col-12">
                <div class="placeholder placeholder-xs col-4"></div>
                </div>
                <div class="col-12">
                <div class="placeholder placeholder-xs col-4"></div>
                </div>
                <div class="col-12">
                <div class="placeholder placeholder-xs col-4"></div>
                </div>
            </div>
        </li>
    </ul>
`;