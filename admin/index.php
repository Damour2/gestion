<?php
include "../library/conexion.php";
include "../library/seguridad.php";
include "../library/auxiliares.php";
include "../library/idioma-$IDIOMA.php";




?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="back.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Libo - Administrador</title>
</head>

<body>

	<div id="container">
    	
        <div id="top">

            <h1>Administrador</h1>
            
        </div>
        
        <div class="content" id="index">
        	<p><a href="in.php?accion=articulo&que=producto"><?=$traducir[agregarproducto]?></a>
             <a href="in.php?accion=articulo&que=noticia"><?=$traducir[agregarnoticia]?></a>
             <a href="in.php?accion=articulo&que=sucursal"><?=$traducir[agregarsucursal]?></a>
             <a href="in.php?accion=clientes"><?=$traducir[clientes]?></a>
            </p>
            <p>
            <a href="in.php?accion=administrador"><?=$traducir[adminarticulos]?></a>
            <a href="in.php?accion=categorias"><?=$traducir[admincategorias]?></a>
            <a href="in.php?accion=imagenes"><?=$traducir[agregarimagenes]?></a>
            </p>
            <p><a href="in.php?accion=compras&estado=pendiente">Administrar compras</a></p>
        </div>
        <a href="login.php?logout" style="position:absolute; bottom:30px; right:30px;"> <?=$traducir[salirsesionde] ." ".$_SESSION[adminnombre]?>.</a>
        
    </div>   



</body>
</html>
