<? 
include "oop/init.php";
$seguridad = new Seguridad($config, 2);



$ACCION = Utils::cargar('accion', 'editar');
$CODIGO = Utils::cargar ('codigo', 0);
$TIPO = Utils::cargar('tipo', '');
$que = Utils::cargar('que', 'producto');
$id = Utils::cargar ('id', 0);
$offset = Utils::cargar ('offset', 0);

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="library/js/jquery-1.8.2.js"></script>

<link rel="stylesheet/less" type="text/css" href="styles.css">
<link rel="stylesheet/less" type="text/css" href="library/css/ui-lightness/jquery-ui-1.9.1.custom.min.css">

<script src="library/less-1.1.5.min.js" type="text/javascript"></script>

<title><? echo $config->title.' :: '.ucfirst($traducir[$ACCION].' '.$traducir[$que])?></title>
</head>

<body>
	<div id="container">
    	
        <div id="top">
			<div class="content">
            <img src="img/logo.png" onclick="window.location = index.php" />
            <h1><? echo ucfirst($ACCION); 
			if (!empty($que)) echo " -> ".ucfirst($que)?>
            </h1>
            <a href="index.php"><?=$traducir[volveralmenu]?></a>
        	</div>
        </div>
        <div class="content" id='<?=$ACCION?>-in' style="padding-top: 10px;">
        	<? include $ACCION.".php"; ?> 
        </div>
        
        
    </div>   
    
<script src="library/comunes.js"></script>
<script src="library/carro.js"></script>
<script src="library/idioma.js"></script>
<script src="library/js/jquery-ui-1.9.1.custom.min.js"></script>
</body>
</html>
