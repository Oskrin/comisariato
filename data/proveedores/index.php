<?php 
session_start();
include('../menu/app.php'); 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>PROVEEDORES</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <link href="../../font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        
    <link href="../../plugins/icon/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <link href="../../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="../../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <link href="../../dist/css/alertify.core.css" rel="stylesheet" />
    <link href="../../dist/css/alertify.default.css" id="toggleCSS" rel="stylesheet" />
    <link href="../../dist/css/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css"/>            
    <link href="../../dist/css/ui.jqgrid.css" rel="stylesheet" type="text/css"/> 
    
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      <?php banner_1(); ?>
      <?php menu_lateral_1(); ?>
      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            Registro Proveedores
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Ingresos</a></li>
            <li class="active">Proveedores</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-body">
                  <div class="row">
                      <form id="proveedores_form" name="proveedores_form" method="post">
                        <div class="col-mx-12">                    
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Tipo Documento: <font color="red">*</font></label>
                              <select class="form-control" name="tipo_docu" id="tipo_docu">
                                <option value="Cedula">Cedula</option>
                                <option value="Ruc">Ruc</option>
                                <option value="Pasaporte">Pasaporte</option>
                              </select>
                              <input type="hidden" name="id_proveedor"  id="id_proveedor" readonly class="form-control">
                            </div>

                            <div class="form-group">
                              <label>Empresa: <font color="red">*</font></label>
                              <input name="empresa_pro"  id="empresa_pro" placeholder="Nombre de la Empresa" class="form-control" />
                            </div>

                            <div class="form-group">
                              <label>Visitador:</label>
                              <input name="visitador" id="visitador" placeholder="Empleado Empresa" class="form-control" />
                            </div>

                            <div class="form-group">
                              <label>Teléfono:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-phone"></i>
                                </div>
                                <input type="text" name="nro_telefono" id="nro_telefono" class="form-control" data-inputmask='"mask": "(999) 999-999"' data-mask/>
                              </div>
                            </div>

                            <div class="form-group">
                              <label>E-mail:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-envelope"></i>
                                </div>
                                <input type="text" name="correo" id="correo" placeholder="Email" class="form-control"/>
                              </div>
                            </div>

                            <div class="form-group">
                              <label>País: <font color="red">*</font></label>
                              <input type="text" name="pais_pro" id="pais_pro" placeholder="Ingrese un país" class="form-control" />
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label>RUC/CI: <font color="red">*</font></label>
                              <input type="text" name="ruc_ci"  id="ruc_ci" class="form-control" />
                            </div>

                            <div class="form-group">
                              <label>Representante Legal:</label>
                              <input type="text" name="representante_legal" id="representante_legal" placeholder="Representante Legal" class="form-control"/>
                            </div>

                            <div class="form-group">
                              <label>Dirección: <font color="red">*</font></label>
                              <input type="text" name="direccion_pro" id="direccion_pro" placeholder="Dirección" class="form-control" />
                            </div>

                            <div class="form-group">
                              <label>Celular:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-mobile"></i>
                                </div>
                                <input type="text" name="nro_celular" id="nro_celular" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask/>
                              </div>
                            </div>

                            <div class="form-group">
                              <label>Fax:</label>
                              <input type="text" name="fax" id="fax" class="form-control" />
                            </div>

                            <div class="form-group">
                              <label>Ciudad: <font color="red">*</font></label>
                              <input type="text" name="ciudad_pro" id="ciudad_pro" class="form-control"/>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Forma de Pago:</label>
                              <select class="form-control" name="forma_pago" id="forma_pago">
                                <option value="Contado" selected>Contado</option>
                                <option value="Credito">Credito</option>     
                              </select>
                            </div>

                            <div class="form-group">
                              <label>Proveedor Principal: <font color="red">*</font></label>
                              <select class="form-control" name="principal_pro" id="principal_pro">
                                <option value="Si" selected>Si</option>
                                <option value="No">No</option>     
                              </select>
                            </div>

                            <div class="form-group">
                              <label>Cupo de Crédito:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-money"></i>
                                </div>
                                <input type="text" name="cupo_credito" id="cupo_credito" placeholder="0.00" class="form-control"/>
                              </div>
                            </div>

                            <div class="form-group">
                              <label>Tipo:</label>
                              <select class="form-control" name="tipo_pro" id="tipo_pro">
                                <option value="Persona Natural" selected>Persona Natural</option>
                                <option value="Persona Jurídica">Persona Jurídica</option>     
                              </select>
                            </div>

                            <div class="form-group">
                              <label>Comentarios:</label>
                              <textarea class="form-control" name="observaciones_pro" id="observaciones_pro" rows="3"></textarea>
                            </div>
                          </div>
                        </div>
                      </form>
                  </div>

                  <div class="row">
                    <div class="col-mx-12">
                      <p>
                        <button class="btn bg-olive margin" id='btnGuardar'><i class="fa fa-save"></i> Guardar</button>
                        <button class="btn bg-olive margin" id='btnModificar'><i class="fa fa-edit"></i> Modificar</button>
                        <button class="btn bg-olive margin" id='btnEliminar'><i class="fa fa-remove"></i> Eliminar</button>
                        <button class="btn bg-olive margin" id='btnBuscar'><i class="fa fa-search"></i> Buscar</button>
                        <button class="btn bg-olive margin" id='btnNuevo'><i class="fa fa-pencil"></i> Nuevo</button>
                      </p> 
                    </div> 

                    <div id="proveedores" title="Búsqueda de Proveedores" class="">
                        <table id="list"><tr><td></td></tr></table>
                        <div id="pager"></div>
                    </div>

                    <div id="cuentas" title="Búsqueda Plan de Cuentas" class="">
                        <table id="list2"><tr><td></td></tr></table>
                        <div id="pager2"></div>
                    </div>

                    <div id="clave_permiso" title="PERMISOS">
                        <table border="0" >
                            <tr>
                                <td><label>Ingese la clave de seguridad</label></td> 
                                <td><input type="password" name="clave" id="clave" class="campo"></td>
                            </tr>  
                        </table>
                        <div class="form-actions" align="center">
                            <button class="btn btn-primary" id='btnAcceder'><i class="icon-ok"></i> Acceder</button>
                            <button class="btn btn-primary" id='btnCancelar'><i class="icon-remove-sign"></i> Cancelar</button>
                        </div>
                    </div> 

                    <div id="seguro">
                        <label>Esta seguro de eliminar al cliente</label>  
                        <br />
                        <button class="btn btn-primary" id='btnAceptar'><i class="icon-ok"></i> Aceptar</button>
                        <button class="btn btn-primary" id='btnSalir'><i class="icon-remove-sign"></i> Cancelar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php footer(); ?>
    </div>

    <script src="../../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="../../plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
    <script src="../../plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="../../plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
    <script src="../../plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="../../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script src='../../plugins/fastclick/fastclick.min.js'></script>
    <script src="proveedores.js" type="text/javascript"></script>
    <script src="../../dist/js/app.min.js" type="text/javascript"></script>
    <script src="../../dist/js/validCampoFranz.js" type="text/javascript" ></script>
    <script src="../../dist/js/alertify.min.js" type="text/javascript"></script>
    <script src="../../dist/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
    <script src="../../dist/js/jquery.jqGrid.src.js" type="text/javascript"></script>
    <script src="../../dist/js/grid.locale-es.js" type="text/javascript"></script>
    <link href="../../dist/css/style.css" rel="stylesheet" type="text/css"/>     
    <script src="../../dist/js/ventana_reporte.js" type="text/javascript"></script>
  </body>
</html>