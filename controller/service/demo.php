<?php
	include_once "pkcs7Encoder.php";
	// 第三方发送消息给公众平台
	$appId = "wx9b498ce460061901";
	$encodingAesKey = "K0M7ch9fyps0tCiMYX5oAKhZYc19cufvCb2NzyD7eJu";
	$token = "yingjiechen";
	$timestamp = $_GET['timestamp'];  
	$nonce = $_GET['nonce'];
	$signature = $_GET['signature'];  
	//解析接收到的数据
	$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
	$postObj = json_decode($postStr,true);
	$prp	=	new Prpcrypt($encodingAesKey);
	$enstr	=	$postObj['Encrypt'];
	$desarr	=	$prp->decrypt($enstr, $appId);
	$desstr	=	$desarr[0];
	file_put_contents("log.json",$desarr);
	$desobj	=	json_decode($desstr,true);
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
	$type_arr	=	array(
		"text"	=>	"content",
		"image"	=>	"media_id",
	);
	$fromuser	=	$desobj['FromUserName'];
	$touser       	=       $desobj['ToUserName'];
	$msgtype        =       $desobj['MsgType'];
	$rescontent	=	$desobj['Content'];
	/*
		{
			"touser":"OPENID",
			"msgtype":"text",
			"text":{
				"content":"Hello World"
			}
		}
	
	$responsedata	=	array(
		'touser'	=>	$fromuser,
		'msgtype'	=>	$msgtype,
		$msgtype	=>	array(
			$type_arr[$msgtype]=>$rescontent
		)
	);*/
	
	//{"errcode": 40001, "errmsg": "invalid credential, access_token is invalid or not latest hint: [iyJokA0693vr63!]"}
	$accesstoken 	= 	$GLOBALS["ACCESS_TOKEN"];
	$url            =       "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=$accesstoken";
        $ch             =       curl_init();
        //设置选项，包括URL
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_HEADER,0);
	// post的变量
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($responsedata));
        //执行并获取HTML文档内容
	/*
		{
			"errcode": 40001, 
			"errmsg": "invalid credential, access_token is invalid or not latest hint: [oC2DoA0030vr29!]"
		}
	*/
        
	/*
	$output         =       curl_exec($ch);
	$sendacctionresponse	=	json_decode($output,true);
	if($sendacctionresponse['errcode']==0){
		//发送成功
	}else{
		//40001
		//没有发送成功
	}
        //释放curl句柄
        curl_close($ch);*/
