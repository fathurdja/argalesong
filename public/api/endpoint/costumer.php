<?php 

	 
	$xdata = myobj_table_to_array($app["link"],"select count(id) as jdata from customer");
	$_POST["email"]=$xdata[0]["jdata"];
	$_POST["whatsapp"]=$xdata[0]["jdata"];
	if ( ($_POST["ktp"] == '')  || ($_POST["ktp"] == '0000000000000000' ))
	{
		$_POST["ktp"] = $xdata[0]["jdata"];
	}
	
	if ( ($_POST["npwp"] == '' ) || ($_POST["npwp"] == '00.000.000.0-000.000' ))
	{
		$_POST["npwp"] = $xdata[0]["jdata"];
	}
	
	try{
		
		$sql = command_sql($app["link"],"customer","ADD",$_POST,"");
		
		if ( $app["link"]->query($sql) ) 
		{
			echo "Penambahan data berhasil";
		} 
		
	}
	catch (Exception $error){
		 echo "Error : ".$error->getMessage();
	}finally 
	{
	}
	 
 