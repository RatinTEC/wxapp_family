<?php
	$m = new MongoClient();    	// 连接到mongodb
	$db = $m->familyapp;		// 选择一个数据库

	//微信客服消息转发接口的配置信息
	// 第三方发送消息给公众平台
	$appId = "wx9b498ce460061901";
	$encodingAesKey = "K0M7ch9fyps0tCiMYX5oAKhZYc19cufvCb2NzyD7eJu";
	$token = "yingjiechen";
	
	$weixin_host			=	"https://api.weixin.qq.com/cgi-bin";
	$weixin_access_token_interface	=	"$weixin_host/token?grant_type=client_credential&appid=$appId&secret=26815aa8a9604889cd63baca8280279e";
	$weixin_message_send_interface	=	"$weixin_host/message/custom/send?access_token=";
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
                        "type"=>"text",
                        "response"=>'{
				"touser":"OPENID",
				"msgtype":"image",
				"image":{
					"media_id":"MEDIA_ID"
				}
			}',
                ),
		"MPP"=>array(
                        "type"=>"text",
                        "response"=>'{
				"touser":"OPENID",
				"msgtype":"miniprogrampage",
				"miniprogrampage":{
					"title":"title",
					"pagepath":"pagepath",
					"thumb_media_id":"thumb_media_id"
				}
			}',
                ),
		"EVENT"=>array(
                        "type"=>"text",
                        "response"=>'{
                                "touser":"OPENID",
                                "msgtype":"text",
                                "text":{
                                        "content":"Hello World"
                                }
                        }',
                ),
		"LINK"=>array(
			"type"=>"link",
			"response"=>'{
					"touser": "OPENID",
					"msgtype": "link",
					"link": {
						"title": "Happy Day",
						"description": "Is Really A Happy Day",
						"url": "URL",
						"thumb_url": "THUMB_URL"
					}
				}
			'
		)
	);
?>
