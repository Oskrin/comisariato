<?php
    require('../fpdf/fpdf.php');
    include '../procesos/base.php';
    include '../procesos/funciones.php';
    conectarse();    
    date_default_timezone_set('America/Guayaquil'); 
    session_start()   ;
    class PDF extends FPDF{   
        var $widths;
        var $aligns;       
        function SetWidths($w){            
            $this->widths=$w;
        }                       
        function Header(){                         
            $this->AddFont('Amble-Regular','','Amble-Regular.php');
            $this->SetFont('Amble-Regular','',10);        
            $fecha = date('Y-m-d', time());
            $this->SetX(1);
            $this->SetY(1);
            $this->Cell(20, 5, $fecha, 0,0, 'C', 0);                         
            $this->Cell(150, 5, "CLIENTE", 0,1, 'R', 0);      
            $this->SetFont('Arial','B',16);                                                    
            $this->Cell(190, 8, $_SESSION['empresa'], 0,1, 'C',0);                                
            $this->Image('../images/logo_empresa.jpg',5,8,35,30);
            $this->SetFont('Amble-Regular','',10);        
            $this->Cell(180, 5, "PROPIETARIO: ".utf8_decode($_SESSION['propietario']),0,1, 'C',0);                                
            $this->Cell(80, 5, "TEL.: ".utf8_decode($_SESSION['telefono']),0,0, 'R',0);                                
            $this->Cell(80, 5, "CEL.: ".utf8_decode($_SESSION['celular']),0,1, 'C',0);                                
            $this->Cell(180, 5, "DIR.: ".utf8_decode($_SESSION['direccion']),0,1, 'C',0);                                
            $this->Cell(180, 5, "SLOGAN.: ".utf8_decode($_SESSION['slogan']),0,1, 'C',0);                                
            $this->Cell(180, 5, utf8_decode( $_SESSION['pais_ciudad']),0,1, 'C',0);                                                                                                    
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(0.4);            
            $this->Line(1,46,210,46);            
            $this->SetFont('Arial','B',12);                                                                            
            $this->Cell(190, 5, utf8_decode("CONSULTA DE LA SERIE ".$_GET['id']),0,1, 'C',0);                                                                                                                            
            $this->SetFont('Amble-Regular','',10);        
            $this->Ln(3);
            $this->SetFillColor(255,255,225);            
            $this->SetLineWidth(0.2);                                        
        }
        function Footer(){            
            $this->SetY(-15);            
            $this->SetFont('Arial','I',8);            
            $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'C');
        }               
    }
    $pdf = new PDF('P','mm','a4');
    $pdf->AddPage();
    $pdf->SetMargins(0,0,0,0);
    $pdf->AliasNbPages();
    $pdf->AddFont('Amble-Regular','','Amble-Regular.php');
    $pdf->SetFont('Amble-Regular','',10);       
    $pdf->SetFont('Arial','B',9);   
    $pdf->SetX(5);    
    $pdf->SetFont('Amble-Regular','',9); 
    
    $pdf->SetX(1);                                                
    $id_serie=0;
    $id_producto=0;
    $id_factura_venta=0;
    $id_factura_compra=0;
    $ci_cliente=0;
    $nombre_cliente="";
    $fecha_venta=0;
    $num_fac_venta=0;
    $ci_proveedor=0;
    $proveedor="";
    $fecha_compra=0;
    $num_fac_compra=0;
    $codigo_prod=0;
    $descripcion=0;
    $precio_venta=0;
    $precio_compra=0;
    $sql=pg_query("select * from serie_venta where serie='$_GET[id]'");
    while($row=pg_fetch_row($sql)){
        $id_serie=$row[0];
        $id_producto=$row[1];
        $id_factura_venta=$row[2];
    }
    $sql=pg_query("select * from series_compra where serie='$_GET[id]'");
    while($row=pg_fetch_row($sql)){
        $id_factura_compra=$row[2];
    }
    $sql=pg_query("select * from factura_venta,clientes where factura_venta.id_cliente=clientes.id_cliente and id_factura_venta='$id_factura_venta'");
    while($row=pg_fetch_row($sql)){
        $ci_cliente=$row[23];
        $nombre_cliente=$row[24];
        $fecha_venta=$row[6];
        $num_fac_venta=$row[5];
    }
    $sql=pg_query("select * from detalle_factura_venta,productos where  detalle_factura_venta.cod_productos=productos.cod_productos and id_factura_venta='$id_factura_venta' and productos.cod_productos='$id_producto'");
    while($row=pg_fetch_row($sql)){
        $codigo_prod=$row[10];
        $descripcion=$row[12];
        $precio_venta=$row[4];
    }

    $sql=pg_query("select * from factura_compra,proveedores where factura_compra.id_proveedor=proveedores.id_proveedor and id_factura_compra='$id_factura_compra'");
    while($row=pg_fetch_row($sql)){
        $ci_proveedor=$row[23];
        $proveedor=$row[24];
        $fecha_compra=$row[5];
        $num_fac_compra=$row[11];
    }
    $sql=pg_query("select * from detalle_factura_compra,productos where detalle_factura_compra.cod_productos=productos.cod_productos and id_factura_compra='$id_factura_compra' and productos.cod_productos='$id_producto'");
    while($row=pg_fetch_row($sql)){
        $precio_compra=$row[4];
    }
    $pdf->SetFillColor(216, 216, 231);                
    $pdf->Cell(100, 8, utf8_decode("RUC/CI:: ".$ci_cliente),1,0, 'L',true);    
    $pdf->Cell(105, 8, utf8_decode("CLIENTE: ".$nombre_cliente),1,1, 'L',true);                                                       
    $pdf->Ln(2);
    $pdf->SetX(1);
    $pdf->Cell(30, 6, utf8_decode('Nro. Factura'),1,0, 'C',0);                                         
    $pdf->Cell(25, 6, utf8_decode('F. Venta'),1,0, 'C',0);                                     
    $pdf->Cell(20, 6, utf8_decode('P. Venta'),1,0, 'C',0);                                     
    $pdf->Cell(40, 6, utf8_decode('Producto'),1,0, 'C',0);                                     
    $pdf->Cell(20, 6, utf8_decode('N. Compra'),1,0, 'C',0);                                     
    $pdf->Cell(20, 6, utf8_decode('F. Compra'),1,0, 'C',0);                                                     
    $pdf->Cell(30, 6, utf8_decode('Proveedor'),1,0, 'C',0);                        
    $pdf->Cell(20, 6, utf8_decode('P. Compra'),1,1, 'C',0);                                                         

    $pdf->SetX(1);
    $pdf->Cell(30, 6,substr($num_fac_venta,8,30) ,0,0, 'C',0);                                                             
    $pdf->Cell(25, 6,$fecha_venta ,0,0, 'C',0);                                                                 
    $pdf->Cell(20, 6,$precio_venta ,0,0, 'C',0);                                                                 
    $pdf->Cell(20, 6,maxCaracter($descripcion,30) ,0,0, 'C',0);                                                                 
    $pdf->Cell(40, 6,substr($num_fac_compra,8,30) ,0,0, 'C',0);                                                             
    $pdf->Cell(20, 6,$fecha_compra ,0,0, 'C',0);                                                                 
    $pdf->Cell(30, 6,maxCaracter($proveedor,20) ,0,0, 'C',0);                                                                 
    $pdf->Cell(20, 6,$precio_compra ,0,0, 'C',0);                                                                 
    
    $pdf->Output();
?>