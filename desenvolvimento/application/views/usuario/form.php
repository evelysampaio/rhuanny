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

if( !isset($usuario) ) {
	$usuario = array('nick' => '', 'senha' => '', 'pessoa_id' => '');
}

$arrayFormGroups = 	array(
						array(
							'id' => 'usuarioNick' ,
							'label' => 'Nick',
							'type' => 'text',
							'placeHolder' => 'nick do usuario'
						),
						array(
							'id' => 'usuarioSenha' ,
							'label' => 'Senha',
							'type' => 'password',
							'placeHolder' => 'senha do usuario'
						),
						array (
							'id' => 'pessoaId' ,
							'label' => 'Id da Pessoa',
							'type' => 'number',
							'placeHolder' => 'id da pessoa'
						)
					);

if( isset($usuario) ){
	if( isset($usuario["nick"]) ) $arrayFormGroups[0]["data"] = $usuario["nick"];
	if( isset($usuario["senha"]) ) $arrayFormGroups[1]["data"] 	= $usuario["senha"];
	if( isset($usuario["pessoa_id"]) ) $arrayFormGroups[2]["data"] = $usuario["pessoa_id"];
}

if( isset($erro) ) $this->adminlte->alertError($erro); 
if( isset($success) ) $this->adminlte->alertSuccess($success); 

$this->adminlte->alertError( validation_errors() );

createFullForm	( $arrayFormGroups, base_url("usuario/cadastrar") );

?>
