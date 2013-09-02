<?
class Component extends ConOpciones {
	
	protected $options = array('nombre' => '', 
								'values' => '',
								'id' => '',
								'selected' => '',
								'type' => 'text',
								'class' => '',
								'label' => false,
								'container' => '',
								'onclick' => '',
								'href' => '#',
								'subtype' => '' // key_value para los select que son distintos los value de los contenidos
								);
	
	
	public function Component($ops = array()) {
		parent::__construct($ops);
	
	}
	
	
	public function display() {
		$op = $this->options;
		
		if (!empty($op[container])) echo "<$op[container] class='$op[class]'>";
		if ($op[label]) echo "<label>".ucfirst($op[nombre])."</label>";
		 
		switch ($op[type]){
			
			case 'text':
				if (empty($op[id])) $op[id] = $op[nombre]; 
				echo "<input type='text' class='$op[class]' id='$op[id]' name='$op[id]' value='$op[value]' placeholder='$op[placeholder]' />"; 
				break;
			
			case 'submit': 
				if (empty($op[values])) $op[values] = ucfirst($op[nombre]);
				echo "<input type='submit' value='$op[values]' />";
				break;
			
			case 'boton' :
				if (empty($op[values])) $op[values] = ucfirst($op[nombre]);
				echo "<a class='boton $op[class]' href='$op[href]' onclick='$op[onclick]' title='$op[nombre]'>$op[values]</a>";
				break;
			
			case 'select' :
				
				echo "<select id='$op[nombre]' name='$op[nombre]' class='$op[class]'>";
					for ($i = 0; $i < count($op[values]); $i++) {
						$selected = ($op[selected] == $op[values][$i]) ? "selected='selected'" : '';
						if ($op[subtype] == 'key_value') // si tienen dos valores distinos
							{
								if ($i % 2 == 0) echo "<option value='".$op[values][$i]."' $selected>".$op[values][($i+1)]."</option>";
							}
						else echo "<option value='".$op[values][$i]."' $selected>".$op[values][$i]."</option>";
					
						}
				echo "</select>"; 	
				break;
		}
			
		if (!empty($op[container])) echo "</$op[container]>";
	}
}
?>