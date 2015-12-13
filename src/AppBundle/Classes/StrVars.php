<?php 
namespace AppBundle\Classes;
class StrVars{

	private $str;

	public function __construct($var){
		ob_start();
			echo "<pre>";
				var_export($var);
			echo "</pre>";
		$content=ob_get_clean();
		$this->str=$content;
	}
	public function getStr(){
		return $this->str;
	}
}