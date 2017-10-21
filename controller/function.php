<?php
	//公共函数
	function curl_function($url,$postdata="",$method="get",$header_input=array()){
		$accept         =       "application/json";
		$content_type   =       "application/json";
		$headers        =       array(
			"Accept:$accept",
			"Content-type:$content_type",
		);
		$headers	=	array_merge($headers,$header_input);
		$ch             =       curl_init();
		//设置选项，包括URL
		curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_HEADER,0);
		switch($method){
			case("post"):
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
			break;
			case("put"):
				// put 数据
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
				//seconds to allow for connection
				curl_setopt($ch, CURLOPT_TIMEOUT, 30);
				//seconds to allow for cURL commands
				curl_setopt($ch, CURLOPT_PUT, 1);
				//定义header
				curl_setopt($ch, CURLOPT_VERBOSE, 0);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
			break;
			case("delete"):
				// delete 数据
				curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'DELETE');
			break;
			// get method 
			default:
			break;
		}
		//执行并获取HTML文档内容
		$output         =       curl_exec($ch);
		//释放curl句柄
		curl_close($ch);
		//打印获得的数据
		return $output;
	}
	//微信转发接口相关函数
	function getservicemessage($appId,$encodingAesKey){
		//解析接收到的数据
		include_once "./pkcs7Encoder.php";
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		$postObj = json_decode($postStr,true);
		$prp	=	new Prpcrypt($encodingAesKey);
		$enstr	=	$postObj['Encrypt'];
		$desarr	=	$prp->decrypt($enstr, $appId);
		$desstr	=	$desarr[0];
		$desobj	=	json_decode($desstr,true);
		return $desobj;
	}
	
	function getassesstoken(){
		global $weixin_access_token_interface;
		$accesstoken                            =       curl_function($weixin_access_token_interface);
                $accesstokenresult                      =       json_decode($accesstoken,true);
		file_put_contents("access_token",$accesstokenresult["access_token"]);
	}
	function customsend($url,$data){
		//这里的 access_token 位于 $root/service/ 下面
		$responsedata		=	curl_function($url.file_get_contents("access_token"),$data,"post");
		$responsedataobj	=	json_decode($responsedata,true);
		$errorcode		=	array(40001,41001,42001);
		if(in_array($responsedataobj['errcode'],$errorcode)||$responsedata==""){
			getassesstoken();
                        $responsedata           =       curl_function($url.file_get_contents("access_token"),$data,"post");
                        $responsedataobj        =       json_decode($responsedata,true);
			return $responsedataobj;
		}else{
			return $responsedataobj;
		}
	}
?>
