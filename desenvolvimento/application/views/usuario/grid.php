<?php  
if( isset($error) ) $this->adminlte->alertError($error); 
if( isset($success) ) $this->adminlte->alertSuccess($success); 

echo $this->adminlte->createFullTable (	
					"Usuários do Sistema", 
					"tabelaUsuarios", 
					array('id','nick', 'senha', 'pessoa_ID', 'modificar'), 
					$tabelaDeUsuarios, 
					true,
					base_url('usuario')

				); 

?>