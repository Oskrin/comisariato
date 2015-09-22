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
            $this->Line(1,45,210,45);            
            $this->SetFont('Arial','B',12);                                                                
            $this->Cell(190, 5, utf8_decode("REPORTE DE VENTAS POR DIRECTOR"),0,1, 'C',0);                                                                                                                
            $this->SetFont('Arial','B',10);                                                                            
            $this->Cell(90, 5, utf8_decode($_GET['inicio']),0,0, 'R',0);                                                                                        
            $this->Cell(40, 5, utf8_decode($_GET['fin']),0,1, 'C',0);                                      
            $this->SetFont('Amble-Regular','',10);                                                                      
            $this->Ln(5);              
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
    
    $consulta = pg_query("select id_director, identificacion_dire ,nombres from directores where id_director='$_GET[id]'");
    while ($row = pg_fetch_row($consulta)) {
        $pdf->SetX(1); 
        $pdf->SetFillColor(187, 179, 180);            
        $pdf->Cell(70, 6, maxCaracter(utf8_decode('RUC/CI:'.$row[1]),35),1,0, 'L',1);                                     
        $pdf->Cell(135, 6, maxCaracter(utf8_decode('DIRECTOR:'.$row[2]),50),1,1, 'L',1);                                                                     
    }

    $pdf->SetX(1);        
    $pdf->Cell(40, 6, utf8_decode("CI/RUC"),1,0, 'C',0);
    $pdf->Cell(35, 6, utf8_decode("Nombres"),1,0, 'C',0);
    $pdf->Cell(50, 6, utf8_decode("Nro. Facturas"),1,0, 'C',0);        
    $pdf->Cell(40, 6, utf8_decode("Total Facturas"),1,1, 'C',0);                            
    
    $sql = pg_query("select id_cliente, identificacion, nombres_cli from clientes where id_director = '$_GET[id]' order by id_cliente asc;");
    $cont1 = 0;
    $cont2 = 0;
    while ($row = pg_fetch_row($sql)) {
        $temp = 0;
        $temp1 = 0;
        $sql1 = pg_query("select count(id_factura_venta) as contador, SUM(total_venta::float) as total_venta from factura_venta where id_cliente ='$row[0]' and estado ='Activo'");
        while ($row1 = pg_fetch_row($sql1)) {
            $temp = $row1[0];
            if ($row1[1] == "") {
                $temp1 = "$ 0";
            } else {
                $temp1 = "$ " . $row1[1];
            }
            $cont1 = $cont1 + $row1[0];
            $cont2 = $cont2 + $row1[1];
        }
        $pdf->SetX(1);        
        $pdf->Cell(40, 6, utf8_decode($row[1]),0,0, 'C',0);                               
        $pdf->Cell(50, 6, utf8_decode($row[2]),0,0, 'C',0);                       
        $pdf->Cell(40, 6, utf8_decode($temp),0,0, 'C',0);                       
        $pdf->Cell(40, 6, utf8_decode($temp1),0,1, 'C',0);                           
    }
    $pdf->SetX(1);                                             
    $pdf->Cell(207, 0, utf8_decode(""),1,1, 'R',0);
    $pdf->Cell(85, 6, utf8_decode("Totales"),0,0, 'R',0);
    $pdf->Cell(25, 6, maxCaracter((number_format($cont1,2,',','.')),20),0,0, 'C',0);                                                    
    $pdf->Cell(25, 6, maxCaracter((number_format($cont2,2,',','.')),20),0,1, 'C',0);                                                    
    $pdf->Ln(3);              
    $pdf->Output();
?>