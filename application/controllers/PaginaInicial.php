<?php  

/**
* 
*/
class PaginaInicial extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();	
	}

	function index(){


		$this->load->model("user_model");
		//$this->load->helper('url');
		$tabelaDeUsuarios = $this->user_model->pegarTodos();

		$dadosPaginaInicial = array(
										'titulo' => 'Página inicial',
										'mensagem' => 'Bem vindo, ' . $_SESSION['nick'] . '!!!',
										'usuarioPermissoes' => $_SESSION['permissoes'],
										'tabelaDeUsuarios' => $tabelaDeUsuarios
									 );

		//pegar lista de permissões e repassar para view
		$this->load->view("template/header.php", $dadosPaginaInicial);		
		$this->load->view("paginaInicial/index", $dadosPaginaInicial);
		$this->load->view("template/footer.php", $dadosPaginaInicial);
		
        
	}	
}
?>