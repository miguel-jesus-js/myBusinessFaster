<div class="modal modal-blur fade" id="modal-cliente" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn-close" onclick="closeModal('modal-cliente', 'form-add-cliente')"></button>
            </div>
            <div class="modal-body">
                <form id="form-add-cliente">
                    <ul class="nav nav-pills" data-bs-toggle="tabs" id="list-tab">
                        <li class="nav-item active">
                            <a href="#tab-datos-pers" class="nav-link active btn-tab" data-bs-toggle="tab">
                                <i class="ti ti-id icono me-1"></i>
                                Datos personales</a>
                        </li>
                        <li class="nav-item">
                            <a href="#contacto" class="nav-link btn-tab" data-bs-toggle="tab">
                                <i class="ti ti-phone icono me-1"></i>
                                Datos de contacto</a>
                        </li>
                        <li class="nav-item">
                            <a href="#direccionesEntrega" class="nav-link btn-tab" data-bs-toggle="tab">
                                <i class="ti ti-lock-access icono me-1"></i>
                                Direcciones</a>
                        </li>
                        <li class="nav-item" id="item-credito">
                            <a href="#credito" class="nav-link btn-tab" data-bs-toggle="tab">
                                <i class="ti ti-currency-dollar icono me-1"></i>
                                Crédito</a>
                        </li>
                        <li class="nav-item" id="item-permisos">
                            <a href="#permisos" class="nav-link btn-tab" data-bs-toggle="tab">
                                <i class="ti ti-lock-access icono me-1"></i>
                                Permisos de acceso</a>
                        </li>
                    </ul>
                    <br>
                    <div class="tab-content">
                        <div id="load-form" class="efecto-cargando">
                        </div>
                        <div class="tab-pane active show" id="tab-datos-pers">
                            <div class="row">
                                @if(Auth::user()->is_admin) 
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Sucursal</label>
                                    <select class="form-select" name="sucursale_id" id="sucursale_id" onclick="getSucursales()" required>
                                        <option value="" id="load-select" disabled selected>Elige una opción</option>
                                    </select>
                                    <div class="invalid-feedback" id="error-sucursale_id"></div>
                                </div>
                                @endif
                                <div class="col-sm-6 col-md-4">
                                    <label class="form-label required">Tipo</label>
                                    <select class="form-select" name="tipo_cliente_id" id="tipo_cliente_id" onclick="getTipoClientes()" required>
                                        <option value="" id="load-select" disabled selected>Elige una opción</option>
                                    </select>
                                    <div class="invalid-feedback" id="error-tipo_cliente_id"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <input type="number" class="d-none" id="id" name="id">
                                    <input type="number" class="d-none" id="cliente_id" name="cliente_id">
                                    <label class="form-label required">Nombre(s)</label>
                                    <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombre(s)" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}">
                                    <div class="invalid-feedback" id="error-nombres"></div>
                                </div>
                                {{-- <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Apellido P</label>
                                    <input type="text" class="form-control" name="app" id="app" placeholder="Apellido paterno" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}">
                                    <div class="invalid-feedback" id="error-app"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Apellido M</label>
                                    <input type="text" class="form-control" name="apm" id="apm" placeholder="Apellido materno" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}">
                                    <div class="invalid-feedback" id="error-apm"></div>
                                </div> --}}
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Clave</label>
                                    <input type="text" class="form-control" name="clave" id="clave" placeholder="Clave" required autocomplete="off" maxlength="10" minlength="3">
                                    <div class="invalid-feedback" id="error-clave"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label">RFC</label>
                                    <input type="text" class="form-control" name="rfc" id="rfc" placeholder="RFC" autocomplete="off" pattern="^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$">
                                    <div class="invalid-feedback" id="error-rfc"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label">Empresa</label>
                                    <input type="text" class="form-control" name="empresa" id="empresa" placeholder="Empresa" autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}">
                                    <div class="invalid-feedback" id="error-empresa"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">Usuario</label>
                                    <input type="text" class="form-control" name="nom_user" id="nom_user" placeholder="Usuario" required autocomplete="off" maxlength="20" minlength="5">
                                    <div class="invalid-feedback" id="error-nom_user"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">Contraseña</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required autocomplete="off" maxlength="20" minlength="8">
                                        <span class="input-group-text">
                                            <a href="#" onclick="showHidePassword('password', 'eye-icon')" class="input-group-link"><i id="eye-icon" class="ti ti-eye"></i></a>
                                        </span>
                                        <div class="invalid-feedback" id="error-password"></div>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Ciudad</label>
                                    <input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="Ciudad" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}" maxlength="50" minlength="5">
                                    <div class="invalid-feedback" id="error-ciudad"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Estado</label>
                                    <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}" maxlength="50" minlength="5">
                                    <div class="invalid-feedback" id="error-estado"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Municipio</label>
                                    <input type="text" class="form-control" name="municipio" id="municipio" placeholder="Municipio" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}" maxlength="50" minlength="5">
                                    <div class="invalid-feedback" id="error-municipio"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Código postal</label>
                                    <input type="number" class="form-control" name="cp" id="cp" placeholder="Código postal" required autocomplete="off" maxlength="5" minlength="5">
                                    <div class="invalid-feedback" id="error-cp"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Colonia</label>
                                    <input type="text" class="form-control" name="colonia" id="colonia" placeholder="Colonia" required autocomplete="off" maxlength="50" minlength="5">
                                    <div class="invalid-feedback" id="error-colonia"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Calle</label>
                                    <input type="text" class="form-control" name="calle" id="calle" placeholder="Calle" required autocomplete="off">
                                    <div class="invalid-feedback" id="error-calle"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label">N° Exterior </label>
                                    <input type="number" class="form-control" name="n_exterior" id="n_exterior" placeholder="N° Exterior" autocomplete="off" min="0" max="200">
                                    <div class="invalid-feedback" id="error-n_exterior"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label">N° Interior</label>
                                    <input type="number" class="form-control" name="n_interior" id="n_interior" placeholder="N° Interior" autocomplete="off" min="0" max="200">
                                    <div class="invalid-feedback" id="error-n_interior"></div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="tab-pane" id="contacto">
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label required">Telefóno</label>
                                    <input type="text" name="telefono" id="telefono" class="form-control" data-mask="(00) 0000-0000" data-mask-visible="true" placeholder="(00) 0000-0000" required autocomplete="off">
                                    <div class="invalid-feedback" id="error-telefono"></div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label required">Correo</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Correo" required autocomplete="off" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}">
                                    <div class="invalid-feedback" id="error-email"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="direccionesEntrega">
                            <div class="d-flex justify-content-end">
                                <label class="form-label required invisible">Agregar dirección</label>
                                <button type="button" class="btn btn-success" onclick="openModal('modal-direcciones','clientes', 2)">Agregar dirección</button>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table class="table" id="table-clientes-direcciones">
                                    <thead>
                                        <tr>
                                            <th class="cliente_id">ID</th>
                                            <th>Ciudad</th>
                                            <th>Estado</th>
                                            <th>Municipio</th>
                                            <th>Código postal</th>
                                            <th>Colonia</th>
                                            <th>Calle</th>
                                            <th>N° Exterior</th>
                                            <th>N° Interior</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <br>
                        </div>
                        <div class="tab-pane" id="credito">
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Límite de crédito</label>
                                    <input type="number" name="limite_credito" id="limite_credito" class="form-control" placeholder="Limite de crédito" autocomplete="off" min="1" max="1000000" minlength="1" maxlength="7" step="0.01">
                                    <div class="invalid-feedback" id="error-limite_credito"></div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label">Dias de crédito</label>
                                    <input type="number" class="form-control" name="dias_credito" id="dias_credito" placeholder="Dias de crédito" autocomplete="off" min="1" max="2000" minlength="1" maxlength="4">
                                    <div class="invalid-feedback" id="error-dias_credito"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="permisos">
                            <div class="d-flex bd-highlight">
                                <div class="p-2 flex-grow-1 bd-highlight">
                                    <div class="col-md-4">
                                        <label class="form-label required">Rol</label>
                                        <select class="form-select" name="role_id" id="role_id" onclick="getRoles()" required>
                                            <option value="" id="load-select" disabled selected>Elige una opción</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="p-2 bd-highlight">
                                    <label class="form-label required invisible">Modulos</label>
                                    <button type="button" class="btn btn-success" onclick="openModal('modal-modulos','usuarios', 2), getModulos()">Seleccionar modulos</button>
                                </div>
                            </div>
                            <br>
                            <table class="table" id="table-user-modulos">
                                <thead>
                                    <tr>
                                        <th class="role_id">ID</th>
                                        <th>Modulo</th>
                                        <th>Consultar</th>
                                        <th>Registrar</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="pasar-modulos" class="d-none">
                                        <td colspan="7"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-red btn-pill" onclick="closeModal('modal-cliente', 'form-add-cliente')">Cancelar</button>
                            <button type="submit" class="btn btn-blue btn-pill" id="btn-submit">
                                <span id="load-button" class="spinner-grow spinner-grow-sm me-1 d-none" role="status" aria-hidden="true"></span>
                                <b id="btn-modal"></b>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para agregar direcciones -->
<div class="modal modal-blur fade" id="modal-direcciones" tabindex="-1" style="display: none; z-index: 5000" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content border">
            <div class="modal-header">
                <h5 class="modal-title">Agregar dirección</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal('modal-direcciones', 'form-add-direcciones')"></button>
            </div>
            <div class="modal-body">
                <form action="" id="form-add-direcciones">
                    <div id="load-form1" class="efecto-cargando">
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6 mb-3">
                            <label class="form-label required">Ciudad</label>
                            <input type="text" class="form-control" name="ciudad1" id="ciudad1" placeholder="Ciudad" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}" maxlength="50" minlength="5">
                            <div class="invalid-feedback" id="error-ciudad1"></div>
                        </div>
                        <div class="col-sm-6 col-md-6 mb-3">
                            <label class="form-label required">Estado</label>
                            <input type="text" class="form-control" name="estado1" id="estado1" placeholder="Estado" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}" maxlength="50" minlength="5">
                            <div class="invalid-feedback" id="error-estado1"></div>
                        </div>
                        <div class="col-sm-6 col-md-6 mb-3">
                            <label class="form-label required">Municipio</label>
                            <input type="text" class="form-control" name="municipio1" id="municipio1" placeholder="Municipio" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}" maxlength="50" minlength="5">
                            <div class="invalid-feedback" id="error-municipio1"></div>
                        </div>
                        <div class="col-sm-6 col-md-6 mb-3">
                            <label class="form-label required">Código postal</label>
                            <input type="number" class="form-control" name="cp1" id="cp1" placeholder="Código postal" required autocomplete="off" maxlength="5" minlength="5">
                            <div class="invalid-feedback" id="error-cp1"></div>
                        </div>
                        <div class="col-sm-6 col-md-6 mb-3">
                            <label class="form-label required">Colonia</label>
                            <input type="text" class="form-control" name="colonia1" id="colonia1" placeholder="Colonia" required autocomplete="off" maxlength="50" minlength="5">
                            <div class="invalid-feedback" id="error-colonia1"></div>
                        </div>
                        <div class="col-sm-6 col-md-6 mb-3">
                            <label class="form-label required">Calle</label>
                            <input type="text" class="form-control" name="calle1" id="calle1" placeholder="Calle" required autocomplete="off">
                            <div class="invalid-feedback" id="error-calle1"></div>
                        </div>
                        <div class="col-sm-6 col-md-6 mb-3">
                            <label class="form-label">N° Exterior</label>
                            <input type="number" class="form-control" name="n_exterior1" id="n_exterior1" placeholder="N° Exterior" autocomplete="off" min="0" max="200">
                            <div class="invalid-feedback" id="error-n_exterior1"></div>
                        </div>
                        <div class="col-sm-6 col-md-6 mb-3">
                            <label class="form-label">N° Interior</label>
                            <input type="number" class="form-control" name="n_interior1" id="n_interior1" placeholder="N° Interior" autocomplete="off" min="0" max="200">
                            <div class="invalid-feedback" id="error-n_interior1"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal('modal-direcciones', 'form-add-direcciones')">Cancelar</button>
                        <button type="submit" class="btn btn-success" id="add-direcciones">
                            <span id="load-button1" class="spinner-grow spinner-grow-sm me-1 d-none" role="status" aria-hidden="true"></span>
                            <b id="btn-modal1">Agregar</b>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>