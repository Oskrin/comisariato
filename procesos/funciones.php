<?php	
	function maxCaracter($texto, $cant){        
    	$texto = substr($texto, 0,$cant);    	
    	return $texto;
	}

	function ceil_caracter($texto, $cant){        		
		$array_t = array();		
		$var = 0;
		$total = strlen($texto) / $cant;				
		$total = ceil($total);		
		for($i = 0; $i < $total; $i++){						
    		$array_t[$i] = substr($texto, $var,$cant);    		    		
    		$var = $var + $cant;    		

    	}
		return $array_t;
    	
	}

	function truncateFloat($number, $digitos){
	    $raiz = 10;
	    $multiplicador = pow ($raiz,$digitos);
	    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
	    return number_format($resultado, $digitos);
	 
	}
?>