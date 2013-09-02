<? 

class Seguridad {

	private $redirect = 'login.php';
	private $minauth = 1;
	private $campo = 'autorizacion';	
	

	public function Seguridad($minlevel = 1, $field = 'autorizacion', $redireccion = 'login.php') {
		
		session_name($NOMBRE_SESION);
		session_cache_expire(120);
		session_start();
		
		if ($_SESSION[$field] < $minlevel)
			header("Location: $redireccion");
		
	}


}



?>