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
        var $tipo;
        var $fecha;
        var $num;
        var $total;
        var $total1;
        var $concepto;
        function SetWidths($w){            
            $this->widths=$w;
        }                       
        function Header(){    
            $total=0;
            $total1 = 0;
            $concepto ="";
            $consulta1=pg_query("select  T.fecha_actual, T.hora_actual, U.nombre_usuario, U.apellido_usuario, T.tipo_transaccion, T.num_transaccion, T.abreviatura, T.concepto, T.total_debe, T.total_haber, T.diferencia from transacciones T, usuario U where T.id_usuario=U.id_usuario and T.comprobante='$_GET[id]'");
            while($row=pg_fetch_row($consulta1)){
                $this->tipo = $row[4];
                $this->fecha= $row[0];
                $this->num = $row[5];
                $this->total=$row[8];
                $this->total1 = $row[9];
                $this->concepto = $row[7];            

            }
            //$codigo.='<h2 style="color:#1B8D72;font-weight: bold;font-size:13px;">Transación Nro: 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nro de Documento: '.$num.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Fecha: '.$fecha.'</h2>';                     
            $this->AddFont('Amble-Regular','','Amble-Regular.php');
            $this->SetFont('Amble-Regular','',10);        
            $fecha = date('Y-m-d', time());
            $this->SetX(1);
            $this->SetY(1);
            $this->Cell(20, 5, $fecha, 0,0, 'C', 0);                         
            $this->Cell(150, 5, "CLIENTE", 0,1, 'R', 0);      
            $this->SetFont('Arial','B',16);                                                    
            $this->Cell(190, 8, "EMPRESA: ".$_SESSION['empresa'], 0,1, 'C',0);                                
            $this->Image('../images/logo_empresa.jpg',5,8,35,25);
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
            $this->Cell(190, 5, utf8_decode('COMPROBANTE DE: '.$this->tipo),0,1, 'C',0);                                                                                                                            
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
    $pdf->SetFillColor(187, 179, 180);            
    $pdf->Cell(60, 6, maxCaracter(utf8_decode('Transación Nro: 1'),35),1,0, 'L',1);                                     
    $pdf->Cell(70, 6, maxCaracter(utf8_decode('Nro. Documento: '.$pdf->num),35),1,0, 'L',1);                                     
    $pdf->Cell(75, 6, maxCaracter(utf8_decode('Fecha: '.$pdf->fecha),35),1,1, 'L',1);                                             
    $pdf->Ln(3);

    $repetido=0;         
    $sql1=pg_query("select P.id_plan_cuentas, P.codigo_plan, P.descripcion, D.tipo_referencia, D.num_referencia, D.debito, D.credito  from transacciones T, detalle_transaccion D, plan_cuentas P where T.id_transacciones = D.id_transacciones and D.id_plan_cuentas = P.id_plan_cuentas and  T.comprobante='$_GET[id]' order by P.id_plan_cuentas asc");
    if(pg_num_rows($sql1)){
        while($row1=pg_fetch_row($sql1)){                
            if($repetido==0){      
                $pdf->SetX(1);     
                $pdf->Cell(35, 6, utf8_decode('Cod, Cuenta'),1,0, 'C',0);                                         
                $pdf->Cell(45, 6, utf8_decode('Descripción'),1,0, 'C',0);                                         
                $pdf->Cell(40, 6, utf8_decode('Tipo Ref.'),1,0, 'C',0);                                         
                $pdf->Cell(45, 6, utf8_decode('# Ref.'),1,0, 'C',0);                                         
                $pdf->Cell(20, 6, utf8_decode('Débito'),1,0, 'C',0);                                                         
                $pdf->Cell(20, 6, utf8_decode('Crédito'),1,1, 'C',0);                                                     
                $repetido=1;
                $contador=1;                
            }  
            $pdf->Cell(35, 6, maxCaracter(utf8_decode($row1[1]),15),0,0, 'L',0);                                             
            $pdf->Cell(45, 6, maxCaracter(utf8_decode($row1[2]),20),0,0, 'L',0);                                             
            $pdf->Cell(40, 6, maxCaracter(utf8_decode($row1[3]),20),0,0, 'L',0);                                             
            $pdf->Cell(45, 6, maxCaracter(utf8_decode($row1[4]),22),0,0, 'L',0);                                             
            $pdf->Cell(20, 6, maxCaracter(utf8_decode($row1[5]),15),0,0, 'C',0);                                  
            $pdf->Cell(20, 6, maxCaracter(utf8_decode($row1[6]),15),0,1, 'C',0);                     
            $repetido=1;   
        }                 
    }
    if($contador>0){
        $pdf->SetX(1);
        $pdf->Cell(205, 0, utf8_decode(''),1,1, 'R',1);                                     
        $pdf->Cell(166, 6, utf8_decode('Totales:'),0,0, 'R',0);                                         
        $pdf->Cell(20, 6,(number_format($pdf->total,2,',','.')) ,0,0, 'C',0);          
        $pdf->Cell(20, 6,(number_format($pdf->total1,2,',','.')) ,0,1, 'C',0);          
        $pdf->Cell(120, 6, utf8_decode('CONCEPTO: '),0,0, 'R',0);                                     
        $pdf->Cell(85, 6, maxCaracter($pdf->concepto,40),0,0, 'L',0);          
    }      
    
    $pdf->Output();
?>