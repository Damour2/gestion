<?php /* Smarty version Smarty-3.1.11, created on 2012-08-02 23:43:39
         compiled from ".\templates\registro.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18769501af2284987d0-70531380%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e477e10e6ed894a35a7b91c16b02b68b21feaef' => 
    array (
      0 => '.\\templates\\registro.tpl',
      1 => 1343943605,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18769501af2284987d0-70531380',
  'function' => 
  array (
  ),
  'cache_lifetime' => 120,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_501af2285ab2c7_14795399',
  'variables' => 
  array (
    'nombre' => 0,
    'usuario' => 0,
    'pass' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_501af2285ab2c7_14795399')) {function content_501af2285ab2c7_14795399($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>
<?php echo $_smarty_tpl->getSubTemplate ("estilos.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('title'=>'foo'), 0);?>

<p><img src="http://www.tucumanofertas.com/v1/img/logo_front.png" /></p>

<h2>Felicitaciones, <?php echo $_smarty_tpl->tpl_vars['nombre']->value;?>
 <br />
	ya eres parte de <b>Tucuman Ofertas</b></h2>
    
<p>Tus datos de acceso son: </p>
<p>Usuario: <b><?php echo $_smarty_tpl->tpl_vars['usuario']->value;?>
</b></p>
<p>Contraseña: <b><?php echo $_smarty_tpl->tpl_vars['pass']->value;?>
</b></p>

<br />
<p>Esperamos que nuestra plataforma te sea útil para vender y encontrar todo lo que necesitas.</p>
<p>Saludos, </p>

<p>El equipo de <b>Tucumán Ofertas</b></p>

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('title'=>'foo'), 0);?>
<?php }} ?>