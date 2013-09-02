<?

class Form extends ConOpciones{
	
	protected $options = array('id' => '', 'action' => '',
								'method' => 'get',
								'target' => '',
								'components' => array()
								);
	
	public function Form ($ops) {
		parent::__construct($ops);
		
	}
	
	public function display() {
		$op = $this->options;
		echo "<form id='$op[id]' action='$op[action]'>";
		if (count($op[components]))	
			foreach ($op[components] as $e)
				{
					
					$e->display();
				}
		echo "</form>";
	}
	

	
}