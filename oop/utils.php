<?
class Utils {
	
	public function Utils() {}
	
	public static function cargar($formname, $else='', $maxchars=0){

		$var = '';
	
		if(is_numeric($else)){
				$var = (isset($_REQUEST[$formname]) and is_numeric($_REQUEST[$formname])) ? floatval($_REQUEST[$formname]) : $else;
	
		}else{
	   		    $var = !empty($_REQUEST[$formname])? $_REQUEST[$formname] : $else;
		}
	
		if( $maxchars > 0 ) $var = substr(strval($var),0,$maxchars);
	
		return $var;
	}	
	


	public static function normalizar($cadena){
	   $tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ· ";
   	   $replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn-_";
   		return(strtr($cadena,$tofind,$replac));
	}
	
	
	
	
	public static function escapar($t) {
	if (get_magic_quotes_gpc())
		$t = stripslashes($t);
	return mysql_real_escape_string($t);
	
	}
	
	
	public static function dmy2ymd($val) {
	$val = str_replace('/', '-', $val);
	$fecha = explode('-', $val);
	if (!$fecha[2]) $fecha[2] = '2012';
	return "$fecha[2]-$fecha[1]-$fecha[0]";
	
	}
	
	public static function ymd2dmy($val) {
	$val = explode(" ", $val);
	$val = $val[0];
	
	$val = str_replace('/', '-', $val);
	$fecha = explode('-', $val);
	return "$fecha[2]-$fecha[1]-$fecha[0]";
	
	}
	
	public static function removeFromArray($del_val, $arr) {
		if(($key = array_search($del_val, $arr)) !== false)
		{
			unset($arr[$key]);
		}
		return $arr;
	}
	
	
	
}

?>