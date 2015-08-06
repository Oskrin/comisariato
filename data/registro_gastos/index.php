<?php
session_start();
include '../../procesos/base.php';
include('../menu/app.php'); 
conectarse();
error_reporting(0);

$cont1 = 0;
    $consulta = pg_query("select * from gastos order by id_gastos asc");
    while ($row = pg_fetch_row($consulta)) {
        $cont1 = $row[0];
    }
    $cont1++;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>REGISTRO GASTOS</title>
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
    <link href="../../plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
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
            Registro Gastos
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Procesos</a></li>
            <li class="active">Registro Gastos</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-body">
                  <div class="rows">
                    <div class="col-mx-12">
                      <form id="clientes_form" name="clientes_form" method="post">
                        <div class="row">
                            <div class="col-mx-12">
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Fecha Actual:</label>
                                  <div class="input-group">
                                    <input type="text" name="fecha_actual"  id="fecha_actual" readonly class="form-control timepicker"/>
                                    <input type="hidden" name="comprobante"  id="comprobante" readonly class="form-control" value="<?php echo $cont1 ?>"/>
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                  </div><!-- /.input group -->
                                </div><!-- /.form group -->
                              </div>

                              <div class="col-md-3">
                                <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                      <label>Hora Actual:</label>
                                      <div class="input-group">
                                        <input type="text" name="hora_actual"  id="hora_actual" readonly  class="form-control timepicker"/>
                                        <div class="input-group-addon">
                                          <i class="fa fa-clock-o"></i>
                                        </div>
                                      </div><!-- /.input group -->
                                    </div><!-- /.form group -->
                                  </div>  
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Digitad@r:</label>
                                  <input type="text" name="digitador"  id="digitador" readonly value="<?php echo $_SESSION['nombres'] ?>" class="form-control" />
                                  <input type="hidden" name="comprobante2"  id="comprobante2" readonly class="form-control">
                                </div>  
                              </div>
                            </div>
                        </div>
                        <h3 class="box-title">DETALLE GASTOS</h3>

                        <div class="row">
                         <div class="col-mx-12">
                            <div class="widget-content">
                                <div class="widget big-stats-container">
                                    <br />
                                    <div style="margin-left: 10px; height: 200px; border: solid 0px">
                                        <table id="tablaNuevo" style="width: 1000px; margin-left: 20px"  class="active table table-bordered " >
                                            <thead>
                                                <tr>
                                                    <th style="width: 150px; text-align: center"># Factura</th>
                                                    <th style="width: 100px; text-align: center">Fecha Factura</th>
                                                    <th style="width: 100px; text-align: center">Valor</th>
                                                    <th style="width: 150px; text-align: center">Cliente</th>
                                                    <th style="width: 150px; text-align: center">Descripción</th>
                                                    <th style="width: 100px; text-align: center">Valor</th>
                                                    <th style="width: 100px; text-align: center">Saldo</th>
                                                    <th style="width: 100px; text-align: center">Acumulado</th>
                                                </tr>   
                                            </thead>
                                            <tbody>
                                                <tr></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                         </div>
                        </div>
                      </form>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-mx-12">
                      <p>
                        <button class="btn bg-olive margin" id='btnBuscar'><i class="fa fa-search"></i> Buscar Factura</button>
                      </p> 
                    </div> 
                  </div>

                  <div id="ingreso_gastos" title="REGISTRAR GASTOS">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                            <label class="col-md-5">Descripción:<font color="red">*</font></label>
                            <div class="form-group col-md-7 no-padding">                                
                              <input type="text" name="descripcion"  id="descripcion"  required class="form-control" />
                            </div> 
                          </div>
                      </div>

                      <div class="col-md-12">
                          <div class="form-group">
                            <label class="col-md-5">Valor:<font color="red">*</font></label>
                            <div class="form-group col-md-7 no-padding">                                
                              <input type="text" name="valor"  id="valor"  required class="form-control" />
                            </div> 
                          </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                        <p>
                         <button class="btn btn-primary" id='btnAceptar'><i class="icon-ok"></i> Aceptar</button>
                         <button class="btn btn-primary" id='btnSalir'><i class="icon-remove-sign"></i> Cancelar</button>   
                        </p>
                    </div>
                  </div>
                </div> 

                <div id="buscar_facturas_venta" title="BUSCAR FACTURAS VENTAS">
                    <table id="list2"><tr><td></td></tr></table>
                    <div id="pager2"></div>
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
    <script src="../../dist/js/app.min.js" type="text/javascript"></script>
    <script src="../../dist/js/validCampoFranz.js" type="text/javascript" ></script>
    <script src="../../dist/js/alertify.min.js" type="text/javascript"></script>
    <script src="../../dist/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
    <script src="../../dist/js/jquery.jqGrid.src.js" type="text/javascript"></script>
    <script src="../../dist/js/grid.locale-es.js" type="text/javascript"></script>
    <script src="../../dist/js/jquery.hotkeys.js" type="text/javascript"></script>
    <script src="gastos.js" type="text/javascript"></script>
    <link href="../../dist/css/style.css" rel="stylesheet" type="text/css"/>     
    <script src="../../dist/js/ventana_reporte.js" type="text/javascript"></script>
  </body>
</html>