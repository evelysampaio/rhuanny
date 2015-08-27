<?php  


/**
* 
*/
class AdminLTE
{
	
	function __construct(){		
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
				$stringHTML .= "<td>
									<a href='". $controllerPath."/editar/".$row['id']. "'
										<i class='fa fa-fw fa-pencil'>
										</i>									
									<a>
									<a href='". $controllerPath."/excluir/".$row['id']."'
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

		foreach ( $sidebarArray as $controller => $methodArray ) {
            
			if ( count($methodArray) == 1 && $methodArray[0] == 'index' ) {

				$treeViewString .= 	'<li class="active">'.
									'	<a href="'. base_url() . $controller.'">'.
									'		<i class="fa fa-link"></i> '.
									'		<span>' . $controller . '</span>'.
									'	</a>'.
									'</li>';
			} else {	

	            $treeViewString .=  '<li class="treeview">'.
	            					'  <a href="#">'.
	                                '    <i class="fa fa-link"></i>'.
	                                '    <span>' . $controller . '</span>'.
	                                '    <i class="fa fa-angle-left pull-right"></i>'.
	                                '  </a>'.
	                                '  <ul class="treeview-menu">';

	            foreach ($methodArray as $method ) {
	              $treeViewString .=  '<li><a href="'. base_url() . $controller.'/'.$method.'">'.$method.'</a></li>';
	            }

	            $treeViewString .= '</ul></li>';
	        }

        }

        return $treeViewString;
	}

	private function _getSidebarLinks( $tabelaPermissoes ){
        
        $arraySidebarLinks = array();        
        foreach ($tabelaPermissoes as $row) {
            if( !$row['oculto'] ) {
                $linkArray = explode('/', $row['url']);
                $controllerName = $linkArray[0];
                $methodName = $linkArray[1]; 

                if ( !isset($arraySidebarLinks[$controllerName]) ){
                    $arraySidebarLinks[$controllerName] = array();
                }

                array_push($arraySidebarLinks[$controllerName], $methodName);
            }
        }      

        return $arraySidebarLinks; 

    }  
}

?>
