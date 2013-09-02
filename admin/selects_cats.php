<?
include "../library/conexion.php";
include "../library/auxiliares.php";
?>

<div>
      <select name="categoria_primaria" id="categoria_primaria">
          <option value="0">Seleccione</option>
          <? $parent = listarCategorias(array('tipo' => 'principales', container => 'option', seleccionados => $categorias)); ?>
      </select>
      
      <select name="categoria_secundaria" id="categoria_secundaria">
          <option value="0">Seleccione</option>
      </select>
      
      <select name="categoria_terciaria" id="categoria_terciaria">
          <option value="0">Seleccione</option>
      </select>
      <img src="../img/borrar.png" title="Borrar" onclick="borrarCat(this)">
</div>