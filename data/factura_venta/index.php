<?php 
session_start();
include '../../procesos/base.php';
include('../menu/app.php'); 
conectarse();
error_reporting(0);

$consulta = pg_query("select num_factura from factura_venta");
while ($row = pg_fetch_row($consulta)) {
    $num_factura = $row[0];
}

$cont1 = 0;
$consulta2 = pg_query("select max(id_factura_venta) from factura_venta");
while ($row = pg_fetch_row($consulta2)) {
    $cont1 = $row[0];
}
$cont1++;

$consulta3 = pg_query("select * from clientes order by id_cliente desc");
while ($row = pg_fetch_row($consulta3)) {
    $campo_id_cliente = $row[0];
    $campo_identificacion_cliente = $row[2];
    $campo_nombre_cliente = $row[3];
    $campo_direccion_cliente = $row[5];

} 



?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>FACTURA VENTA</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <link href="../../font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        
    <link href="../../plugins/icon/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <link href="../../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="../../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    
    <link href="../../plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <link href="../../dist/css/alertify.core.css" rel="stylesheet" />
    <link href="../../dist/css/alertify.default.css" id="toggleCSS" rel="stylesheet" />
    <link href="../../dist/css/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css"/>            
    <link href="../../dist/css/ui.jqgrid.css" rel="stylesheet" type="text/css"/> 
    <link href="../../plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
  </head>
  
  <body class="skin-blue">
    <div class="wrapper">
      <?php banner_1(); ?>
      <?php menu_lateral_1(); ?>
      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            FACTURA VENTA
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Procesos</a></li>
            <li class="active">Factura Venta</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Generales</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Adicionales</a></li>
                </ul>
                <div class="box-body">
                  <div class="row">
                    <form id="productos_form" name="productos_form" method="post">
                      <div class="tab-content">
                        <div class="tab-pane active" id="tab_1"> 
                          <div class="row">                       
                            <div class="col-md-12"> 
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Fecha Actual:</label>
                                  <div class="input-group">
                                    <input type="text" name="fecha_actual"  id="fecha_actual" readonly class="form-control"/>
                                    <input type="hidden" name="comprobante"  id="comprobante" readonly class="form-control" value="<?php echo $cont1 ?>"/>
                                    <input type="hidden" name="proforma"  id="proforma" readonly class="form-control"/>
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
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="col-md-7" >Nro de Factura Preimpresa:     001-001 </label>
                                <div class="form-group col-md-5 no-padding">                                
                                  <input type="text" name="num_factura"  id="num_factura" required class="form-control" />
                                  <input type="hidden" name="num_oculto"  id="num_oculto" required class="form-control" value="<?php echo $num_factura ?>" />
                                </div> 
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="form-group">
                                <label class="col-md-5">Tipo de Venta:</label>
                                <div class="form-group col-md-7 no-padding">                                
                                  <select class="form-control" name="tipo_venta" id="tipo_venta">
                                    <option value="FACTURA" selected>FACTURA</option>
                                    <option value="NOTA">NOTA VENTA</option>
                                  </select>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-2">
                              <!-- <div class="form-group"> -->
                                <div id="estado" style="margin-top: -10px"><h3></h3></div>  
                              <!-- </div> -->
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-5">
                              <div class="form-group">
                                <label class="col-md-5">Identicación/RUC: <font color="red">*</font></label>
                                <div class="form-group col-md-7 no-padding">                                
                                  <input type="text" name="ruc_ci"  id="ruc_ci" placeholder="Buscar....." required class="form-control" value="<?php echo $campo_identificacion_cliente ?>"  />
                                  <input type="hidden" name="id_cliente"  id="id_cliente" placeholder="Buscar....." required class="form-control" value="<?php echo $campo_id_cliente ?>" />
                                </div> 
                              </div>
                            </div>

                            <div class="col-md-7">
                              <div class="form-group">
                                <label class="col-md-4" >Nombres Completos:</label>
                                <div class="form-group col-md-8 no-padding">                                
                                  <input type="text" name="nombre_cliente"  id="nombre_cliente" required class="form-control" value="<?php echo $campo_nombre_cliente ?>"  />
                                </div> 
                              </div>
                            </div>

                            <div class="col-md-5">
                              <div class="form-group">
                                <label class="col-md-4" >Dirección: <font color="red">*</font></label>
                                <div class="form-group col-md-8 no-padding">                                
                                  <input type="text" name="direccion_cliente"  id="direccion_cliente" required class="form-control" value="<?php echo $campo_direccion_cliente ?>"  />
                                </div> 
                              </div>  
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label class="col-md-4">Teléfono:</label>
                                <div class="form-group col-md-8 no-padding">                                
                                  <input type="text" name="telefono_cliente"  id="telefono_cliente" required class="form-control" />
                                </div> 
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="form-group">
                                <label class="col-md-3">Correo:</label>
                                <div class="form-group col-md-9 no-padding">                                
                                  <input type="text" name="correo"  id="correo" required class="form-control" />
                                </div> 
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="form-group">
                                <label class="col-md-5">Autorización:</label>
                                <div class="form-group col-md-7 no-padding">                                
                                  <input type="text" name="autorizacion"  id="autorizacion" required class="form-control" />
                                </div> 
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="form-group">
                                <label class="col-md-5">Fecha autorización:</label>
                                <div class="form-group col-md-7 no-padding">                                
                                  <input type="text" name="fecha_auto"  id="fecha_auto" readonly required class="form-control" />
                                </div> 
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="form-group">
                                <label class="col-md-5">Fecha caducidad:</label>
                                <div class="form-group col-md-7 no-padding">                                
                                  <input type="text" name="fecha_caducidad"  id="fecha_caducidad" readonly required class="form-control" />
                                </div>
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="form-group">
                                <label class="col-md-5">Fecha Cancelación:</label>
                                <div class="form-group col-md-7 no-padding">                                
                                  <input type="text" name="cancelacion"  id="cancelacion" readonly required class="form-control" />
                                </div> 
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="form-group">
                                <label class="col-md-5">Tipo de Precio:</label>
                                <div class="form-group col-md-7 no-padding">                                
                                  <select class="form-control" name="tipo_precio" id="tipo_precio">
                                    <option value="MINORISTA">MINORISTA</option>
                                    <option value="MAYORISTA">MAYORISTA</option>
                                  </select>
                                </div> 
                              </div>
                            </div>

                            <div class="col-md-4">
                              <div class="form-group">
                                <label class="col-md-5">Formas de Pago:</label>
                                <div class="form-group col-md-7 no-padding">                                
                                  <select class="form-control" name="formas" id="formas">
                                    <option value="Contado">Contado</option>
                                    <option value="Credito">Crédito</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>  
                        </div>

                        <hr />
                        <h3 class="box-title" style="margin-left: 15px">Detalle Factura</h3>
                        
                        <div class="row">
                         <div class="col-md-12">
                            <div class="col-md-2">
                              <div class="form-group">
                                <label>CÓDIGO BARRAS</label>
                                <input type="text" name="codigo_barras"  id="codigo_barras" placeholder="Buscar..." class="form-control" />
                              </div>  
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>CÓDIGO</label>
                                <input type="text" name="codigo"  id="codigo" placeholder="Buscar..." class="form-control" />
                              </div>  
                            </div>

                            <div class="col-md-4">
                              <div class="form-group">
                                <label>PRODUCTO</label>
                                <input type="text" name="producto"  id="producto" placeholder="Buscar..." class="form-control" />
                              </div>  
                            </div>

                            <div class="col-md-1">
                              <div class="form-group">
                                <label>CANTIDAD</label>
                                <input type="text" name="cantidad"  id="cantidad" class="form-control" />
                              </div>
                            </div>

                            <div class="col-md-1">
                              <div class="form-group">
                                <label>PRECIO</label>
                                <input type="text" name="p_venta"  id="p_venta" class="form-control" />
                              </div> 
                            </div>

                            <div class="col-md-1">
                              <div class="form-group">
                                <label>DESC.</label>
                                <input type="number" name="descuento" id="descuento"  min="0" placeholder="%" class="form-control" />
                                <input type="hidden" name="disponibles"  id="disponibles" readonly class="form-control" />
                                <input type="hidden" name="iva_producto"  id="iva_producto" readonly class="form-control" />
                                <input type="hidden" name="carga_series"  id="carga_series" readonly class="form-control" />
                                <input type="hidden" name="cod_producto"  id="cod_producto" readonly class="form-control" />
                                <input type="hidden" name="des"  id="des" readonly class="form-control" />
                                <input type="hidden" name="incluye"  id="incluye" readonly class="form-control" />
                                <input type="hidden" name="inventar"  id="inventar" readonly class="form-control" />
                              </div>  
                            </div> 
                         </div>
                        </div>

                        <!-- <div class="row"> -->
                         <div class="col-md-12">
                            <div id="grid_container">
                                <table id="list"></table>
                                <!--<div id="pager"></div>-->   
                            </div>
                         </div>   
                        <!-- </div> -->

                        <div class="row">
                         <div class="col-md-12">
                            <div class="col-md-9">
                              
                            </div>
                            <!-- <div class="col-md-2"></div> -->
                            <div class="col-md-3">
                              <div class="form-group">
                                <label class="col-md-5" >Tarifa 0:</label>
                                <div class="form-group col-md-7 no-padding">
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="glyphicon glyphicon-usd"></i>
                                    </div>
                                    <input type="text" name="total_p" id="total_p" value="0.000" readonly class="form-control"/>
                                  </div>                                
                                </div> 
                              </div>

                              <div class="form-group">
                                <label class="col-md-5" >Tarifa 12:</label>
                                <div class="form-group col-md-7 no-padding">
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="glyphicon glyphicon-usd"></i>
                                    </div>
                                    <input type="text" name="total_p2" id="total_p2" value="0.000" readonly class="form-control"/>
                                  </div>                                
                                </div> 
                              </div>

                              <div class="form-group">
                                <label class="col-md-5" >12 %Iva:</label>
                                <div class="form-group col-md-7 no-padding">
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="glyphicon glyphicon-usd"></i>
                                    </div>
                                    <input type="text" name="iva" id="iva" value="0.000" readonly class="form-control"/>
                                  </div>                                
                                </div> 
                              </div>

                              <div class="form-group">
                                <label class="col-md-5" >Descuento:</label>
                                <div class="form-group col-md-7 no-padding">
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="glyphicon glyphicon-usd"></i>
                                    </div>
                                    <input type="text" name="desc" id="desc" value="0.000" readonly class="form-control"/>
                                  </div>                                
                                </div> 
                              </div> 

                              <div class="form-group">
                                <label class="col-md-5" >Total:</label>
                                <div class="form-group col-md-7 no-padding">
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="glyphicon glyphicon-usd"></i>
                                    </div>
                                    <input type="text" name="tot" id="tot" value="0.000" readonly class="form-control"/>
                                  </div>                                
                                </div> 
                              </div>
                            </div>
                         </div>   
                        </div>
                        </div><!-- /.tab-pane -->

                        <div class="tab-pane" id="tab_2" style="height: 854px">  
                        <div class="row">
                          <div class="col-md-12"> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label class="col-md-4">Adelanto:</label>
                                <div class="form-group col-md-7 no-padding">
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="glyphicon glyphicon-usd"></i>
                                    </div>
                                    <input type="text" name="adelanto" id="adelanto" placeholder="0.00" class="form-control"/>
                                  </div>                                
                                </div> 
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label class="col-md-4">Meses:</label>
                                <div class="form-group col-md-8 no-padding">                                
                                  <input type="number" name="meses"  id="meses" required min="1" max="3" class="form-control" />
                                </div> 
                              </div>
                            </div>
                           </div>
                          </div>

                          <div class="row"> 
                            <div class="col-md-12">
                            <div class="col-md-5">
                             <div style="margin-left: 10px; height: 200px; border: solid 0px">
                                <table id="tablaNuevo" style="width: 400px; margin-left: 20px"  class="table table-striped table-bordered"  >
                                    <thead>
                                        <tr>
                                            <th style="width: 200px; text-align: center">Fecha de Pagos</th>
                                            <th style="width: 200px; text-align: center">Montos a Pagar</th>
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
                        </div><!-- /.tab-pane -->
                      </div><!-- /.tab-content -->
                   </form>
                  </div>  
                  <div class="row">
                   <div class="col-mx-12">
                    <p>
                      <button class="btn bg-olive margin" id='btnGuardar'><i class="fa fa-save"></i> Guardar</button>
                      <button class="btn bg-olive margin" id='btnModificar'><i class="fa fa-edit"></i> Modificar</button>
                      <button class="btn bg-olive margin" id='btnBuscar'><i class="fa fa-search"></i> Buscar</button>
                      <button class="btn bg-olive margin" id='btnNuevo'><i class="fa fa-pencil"></i> Nuevo</button>
                      <button class="btn bg-olive margin" id='btnAnular'><i class="fa fa-remove"></i> Anular</button>
                      <button class="btn bg-olive margin" id='btnImprimir'><i class="fa fa-print"></i> Imprimir</button>
                      <button class="btn bg-olive margin" id='btnProforma'>Proformas</button>
                      <button class="btn bg-olive margin" id='btnAtras'><i class="fa fa-backward"></i> Atras</button>
                      <button class="btn bg-olive margin" id='btnAdelante'>Adelante <i class="fa fa-forward"></i></button>
                    </p> 
                   </div>                           
                  </div>
                </div>

                <div id="series" title="AGREGAR SERIES">
                    <table cellpadding="2" border="0" style="margin-left: 10px">
                        <tr>
                            <td><label>Series: <font color="red">*</font></label></td>
                            <td><div class="ui-widget"><select name="combobox" id="combobox" class="campo">
                                        <option value=""></option>
                                    </select> </div></td>
                            <td><button class="btn btn-primary" id='btnAgregar' style="margin-top: -5px; margin-left: 50px"><i class="icon-list"></i> Agregar</button></td>
                        </tr>
                    </table>
                    <hr style="color: #0056b2;" /> 
                    <div align="center">
                        <table id="list3"><tr><td></td></tr></table>
                        <div class="form-actions">
                            <button class="btn btn-primary" id='btnGuardarSeries'><i class="icon-save"></i> Guardar</button>
                            <button class="btn btn-primary" id='btnCancelarSeries'><i class="icon-remove-sign"></i> Cancelar</button>
                        </div>
                    </div>
                </div>

                <div id="tipo_busqueda" title="TIPO BUSQUEDA">
                  <table cellpadding="2" border="0" style="margin-left: 10px">
                    <tr>
                      <td><label>Buscar por:</label></td>
                      <td><select id="tipo_venta_busqueda" name="tipo_venta_busqueda" style="width: 180px">
                        <option value="FACTURA">FACTURA</option>
                        <option value="NOTA">NOTA VENTA</option>
                      </select></td>
                    </tr> 
                  </table> 
                  <br />
                  <button class="btn btn-primary" id='btnTipoBuscar'><i class="icon-ok"></i> Buscar</button>
                </div>

                <div id="buscar_facturas_venta" title="BUSCAR FACTURAS VENTAS">
                    <table id="list2"><tr><td></td></tr></table>
                    <div id="pager2"></div>
                </div>

                <div id="buscar_notas_venta" title="BUSCAR NOTAS VENTAS">
                  <table id="list5"><tr><td></td></tr></table>
                  <div id="pager5"></div>
                </div>

                <div id="clave_permiso" title="PERMISOS">
                  <div class="row">
                    <div class="form-group">
                    <label class="col-md-6" >Ingese la clave de seguridad</label>
                    <div class="form-group col-md-6 no-padding">                                
                      <input type="password" name="clave"  id="clave" required class="form-control" />
                    </div> 
                  </div>  
                  </div>

                  <div class="form-actions" align="center">
                     <button class="btn btn-primary" id='btnAcceder'><i class="icon-ok"></i> Acceder</button>
                     <button class="btn btn-primary" id='btnCancelar'><i class="icon-remove-sign"></i> Cancelar</button>
                  </div>
                </div> 

                <div id="seguro">
                 <label>Esta seguro de Anular la factura</label>  
                 <br />
                 <div class="form-actions" align="center">
                    <button class="btn btn-primary" id='btnAceptar'><i class="icon-ok"></i> Aceptar</button>
                    <button class="btn btn-primary" id='btnSalir'><i class="icon-remove-sign"></i> Cancelar</button>
                 </div>
                </div>

                <div id="buscar_proformas" title="BUSCAR PROFORMAS">
                    <table id="list4"><tr><td></td></tr></table>
                    <div id="pager4"></div>
                </div>


              </div><!-- nav-tabs-custom -->
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
    <script src='../../plugins/fastclick/fastclick.min.js'></script>
    <script src="../../dist/js/app.min.js" type="text/javascript"></script>
    <script src="../../dist/js/validCampoFranz.js" type="text/javascript" ></script>
    <script src="../../dist/js/alertify.min.js" type="text/javascript"></script>
    <script src="../../dist/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
    <script src="../../dist/js/jquery.jqGrid.src.js" type="text/javascript"></script>
    <script src="../../dist/js/grid.locale-es.js" type="text/javascript"></script>
    <script src="../../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script src="factura_venta.js" type="text/javascript"></script>
    <link href="../../dist/css/style.css" rel="stylesheet" type="text/css"/>     
    <script src="../../dist/js/ventana_reporte.js" type="text/javascript"></script>
  </body>
</html>