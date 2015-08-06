<?php
session_start();
include '../../procesos/base.php';
include('../menu/app.php'); 
conectarse();
error_reporting(0);

$cont1 = 0;
    $consulta = pg_query("select max(id_c_pagarexternas) from c_pagarexternas");
    while ($row = pg_fetch_row($consulta)) {
        $cont1 = $row[0];
    }
    $cont1++;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>CUENTAS PAGAR</title>
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
            CUENTAS PAGAR
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Procesos</a></li>
            <li class="active">Cuentas Pagar Externas</li>
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
                        <br />
                        <div class="row">
                          <div class="col-md-12"> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label class="col-md-5" >Proveedor: <font color="red">*</font></label>
                                <div class="form-group col-md-7 no-padding">                                
                                  <select class="form-control" name="tipo_docu" id="tipo_docu">
                                    <option value="">......Seleccione......</option>
                                    <option value="Cedula">Cedula</option>
                                    <option value="Ruc">Ruc</option>
                                    <option value="Pasaporte">Pasaporte</option>
                                  </select>
                                  <input type="hidden" name="id_proveedor"  id="id_proveedor" required class="form-control" />
                                </div> 
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="form-group">
                                <label class="col-md-5" >Identificación: <font color="red">*</font></label>
                                <div class="form-group col-md-7 no-padding">                                
                                  <input type="text" name="ruc_ci"  id="ruc_ci" required placeholder="Buscar....." class="form-control" />
                                </div> 
                              </div>  
                            </div>

                            <div class="col-md-4">
                              <div class="form-group">
                                <div class="form-group ">                                
                                  <input type="text" name="empresa"  id="empresa" required class="form-control" />
                                </div>  
                              </div>  
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="col-md-3">Nro. de serie: <font color="red">*</font></label>
                                <div class="form-group col-md-9 no-padding">
                                  <input type="text" name="num_factura"  id="num_factura" required data-inputmask='"mask": "999-999-999999999"' data-mask class="form-control" />                               
                                </div> 
                              </div> 

                              <div class="form-group">
                                <label class="col-md-3">Total:<font color="red">*</font></label>
                                    <div class="form-group col-md-9 no-padding">
                                      <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-money"></i>
                                    </div>
                                    <input type="text" name="total" id="total" placeholder="0.00" class="form-control"/>
                                  </div>
                                </div> 
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="col-md-4" >Tipo de comprobante:<font color="red">*</font></label>
                                <div class="form-group col-md-8 no-padding">                                
                                  <select class="form-control" name="tipo_documento" id="tipo_documento">
                                    <option value="">........Seleccione........</option>
                                    <?php
                                    $consulta = pg_query("select * from tipo_comprobante ");
                                    while ($row = pg_fetch_row($consulta)) {
                                        echo "<option id=$row[0] value=$row[0]>$row[1] $row[2]</option>";
                                    }
                                    ?>
                                  </select>
                                </div> 
                              </div> 
                            </div>
                          </div>  
                        </div>
                      </form>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <p>
                        <button class="btn bg-olive margin" id='btnGuardar'><i class="fa fa-save"></i> Guardar</button>
                        <button class="btn bg-olive margin" id='btnModificar'><i class="fa fa-edit"></i> Modificar</button>
                        <button class="btn bg-olive margin" id='btnBuscar'><i class="fa fa-search"></i> Buscar</button>
                        <button class="btn bg-olive margin" id='btnNuevo'><i class="fa fa-pencil"></i> Nuevo</button>
                        <button class="btn bg-olive margin" id='btnImprimir'><i class="fa fa-print"></i> Imprimir</button>
                        <button class="btn bg-olive margin" id='btnAtras'><i class="fa fa-backward"></i> Atras</button>
                        <button class="btn bg-olive margin" id='btnAdelante'>Adelante <i class="fa fa-forward"></i></button>
                      </p> 
                    </div>
                  </div>

                  <div id="buscar_cartera_pagar" title="BUSCAR CARTERA POR PAGAR">
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
    <script src="cxpexternas.js" type="text/javascript"></script>
    <link href="../../dist/css/style.css" rel="stylesheet" type="text/css"/>     
    <script src="../../dist/js/ventana_reporte.js" type="text/javascript"></script>
  </body>
</html>