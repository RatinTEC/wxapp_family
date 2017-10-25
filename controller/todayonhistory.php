<?php
	include_once("config.php");
	include_once("function.php");
	$action		=	isset($_GET["action"])?$_GET["action"]:"list";
	$tohdata	=	"";
	$e_id		=	isset($_GET["e_id"])?$_GET["e_id"]:1;
	switch($action){
		case("list"):
			$tohdata	=	curl_function($toh_interface,array(
				"key=$toh_key",
				"date=".date("m",time())."/".date("d",time()),
			));
		break;
		case("detail"):
			if(file_exists("./data/toh/$e_id.json")){
                                $tohdata	=	file_get_contents("./data/toh/$e_id.json");
                        }else{
				$tohdata        =       curl_function($tohdet_interface,array(
					"key=$toh_key",
					"e_id=$e_id",
				));
				file_put_contents("./data/toh/$e_id.json",$tohdata);
			}
		break;
	}
	echo $tohdata;
?>
