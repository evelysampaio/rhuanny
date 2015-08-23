<?php  

/**
* 
*/
class User_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();		
	}

	function pegarUsuarioPorNick($usuarioNick){

		$query = $this->db->get_where('usuario', array('nick' => $usuarioNick));
        return $query->row_array();        
	}

	function pegarTodos(){
		$query = $this->db->get('usuario');       
        return $query->result_array();   

	}
}

?>