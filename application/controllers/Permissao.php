<?php  

/**
* 
*/
class Permissao extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();	
		$this->load->model("user_model");
	}

	function index(){	
		$this->mostrar();        
	}

	function mostrar( $usuarioNick = false ){}	
	function cadastrar(){}
	function excluir(){}
	function editar(){}
}
?>