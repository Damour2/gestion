<?
// error_reporting(E_ALL ^ E_NOTICE);
include "oop/init.php";
$seguridad = new Seguridad($config, 2);


$accion = Utils::cargar('accion', 'listar');
$que = Utils::cargar('que', 'producto');
$categoria = Utils::cargar('categoria', '0');
$parent = Utils::cargar('parent', '');
$nombre = Utils::cargar('nombre', '');
$proveedor = Utils::cargar('proveedor', 0);
$cliente = Utils::cargar('cliente', 0);
$offset = Utils::cargar('offset', 0);
$campo = Utils::cargar('campo', '');
$value = Utils::cargar('value', '');
$id = Utils::cargar('id', 0);
$template = Utils::cargar('template', '');
$total = Utils::cargar('total', 0);


$options = array('producto' => array(table => 'articulo LEFT JOIN datos_producto USING (id_art)',
									  fields => 'nombre, articulo.id_art, codigo, valor, valor_mayor, stock, stock_minimo',
									  update => 'articulo'),
				 'proveedor' => array(table => 'clientes',
				 					   fields => 'id_cli, nombre'),
				 'materia_prima' => array(table => 'materias_primas',
				 						  fields => 'id_mat, nombre, valor, id_cli, unidad')
				 );

//condiciones
$params = array();

		$items = new $que();
		
switch ($accion) {
	case 'listar':	
		if ($nombre != '') $params[] = "nombre LIKE '%".Utils::escapar($nombre)."%'";
		if (!empty($categoria)) $params[] = "id_cat = $categoria"; 
		if (!empty($proveedor)) $params[] = "id_cli = $proveedor";
		if (!empty($cliente)) $params[] = "id_cli = $cliente";
		if (!empty($fuente)) $params[] = "status = $fuente";
		if (is_numeric($parent)) $params[] = "parent = $parent";
		$items->listar($params, $offset, 20);
		break;
	case 'update':
		$actualizarPrecios = false; //no se actualiza el valor de las materias
		if (!empty($value) and !empty($campo)) {
			$params[] = "$campo = '".Utils::escapar($value)."'";
			if ($campo == 'valor' and $que == 'materia') $actualizarPrecios = true; //si es una materia a la que se le cambia el valor si
		}
		else {
			unset($_POST[que]);
			unset($_POST[accion]);
			unset($_POST[id]);
			foreach ($_POST as $k => $v)
				$params[] = "$k = '".Utils::escapar($v)."'";
			if ($que == 'materia' and array_key_exists('valor', $_POST)) $actualizarPrecios = true; //si es una materia a la que se le cambia el valor si
		}
				
		$items->update($params, $id, $actualizarPrecios);
		break;
	case 'delete':
		$items->delete($id);
		break;
		
	case 'editar':
		
		$items->editar($id, $parent, $compraId); //compraId solo lo usa el pago
		break;
	case 'insert':
		unset($_POST[que]);
		unset($_POST[accion]);
		unset($_POST[id]);
		foreach ($_POST as $k => $v)
				$params[] = "$k = '".Utils::escapar($v)."'";
		
		$items->insert($_POST);
		break;
	case 'search':
		$items->search($_REQUEST[term]);
		break;
	case 'subirPorcentaje':
		$items->subirPorcentaje($id, $nombre);
		break;
	case 'subirAhora':
		$items->subirAhora($id, $value);
		break;
	case 'calcularInversion':
		$items->calcularInversion($value);
		break;
	case 'guardarInversion': 
		$items->guardarInversion($id, $value, $nombre, $total);
		break;
	case 'cargarInversion': 
		$items->cargarInversion($id);
		break;
	case 'eliminarInversion':
		$items->eliminarInversion($id);
		break;
	case 'guardar':
		$items->guardar($value);
		break;
	case 'cargar':
		$items->cargar($id);
		break;
	case 'eliminar':
		$items->eliminar($id, $cliente);
		break;
	case 'preguntarPorPago':
		$items->preguntarPorPago();
		break;
	case 'preguntarQueSigue':
		$items->preguntarQueSigue();
		break;	
	case 'variantes':
		$items->variantes($id);
		break;
	case 'listados':
		$items->listados($_GET);
		break;
	case 'modificar':
		$items->modificar($_GET);
		break;
}






		
			







?>