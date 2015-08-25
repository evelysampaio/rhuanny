<?php 

/**
* Classe de acesso somente para pessoas logadas.
*/
class MY_Controller extends CI_Controller
{	
	function __construct()
	{
		parent::__construct();
		
		//verifica login
		if( !isset($_SESSION['estaLogado']) ){
			show_error('Você precisa estar logado para acessar essa página.');			
		} 
		//verificar permissão
		if( !$this->_usuarioTemPermissao() ){
			show_error('Você não possui privilégios para acessar essa página');			
		} 

	}

	private function _usuarioTemPermissao(){
	
		$controllerName = $this->router->fetch_class(); // class = controller
		$methodName 	= $this->router->fetch_method();
		$url 			= $controllerName . '/' . $methodName;			

		if($url == 'paginainicial/index') { //sempre tem permissao para pagina inicial do sistema
			return true;
		} else {
			foreach ( (array)$_SESSION['permissoes'] as $row) {			
				if ( $url == $row['url'] ) 
					return true;
			}
		}	
		
		return false;
	}
}


?>