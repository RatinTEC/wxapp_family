<?php
	include_once "pkcs7Encoder.php";
	include_once "../config.php";
	include_once "../function.php";
	// 第三方发送消息给公众平台
        $timestamp = $_GET['timestamp'];  
        $nonce = $_GET['nonce'];
        $signature = $_GET['signature'];
	//解析接收到的数据
	$desobj		=	getservicemessage($appId,$encodingAesKey);
	/*
		{
			"ToUserName": "gh_95b5a54189ca",
			"FromUserName": "oLBv00K0fxjBkvKU5Ke64dzLrb6s",
			"CreateTime": 1508487303,
			"MsgType": "text",
			"Content": "，，，",
			"MsgId": 6478903633228738994
		}
	*/
	//返回相应的数据
	$fromuser       =       $desobj['FromUserName'];
        $touser         =       $desobj['ToUserName'];
        $msgtype        =       $desobj['MsgType'];
        $rescontent     =       $desobj['Content'];
	$accesstokenstr	=	$GLOBALS["WEIXIN_SERVICE_ACCESS_TOKEN"];
	
	switch($msgtype){
		case($type_response["TEXT"]["type"]):
			$responsedata		=	$type_response["TEXT"]["response"];
			$responsedata		=	str_replace("OPENID","oLBv00K0fxjBkvKU5Ke64dzLrb6s",$responsedata);
			$responsedata           =       str_replace("{{content}}",$desobj['Content'],$responsedata);
			customsend($weixin_message_send_interface,$responsedata);
		break;
		case($type_response["EVENT"]["type"]):
			$responsedata           =       $type_response["EVENT"]["response"];
                        $responsedata           =       str_replace("OPENID",$fromuser,$responsedata);
                        $responsedata           =       str_replace("{{content}}","您好，请问有什么可以帮到您？",$responsedata);
                        customsend($weixin_message_send_interface,$responsedata);
		break;
		case($type_response["IMAGE"]["type"]):
			//MediaId
			$responsedata           =       $type_response["IMAGE"]["response"];
                        $responsedata           =       str_replace("OPENID",$fromuser,$responsedata);
                        $responsedata           =       str_replace("{{media_id}}",$desobj['MediaId'],$responsedata);
                        customsend($weixin_message_send_interface,$responsedata);
		break;
		default:
		break;
	}
