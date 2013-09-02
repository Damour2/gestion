<?php

include "../library/conexion.php";
include "../library/seguridad.php";
include "../library/auxiliares.php";
include "../library/idioma-$IDIOMA.php";

$ACCION = cargar('accion', 'editar');
$CODIGO = cargar ('codigo', 0);
$TIPO = cargar('tipo', '');
$que = cargar('que', '');

if ($ACCION == "administrador") $que = "artículos";
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../library/jquery-1.4.2.min.js"></script>
<link rel="stylesheet" href="back.css" />
<title><?=ucfirst($traducir[$ACCION].$traducir[$que])?></title>
</head>

<body>
	<div id="container">
    	
        <div id="top">

            <h1><? echo $traducir[$ACCION]; 
			if (!empty($traducir[$que])) echo "($traducir[$que])"?>
            </h1>
            <a href="index.php"><?=$traducir[volveralmenu]?></a>
        </div>
        
        <div class="content" id='<?=$ACCION?>-in'>
        	<? include $ACCION.".php"; ?> 
        </div>
        
        
    </div>   
    
<script src="../library/comunes.js"></script>
</body>
</html>
