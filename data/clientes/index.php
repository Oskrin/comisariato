<?php 
session_start();
include('../menu/app.php'); 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>CLIENTES..</title>
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
            Registro Clientes
          </h1>
          <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Ingresos</a></li>
            <li class="active">Clientes</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-body">
                  <div class="row">
                      <form id="clientes_form" name="clientes_form" method="post">
                        <div class="col-mx-12">                    
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Tipo Documento: <font color="red">*</font></label>
                              <select class="form-control" name="tipo_docu" id="tipo_docu">
                                <option value="Cedula">Cedula</option>
                                <option value="Ruc">Ruc</option>
                                <option value="Pasaporte">Pasaporte</option>
                              </select>
                              <input type="hidden" name="id_cliente"  id="id_cliente" readonly class="form-control">
                            </div>

                            <div class="form-group">
                              <label>Nombres Completos: <font color="red">*</font></label>
                              <input type="text" name="nombres_cli"  id="nombres_cli" placeholder="Nombres y Apellidos" class="form-control" />
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
                              <label>País: <font color="red">*</font></label>
                              <input type="text" name="pais_cli" id="pais_cli" placeholder="Ingrese un pais" class="form-control" />
                            </div>

                            <div class="form-group">
                              <label>Dirección: <font color="red">*</font></label>
                              <input type="text" name="direccion_cli" id="direccion_cli" placeholder="Dirección cliente" class="form-control" />
                            </div>

                            <div class="form-group">
                              <label>Comentarios:</label>
                              <textarea class="form-control" name="notas_cli" id="notas_cli" rows="3"></textarea>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label>RUC/CI: <font color="red">*</font></label>
                              <input type="text" name="ruc_ci"  id="ruc_ci" class="form-control" />
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
                              <label>Ciudad: <font color="red">*</font></label>
                              <input type="text" name="ciudad_cli" id="ciudad_cli" class="form-control"/>
                            </div>

                            <div class="form-group">
                              <label>E-mail:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-envelope"></i>
                                </div>
                                <input type="text" name="email" id="email" placeholder="Email" class="form-control"/>
                              </div>
                            </div>

                            <div class="form-group">
                              <label>Cupo de Crédito: <font color="red">*</font></label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-money"></i>
                                </div>
                                <input type="text" name="cupo_credito" id="cupo_credito" placeholder="0.00" class="form-control"/>
                              </div>
                            </div>

                            <div class="form-group">
                              <label>Tipo:</label>
                              <select class="form-control" name="tipo_cli" id="tipo_cli">
                                <option value="Persona Natural" selected>Persona Natural</option>
                                <option value="Persona Jurídica">Persona Jurídica</option>     
                              </select>
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

                    <div id="clientes" title="Búsqueda de Clientes" class="">
                      <table id="list"><tr><td></td></tr></table>
                      <div id="pager"></div>
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
    <script src="clientes.js" type="text/javascript"></script>
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