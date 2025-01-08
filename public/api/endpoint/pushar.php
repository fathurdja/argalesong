<?php 

$type_data = isset($_REQUEST["t"]) ? $_REQUEST["t"] : "url";
$rcvdata = "";

switch ($type_data)
{
	case "xml":
	$rcvdata = xml_to_array($_REQUEST["odata_ar"]);
	break;
	
	case "json":
	$rcvdata = json_decode($_REQUEST["odata_ar"],true);
	break;
	
	case "url":
	$rcvdata = $_REQUEST;
	break;
	
	default:
	
}

//(id_Pelanggan,name,ktp,npwp,alamat,email,whatsapp,telepon,kota,kode_pos,provinsi,notes,idtypepelanggan,fax,sharing)


if ( is_array($rcvdata) )
{
	try 
	{
		$rcvdata["tgl_jatuh_tempo"] = date_to_mysqlformat($rcvdata["tgl_jatuh_tempo"]);
		
		$rcvdata["tgltra"] = date_to_mysqlformat($rcvdata["tgltra"]);
		
		$sql = command_sql($app["link"],"detailpiutang","ADD",$rcvdata,"");
		$exec = $app["link"]->query($sql);
		 
		 
		echo "Success sending data to AR System";
		
		
	}catch(Exception $errors)
	{
		echo "Error : ".$errors->getMessage() ;
		 
		 
	}finally 
	{
	}
	
}
else
{
	echo "Unknown format";
}

 