<?php  

/**
* 
*/
class PaginaInicial extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();	
		$this->_loadUserPermissions();
	}

	function index(){


		$dadosPaginaInicial = array(
										'titulo' => 'Página inicial',
										'mensagem' => 'Bem vindo, ' . $_SESSION['nick'] . '!!!',
										'usuarioPermissoes' => $_SESSION['permissoes'],
									 );

		//pegar lista de permissões e repassar para view
		$this->load->view("template/header.php", $dadosPaginaInicial);		
		$this->load->view("paginaInicial/index", $dadosPaginaInicial);
		$this->load->view("template/footer.php", $dadosPaginaInicial);
  
	}	

	private function _loadUserPermissions(){
        
        $this->load->model('permissao_model');
        $_SESSION['permissoes'] = $this->permissao_model->pegarPermissaoPorUsuarioNick( $_SESSION['nick'] );        

    }
}
?>