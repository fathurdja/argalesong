<?php 
	
	include "mylibs.php";
	
	$q = isset($_REQUEST["q"]) ? $_REQUEST["q"] : "Default";
	$idcmp = isset($_REQUEST["idcmp"]) ? $_REQUEST["idcmp"] : "";
	$idpt = isset($_REQUEST["idpt"]) ? $_REQUEST["idpt"] : "";
	 
	
	
	switch ( $q ) 
	{
		
		case 'dcostuer':
			require('endpoint/costumer.php');
			break;
			 
		case 'ar':
			 
			require('endpoint/pushar.php');
			break;
			 
			
			default:
			
			echo "Request id: ".$q."<br>";
			print_r($app["link"]->client_info);
			echo "<br>";
			echo "PHP : ".phpversion();
	}
	
	
	 
	
	
	
?>