<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
date_default_timezone_set("Asia/Kuala_Lumpur");
$app = array();

include "config/config.inc.php";

$app["link"] = new mysqli($app["hostdb"],$app["userdb"],$app["passdb"],$app["db"]);
$app["rootpath"] = "../";


function command_sql($koneksi,$nametable,$mode_operation,$array,$txtcriteria)

	{

		$sql = "show columns from ".$nametable;

		$rq = $koneksi->query($sql);
		$rcv = $array;
		$arraykeys = array_keys($array);
		$nkolom = count($rcv);

		switch($mode_operation) 
		{
			case "ADD" :
			$cmm = "insert into ".$nametable."(";
			$val = "(";
			while ($pointer_kolom = $rq->fetch_object()) //mysqli_fetch_object($rq)

			{
				for ($look = 0; $look < $nkolom ;$look++)

				{

					if ( $pointer_kolom->Field == $arraykeys[$look])

					{

						$cmm .= $pointer_kolom->Field.",";

						$val .=  "'".$rcv[$arraykeys[$look]]."',";

					} 


				} 

			}

			$cmm = substr($cmm,0,strlen($cmm)-1).")values";

			$val = substr($val,0,strlen($val)-1).")";

			$cmm .= $val ;


			break ;


			case "UPDATE":

			$cmm = "update ".$nametable." set ";


			while ($pointer_kolom = $rq->fetch_object()) //mysqli_fetch_object($rq)

			{

				for ($look = 0; $look < $nkolom ;$look++)

				{

					if ( $pointer_kolom->Field == $arraykeys[$look])

					{

						$cmm .=  $pointer_kolom->Field."="."'".$rcv[$arraykeys[$look]]."',";

					} 



				}

			}

			$cmm = substr($cmm,0,strlen($cmm)-1)." where ".$txtcriteria;

			break;


			case "DELETE":

			$cmm = "delete from  ".$nametable." where ".$txtcriteria;

			break;

			case "OPT":
			$cmm = "";
			while ($pointer_kolom = $rq->fetch_object()) //mysqli_fetch_object($rq)
			{

				for ($look = 0; $look < $nkolom ;$look++)
				{
					if ( $pointer_kolom->Field == $arraykeys[$look])
					{
					$cmm .=  $pointer_kolom->Field."="."'".$rcv[$arraykeys[$look]]."',";
					}
				}
			}
			$cmm = substr($cmm,0,strlen($cmm)-1);
			break;

			

			default :

			$cmm = "select 'error sql command' as pesan";

			break;
		}
		return $cmm; 
	}

	

	function date_to_mysqlformat($xdate)

	{
		return date("Y-m-d",strtotime($xdate));
	}
	
	function set_trx_begin($link)
	{
		return mysqli_autocommit($link,FALSE);
	}
	
	function run_commit($link)
	{
		return mysqli_commit($link);
	}
	
	function run_rollback_trx($link)
	{
		return mysqli_rollback($link);
	}
	
	function set_auto_commit($link)
	{
		return mysqli_autocommit($link,TRUE);
	}
	 
	function clear_old_process($idcnn)  
	{
		$nprc = mysqli_more_results($idcnn);
		
		if ( $nprc > 0 ) 
		{
			while ( mysqli_more_results($idcnn) && mysqli_next_result($idcnn) )
			{
				
				if ( $ptr = mysqli_store_result($idcnn) )
				{	
					mysqli_free_result($ptr);
				}
			}
		}		
	} 
	
	
	function get_id_documen($cnn,$init,$iduser,$idcaban,$nlen)
	{
		$request = $cnn->query("select get_id_document('$init','$iduser','$idcaban','$nlen') as iddoc ");
		$rrows = $request->fetch_object();
		return trim($rrows->iddoc);
	}
 
	function myobj_table_to_array($cnn,$sql)
        {
            $response = array();

            if ( $rest = $cnn->query($sql) )
               {
                    while ( $brs =  $rest->fetch_array() )
                    {
                         array_push($response,$brs);
                   }


				}
            return   $response;
        }
 
	
	function myobj_table_to_json($cnn,$sql)
	{
		$response = array();
		
		if ( $rest = $cnn->query($sql) )
		{
			while ( $brs =  $rest->fetch_array() )
			{
				array_push($response,$brs);
			}
			
			 
		} 
		return 	 json_encode($response);
	}
	
	function myobj_table_to_object($cnn,$sql)
	{
		$response=[];
		$nloop = 0;
		if ( $rest = $cnn->query($sql) )
		{
			while ( $brs =  $rest->fetch_object() )
			{
				$response[$nloop] =  $brs;
				 
				$nloop ++;
			}
			
			 
		} 
		return 	 $response;
	}
	 

	function push_time_line($cnn,$array) //inlude link.php required
	{
		
		$sql = command_sql($cnn,"tbtimeline","ADD",$array,"");
		
		if ( $cnn->query($sql) )
		{
			return true;
		}else
		{
			return false;
		}
		
		
	}
	
	function myobj_table_to_xml($oData)
	{
	  $nomor=1;
	  $xml = new SimpleXMLElement('<table/>');
	  forEach($oData as $key=>$val)
		{
			$row = $xml->addChild("row");  
			$keys = array_keys((array)$val);
			forEach($keys as $x=>$y)
			{
				$xk=$keys[$x];
				$xl=$val->$xk;
				 
				$row->addChild("$xk",$xl ); 
				$row->addChild("rowid", $nomor); 
			}
			 $nomor ++;
		}
		return $xml->asXML();
	}
	
	function xml_to_array($oXml)
	{
		$xml = simplexml_load_string($oXml);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);
		return $array ;
		
	}
	
	function xml_to2_array($oXml)
	{
		$xml = new SimpleXMLElement($oXml,LIBXML_NOCDATA);
		return (array)$xml;
		
	}
	
	
	function remove_special_char($cVars)
    {
		$creturn = trim(str_replace(array('&'),' dan ',$cVars));
    	return trim(str_replace(array('/','#','$','&','@','!','/','<','>','%'),' ',$creturn));
    }

 