<?php 


function createFullForm($arrayFormGroups, $action){

	$formString = '<div class="box">'.	
					'<form action="'.$action.'" method="post" accept-charset="utf-8">'.
						'<div class="box-body">';

	foreach ($arrayFormGroups as $formGroup) {
		
	$formString .=			'<div class="form-group">'.
								'<label for="'.$formGroup['id'].'">'.$formGroup['label'].'</label>'.
								'<input type="'.$formGroup['type'].'" class="form-control" id="'.$formGroup['id'].'" name="'.$formGroup['id'].'" placeholder="'.$formGroup['placeHolder'].'">'.
							'</div>';	

	}
	
	$formString .=		'</div>'.
						'<div class="box-footer">'.
		                	'<input type="submit" value="Enviar" class="btn btn-primary" >'.
		                '</div>'.
		            '</form>'.
		         '</div>';   

	echo $formString;	            

}

$arrayFormGroups = array();

array_push 	( $arrayFormGroups, array (
										'id' => 'usuarioNick' ,
										'label' => 'Nick',
										'type' => 'text',
										'placeHolder' => 'nick do usuario'	
									)
			);

array_push 	( $arrayFormGroups, array (
										'id' => 'usuarioSenha' ,
										'label' => 'Senha',
										'type' => 'password',
										'placeHolder' => 'senha do usuario'	
									)
			);

array_push 	( $arrayFormGroups, array (
										'id' => 'pessoaId' ,
										'label' => 'Id da Pessoa',
										'type' => 'number',
										'placeHolder' => 'id da pessoa'	
									)
			);

//print_r($arrayFormGroups);
//exit();

if( isset($erro) ) $this->adminlte->alertError($erro); 
if( isset($success) ) $this->adminlte->alertSuccess($success); 

$this->adminlte->alertError( validation_errors() );

createFullForm	( $arrayFormGroups, base_url("usuario/cadastrar") );

?>
