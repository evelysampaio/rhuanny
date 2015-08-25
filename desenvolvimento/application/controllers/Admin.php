<?php  

/**
* 
*/
class Admin extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();	
		$this->load->model("user_model");
		$this->load->model("permissao_model");
	}

	function index(){}
	function usuarios(){}	
	function permissoes(){}	
}
?>