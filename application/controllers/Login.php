<?php  

/**
* 
*/
class Login extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();      		
	}

	public function index(){

		if( isset($_SESSION['estaLogado']) ){
           redirect('paginainicial');          
        }

        $dadosTelaLogin = array('titulo' => "Login Rhuanny");
		
		$this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('usuarioNick', 'usuarioNick', 'required');
        $this->form_validation->set_rules('usuarioSenha', 'usuarioSenha', 'required');

        if ($this->form_validation->run() === FALSE){ 

            // se o formulário não foi validado
            $this->_mostrarTelaLogin($dadosTelaLogin);

        } else { // se passou pelas validações de codigo
            
            $usuarioNick        = $this->input->post('usuarioNick');
            $usuarioSenha       = $this->input->post('usuarioSenha');
            $usuarioValidado    = $this->_validarUsuario($usuarioNick, $usuarioSenha );        
            
            if( $usuarioValidado ) {

                $arrayPermissoes     = $this->_carregarPermissoes( $usuarioNick );
                $arraySidebarLinks   = $this->_carregarSidebarLinks( $arrayPermissoes );                 
                 
                // TODO -> carregar dados de PESSOA e id usuario também
                $dadosParaSessaoUsuario = array(
                    'nick' => $usuarioNick, 
                    'estaLogado' => true,
                    'permissoes' => $arrayPermissoes,
                    'sidebarLinks' => $arraySidebarLinks
                );
                   
                $this->session->set_userdata( $dadosParaSessaoUsuario );
                redirect( 'paginainicial' );
                
            } else {                
                $dadosTelaLogin["erro"] = "usuario ou senha incorretos";                               
                $this->_mostrarTelaLogin( $dadosTelaLogin );
            }
        }
	}

    public function logout(){
        $this->session->sess_destroy();
        redirect( $this->config->base_url() );
    }

    private function _mostrarTelaLogin( $dadosTelaLogin ){      
        
        
        $this->load->view("login/index", $dadosTelaLogin);
    }

    private function _validarUsuario( $usuarioNick, $usuarioSenha ){

        $this->load->model('user_model');
        $usuario = $this->user_model->pegarUsuarioPorNick($usuarioNick);
        if( $usuario['senha'] == $usuarioSenha )
            return true;
        return false;

    }

    private function _carregarPermissoes( $usuarioNick ){
        
        $this->load->model('permissao_model');
        return $this->permissao_model->pegarPermissaoPorUsuarioNick( $usuarioNick );        

    }
    
    private function _carregarSidebarLinks( $tabelaPermissoes ){
        
        $arraySidebarLinks = array();        
        foreach ($tabelaPermissoes as $row) {
            if( !$row['oculto'] ) {
                $linkArray = explode('/', $row['url']);
                $controllerName = $linkArray[0];
                $methodName = $linkArray[1]; 

                if ( !isset($arraySidebarLinks[$controllerName]) ){
                    $arraySidebarLinks[$controllerName] = array();
                }

                array_push($arraySidebarLinks[$controllerName], $methodName);
            }
        }      

        return $arraySidebarLinks; 

    }    

}

?>