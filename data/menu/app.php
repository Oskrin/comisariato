<?php 

if (empty($_SESSION['id'])) {
    header('Location: ../');
}
// pie de pagina
function footer() {
	print' <footer class="main-footer">
        <strong>Copyright &copy; 2015 <a href="">P&S System</a>.</strong> Todos los derechos reservados.
      </footer>';
}
// banner o cabecera
function banner_1() {
	print'
	<header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo"><b>SISWEB</b></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs">' . $_SESSION['nombres'] . '</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../../dist/img/defaul.png" class="img-circle" alt="User Image" />
                    <p>
                      ' . $_SESSION['nombres'] . '
                    </p>
                  </li>
                                
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="../configuracion" class="btn btn-default btn-flat">Ajustes</a>
                    </div>
                    <div class="pull-right">
                      <a href="../" class="btn btn-default btn-flat">Salir</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
';
}
// menu principal lateral
function menu_lateral_1() {
print'
<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="active treeview">
              <a href="">
                <i class="fa fa-share"></i> <span>Parámetros</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <!--<li><a href=""><i class="fa fa-circle-o"></i>Empresa</a></li>-->
                <!--<li><a href=""><i class="fa fa-circle-o"></i>Privilegios</a></li>-->
                  <li>
                  <a href=""><i class="fa fa-circle-o"></i>Generales<i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <!--<li>
                      <a href=""><i class="fa fa-circle-o"></i>Facturación<i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href=""><i class="fa fa-circle-o"></i>Impuestos Ventas/Compras</a></li>
                        <li><a href=""><i class="fa fa-circle-o"></i>Retención en Impuesto</a></li>
                        <li><a href=""><i class="fa fa-circle-o"></i>Retención en Fuente</a></li>
                        <li><a href=""><i class="fa fa-circle-o"></i>Segundo Impuesto Ventas/Compras</a></li>
                      </ul>
                    </li>-->
                    <li>
                      <a href=""><i class="fa fa-circle-o"></i>Inventario<i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="../bodegas" target="_blank"><i class="fa fa-circle-o"></i>Bodegas</a></li>
                        <li><a href="../categorias" target="_blank"><i class="fa fa-circle-o"></i>Categorias</a></li>
                        <li><a href="../marcas" target="_blank"><i class="fa fa-circle-o"></i>Marcas</a></li>
                        <li><a href="../medida" target="_blank"><i class="fa fa-circle-o"></i>Unidades Productos</a></li>
                      </ul>
                    </li>
                    <!--<li>
                      <a href=""><i class="fa fa-circle-o"></i>Importar<i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href=""><i class="fa fa-circle-o"></i>Cargar Productos</a></li>
                        <li><a href=""><i class="fa fa-circle-o"></i>Cargar Plan Cuentas</a></li>
                      </ul>
                    </li>-->
                  </ul>
                </li>
                <!--<li><a href="#"><i class="fa fa-circle-o"></i>Respaldo</a></li>-->
              </ul>
            </li>

            <li class="treeview">
              <a href="">
                <i class="fa fa-laptop"></i> <span>Ingresos</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../usuarios" target="_blank"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="../proveedores" target="_blank"><i class="fa fa-circle-o"></i> Proveedores</a></li>
                <li><a href="../clientes" target="_blank"><i class="fa fa-circle-o"></i> Clientes</a></li>
                <li><a href="../productos" target="_blank"><i class="fa fa-circle-o"></i> Productos</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="">
                <i class="fa fa-files-o"></i> <span>Procesos</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../inventario" target="_blank"><i class="fa fa-circle-o"></i>Inventario</a></li>
                <li><a href="../proformas" target="_blank"><i class="fa fa-circle-o"></i> Proforma</a></li>
                <li>
                  <a href=""><i class="fa fa-circle-o"></i>Compras<i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="../factura_compra" target="_blank"><i class="fa fa-circle-o"></i>Productos Bodega</a></li>
                    <li><a href="../devolucion_compra" target="_blank"><i class="fa fa-circle-o"></i>Devolución Compra</a></li>
                  </ul>
                </li>

                <li>
                  <a href=""><i class="fa fa-circle-o"></i>Ventas<i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="../factura_venta" target="_blank"><i class="fa fa-circle-o"></i>Ventas facturación</a></li>
                    <li><a href="../notas_credito" target="_blank"><i class="fa fa-circle-o"></i>Notas de crédito</a></li>
                  </ul>
                </li>

                <li>
                  <a href=""><i class="fa fa-circle-o"></i>Cartera<i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="../cuentas_cobrar" target="_blank"><i class="fa fa-circle-o"></i>Cuentas por cobrar</a></li>
                    <li><a href="../cuentas_pagar" target="_blank"><i class="fa fa-circle-o"></i>Cuentas por pagar</a></li>
                    <li>
                      <a href=""><i class="fa fa-circle-o"></i>Externas<i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="../cxc_externa" target="_blank"><i class="fa fa-circle-o"></i>Cuentas por cobrar</a></li>
                        <li><a href="../cxp_externa" target="_blank"><i class="fa fa-circle-o"></i>Cuentas por pagar</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>

                <!--<li>
                  <a href=""><i class="fa fa-circle-o"></i>Transferencias<i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="../ingresos"><i class="fa fa-circle-o"></i>Ingresos</a></li>
                    <li><a href="../egresos"><i class="fa fa-circle-o"></i>Egresos</a></li>
                  </ul>
                </li>-->

                <li><a href="../registro_gastos" target="_blank"><i class="fa fa-circle-o"></i>Registro Gastos</a></li>
                <li><a href="../gastos" target="_blank"><i class="fa fa-circle-o"></i>Gastos Internos</a></li>
              </ul>
            </li>
            <li>
              <a href=""><i class="fa fa-circle-o"></i>Reportes<i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">                
                <li>
                  <a href=""><i class="fa fa-circle-o"></i>Productos<i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="" id="producto_general"><i class="fa fa-files-o"></i>P. en General</a></li>
                    <li><a href="" id="producto_marca_categoria"><i class="fa fa-files-o"></i>P. Categorías y Marcas</a></li>
                    <li><a href="" id="producto_existencia_minima"><i class="fa fa-files-o"></i>Existencia mínima</a></li>
                  </ul>
                </li>

                <li>
                  <a href=""><i class="fa fa-circle-o"></i>Compras<i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li>
                    <a href=""><i class="fa fa-circle-o"></i>Res. Compras Locales<i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="#" id="reporte_factura_compra"><i class="fa fa-files-o"></i>Facturas</a></li>
                        <li><a href="#" id="agrupados_proveedor"><i class="fa fa-files-o"></i>Agrupados Proveedor</a></li>                        
                        <li><a href="#" id="reporte_dev_compras"><i class="fa fa-files-o"></i>Devolución Compra</a></li>
                        <li><a href="#" id="resumenFacturas"><i class="fa fa-files-o"></i>Facturas Proveedor</a></li>
                        <li><a href="#" id="resumenFacturasCompras"><i class="fa fa-files-o"></i>Facturas Agrupadas</a></li>
                      </ul>                    
                      </li>
                  </ul>
                </li>

                <li>
                  <a href=""><i class="fa fa-circle-o"></i>Ventas<i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li>
                      <a href=""><i class="fa fa-circle-o"></i>Flujo de Caja<i class="fa fa-angle-left pull-right"></i></a>                      
                      <ul class="treeview-menu">
                        <li><a href="" id="ventaGeneralClientes"><i class="fa fa-files-o"></i>Resumen de venta general clientes</a></li>
                        <li><a href="" id="ventaGeneral"><i class="fa fa-files-o"></i>Resumen de venta general</a></li>                        
                        <li><a href="" id="diario_caja"><i class="fa fa-files-o"></i>Diario de caja</a></li>                        
                      </ul>                    
                    </li>

                    <li>
                      <a href=""><i class="fa fa-circle-o"></i>Resumen de:<i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="" id="reporte_factura_venta"><i class="fa fa-files-o"></i>Facturas y Notas</a></li>
                        <li><a href="" id="reporte_facturas_notas_anuladas"><i class="fa fa-files-o"></i>Facturas y Notas Anuladas</a></li>                        
                        <li><a href="" id="reporte_nota_credito"><i class="fa fa-files-o"></i>Notas de Crédito</a></li>
                        <li><a href="" id="reporte_general"><i class="fa fa-files-o"></i>General Notas y Facturas</a></li>
                        
                      </ul>                    
                    </li>

                    <li>
                      <a href=""><i class="fa fa-circle-o"></i>Autorizaciones<i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="" id="autorizaciones_cliente"><i class="fa fa-files-o"></i>Clientes</a></li>
                        <li><a href="" id="autorizaciones_cliente_fechas"><i class="fa fa-files-o"></i>Clientes Fechas</a></li>                        
                        <li><a href="" id="autorizaciones_cliente_caducidad"><i class="fa fa-files-o"></i>Caducidad Clientes</a></li>
                      </ul>                    
                    </li>

                    <li><a href="" id="reporte_utilidad_producto"><i class="fa fa-circle-o"></i>Utilidad de producto</a></li>
                    <li><a href="" id="reporte_utilidad_factura"><i class="fa fa-circle-o"></i>Utilidad por factura</a></li>
                    <li><a href="" id="reporte_utilidad_factura_general"><i class="fa fa-circle-o"></i>utilidad General Facturas</a></li>
                    <li><a href="" id="buscar_serie"><i class="fa fa-circle-o"></i>Números de Serie</a></li>
                  </ul>
                </li>

                <li>
                  <a href=""><i class="fa fa-circle-o"></i>Cartera<i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li>
                      <a href=""><i class="fa fa-circle-o"></i>Cuentas por cobrar<i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="" id="facturas_canceladas"><i class="fa fa-files-o"></i>Facturas Canceladas</a></li>
                        <li><a href="" id="facturas_cobrar_clientes"><i class="fa fa-files-o"></i>Facturas por cobrar</a></li>                        
                        <li><a href="" id="cobros_realizados"><i class="fa fa-files-o"></i>Cobros realizados</a></li>                        
                      </ul>     
                    </li>

                    <li>
                      <a href=""><i class="fa fa-circle-o"></i>Cuentas por pagar<i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="" id="facturas_canceladas_proveedor"><i class="fa fa-files-o"></i>Facturas Canceladas</a></li>
                        <li><a href="" id="facturas_pagar_proveedor"><i class="fa fa-files-o"></i>Facturas por pagar</a></li>                        
                        <li><a href="" id="pagos_realizados"><i class="fa fa-files-o"></i>Pagos realizados</a></li>                                                
                      </ul>     
                    </li>
                  </ul>
                </li>

                <li>
                  <a href=""><i class="fa fa-circle-o"></i>Gastos<i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="" id="gastos"><i class="fa fa-circle-o"></i>Gastos por factura</a></li>
                    <li><a href="" id="gastos_general"><i class="fa fa-circle-o"></i>Gastos Generales</a></li>
                    <li><a href="" id="gastos_internos"><i class="fa fa-circle-o"></i>Gastos Internos Fechas</a></li>
                  </ul>
                </li>
              </ul>
            </li>

            <!--<li class="header">Otros.</li>
            <li><a href=""><i class="fa fa-circle-o text-danger"></i> Important</a></li>
            <li><a href=""><i class="fa fa-circle-o text-warning"></i> Warning</a></li>
            <li><a href=""><i class="fa fa-circle-o text-info"></i> Information</a></li>-->
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

	';
}
?>