<?php
    require('../fpdf/fpdf.php');
    include '../procesos/base.php';
    include '../procesos/funciones.php';
    conectarse();    
    date_default_timezone_set('America/Guayaquil'); 
    session_start();

    class PDF extends FPDF {   
        var $widths;
        var $aligns;
        function SetWidths($w) {            
            $this->widths=$w;
        }                      

        function Header() {             
            $this->AddFont('Amble-Regular','','Amble-Regular.php');
            $this->SetFont('Amble-Regular','',10);        
            $fecha = date('Y-m-d', time());
            $this->SetX(1);
            $this->SetY(1);
            $this->Cell(20, 5, $fecha, 0,0, 'C', 0);                         
            $this->Cell(150, 5, "CLIENTE", 0,1, 'R', 0);      
            $this->SetFont('Arial','B',16);                                                    
            $this->Cell(190, 8,$_SESSION['empresa'], 0,1, 'C',0);                                
            $this->Image('../images/logo_empresa.jpg',5,8,35,28);
            $this->SetFont('Amble-Regular','',10);        
            $this->Cell(180, 5, "PROPIETARIO: ".utf8_decode($_SESSION['propietario']),0,1, 'C',0);                                
            $this->Cell(80, 5, "TEL.: ".utf8_decode($_SESSION['telefono']),0,0, 'R',0);                                
            $this->Cell(80, 5, "CEL.: ".utf8_decode($_SESSION['celular']),0,1, 'C',0);                                
            $this->Cell(180, 5, "DIR.: ".utf8_decode($_SESSION['direccion']),0,1, 'C',0);                                
            $this->Cell(180, 5, "SLOGAN.: ".utf8_decode($_SESSION['slogan']),0,1, 'C',0);                                
            $this->Cell(180, 5, utf8_decode( $_SESSION['pais_ciudad']),0,1, 'C',0);                                                                                        
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(0.5);
            $this->SetFillColor(120,120,120);
            $this->Line(1,55,210,55);            
            $this->SetFont('Arial','B',12);                                                                
            $this->Cell(190, 5, utf8_decode("PRODUCTOS AGRUPADOS POR PROVEEDOR"),0,1, 'C',0);                                                                                                                
            $this->SetFont('Amble-Regular','',10);        
            $this->Ln(2);
            $sql=pg_query("select proveedores.id_proveedor, identificacion_pro,empresa_pro from proveedores,factura_compra where proveedores.id_proveedor='$_GET[id]' LIMIT 1");                        
            $this->SetLineWidth(0.2);
            while($row=pg_fetch_row($sql)) {          
                $this->SetX(1);                  
                $this->Cell(80, 8, utf8_decode('RUC/CI: '.$row[1]),1,0, 'L',1);                                                                                                        
                $this->Cell(125, 8, utf8_decode('NOMBRE: '.$row[2]),1,1, 'L',1);                                                                                                        
            }                        
            $this->Ln(2);
            $this->SetX(1);
            $this->SetFont('Amble-Regular','',10);        
            $this->Cell(35, 5, utf8_decode("Nro Factura"),1,0, 'C',0);
            $this->Cell(30, 5, utf8_decode("Código"),1,0, 'C',0);
            $this->Cell(60, 5, utf8_decode("Producto"),1,0, 'C',0);        
            $this->Cell(30, 5, utf8_decode("Precio Compra"),1,0, 'C',0);    
            $this->Cell(30, 5, utf8_decode("Total Compra"),1,0, 'C',0);    
            $this->Cell(20, 5, utf8_decode("Cantidad"),1,1, 'C',0);               
        }
        function Footer() {            
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
    $total = 0;      
    $sql=pg_query("select proveedores.id_proveedor, identificacion_pro,factura_compra.id_factura_compra,num_serie from proveedores,factura_compra where proveedores.id_proveedor='$_GET[id]' and factura_compra.id_proveedor=proveedores.id_proveedor");
    while($row=pg_fetch_row($sql)) {        
        $sql1=pg_query("select detalle_factura_compra.id_detalle_compra,productos.codigo,productos.articulo,productos.iva_minorista,productos.iva_mayorista,productos.stock,detalle_factura_compra.precio_compra,total_compra,cantidad from detalle_factura_compra,productos where detalle_factura_compra.cod_productos=productos.cod_productos and detalle_factura_compra.id_factura_compra='$row[2]' order by id_detalle_compra asc");
        while($row1=pg_fetch_row($sql1)) {            
            $pdf->SetX(1);                  
            $pdf->Cell(35, 5, maxCaracter(utf8_decode($row[3]),20),0,0, 'L',0);
            $pdf->Cell(30, 5, maxCaracter(utf8_decode($row1[1]),12),0,0, 'L',0);
            $pdf->Cell(60, 5, maxCaracter(utf8_decode($row1[2]),40),0,0, 'L',0);        
            $pdf->Cell(30, 5, maxCaracter(utf8_decode($row1[6]),10),0,0, 'C',0);                         
            $pdf->Cell(30, 5, maxCaracter( utf8_decode($row1[7]),10),0,0, 'C',0);                         
            $pdf->Cell(20, 5, maxCaracter( utf8_decode($row1[8]),10),0,0, 'C',0);                         
            $total=$total+$row1[7];                                                            
            $pdf->Ln(5);        
        }            
    }
    $pdf->SetX(1);                  
    $pdf->Ln(5);   
    $pdf->Cell(185, 5, "Totales:",0,0, 'R',0);                         
    $pdf->Cell(20, 5, number_format($total,2,',','.'),0,1, 'C',0);                                 
    $pdf->Output();
?>