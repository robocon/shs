<?php

/**
 * 
 */
class View 
{
	private $path = null;
	private $template = 'default';
	private $data = array();
	
	function __construct($name)
	{
		$this->path = APP_DIR.'views/'.$name.'.php';
	}
	
	public function set_val($items){
		$this->data = $items;
	}
	
	public function set_template($template = null){
		$this->template = $template;
	}
	
	public function render(){
		
		extract($this->data);
		
		ob_start();
		require(APP_DIR.'views/templates/'.$this->template.'/header.php');
		require($this->path);
		require(APP_DIR.'views/templates/'.$this->template.'/footer.php');
		echo ob_get_clean();
	}
}
