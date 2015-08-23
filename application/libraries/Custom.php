<?php  


/**
* 
*/
class Custom
{
	
	function __construct(){}

}

function adminLTE_url($string){
	return public_url( "AdminLTE-2.2.0/". $string );
}

function public_url($string){
	return base_url( "public/". $string );
}



?>