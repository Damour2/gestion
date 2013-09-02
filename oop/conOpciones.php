<?

abstract class ConOpciones {

	//protected $options = array();

	function __construct($ops = array()) {
		$this->updateOptions($ops);	
	}

	protected function updateOptions($ops) {
		$this->options = array_merge($this->options, $ops);
	}

}
?>