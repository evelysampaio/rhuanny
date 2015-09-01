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
	
	function cadastrar(){

		$viewDataCadastrar = array('title' => 'Cadastrar Usuário');

		$this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('usuarioNick', 'usuarioNick', 'required');
        $this->form_validation->set_rules('usuarioSenha', 'usuarioSenha', 'required');

        if ($this->form_validation->run() === FALSE){ 

            $this->_mostrarVisaoCadastrar( $viewDataCadastrar );

        } else { 
            
            $usuarioNick        = $this->input->post('usuarioNick');
            $usuarioSenha       = $this->input->post('usuarioSenha');
            
            $usuario            = $this->user_model->pegarUsuarioPorNick( $usuarioNick );        
            
            if( is_null($usuario) ) {

	            $data = array(
	            	'nick' => $this->input->post('usuarioNick'),
	            	'senha' => md5($this->input->post('usuarioSenha')) 
	            );

	            $this->db->insert('sys_usuario', $data); 

	            $viewDataCadastrar['success'] = 'Usuário cadastrado com sucesso!';

			} else{ 
				$viewDataCadastrar['error'] = 'Nome de usuário já existente!';
			}

			$this->_mostrarVisaoCadastrar( $viewDataCadastrar );
				
        } 
        
	}

	function excluir(){}
	function editar(){
		
	}

	private function _mostrarVisaoCadastrar($data){
		$this->load->view("template/header.php", $data);		
		$this->load->view("usuario/cadastrar", $data);		
		$this->load->view("template/footer.php", $data);
	}
}
?>