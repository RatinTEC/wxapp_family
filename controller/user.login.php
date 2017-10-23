<?php
	$usercollection = 	$db->user; // 选择集合
	//获取 openid
	$openidstr	=	curl_function($weixin_openid_interface);
	$openidobj	=	json_decode($openidstr,true);
	// 更新文档
	$usercollection->update(array("wechatid"=>$openidobj['openid']), array('$set'=>$_GET),array("upsert" => true));
	$users		=	$usercollection->findOne(array("wechatid"=>$openidobj['openid']));
	//$users          =       $usercollection->find();
	echo json_encode($users);
?>
