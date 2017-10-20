<?php
	$usercollection = 	$db->user; // 选择集合
	$avatarUrl	=	$_GET['avatarUrl'];
	preg_match_all('/vi_32\/(.+?)\/0/si',$avatarUrl,$match);
	$wechatid	=	$match[1][0];
	// 更新文档
	$usercollection->update(array("wechatid"=>$wechatid), array('$set'=>$_GET),array("upsert" => true));
	$users		=	$usercollection->findOne(array("wechatid"=>$wechatid));
	//$users          =       $usercollection->find();
	echo json_encode($users);
?>
