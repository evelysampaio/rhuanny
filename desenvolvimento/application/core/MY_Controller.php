<?php 

/**
* Classe de acesso somente para pessoas logadas.
*/
class MY_Controller extends CI_Controller
{	
	function __construct()
	{
		parent::__construct();
		
		$controllerName = $this->router->fetch_class(); // class = controller
		$methodName 	= $this->router->fetch_method();
		$url 			= $controllerName . '/' . $methodName;

		//verifica login
		if( !isset($_SESSION['usuario']['estaLogado']) ){
			show_error	(	'Você precisa estar logado para acessar essa página. 
							<br />
							<br /> 
							url:' . $url . '
							<br />
							<br />
							<blockquote><h2><a href="'.base_url().'">voltar</a></h2></blockquote>'
						);			
		} 
		//verificar permissão
		if( !$this->_usuarioTemPermissao() ){
			show_error	(	'Você precisa estar logado para acessar essa página. 
							<br />
							<br /> 
							url:' . $url . '
							<br />
							<br />
							<blockquote><h2><a href="'.base_url().'">voltar</a></h2></blockquote>'
						);			
		} 

	}

	private function _usuarioTemPermissao(){
	
		$controllerName = $this->router->fetch_class(); 
		$methodName 	= $this->router->fetch_method();

		if( $controllerName == 'paginainicial' and $methodName == 'index' ){
			return true;
		}
		
		else {
			foreach ( (array)$_SESSION['usuario']['permissoes'] as $row ) {			
				if ( $controllerName == $row['controllerName'] and $methodName == $row['methodName'] )
					return true;
			}
		}	
		
		return false;
	}
}


?>