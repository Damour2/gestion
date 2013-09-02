<?

require_once('oop/init.php');

$seguridad = new Seguridad($config, 0);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet/less" type="text/css" href="styles.css">
<script src="library/less-1.1.5.min.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$con->title?></title>
</head>

<body>

	<div id="container">
    	
        <div id="top">
        	<div class="content">
			<img src='img/logo.png' />
            <h1><?=ucfirst($traducir[administrador])?></h1>
            </div>
        </div>
        <div class="content">
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
    </div>   

</body>
</html>





