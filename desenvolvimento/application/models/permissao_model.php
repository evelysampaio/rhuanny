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

		$this->db->select('permissao.id as id');
		$this->db->select('link.url as url');
		$this->db->select('link.oculto as oculto');
    	$this->db->from('permissao');
    	$this->db->join('link', 'link.id = permissao.linkId');
    	$this->db->join('usuario', 'usuario.id = permissao.usuarioId');
    	$this->db->where('usuario.nick', $usuarioNick);
    	$query = $this->db->get();    		
		
		return $query->result_array();       
	}

	function pegarPermissaoPorUsuarioId( $usuarioId ){

		$this->db->select('permissao.id as id');
		$this->db->select('link.url as url');
		$this->db->select('link.oculto as oculto');
    	$this->db->from('permissao');
    	$this->db->join('link', 'link.id = permissao.linkId');
    	$this->db->join('usuario', 'usuario.id = permissao.usuarioId');
    	$this->db->where('usuario.id', $usuarioId);
    	$query = $this->db->get();    		
		
		return $query->result_array();       
	}
}

?>