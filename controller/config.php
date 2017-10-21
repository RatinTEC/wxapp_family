<?php
	$m = new MongoClient();    	// 连接到mongodb
	$db = $m->familyapp;		// 选择一个数据库

	//微信客服消息转发接口的配置信息
	// 第三方发送消息给公众平台
	$appId = "wx9b498ce460061901";
	$encodingAesKey = "K0M7ch9fyps0tCiMYX5oAKhZYc19cufvCb2NzyD7eJu";
	$token = "yingjiechen";
	$secret= "26815aa8a9604889cd63baca8280279e";
	
	$weixin_host			=	"https://api.weixin.qq.com";
	$weixin_cgi                     =       "$weixin_host/cgi-bin";
	$weixin_sns                     =       "$weixin_host/sns";
	$weixin_access_token_interface	=	"$weixin_cgi/token?grant_type=client_credential&appid=$appId&secret=$secret";
	$weixin_message_send_interface	=	"$weixin_cgi/message/custom/send?access_token=";

	$code				=	$_GET['code'];
	$weixin_openid_interface	=	"$weixin_sns/jscode2session?appid=$appId&secret=$secret&js_code=$code&grant_type=authorization_code";
	unset($_GET['code']);

	$type_response	=	array(
		"TEXT"=>array(
			"type"=>"text",
			"response"=>'{
				"touser":"OPENID",
				"msgtype":"text",
				"text":{
					"content":"{{content}}"
				}
			}',
		),
		"IMAGE"=>array(
                        "type"=>"image",
                        "response"=>'{
				"touser":"OPENID",
				"msgtype":"image",
				"image":{
					"media_id":"{{media_id}}"
				}
			}',
                ),
		"MPP"=>array(
                        "type"=>"text",
                        "response"=>'{
				"touser":"OPENID",
				"msgtype":"miniprogrampage",
				"miniprogrampage":{
					"title":"{{title}}",
					"pagepath":"{{pagepath}}",
					"thumb_media_id":"{{thumb_media_id}}"
				}
			}',
                ),
		"EVENT"=>array(
                        "type"=>"event",
                        "response"=>'{
                                "touser":"OPENID",
                                "msgtype":"text",
                                "text":{
                                        "content":"{{content}}"
                                }
                        }',
                ),
		"LINK"=>array(
			"type"=>"link",
			"response"=>'{
					"touser": "OPENID",
					"msgtype": "link",
					"link": {
						"title": "{{title}}",
						"description": "{{description}}",
						"url": "{{url}}",
						"thumb_url": "{{thumb_url}}"
					}
				}
			'
		)
	);
?>
