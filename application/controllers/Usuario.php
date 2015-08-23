<?php  

/**
* 
*/
class Usuario extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();	
		$this->load->model("user_model");
	}

	function index(){	
		$this->mostrar();	        
	}

	function mostrar($usuarioNick = false){

		if( $usuarioNick ){
			// pegar usuario específico
		} else {
			$tabelaDeUsuarios = $this->user_model->pegarTodos();// mostrar todos os usuarios
		}		

		$dadosParaVisao = array(
								'tabelaDeUsuarios' => $tabelaDeUsuarios
								);

		$this->load->view("template/header.php", $dadosParaVisao);		
		$this->load->view("usuario/index", $dadosParaVisao);		
		$this->load->view("template/footer.php", $dadosParaVisao);
	}
	
	function cadastrar(){}
	function excluir(){}
	function editar(){}
}
?>