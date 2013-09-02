<?

session_cache_expire(120);
session_start();

if (!isset($_SESSION[cantidadproductos])) $_SESSION[cantidadproductos] = 0;
if (!isset($_SESSION[importe]))  $_SESSION[importe] = 0; 
if (!isset($_SESSION[carro])) $_SESSION[carro] = array();
if (!isset($_SESSION[autorizacion])) $_SESSION[autorizacion] = 0;
if (!isset($_SESSION[id_cli])) $_SESSION[id_cli] = 0;








?>