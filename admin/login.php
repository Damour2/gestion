<?

require_once('../library/conexion.php');
require_once('../library/auxiliares.php');

session_name($NOMBRE_SESION);
session_cache_expire(15);
session_start();

/*
PERMISOS BINARIOS
Administradores = 8
Editores = 4
Periodistas = 2
Clientes (registrados) = 1
*/

// LOGOUT
if( isset($_GET["logout"]) ){
	$_SESSION['admincod']=0;
	unset($_SESSION);
	$_SESSION = array();
	session_destroy();
	header('Location: login.php');
	exit;
	
}

if( !empty($_POST['usuario']) and !empty($_POST['clave'])){
	
	$usuario = cargar('usuario');
	$clave = cargar('clave');

	//echo "select nombre, usuario from administradores where usuario='".$usuario."' and password ='".$clave."'";
	$r = mysql_query( "select nombre, usuario from administradores where usuario='".$usuario."' and password ='".$clave."'" ) or die(mysql_error());
	

	
	if( $rs = mysql_fetch_assoc($r) ){
		
		$_SESSION['adminuser'] = $rs['usuario'] ;
		$_SESSION['adminnombre'] = $rs['nombre'];
		$_SESSION['adminpermisos'] = "todos";	
		
		mysql_close();

		header('Location: index.php');
		exit;
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="back.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Scandinavian - <?=$traducir[administrador]?></title>
</head>

<body>

	<div id="container">
    	
        <div id="top">

            <h1><?=$traducir[administrador]?></h1>
            
        </div>
        
        <form action="login.php" method="post">
<p> Benvenutti</p>

<fieldset>
<legend>Login</legend>
<label>User:
<input name="usuario" type="text" class="input" id="usuario" style="width:90px" />
</label>
<label>Password:
<input name="clave" type="password" class="input" id="clave" style="width:90px" />
</label>
<div align="left" style="padding-top: 5px">
<input name="login"  type="submit" class="button" id="login" value="Login" style="width:60px" />
</div>
</fieldset>
</form>
        
        
    </div>   

</body>
</html>





