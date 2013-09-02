{config_load file="test.conf" section="setup"}
{include file="estilos.tpl" title=foo}


<h2>Estos son tus datos de acceso, {$nombre|capitalize}  <br />
	para ingresar en <b>Tucuman Ofertas</b></h2>
    

<p>Usuario: <b>{$usuario}</b></p>
<p>Contraseña: <b>{$pass}</b></p>

<br />
<p>Esperamos que nuestra plataforma te sea útil para vender y encontrar todo lo que necesitas.</p>
<p>Saludos, </p>

<p>El equipo de <b>Tucumán Ofertas</b></p>

{include file="footer.tpl" title=foo}