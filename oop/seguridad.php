<? 

class Seguridad {

	private $redirect;
	private $success;
	public $mensaje;
	public $status;

	public function Seguridad($config = null, $minlevel = 1, $field = 'autorizacion', $redireccion = 'login.php', $exito = 'index.php') {
		
		
		session_name($config->NOMBRE_SESION);
		session_cache_expire(120);
		session_start();
		
		if (!isset($_SESSION[cantidadproductos])) $_SESSION[cantidadproductos] = 0;
		if (!isset($_SESSION[importe]))  $_SESSION[importe] = 0; 
		if (!isset($_SESSION[carro])) $_SESSION[carro] = array();
		if (!isset($_SESSION[autorizacion])) $_SESSION[autorizacion] = 0;
		if (!isset($_SESSION[id_cli])) $_SESSION[id_cli] = 0;	
		
		$this->redirect = $redireccion;
		$this->success = $exito;
		
		
		if ($_SESSION[$field] < $minlevel)
			header("Location: $redireccion");
			
		if (isset($_REQUEST[logout])) 
			$this->logout();
		
		if( !empty($_POST['usuario']) and !empty($_POST['clave']))
			$this->login($_POST[usuario], $_POST[clave]);
		
		
	}
	
	public function logout() {
		$_SESSION[cantidadproductos] = 0;
		$_SESSION[importe] = 0; 
		$_SESSION[carro] = array();
		$_SESSION[autorizacion] = 0;
		$_SESSION[id_cli] = 0;	
		
		header("Location: $this->redirect");
	}

	public function login($usuario, $clave) {
		$DB = new DB();
		
		
		$q = $DB->select('administradores', 'nombre, usuario, autorizacion, id_cli', "usuario = '$usuario' AND password = '$clave'", null, 0, 1);
		
		print_r($q);
		if ($q->cantidad) {
			
			foreach ($q->results[0] as $k => $v)
				$_SESSION[$k] = $v;
				
			header("Location: $this->success");
			return true;	
		}
		else {
			
			$mensaje = "No se encontró un usuario con esos datos.";
			return false;
		}
	}

}



?>