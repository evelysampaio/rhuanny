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
		$this->load->view("usuario/grid", $dadosParaVisao);		
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

	function excluir( $usuarioId = false ){

		$dataViewUsuarioGrid 						= array('title' => 'Cadastrar Usuário');

		if ( $usuarioId == false ) {

			$dataViewUsuarioGrid['error'] = 'Informe um ID de usuário';

		} else {

			$usuario = $this->user_model->pegarUsuarioPorId( $usuarioId );

			if( is_null($usuario) ) {

				$dataViewUsuarioGrid['error'] = 'Id de usuário <b>'. $usuarioId .'</b> não existe.';	

			} else {

				if( $this->db->delete('sys_usuario', array('id' => $usuarioId)) ) {

				    $dataViewUsuarioGrid['success'] = 'Usuário <b>'. $usuario['nick'] .'</b> deletado com sucesso!';

				} else {

					$dataViewUsuarioGrid['error'] = $this->db->_error_message();
					
				}
			}
		}

		$dataViewUsuarioGrid['tabelaDeUsuarios'] 	= $this->user_model->pegarTodos();
		$this->load->view("template/header.php", $dataViewUsuarioGrid);		
		$this->load->view("usuario/grid", $dataViewUsuarioGrid);		
		$this->load->view("template/footer.php", $dataViewUsuarioGrid);

	}

	function editar( $usuarioId = false ) {

		$dataView 						= array('title' => 'Editar Usuário');
		$dataView['tabelaDeUsuarios'] 	= $this->user_model->pegarTodos();

		if ( $usuarioId == false ) {

			$dataView['error'] = 'Informe um ID de usuário';
			$this->load->view("template/header.php", $dataView);		
			$this->load->view("usuario/grid", $dataView);		
			$this->load->view("template/footer.php", $dataView);

		} else {

			$usuario = $this->user_model->pegarUsuarioPorId( $usuarioId );

			if( is_null($usuario) ) {

				$dataView['error'] = 'Usuário não existe.';	
				$this->load->view("template/header.php", $dataView);		
				$this->load->view("usuario/grid", $dataView);		
				$this->load->view("template/footer.php", $dataView);

			} else {
				$dataView['usuario'] = $usuarioId;

				$this->load->view("template/header.php", $data);		
				$this->load->view("usuario/form", $data);		
				$this->load->view("template/footer.php", $data);

			}
		}
		
	}

	private function _mostrarVisaoCadastrar($data){
		$this->load->view("template/header.php", $data);		
		$this->load->view("usuario/form", $data);		
		$this->load->view("template/footer.php", $data);
	}
}
?>