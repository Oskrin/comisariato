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
            $this->Image('../images/logo_empresa.jpg',5,8,35,28);
            $this->SetFont('Amble-Regular','',10);        
            $this->Cell(180, 5, "PROPIETARIO: ".utf8_decode($_SESSION['propietario']),0,1, 'C',0);                                
            $this->Cell(80, 5, "TEL.: ".utf8_decode($_SESSION['telefono']),0,0, 'R',0);                                
            $this->Cell(80, 5, "CEL.: ".utf8_decode($_SESSION['celular']),0,1, 'C',0);                                
            $this->Cell(180, 5, "DIR.: ".utf8_decode($_SESSION['direccion']),0,1, 'C',0);                                
            $this->Cell(180, 5, "SLOGAN.: ".utf8_decode($_SESSION['slogan']),0,1, 'C',0);                                
            $this->Cell(180, 5, utf8_decode( $_SESSION['pais_ciudad']),0,1, 'C',0);                                                                                                    
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(0.4);            
            $this->Line(1,50,210,50);            
            $this->SetFont('Arial','B',12);                                                                
            $this->Cell(90, 5, utf8_decode($_GET['inicio']),0,0, 'R',0);                                                                                        
            $this->Cell(40, 5, utf8_decode($_GET['fin']),0,1, 'C',0);                                                                                                    
            $this->Cell(190, 5, utf8_decode("UTILIDAD POR PRODUCTO"),0,1, 'C',0);                                                                                                                            
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
    
    $total=0;
    $sub=0;
    $repetido=0;   
    $contador=0; 
    $consulta=pg_query("select id_cliente,identificacion,nombres_cli from clientes");
    while($row=pg_fetch_row($consulta)){
        $repetido=0;   
        $contador=0; 
        $total=0;
        $sql1=pg_query("select * from factura_venta where fecha_actual between '$_GET[inicio]' and '$_GET[fin]' and id_cliente='$row[0]' and estado='Activo'");
        if(pg_num_rows($sql1)){
            if($repetido==0){
                $total=0;
                $pdf->SetX(1);
                $pdf->SetFillColor(216, 216, 231);                
                $pdf->Cell(100, 8, utf8_decode("RUC/CI:: ".$row[1]),1,0, 'L',true);    
                $pdf->Cell(105, 8, utf8_decode("CLIENTE: ".$row[2]),1,1, 'L',true);                                                        
                $repetido=1;
            }
            while($row1=pg_fetch_row($sql1)){
                $contador=0;
                $sub=0;
                $pdf->Ln(3);
                $pdf->SetX(1); 
                $pdf->Cell(30, 6, utf8_decode('Nro Factura:'),1,0, 'L',true);                                     
                $pdf->Cell(115, 6, utf8_decode($row1[5]),1,0, 'L',true);                                     
                $pdf->Cell(30, 6, utf8_decode('Total Factura:'),1,0, 'L',true);                                     
                $pdf->Cell(30, 6, utf8_decode($row1[15]),1,1, 'L',true);                                                                     

                $pdf->Ln(3);
                $pdf->SetX(1); 
                $pdf->Cell(25, 6, utf8_decode('Cod. Producto'),1,0, 'C',0);                                     
                $pdf->Cell(60, 6, utf8_decode('Descripción'),1,0, 'C',0);                                     
                $pdf->Cell(20, 6, utf8_decode('Cantidad'),1,0, 'C',0);                                     
                $pdf->Cell(20, 6, utf8_decode('P. Venta'),1,0, 'C',0);                                     
                $pdf->Cell(20, 6, utf8_decode('T. P. Venta'),1,0, 'C',0);                                     
                $pdf->Cell(20, 6, utf8_decode('P. Compra'),1,0, 'C',0);                                     
                $pdf->Cell(20, 6, utf8_decode('T. P. Compra'),1,0, 'C',0);                                     
                $pdf->Cell(20, 6, utf8_decode('Utilidad'),1,1, 'C',0);    
    
                $sql2=pg_query("select * from detalle_factura_venta,productos where detalle_factura_venta.cod_productos=productos.cod_productos and id_factura_venta='$row1[0]'");
                   
                while($row2=pg_fetch_row($sql2)){
                    $pdf->SetX(1); 
                    $pdf->Cell(25, 6,maxCaracter($row2[10],13),0,0, 'L',0);                                     
                    $pdf->Cell(60, 6,maxCaracter($row2[12],30),0,0, 'L',0); 
                    $pdf->Cell(20, 6,$row2[3],0,0, 'C',0);
                    $pdf->Cell(20, 6,$row2[4],0,0, 'C',0);
                    $pdf->Cell(20, 6,($row2[3] * $row2[4]),0,0, 'C',0);
                    $pdf->Cell(20, 6,$row2[15],0,0, 'C',0);
                    $pdf->Cell(20, 6,($row2[3] * $row2[15]),0,0, 'C',0);
                    $pdf->Cell(20, 6,(($row2[3] * $row2[4]) - ($row2[3] * $row2[15])),0,0, 'C',0);                     
                    $sub=($sub+(($row2[3]*$row2[4])-($row2[3]*$row2[15])));
                    $pdf->Ln(6);
                }
                $contador=1;
                if($contador>0){
                    $pdf->Ln(2);
                    $pdf->Cell(187, 6, utf8_decode('Total Utilidad por factura'),0,0, 'R',0);                                     
                    $pdf->Cell(20, 6,(number_format($sub,2,',','.')) ,0,0, 'C',0);                                                         
                    $total=$total+$sub;
                    $sub=0;                    
                    $pdf->Ln(6);
                }   
            } 
            $pdf->SetX(1);
            $pdf->Cell(205, 0, utf8_decode(''),1,1, 'R',1);                                     
            $pdf->Cell(187, 6, utf8_decode('Total Utilidad por cliente'),0,0, 'R',0);                                     
            $pdf->Cell(20, 6,(number_format($total,2,',','.')) ,0,1, 'C',0);                                                                                 
            $total=0;    
        }
    }   
    $pdf->Output();
?>