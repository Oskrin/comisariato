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
            $this->Cell(190, 8,$_SESSION['empresa'], 0,1, 'C',0);                                
            $this->Image('../images/logo_empresa.jpg',5,8,35,26);
            $this->SetFont('Amble-Regular','',10);        
            $this->Cell(190, 5, "PROPIETARIO: ".utf8_decode($_SESSION['propietario']),0,1, 'C',0);                                
            $this->Cell(80, 5, "TEL.: ".utf8_decode($_SESSION['telefono']),0,0, 'R',0);                                
            $this->Cell(80, 5, "CEL.: ".utf8_decode($_SESSION['celular']),0,1, 'C',0);                                
            $this->Cell(180, 5, "DIR.: ".utf8_decode($_SESSION['direccion']),0,1, 'C',0);                                
            $this->Cell(180, 5, "SLOGAN.: ".utf8_decode($_SESSION['slogan']),0,1, 'C',0);                                
            $this->Cell(180, 5, utf8_decode( $_SESSION['pais_ciudad']),0,1, 'C',0);                                                                                                    
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(0.4);            
            $this->Line(1,50,210,50);            
            $this->SetFont('Arial','B',12);                                                                            
            $this->Cell(190, 5, utf8_decode("ORDENES DE PRODUCCIÓN POR FECHAS"),0,1, 'C',0); 
            $this->SetFont('Arial','B',10);                                                                            
            $this->Cell(90, 5, utf8_decode("Desde: ".$_GET['inicio']),0,0, 'R',0);                                                                                        
            $this->Cell(40, 5, utf8_decode("Hasta: ".$_GET['fin']),0,1, 'C',0);                                                                                                                           
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
    $consulta=pg_query("select id_usuario,ci_usuario,nombre_usuario,apellido_usuario,telefono_usuario,direccion_usuario from usuario;");
    while($row=pg_fetch_row($consulta)){
        $repetido=0;
        $total=0;
        $sql1=pg_query("select comprobante,fecha_actual,codigo,articulo,cantidad,precio_compra,sub_total from ordenes_produccion,usuario,productos where  ordenes_produccion.id_usuario = usuario.id_usuario and ordenes_produccion.cod_productos = productos.cod_productos and fecha_actual between '".$_GET['inicio']."' and '".$_GET['fin']."' and usuario.id_usuario='$row[0]'");
        if(pg_num_rows($sql1)){
            if($repetido==0){
                $pdf->SetX(1); 
                $pdf->SetFillColor(187, 179, 180);            
                $pdf->Cell(70, 6, maxCaracter(utf8_decode('RUC/CI: '.$row[1]),35),1,0, 'L',1);                                     
                $pdf->Cell(135, 6, maxCaracter(utf8_decode('NOMBRE: '.$row[2].' '.$row[3]),35),1,1, 'L',1);                                                                     
                $pdf->SetX(1); 
                $pdf->Cell(70, 6, maxCaracter(utf8_decode('TELF:'.$row[4]),35),1,0, 'L',1);                                     
                $pdf->Cell(135, 6, maxCaracter(utf8_decode('DIRECCIÓN:'.$row[5]),35),1,1, 'L',1);                                                                                     
                $pdf->Ln(2);
                $pdf->SetX(1); 
                $pdf->Cell(25, 6, utf8_decode('Comprobante'),1,0, 'C',0);                                     
                $pdf->Cell(25, 6, utf8_decode('Fecha'),1,0, 'C',0);                                     
                $pdf->Cell(35, 6, utf8_decode('Código'),1,0, 'C',0);                                     
                $pdf->Cell(45, 6, utf8_decode('Producto'),1,0, 'C',0);                                     
                $pdf->Cell(20, 6, utf8_decode('Cantidad'),1,0, 'C',0);                                     
                $pdf->Cell(25, 6, utf8_decode('P. Costo'),1,0, 'C',0);                                                     
                $pdf->Cell(30, 6, utf8_decode('T. Costo'),1,1, 'C',0);                                     
                $pdf->Ln(1);                
                $repetido=1;
            }            
            while($row1=pg_fetch_row($sql1)){
                $pdf->Cell(25, 6, utf8_decode($row1[0]),0,0, 'C',0);                
                $pdf->Cell(25, 6, utf8_decode($row1[1]),0,0, 'C',0);                
                $pdf->Cell(35, 6, utf8_decode($row1[2]),0,0, 'C',0);                
                $pdf->Cell(45, 6, utf8_decode($row1[3]),0,0, 'C',0);                
                $pdf->Cell(22, 6, utf8_decode($row1[4]),0,0, 'C',0);                
                $pdf->Cell(25, 6, utf8_decode($row1[5]),0,0, 'C',0);                
                $pdf->Cell(30, 6, utf8_decode($row1[6]),0,1, 'C',0);                                                                                
            }            
        }        
    }
    $pdf->Output();
?>