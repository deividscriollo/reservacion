<?php

class fngccvalidator{
	/**
	 * 
	 * @param string $ccnumber
	 * @param string $cardtype
	 * @param string $allowTest
	 * @return mixed
	 */
	public function CreditCard($ccnumber, $cardtype = '', $allowTest = false){
		// proceso prueba
		if($allowTest == false && $ccnumber == '4111111111111111'){
			return false;
		}
		
		$ccnumber = preg_replace('/[^0-9]/','',$ccnumber); // string numero de caracteres
		
		$creditcard = array(
			'visa'			=>	"/^4\d{3}-?\d{4}-?\d{4}-?\d{4}$/",
			'mastercard'	=>	"/^5[1-5]\d{2}-?\d{4}-?\d{4}-?\d{4}$/",
			'discover'		=>	"/^6011-?\d{4}-?\d{4}-?\d{4}$/",
			'amex'			=>	"/^3[4,7]\d{13}$/",
			'diners'		=>	"/^3[0,6,8]\d{12}$/",
			'bankcard'		=>	"/^5610-?\d{4}-?\d{4}-?\d{4}$/",
			'jcb card'			=>	"/^[3088|3096|3112|3158|3337|3528]\d{12}$/",
			'enroute'		=>	"/^[2014|2149]\d{11}$/",
			'switch'		=>	"/^[4903|4911|4936|5641|6333|6759|6334|6767]\d{12}$/"
		);
		
		if(empty($cardtype)){
			$match=false;
			foreach($creditcard as $cardtype=>$pattern){
				if(preg_match($pattern,$ccnumber)==1){
					$match=true;
					break;
				}
			}
			if(!$match){
				return false;
			}
		}elseif(@preg_match($creditcard[strtolower(trim($cardtype))],$ccnumber)==0){
			return false;
		}		
		
		$return['valid']	=	$this->LuhnCheck($ccnumber);
		$return['ccnum']	=	$ccnumber;
		$return['type']		=	$cardtype;
		return $return;
	}
	
	/**
	 * longitud del algoritmo
	 *
	 * @param string $ccnum
	 * @return boolean
	 */
	public function LuhnCheck($ccnum){
		$checksum = 0;
		for ($i=(2-(strlen($ccnum) % 2)); $i<=strlen($ccnum); $i+=2){
			$checksum += (int)($ccnum{$i-1});
		}
		
		// verificar el tamaño de la cadena
		for ($i=(strlen($ccnum)% 2) + 1; $i<strlen($ccnum); $i+=2){
			$digit = (int)($ccnum{$i-1}) * 2;
			if ($digit < 10){
				$checksum += $digit;
			}else{
				$checksum += ($digit-9);
			}
		}
		if(($checksum % 10) == 0){
			return true; 
		}else{
			return false;
		}
	}
	
}

// validacion de la targeta
if (isset($_POST['validar_targeta'])) {
	$valor = new fngccvalidator();
	$valor2=$valor->CreditCard($_POST['tarjeta']);
	print_r(json_encode($valor2));
}


?>