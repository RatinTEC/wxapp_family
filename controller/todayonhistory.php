<?php
	include_once("config.php");
	include_once("function.php");
	$action		=	isset($_GET["action"])?$_GET["action"]:"list";
	$tohdata	=	"";
	$e_id		=	isset($_GET["eid"])?$_GET["eid"]:1;
	switch($action){
		case("list"):
			if(!file_exists("./data/toh/".date("m",time())."-".date("d",time()).".json")){
				$tohdata	=	curl_function($toh_interface,array(
					"key=$toh_key",
					"date=".date("m",time())."/".date("d",time()),
				));
				file_put_contents("./data/toh/".date("m",time())."-".date("d",time()).".json",$tohdata);
			}else{
				$tohdata	=	file_get_contents("./data/toh/".date("m",time())."-".date("d",time()).".json");
			}
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
