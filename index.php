<? 
include "oop/init.php";
$seguridad = new Seguridad($config, 2);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$config->title?></title>
<link rel="stylesheet/less" type="text/css" href="styles.css">
<script src="library/less-1.1.5.min.js" type="text/javascript"></script>
<script src="library/js/jquery-1.8.2.js"></script>
</head>

<body>

<div id="container" style='height:100%'>
    	
        <div id="top">
			<div class='content'>
            	<img src="img/logo.png" onclick="window.location = index.php" />
            	<h1>Administrador Libo</h1>
            </div>
        </div>
        
        <div class="content" id="index">
        	<p><a class='boton' href="in.php?accion=articulo&que=producto"><?=$traducir[agregarproducto]?></a>
             <a class='boton' href="in.php?accion=administrador&que=producto">Administrar productos</a>
             <a class='boton' href="in.php?accion=administrador&que=materia">Materias Primas</a>
             <a class='boton' href="in.php?accion=faltantes">Faltantes</a>
             </p>
             <p>
             <a class='boton' href="in.php?accion=administrador&que=proveedor">Proveedores</a>
             <a class='boton' href="in.php?accion=administrador&que=cliente">Clientes</a>
             <a class='boton' href="in.php?accion=categorias">Categorías</a>
            </p>
            <p>
                <a class="boton" href="in.php?accion=inversion">Inversión</a>
                <a class="boton" href="in.php?accion=compras&status=proveedor">Operacion con proveedores</a>
                <a class="boton" href="in.php?accion=compras&status=cliente">Operacion con clientes</a>
             </p>  
             <p>
            	<a class="boton" href="in.php?accion=cheques">Cheques</a>
                <a class="boton" href="in.php?accion=retenciones">Retenciones</a>
                <a class="boton" href="in.php?accion=balances">Balances</a>
             </p>   
            <!--<p>
            <a class='boton' href="in.php?accion=administrador"><?=$traducir[adminarticulos]?></a>
            <a class='boton' href="in.php?accion=categorias"><?=$traducir[admincategorias]?></a>
            <a class='boton' href="in.php?accion=imagenes"><?=$traducir[agregarimagenes]?></a>
            </p>
            <p><a class='boton' href="in.php?accion=compras&estado=pendiente">Administrar compras</a></p>-->
            
            
             <div id="notificaciones">
        	<?
				$DB->select('variantes', 'COUNT(*) as cuantos', 'stock < stock_minimo AND stock_minimo > 0 AND stock_minimo IS NOT NULL AND stock IS NOT NULL');
				$artsFaltantes = $DB->results[0][cuantos];
				
				$DB->select('materias_primas', 'COUNT(*) as cuantos', 'stock < stock_minimo AND stock_minimo > 0 AND stock_minimo IS NOT NULL AND stock IS NOT NULL');
				$matsFaltantes = $DB->results[0][cuantos];
				
				if ($artsFaltantes) echo "<p>Hay <a href='in.php?accion=faltantes'>$artsFaltantes artículos </a>con stock por bajo del mínimo.</p>";
				if ($matsFaltantes) echo "<p>Hay <a href='in.php?accion=faltantes'>$matsFaltantes materias </a>con stock por bajo del mínimo.</p>";
				
			?>
            </div>
            
            <div id='deudas'>
                <?
                $DB->rawQuery("SELECT a.id_cli, a.saldo, b.ultimo, clientes.nombre, clientes.tipo
                                FROM movimientos a
                                INNER JOIN 
                                (SELECT id_cli, MAX(id_ses) as ultimo FROM `movimientos` b WHERE tipo != 'inversion' GROUP BY id_cli) as b ON a.id_ses = b.ultimo 
                                LEFT JOIN clientes ON b.id_cli = clientes.id_cli
                                WHERE a.saldo != 0 ORDER by clientes.tipo");
                $provOpen = false;
                $cliOpen = false;

                foreach ($DB->results as $deuda) {
                    if ($deuda[tipo] == 'cliente' && !$cliOpen) {
                         echo "<h4>Deudas de clientes</h4>";
                        $cliOpen = true;
                    }
                    if ($deuda[tipo] == 'proveedor' && !$provOpen) {
                        echo "<h4>Deudas a proveedores</h4>";
                        $provOpen = true;
                    }

                    echo "<p id='$deuda[id_cli]'><span class='nombre'><a href='in.php?accion=cc&tipo=$deuda[tipo]&id=$deuda[id_cli]'>$deuda[nombre]</a></span><span class='deuda'>$deuda[saldo]</span></p>";

                }

                                ?>

            </div>



            
        </div>

        <a class='boton' href="login.php?logout" style="position:absolute; bottom:30px; right:30px;"> <?=$traducir[salirsesionde] ." ".$_SESSION[nombre]?>.</a>
        
        
       
    </div>   


<script type="text/javascript">
    $(document).ready(function() {
        update();
        
        $(window).resize(function() {
            update();
        })
    })

    function update() {
        $('#deudas').height($(window).height()-140);
    }
</script>

</body>
</html>