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
										'titulo' => 'Página inicial'
										
									 );

		//pegar lista de permissões e repassar para view
		$this->load->view("template/header.php", $dadosPaginaInicial);		
		$this->load->view("paginaInicial/index", $dadosPaginaInicial);
		$this->load->view("template/footer.php", $dadosPaginaInicial);
  
	}	

	private function _loadUserPermissions(){
        
        $this->load->model('permissao_model');
        $_SESSION['permissoes'] = $this->permissao_model->pegarPermissaoPorUsuarioNick( $_SESSION['usuario']['nick'] );        

    }
}
?>