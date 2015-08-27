<?php  

/**
* 
*/
class Login extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();  
        $this->load->model('user_model');
    		
	}

	public function index(){

		if( isset($_SESSION['usuario']['estaLogado']) ){
           redirect('paginainicial');          
        }

        $dadosTelaLogin = array('titulo' => "Login Rhuanny");
		
		$this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('usuarioNick', 'usuarioNick', 'required');
        $this->form_validation->set_rules('usuarioSenha', 'usuarioSenha', 'required');

        if ($this->form_validation->run() === FALSE){ 

            $this->_mostrarTelaLogin($dadosTelaLogin);

        } else { 
            
            $usuarioNick        = $this->input->post('usuarioNick');
            $usuarioSenha       = $this->input->post('usuarioSenha');
            $usuario            = $this->user_model->pegarUsuarioPorNick( $usuarioNick );        
            
            if( $usuario['senha'] == $usuarioSenha ){
                
                $usuario['estaLogado'] = true; 
                unset($usuario['senha']);
                $this->session->set_userdata( array('usuario' => $usuario) );
                redirect( 'paginainicial' );
                
            } else {                
                $dadosTelaLogin["erro"] = "usuario ou senha incorretos.";                               
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

    private function _carregarPermissoes( $usuarioNick ){
        
        $this->load->model('permissao_model');
        return $this->permissao_model->pegarPermissaoPorUsuarioNick( $usuarioNick );        

    }

}

?>