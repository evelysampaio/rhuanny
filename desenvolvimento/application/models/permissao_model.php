<?php  

/**
* 
*/
class Permissao_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();		
	}

	function pegarPermissaoPorUsuarioNick( $usuarioNick ){

		$query = $this->db->get_where('sys_permissoes_e_usuarios', array('usuarioNick' => $usuarioNick));
        return $query->result_array();      
	}

	function pegarPermissaoPorUsuarioId( $usuarioId ){

		$query = $this->db->get_where('sys_permissoes_e_usuarios', array('usuarioId' => $usuarioId));
        return $query->result_array();               
	}
}

?>