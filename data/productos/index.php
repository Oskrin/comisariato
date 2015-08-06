<?php 
session_start();
include '../../procesos/base.php';
include('../menu/app.php'); 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>PRODUCTOS</title>
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
            Registro Productos
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Ingresos</a></li>
            <li class="active">Productos</li>
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
                            <div class="col-mx-12"> 
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Código Producto: <font color="red">*</font></label>
                                  <input type="text" name="cod_prod"  id="cod_prod" placeholder="El código debe ser único" class="form-control" />
                                  <input type="hidden" name="cod_productos"  id="cod_productos" readonly class="form-control">
                                </div>

                                <div class="form-group">
                                  <label>Nombre Artículo: <font color="red">*</font></label>
                                  <input type="text" name="nombre_art" id="nombre_art" placeholder="Usb 0000x" class="form-control" />
                                </div>

                                <div class="form-group">
                                  <label>PVP Minorista: <font color="red">*</font></label>
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-usd"></i>
                                    </div>
                                    <input type="text" name="precio_minorista" id="precio_minorista" placeholder="0.00" class="form-control"/>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label>Utilidad Minorista:</label>
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-usd"></i>
                                    </div>
                                    <input type="text" name="utilidad_minorista" id="utilidad_minorista" class="form-control" />
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label>Categoria:</label>
                                  <select class="form-control" name="categoria" id="categoria">
                                    <option value="">........Seleccione........</option>
                                    <?php
                                    $consulta = pg_query("select * from categoria ");
                                    while ($row = pg_fetch_row($consulta)) {
                                        echo "<option id=$row[0] value=$row[1]>$row[1]</option>";
                                    }
                                    ?>     
                                  </select>
                                </div>

                                <div class="form-group">
                                  <label>Descuento:</label>
                                  <input type="number" name="descuento" id="descuento" value="0" min="0" class="form-control" />
                                </div>

                                <div class="form-group">
                                  <label>Observaciones:</label>
                                  <textarea class="form-control" name="aplicacion" id="aplicacion" rows="3"></textarea>
                                </div>
                              </div>

                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Código Barras:</label>
                                  <input type="text" name="cod_barras" id="cod_barras" required placeholder="El código debe ser único" class="form-control" />
                                </div>

                                <div class="form-group">
                                  <label>Precio Compra: <font color="red">*</font></label>
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-usd"></i>
                                    </div>
                                    <input type="text" name="precio_compra" id="precio_compra"   placeholder="0.00" class="form-control" />
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label>PVP Mayorista: <font color="red">*</font></label>
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-usd"></i>
                                    </div>
                                    <input type="text" name="precio_mayorista" id="precio_mayorista" class="form-control" placeholder="0.00" />
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label>Utilidad Mayorista:</label>
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-usd"></i>
                                    </div>
                                    <input type="text" name="utilidad_mayorista" id="utilidad_mayorista" class="form-control" />
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label>Marca:</label>
                                  <select class="form-control" name="marca" id="marca">
                                    <option value="">........Seleccione........</option>
                                    <?php
                                    $consulta2 = pg_query("select * from marcas ");
                                    while ($row = pg_fetch_row($consulta2)) {
                                        echo "<option id=$row[0] value=$row[1]>$row[1]</option>";
                                    }
                                    ?>     
                                  </select>
                                </div>

                                <div class="form-group">
                                  <label>Stock:</label>
                                  <input type="number" name="stock" id="stock"  value="0" min="0" class="form-control"/>
                                </div>

                                <div class="form-group">
                                  <label>Caracteristicas:</label>
                                  <input type="text" name="modelo" id="modelo" placeholder="Ingrese las caracteristicas" class="form-control"/>
                                </div>
                              </div>

                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Stock Mínimo:<font color="red">*</font></label>
                                  <input type="number" name="minimo" id="minimo" value="1" class="form-control" min="0" />
                                </div>

                                <div class="form-group">
                                  <label>Stock Máximo: <font color="red">*</font></label>
                                  <input type="number" name="maximo" id="maximo"  value="1" min="0" class="form-control"/>
                                </div>

                                <div class="form-group">
                                  <label>Fecha Creación:<font color="red">*</font></label>
                                  <input type="text" name="fecha_creacion" id="fecha_creacion" class="form-control" readonly />
                                </div>

                                <div class="form-group">
                                  <label> Contiene Iva:</label>
                                  <select class="form-control" name="iva" id="iva">
                                    <option value="Si" selected>Si</option> 
                                    <option value="No">No</option>     
                                  </select>
                                </div>

                                <div class="form-group" style="display: none">
                                  <label>Series:</label>
                                  <select class="form-control" name="series" id="series">
                                    <option value="Si">Si</option> 
                                    <option value="No" selected>No</option>     
                                  </select>
                                </div>

                                <div class="form-group">
                                  <label>Incluye Iva:</label>
                                  <select class="form-control" name="incluye" id="incluye">
                                    <option value="Si" selected>Si</option> 
                                    <option value="No">No</option>     
                                  </select>
                                </div>

                                <div class="form-group">
                                  <label>Inventariable:</label>
                                  <select class="form-control" name="inventario" id="inventario">
                                    <option value="Si" selected>Si</option> 
                                    <option value="No">No</option>     
                                  </select>
                                </div>

                                <div class="form-group">
                                  <label>Bodegas: <font color="red">*</font></label>
                                  <select class="form-control" name="bodegas" id="bodegas">
                                    <?php
                                    $consulta = pg_query("select * from bodegas order by id_bodega asc");
                                    while ($row = pg_fetch_row($consulta)) {
                                        echo "<option id=$row[0] value=$row[0]>$row[1]</option>";
                                    }
                                    ?>     
                                  </select>
                                </div>
                              </div>
                            </div>
                        </div><!-- /.tab-pane -->

                        <div class="tab-pane" id="tab_2" style="height: 854px">  
                          <div class="col-mx-12"> 
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="archivo">Imagen</label>
                                  <input type="file" name="archivo" id="archivo" onchange='Test.UpdatePreview(this)' accept="image/*">
                                </div>

                                <div class="form-group">
                                  <div style="width: 200px; height: 250px; align="center" " title="LOGO">
                                      <img id="foto" name="foto" style="width: 100%; height: 100%"  />
                                  </div> 
                                </div>
                              </div>

                              <div class="col-md-6" >
                               
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
                      <button class="btn bg-olive margin" id='btnEliminar'><i class="fa fa-remove"></i> Eliminar</button>
                      <button class="btn bg-olive margin" id='btnBuscar'><i class="fa fa-search"></i> Buscar</button>
                      <button class="btn bg-olive margin" id='btnNuevo'><i class="fa fa-pencil"></i> Nuevo</button>
                    </p> 
                   </div>                           
                  </div>
                </div>
                <div id="productos" title="Búsqueda de Productos" class="">
                    <table id="list"><tr><td></td></tr></table>
                    <div id="pager"></div>
                </div>

                <div id="cuentas" title="Búsqueda Plan de Cuentas" class="">
                    <table id="list2"><tr><td></td></tr></table>
                    <div id="pager2"></div>
                </div>

                <div id="categorias" title="AGREGAR CATEGORIA">
                    <div class="control-group">
                        <label class="control-label" for="nombre_categoria">Nombre Categoria: <font color="red">*</font></label>
                        <div class="controls" >
                            <input type="text" name="nombre_categoria" id="nombre_categoria" class="campo" placeholder="Categoria" required/>
                        </div>  
                    </div>  
                    <button class="btn btn-primary" id='btnGuardarCategoria'>Guardar</button>
                </div>

                <div id="marcas" title="AGREGAR MARCA">
                    <div class="control-group">
                        <label class="control-label" for="nombre_marca">Nombre Marca: <font color="red">*</font></label>
                        <div class="controls" >
                            <input type="text" name="nombre_marca" id="nombre_marca" class="campo" placeholder="Ingrese la Marca" required />
                        </div>  
                    </div>  
                    <button class="btn btn-primary" id='btnGuardarMarca'>Guardar</button>
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
                    <label>Esta seguro de eliminar al producto</label>  
                    <br />
                    <button class="btn btn-primary" id='btnAceptar'><i class="icon-ok"></i> Aceptar</button>
                    <button class="btn btn-primary" id='btnSalir'><i class="icon-remove-sign"></i> Cancelar</button>
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
    <script src="productos.js" type="text/javascript"></script>
    <link href="../../dist/css/style.css" rel="stylesheet" type="text/css"/>     
    <script src="../../dist/js/ventana_reporte.js" type="text/javascript"></script>
   
  </body>

</html>