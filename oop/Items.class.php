<?

class Items {
	
	public $type;
	protected $smarty;
	protected $DB;
	protected $template;
	//protected $opParent = array('offset' => 0, 'limit' => 20, where => array());
	protected $op = array();
	
	function __construct() {
		$this->smarty = new Smarty();
		$this->DB = new DB();
		$this->template = $this->type.'-admin.tpl'; 
	}


	public function listar($where, $offset = 0, $limit = 20, $encabezado = true, $template = null) {
		
		
		if (count($where)) $this->op[where] = array_merge($this->op[where], $where);
		//print_r($this->op);
		if (empty($this->order)) $this->order = "nombre ASC";
		$q = $this->DB->select($this->op[table], $this->op[fields], $this->op[where], $this->order, $offset, $limit, false);
		$datos = $q->results;
		
		if ($template != 'json') {
			$this->smarty->assign('encabezado', $encabezado);	
			$this->smarty->assign('datos', $datos);
			// $this->smarty->debugging = true;

			$this->display($template);
		}
		else echo json_encode($datos);
	}
	
	public function update($params, $where) {
		$fields = implode(', ', $params);
		$where = $this->op[fieldUpdate]." = ".$where;
		if (empty($this->op[tableUpdate])) $this->op[tableUpdate] = $this->op[table];
		$this->DB->update($this->op[tableUpdate], $fields, $where);
			
	}
	
	public function delete ($where) {
		$where = $this->op[fieldUpdate]." = ".$where;	
		if (empty($this->op[tableUpdate])) $this->op[tableUpdate] = $this->op[table];
		$this->DB->delete($this->op[tableUpdate], $where);
	}
	
	
	public function editar($id) {
		
		if ($id != 0) {
			
			$datos = $this->DB->select($this->op[table], "*", $this->op[fieldUpdate]." = $id");	
			$this->smarty->assign('r', $datos->results[0]);
		}
		
		$this->template = $this->type."-editar.tpl";
		//$this->smarty->debugging = true;
		$this->display();
	}
	
	
	
	public function insert($params) {
		$q = $this->DB->insert($this->op[table], $params);	
		
		if (is_numeric($q)) $this->listar( array($this->op[fieldUpdate]." = $q"), 0, 1, false);
	}
	
	
	public function display($template = null) {
		if (!$template) $template = $this->template; 
		
		
		$this->smarty->display($template);
		$this->DB->navegacion();
		
	}
	
	
	public function search($term, $inheritWhere) {
		$terms = explode(" ", $term);
		foreach ($terms as $e) 
			$wheres[] = "nombre LIKE '%$e%'";
		
		if ($inheritWhere)
			foreach ($this->op[where] as $e)
			$wheres[] = $e;
		
		$this->listar($wheres, 0, 10, true, 'json');
	
	}
	

}


class Categoria extends Items {
	
	protected $op = array(table => 'categorias',
				 			   fields => 'id_cat, nombre',
							   where => array(),
							   fieldUpdate => "id_cat"
							   );
	
	public function __construct() {
		//$this->op = array_merge($this->opParent, $this->op);
		$this->type = 'categoria';
		parent::__construct();
	}
	
	public function editar($id, $parent) {
		
		$this->smarty->assign('parent', $parent);
		parent::editar($id);	
	}
	
	public function delete ($where) {
		//$where = $this->op[fieldUpdate]." = ".$where;	
		$borrar = array($where);
		$temp = new DB();
		$temp->select('categorias', 'id_cat', "parent = $where");
		foreach ($temp->results as $k)
			$borrar[] = $k[id_cat];
		$borrar = implode(', ', $borrar);	
		$temp->delete($this->op[table], "id_cat IN ($borrar) OR parent IN ($borrar)", true);
	}

}


class Proveedor extends Items {
	
	protected $op = array(table => 'clientes',
				 			   fields => 'id_cli, nombre',
							   where => array("tipo = 'proveedor'"),
							   fieldUpdate => "id_cli"
							   );
	
	public function __construct() {
		//$this->op = array_merge($this->opParent, $this->op);
		$this->type = 'proveedor';
		parent::__construct();
	}
	
	public function insert($params) {
		$params[tipo] = "proveedor";
		parent::insert($params);	
	}
	
	public function search($term) {
		$this->op[fields] = 'id_cli as id, nombre as value';
		parent::search($term, true);	
	}
	
	
	public function subirPorcentaje($id, $nombre) {
		$this->smarty->assign('id', $id);
		$this->smarty->assign('nombre', $nombre);
		$this->smarty->display('subir-porcentaje.tpl');	
	}
	
	public function subirAhora($id, $value) {
		if (!is_numeric($value)) return false;
		$value = 1 + $value / 100;
		$this->DB->update('materias_primas', "valor = (valor * $value)", "id_cli = $id");
		
		$items = new Materia();
		$items->actualizarPrecios(0, $id);
			
	}
	
	public function abrir($id) {
		$this->DB->select('clientes', '*', "id_cli = $id");
		$this->smarty->assign('cliente', $this->DB->results[0]);
		$this->smarty->assign('tipo', $this->type);
		$this->smarty->display("cliente-abierto.tpl");
	}

}


class Cliente extends Items {
	
	protected $op = array(table => 'clientes',
				 			   fields => 'id_cli, nombre',
							   where => array("tipo = 'cliente'"),
							   fieldUpdate => "id_cli"
							   );
	
	public function __construct() {
		//$this->op = array_merge($this->opParent, $this->op);
		$this->type = 'cliente';
		parent::__construct();
	}

	public function insert($params) {
		$params[tipo] = "cliente";
		parent::insert($params);	
	}
	
	public function search($term) {
		$this->op[fields] = 'id_cli as id, nombre as value';
		parent::search($term, true);	
	}
	
	public function abrir($id) {
		$this->DB->select('clientes', '*', "id_cli = $id");
		$this->smarty->assign('cliente', $this->DB->results[0]);
		$this->smarty->assign('tipo', $this->type);
		$this->smarty->display("cliente-abierto.tpl");
	}
}



class Materia extends Items {
	
	protected $op = array(table => 'materias_primas',
							where => array(),
				 			   fields => 'id_mat, nombre, valor, id_cli, unidad, stock, stock_minimo',
							   fieldUpdate => "id_mat"
							   
							   );
							   
	
	public function __construct() {
		//$this->op = array_merge($this->opParent, $this->op);
		$this->type = 'materia';
		parent::__construct();
	}



	public function listar($where, $offset = 0, $limit = 20, $encabezado = true, $template = null) {
			$this->generarUnidadesYProveedores();
			parent::listar($where, $offset, $limit, $encabezado, $template);
	}
	
	public function editar($id) {
		$this->generarUnidadesYProveedores();
		parent::editar($id);
	}
	
	public function search($term) {
		$this->op[fields] = 'id_mat as id, nombre as value, unidad, valor';
		parent::search($term, false);	
	}
	
	private function generarUnidadesYProveedores() {
			$tem = new DB();
			$temp = $tem->select('clientes', 'id_cli, nombre', "tipo = 'proveedor'", "nombre ASC");
			$proveedores = $tem->DBtoAssocArray($temp->results);
			$inicial = array(0=> 'Seleccione proveedor'); //agregae l x defecto	
			$proveedores = $inicial + $proveedores;
			
			
			$this->smarty->assign('proveedores', $proveedores);
			$this->smarty->assign('unidades', Config::$UNIDADES);
	}
	
	public function update($params, $id, $actualizarPrecios = true) {
		parent::update($params, $id);
		print_r($params);
		if ($actualizarPrecios) {
			$this->actualizarPrecios($id, 0);	
		}
	}
	
	public function actualizarPrecios($id_mat, $id_prov) {
		//echo "actiualidlxl";
		//if (is_array($id_mat)) $id_mat = implode(', ', $id_mat); //si es un array de materias las serializa
		if ($id_mat != 0) //por materia
			$consulta = "SELECT id_art, id_mat, cantidad, materias_primas.valor, auto_publico, auto_mayor, margen_recomendado, margen_mayor, datos_producto.valor, valor_mayor,
			SUM((materias_primas.valor * cantidad)) as costo_total
			FROM materias_producto 
			LEFT JOIN materias_primas USING (id_mat) 
			LEFT JOIN datos_producto USING (id_art)
			WHERE id_art IN 
			(SELECT id_art FROM materias_producto WHERE id_mat IN ($id_mat))  
			GROUP BY id_art";
		elseif (!empty($id_prov)) //por proveedor
			$consulta = "SELECT id_art, id_mat, cantidad, materias_primas.valor, auto_publico, auto_mayor, margen_recomendado, margen_mayor, datos_producto.valor, valor_mayor, 
			SUM((materias_primas.valor * cantidad)) as costo_total
			FROM materias_producto 
			LEFT JOIN materias_primas USING (id_mat) 
			LEFT JOIN datos_producto USING (id_art)
			WHERE id_art IN 
			(SELECT id_art FROM materias_producto LEFT JOIN materias_primas USING (id_mat) WHERE id_cli IN ($id_prov))  
			GROUP BY id_art";
		
		$this->DB->rawQuery($consulta); // toma los datos para actualizar de cada producrto que tenga esas materias o ese proveedor
		
		
		
		foreach ($this->DB->results as $e) 
			if (!empty($e[id_art])) {
				$campos = array($e[id_art],  $e[costo_total]); //prestablece el id y cosoto
				
				if ($e[auto_publico]) { //si es automtico el precio al publico
 					$valor_recomendado = $e[costo_total] * (1 + $e[margen_recomendado] / 100);	// lo calcula
					$campos[] = $valor_recomendado;
				}
				else $campos[] = $e[valor]; //sino el que ya esta
				
				if ($e[auto_mayor]) { //si es auto el rpoecio al pro mayor
					$valor_mayor = $e[costo_total] * (1 + $e[margen_mayor] / 100);	 //lo calcula y lo pneo en una array
					$campos[] = $valor_mayor;
				}
				else $campos[] = $e[valor_mayor];
				
				
				$registros[] = "(".implode(', ', $campos).")";
				
			}
			
		if (count($registros)) { //is hay productos que actualizar
		$query = "INSERT INTO datos_producto (id_art, valor_costo, valor, valor_mayor) VALUES ".implode(', ', $registros)." ON DUPLICATE KEY UPDATE valor_costo = VALUES(valor_costo), valor = VALUES(valor), valor_mayor = VALUES(valor_mayor)";	
		echo $query;
		mysql_query($query);	
		}
		
	} //actualizar precios

} //Materia clase






class Producto extends Items {
	
	protected $op = array(table => 'articulo LEFT JOIN datos_producto USING (id_art) LEFT JOIN categorias_articulo USING (id_art)',
							where => array(),
						  fields => 'nombre, articulo.id_art, codigo, valor, valor_mayor, auto_publico, auto_mayor',
						  tableUpdate => 'datos_producto',
						  fieldUpdate => "id_art");
							   
	
	public function __construct() {
		//$this->op = array_merge($this->opParent, $this->op);
		$this->type = 'producto';
		parent::__construct();
	}
	
	
	public function delete($where) {
		$this->op[tableUpdate] = "articulo";
		parent::delete($where);	
	}
	
	
	public function open($id) {
		$this->op[fields] = "articulo.*, datos_producto.*, GROUP_CONCAT(categorias_articulo.id_cat SEPARATOR '*') AS categorias";
		if (!empty($id)) $this->op[where][] = "id_art = $id";
		
		$this->DB->select($this->op[table], $this->op[fields], $this->op[where], null, 0, 1, false);
		return $this->DB->results;	
	}
	
	public function search($term) {
		
		$this->op[fields] = 'id_art as id, nombre as value, valor, valor_mayor';
		parent::search($term, false);	
	}
	
	public function variantes($id) {
		$q = $this->DB->select("variantes", 'id_var, variante', "id_art = $id");
		echo json_encode($q->results);
	}

	public function calcularInversion($value) {
		$data = json_decode($value);
		$this->DB->rawQuery("CREATE TEMPORARY TABLE inversion (id_art INT, cantidad INT)");
		$this->DB->insert("inversion", $data, false);
		
		$this->DB->rawQuery("SELECT aa.id_mat, aa.cantidad_final as requerida, bb.unidad, bb.nombre, bb.valor, bb.valor * (aa.cantidad_final - bb.stock) as costo, bb.stock,  aa.cantidad_final - bb.stock as a_comprar  
							FROM (
									SELECT x . * , SUM( x.cantidad_materia ) AS cantidad_final
									FROM (
										SELECT a . * , b.id_mat, a.cantidad * b.cantidad AS cantidad_materia
										FROM inversion as a
										LEFT JOIN materias_producto b
										USING ( id_art )
										) AS x
									GROUP BY x.id_mat) as aa
						LEFT JOIN materias_primas AS bb USING ( id_mat )"); 
		$this->smarty->assign('datos', $this->DB->results);
		$this->smarty->display('inversion.tpl');
		}
	
	public function guardarInversion($id, $value, $nombre, $total) {

		if ($id == 0) {
			$this->DB->insert("movimientos", array(tipo => "inversion", total => $total, descripcion => $nombre));
			$id = $this->DB->lastInsert();
			
		}
		else {
			$this->DB->update("movimientos", "descripcion = '$nombre', total = $total", "id_ses = $id");
			$this->DB->delete("movimientos_detalle", "id_ses = $id");
		}
		
		$value = json_decode($value);
		foreach ($value as &$e) {
			$e->id_ses = $id;
			$e->importe = $e->valor;
			unset($e->valor);
		}
		


		$this->DB->insert("movimientos_detalle", $value);
		echo json_encode(array(status => "ok", id => $id));
	}
	
	public function cargarInversion($id) {
		$this->DB->select("movimientos_detalle", "id_art as id, nombre as value, cantidad, importe as valor, valor_unitario as valor_mayor", "id_ses = $id");
		$resultados = $this->DB->results;
		$this->DB->select("movimientos", "descripcion", "id_ses = $id");
		echo json_encode(array(status => "ok", results => $resultados, nombre => $this->DB->results[0][descripcion]));
	}
	
	public function eliminarInversion($id) {
		$this->DB->delete("movimientos", "id_ses = $id");
	}
	
}
	

class Movimiento extends Items {
	
	protected $op = array(table => 'movimientos',
							where => array(),
						  fields => 'movimientos.*',
						  tableUpdate => 'movimientos',
						  fieldUpdate => "id_ses");
	protected $order = 'id_ses DESC';					   
	private static $data;
	
	public function __construct() {
		//$this->op = array_merge($this->opParent, $this->op);
		$this->type = 'movimiento';
		parent::__construct();
	}
	
	public function guardar($value) {
		$data = json_decode($value);	
		$detalle = $data->detalle;
		
		
		$arr = (array) $data;
		unset($arr[id]);
		unset($arr[detalle]);
		$arr[fecha] = Utils::dmy2ymd($arr[fecha]).' 00:00:00';	
		if ($data->id == 0) {
			$arr[saldo] = $this->ultimoSaldo($arr[id_cli]) + $this->darSignoSegunMovimiento($arr[total], $arr[tipo], $arr[status]);
			$this->DB->insert("movimientos", $arr);
			$id = $this->DB->lastInsert();
			$verSaldo = false;
		}
		else {
			$id = $data->id;
			
			/////////////////TODO hacer lo del stock
			$this->deshacerMovimientoDeStock($id, $data->status, $data->tipo);
			$this->DB->update("movimientos", $arr, "id_ses = $id");
			$this->DB->delete("movimientos_detalle", "id_ses = $id");
			$verSaldo = true;
		}
		
		
		foreach ($data->detalle as &$e) {
			$e->id_ses = $id;
			if ($data->tipo == 'pago') {
				if (!empty($e->fecha_emision)) $e->fecha_emision = Utils::dmy2ymd($e->fecha_emision);
				if (!empty($e->fecha_cobro)) $e->fecha_cobro = Utils::dmy2ymd($e->fecha_cobro);
			}
		}
		if (count($data->detalle)) 
			$this->DB->insert("movimientos_detalle", $data->detalle);
		
		if ($verSaldo) {
			$this->actualizarSaldo($arr[id_cli], $id);
		}

		$this->actualizarStock($detalle, $arr[tipo], $arr[status], false);

		echo json_encode(array(status => "ok", id => $id));
		return;
	}
	
	public function cargar($id) {
		$this->DB->select("movimientos_detalle", "id_art as id, nombre as value, cantidad, valor_unitario as valor, importe as valor_mayor", "id_ses = $id");
		$resultados = $this->DB->results;
		$this->DB->select("movimientos LEFT JOIN clientes USING (id_cli)", "movimientos.*, clientes.nombre as cliente", "id_ses = $id");
		$this->DB->results[0][fecha] = Utils::ymd2dmy($this->DB->results[0][fecha]);
		echo json_encode(array(status => "ok", results => $resultados, movimiento => $this->DB->results[0]));
	}
	
	public function eliminar($id, $id_cli) {
		$this->DB->delete("movimientos", "id_ses = $id", true);
		$this->actualizarSaldo($id_cli, $id);
		
	}
	
	private function ultimoSaldo($id_cli, $hastaId = 0) {
		$hasta = ($hastaId) ? "AND id_ses < $hastaId" : "";
		$this->DB->select('movimientos', 'saldo', "id_cli = $id_cli $hasta", "id_ses DESC", 0, 1);
		return count($this->DB->results) ? $this->DB->results[0][saldo] : 0;	
	}
	
	private function darSignoSegunMovimiento($importe, $tipo, $status = '') {
		//TODO devolver mas o menos segun movimiento
		if ($tipo == 'pago' || $tipo == 'nota de credito' || $tipo == 'nota_credito')
			return -$importe;
		else
			return $importe;
	}
	
	public function listar($id, $tipo, $offset) {
		
		$wher = array("id_cli = $id");
		if (!empty($tipo)) $wher[] = "tipo = '$tipo";
		parent::listar($wher, $offset, 20, true);
	}

	public function actualizarSaldo($id_cli, $desdeId = 0) {
		$saldo = ($desdeId) ? $this->ultimoSaldo($id_cli, $desdeId) : 0;
		$this->DB->select('movimientos', 'id_ses, tipo, total', "id_cli = $id_cli AND id_ses >= $desdeId", "id_ses ASC" );
		$registros = array();
		foreach ($this->DB->results as $e) {
			$saldo += $this->darSignoSegunMovimiento($e[total], $e[tipo]);
			$registros[] = "($e[id_ses], $saldo)";
		}
		$query = "INSERT INTO movimientos (id_ses, saldo) VALUES ".implode(', ', $registros)." ON DUPLICATE KEY UPDATE saldo = VALUES(saldo)";	
		$this->DB->rawQuery($query);
		
	} 
	

	public function actualizarStock($detalle, $tipo, $status, $deshacer) {
		if ($tipo == 'pago') return;
		$detallea = (array) $detalle;
		// print_r($detallea);
		foreach ($detallea as $e) {
			$e = (array) $e;
			if ($status == 'proveedor')
				$consultas[] = "($e[id_art], ".$this->darSignoStock($e[cantidad], $status, $tipo, $deshacer) .")"; 
			else if (!empty($e[id_var]))
				$consultas[] = "($e[id_var], ".$this->darSignoStock($e[cantidad], $status, $tipo, $deshacer) .")"; 
		}
		if (count($consultas)) {
			if ($status == 'proveedor')
				$query = "INSERT INTO materias_primas (id_mat, stock) VALUES ".implode(", ", $consultas). " ON DUPLICATE KEY UPDATE stock = stock + VALUES(stock)";
			else
				$query = "INSERT INTO variantes (id_var, stock) VALUES ".implode(", ", $consultas). " ON DUPLICATE KEY UPDATE stock = stock + VALUES(stock)";
			// echo $query;
			$this->DB->rawQuery($query);
		}
	}

	public function deshacerMovimientoDeStock($id, $tipoCliente, $tipoMovimiento) {
		$conds = ($tipoCliente == 'cliente') ? "id_art != 0 AND id_var != 0 AND id_ses = $id" : "id_art != 0 AND id_ses = $id";
		$this->DB->select('movimientos_detalle', 'cantidad, id_var, id_art', $conds);
		$this->actualizarStock($this->DB->results, $tipoMovimiento, $tipoCliente, true);
	}
	
	public function darSignoStock($cantidad, $tipoCliente, $tipoMovimiento, $paraDeshacer = false) {
		if ($tipoCliente == 'cliente') {
			$cantidad = -$cantidad;
		}	
		if ($tipoMovimiento == 'nota de credito') {
			$cantidad = -$cantidad;
		}	
		return ($paraDeshacer) ? -$cantidad : $cantidad;
	}
	


	public function listados($params) {
		// print_r($params);
		$desde = Utils::dmy2ymd($params[de_fecha]);
		$hasta = Utils::dmy2ymd($params[hasta_fecha]);
		switch ($params[fuente]) {
		    case 0:
		        $ivaCompras = "AND iva_movimiento = 0";
		        break;
		    case 1:
		        $ivaCompras = "AND iva_movimiento = 1";
		        break;
		    case 2:
		        $ivaCompras = "AND iva_movimiento = 2";
		        break;
		    case -1:
		        $ivaCompras = "";
		        break;
		}

		switch ($params[venta]) {
		    case 0:
		        $ivaVentas = "AND iva_movimiento = 0";
		        break;
		    case 1:
		        $ivaVentas = "AND iva_movimiento = 1";
		        break;
	       case 2:
		        $ivaVentas = "AND iva_movimiento = 2";
		        break;
		    case 3:
		        $ivaVentas = "AND iva_movimiento > 0";
		        break;
		    case -1:
		        $ivaVentas = "";
		        break;
		}



		$consulta = "SELECT a.*, b.nombre as nombre_cli FROM movimientos a LEFT JOIN clientes b USING (id_cli) WHERE fecha >= '$desde 00:00:00' AND fecha <= '$hasta 00:00:00' AND a.tipo = 'compra' AND ((status = 'cliente' $ivaVentas) OR (status = 'proveedor' $ivaCompras)) ORDER BY fecha ASC";
		// echo $consulta;
		$q = mysql_query($consulta) or die(mysql_error());
		$compras = array();
		$ventas = array();
		$totales = array();
		while ($r = mysql_fetch_assoc($q)) {
			if ($r[iva_movimiento] == 1) {

				$r[iva] = $r[total] / 1.21 * 0.21;
				$r[comprobante] = "FC B";
			}
			elseif ($r[iva_movimiento] == 2) {
				$r[iva] = $r[total] / 1.21 * 0.21;
				$r[comprobante] = "FC A";
			}
			else {
				$r[comprobante] = "SIN FC";
				$r[iva] = 0;
			}

			if ($r[status] == 'cliente') {
				$ventas[] = $r;
				$totales[ventas] += $r[total]; 
				$totales[ivaVentas] += $r[iva]; 
			} else {
				$compras[] = $r;
				$totales[compras] += $r[total]; 
				$totales[ivaCompras] += $r[iva]; 
			}

		}
		// print_r($totales);
		$this->smarty->assign('totales', $totales);
		$this->smarty->assign('ventas', $ventas);
		$this->smarty->assign('compras', $compras);
		// $this->smarty->debugging = true;
		$this->smarty->display('balances.tpl');

	}

}


class Pago extends Items {
	
	protected $op = array(table => 'formas_pago',
							where => array(),
						  fields => 'formas_pago.*',
						  tableUpdate => 'formas_pago',
						  fieldUpdate => "id");
	protected $order = '';					   
	private static $data;
	
	public function __construct() {
		$this->type = 'pago';
		parent::__construct();
	}
	
	public function editar($id, $id_cli, $compraId = 0) {
		if ($compraId) {
			$this->DB->select('movimientos', 'id_ses', "pago = $compraId");
			$id = $this->DB->results[0][id_ses];
			echo "[[[[$id]]]]";
		}
		$this->smarty->assign('mov', array(id_ses => $id, id_cli => $id_cli));
		if ($id) {
		$this->DB->select('movimientos', 'fecha', "id_ses = $id");
		$this->smarty->assign('fecha', Utils::ymd2dmy($this->DB->results[0][fecha]));
		$this->DB->select('movimientos_detalle', '*', "id_ses = $id");
		foreach ($this->DB->results as &$e) {
			$e[fecha_emision] = Utils::ymd2dmy($e[fecha_emision]);
			$e[fecha_cobro] = Utils::ymd2dmy($e[fecha_cobro]);
		}
		$this->smarty->assign('detalles', $this->DB->results);
		}
		$this->DB->select('formas_pago', 'nombre');
		$this->smarty->assign('formas_pago', $this->DB->results);

		$this->display('pago-editar.php');
	}
	
	public function search($term) {
		
		$this->op[fields] = 'id as id, nombre as value';
		parent::search($term, false);	
	}
	
	public function preguntarPorPago() {
		$this->smarty->display('preguntar-por-pago.tpl');
	}
	
	public function preguntarQueSigue() {
		$this->smarty->display('preguntar-que-sigue.tpl');
	}
}




	class Cheques extends Items {
	
	public function __construct() {
		//$this->op = array_merge($this->opParent, $this->op);
		$this->type = 'cheques';
		parent::__construct();
	}

	public function listados($params) {
		$wheres[] = "c.tipo = '$params[fuente]'";
		$wheres[] = "b.tipo = 'pago'";
		if ($params[activo] != -1) $wheres[] = "a.activo = '$params[activo]'";
		$wheres[] = empty($params[nombre]) ? "(a.nombre LIKE '%cheque propio%' OR a.nombre LIKE '%cheque de terceros%')" : "a.nombre LIKE '%$params[nombre]%'";
		if (!empty($params[de_fecha])) $wheres[] = "(a.fecha_emision > '".Utils::dmy2ymd($params[de_fecha])."' OR a.fecha_cobro > '".Utils::dmy2ymd($params[de_fecha])."' OR a.fecha_cobro = '0000-00-00 00:00:00')";
		if (!empty($params[hasta_fecha])) $wheres[] = "(a.fecha_emision < '".Utils::dmy2ymd($params[hasta_fecha])."' OR a.fecha_cobro < '".Utils::dmy2ymd($params[hasta_fecha])."' OR a.fecha_cobro = '0000-00-00 00:00:00')";

		$consulta = "SELECT a.*, c.nombre as nombre_cli, id_cli FROM movimientos b LEFT JOIN movimientos_detalle a USING(id_ses) LEFT JOIN clientes c USING (id_cli) WHERE ".implode(" AND ", $wheres);
		// echo $consulta."<br><br><br><br>";
		$this->DB->rawQuery($consulta);
		foreach($this->DB->results as &$e) {
			$e[fecha_emision] = Utils::ymd2dmy($e[fecha_emision]);
			$e[fecha_cobro] = Utils::ymd2dmy($e[fecha_cobro]);
			$e[nombre] = ucfirst(str_replace('cheque ', '', $e[nombre]));
		}

		$this->smarty->assign('params', $params);
		$this->smarty->assign('datos', $this->DB->results);
		$this->smarty->display('cheques.tpl');

	}

	public function modificar($params) {
		$this->DB->update("movimientos_detalle", "activo = $params[activo]", "id_mov = $params[id]", true);
	}

}


class Retenciones extends Items {
	
	public function __construct() {
		//$this->op = array_merge($this->opParent, $this->op);
		$this->type = 'cheques';
		parent::__construct();
	}

	public function listados($params) {
		$wheres[] = "recargo != 0";
		if (!empty($params[fuente])) $wheres[] = "c.tipo = '$params[fuente]'";
		if (!empty($params[de_fecha])) $wheres[] = "a.fecha > '".Utils::dmy2ymd($params[de_fecha])." 00:00:00'";
		if (!empty($params[hasta_fecha])) $wheres[] = "a.fecha < '".Utils::dmy2ymd($params[hasta_fecha])." 00:00:00'";

		$consulta = "SELECT a.*, c.nombre as nombre_cli, id_cli, c.tipo as tipo_cli FROM movimientos a LEFT JOIN clientes c USING (id_cli) WHERE ".implode(" AND ", $wheres);
		$this->DB->rawQuery($consulta);
		foreach($this->DB->results as &$e) {
			$e[fecha] = date('d-m-Y', strtotime($e[fecha]));
		}

		$this->smarty->assign('params', $params);
		$this->smarty->assign('datos', $this->DB->results);
		$this->smarty->display('retenciones.tpl');

	}



}

?>