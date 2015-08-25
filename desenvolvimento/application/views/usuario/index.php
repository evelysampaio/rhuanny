<?php  

echo $this->adminlte->createFullTable (	
					"Usuários do Sistema", 
					"tabelaUsuarios", 
					array('id','nick', 'senha', 'pessoa_ID', 'modificar'), 
					$tabelaDeUsuarios, 
					true,
					base_url('usuario')

				); 

?>