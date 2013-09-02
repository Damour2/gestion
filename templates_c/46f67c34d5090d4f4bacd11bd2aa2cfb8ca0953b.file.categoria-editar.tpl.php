<?php /* Smarty version Smarty-3.1.11, created on 2012-09-14 18:39:40
         compiled from "./templates/categoria-editar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13092998215053a41ced8504-24957408%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46f67c34d5090d4f4bacd11bd2aa2cfb8ca0953b' => 
    array (
      0 => './templates/categoria-editar.tpl',
      1 => 1346181894,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13092998215053a41ced8504-24957408',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'r' => 0,
    'parent' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5053a41d0fd615_05131659',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5053a41d0fd615_05131659')) {function content_5053a41d0fd615_05131659($_smarty_tpl) {?>
    	
   
     
       <input type="hidden" id="id" name="id" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['id_cat'];?>
" />
       <input type="hidden" id="parent" name="parent" value="<?php echo $_smarty_tpl->tpl_vars['parent']->value;?>
" />

		<label>Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['nombre'];?>
" />
     
        
        <a class="boton rojo" onClick="cerrar_ventana()">Descartar</a> 
        <a class="boton azul" onClick="guardar()">Guardar</a>
        <img class="loader" src="img/loader.gif"><?php }} ?>