<?php 	

function createNormalBox(){}
function createFullTable($tituloTabela, $tabelaId, $arrayNomeColunas, $arrayValores, $podeEditar=false){
	
	$stringHTML = "
						<div class='box'>							
							<div class='box-body'>
								<table id='". $tabelaId. "'class='table table-bordered table-striped'>
									<thead>
										<tr>
					";
	
	$stringHTMLCabecalho = "";
	foreach ($arrayNomeColunas as $nomeColuna) {
		$stringHTMLCabecalho .=	"<th>". $nomeColuna ."</th>";				
	}

	$stringHTML .= $stringHTMLCabecalho;

	$stringHTML .= "</tr></thead><tbody>";

	foreach ($arrayValores as $row) {
		$stringHTML .= "<tr>";
		
		foreach ($row as $column) {
			$stringHTML .= "<td>".$column."</td>";			
		}

		if($podeEditar){
			$stringHTML .= "<td>
								<a href='usuario/editar/".$row['id']."'
									<i class='fa fa-fw fa-pencil'>
									</i>									
								<a>
								<a href='usuario/excluir/".$row['id']."'
									<i class='fa fa-fw fa-times'>
									</i>									
								</a>
							</td>";
		}	

		$stringHTML .= "</tr>";	
	}

	$stringHTML .= "</tbody><tfoot>";
	$stringHTML .= '</tfoot></table></div></div>
					<script>
						$(function () {
							$( "#'.$tabelaId.'").DataTable();        
						});
					</script>';

	return $stringHTML;
}


echo createFullTable (	
					"Usuários do Sistema", 
					"tabelaUsuarios", 
					array('id','nick', 'senha', 'pessoa_ID', 'modificar'), 
					$tabelaDeUsuarios, 
					true
				); 

?>

<script>
	
	function rhuan(link){		

		 
		$.ajax	(
					{						
						async: true,
			  			url: link,
			  			beforeSend: function( ) {
			   										 $('#conteudo').html("<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>");
			  									}
					}
				)
		  .done( 
		  			function( data ){
		    								$('#conteudo').html(data);
		    						}
		  		)
		  .fail(
		  			function() {
			   					 $('#conteudo').html("aglum erro");
			  					}
			  );
		

	}
	

</script>

