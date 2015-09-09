<?php  


/**
* 
*/
class AdminLTE
{
	
	function __construct(){		
	}	

	public function alertError($error){

		if( $error != "" ) 
			echo '	<br/>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-ban"></i> Erro! </h4>
						'.$error.'
					</div>';
              
	}

	public function alertSuccess($success){

		if( $success != "" ) 
			echo '	<br/>
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-check"></i>Sucesso!</h4>
						'.$success.'
					</div>';
              
	}

	public function createNormalBox(){}

	public function createFullTable(	$tituloTabela, 
										$tabelaId, 
										$arrayNomeColunas, 
										$arrayValores, 
										$podeEditar=false, 
										$controllerPath										
									) {
		
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

				$stringOnConfirm = 'onClick="return confirm()"';
				$stringHTML .= "<td>
									<a href='". $controllerPath."/editar/".$row['id']. "'
										<i class='fa fa-fw fa-pencil'>
										</i>									
									<a>
									<a ". $stringOnConfirm." href='". $controllerPath."/excluir/".$row['id']."'
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

	public function createSideBarLinks(){

		$sidebarArray = $this->_getSidebarLinks( $_SESSION['usuario']['permissoes'] );
		$treeViewString = "";

		foreach ( $sidebarArray as $controllerName => $controller ) {

			$methodArray = $controller['arrayMethods'];
            
			if ( count($methodArray) == 1 && $methodArray[0] == 'index' ) {

				$treeViewString .= 	'<li class="active">'.
									'	<a href="'. base_url() . $controller.'">'.
									'		<i class="fa '. $controller['sidebarImage'] .'"></i> '.
									'		<span>' . $controllerName . '</span>'. //verificar o alias
									'	</a>'.
									'</li>';
			} else {	

	            $treeViewString .=  '<li class="treeview">'.
	            					'  <a href="#">'.
	                                '    <i class="fa '. $controller['sidebarImage'] .'"></i> '.
	                                '    <span>' . $controllerName . '</span>'. //verificar o alias
	                                '    <i class="fa fa-angle-left pull-right"></i>'.
	                                '  </a>'.
	                                '  <ul class="treeview-menu">';

	            foreach ($methodArray as $method ) {
	              $treeViewString .=  '<li><a href="'. base_url() . $controllerName.'/'.$method['name'].'">'.$method['name'].'</a></li>';
	            }

	            $treeViewString .= '</ul></li>';
	        }

        }

        return $treeViewString;
	}

	private function _getSidebarLinks( $tabelaPermissoes ){

        $arrayControllers = array();
        
        foreach ($tabelaPermissoes as $row) {

	        $controllerName 	= $row['controllerName'];
			$controllerAlias 	= $row['controllerAlias'];
			$sidebarImage		= $row['sidebarImage'];
			$methodName 		= $row['methodName'];
			$methodAlias		= $row['methodAlias'];

            if( $row['mostrarNaSideBar'] ) {
      
                if ( !isset( $arrayControllers[$controllerName] ) ){
                    
                	$arrayMethods = array();
                	$arrayControllerAttributes = array 	(
                											'sidebarImage' => $sidebarImage,
                    										'alias' =>  $controllerAlias,
                    										'arrayMethods' => $arrayMethods 
                						 				);	

                    $arrayControllers[$controllerName] = $arrayControllerAttributes;
                }

                $arrayMethodAttributes = array 	(
                									'name' => $row['methodName'],
                    								'alias' =>  $row['methodAlias']
                								);

                array_push( $arrayControllers[$controllerName]['arrayMethods'], $arrayMethodAttributes );
            }
        }      

        return $arrayControllers; 

    }  

}

?>
