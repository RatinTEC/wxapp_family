<?php
	$visitcollection = 	$db->visithistory; // 选择集合
	$wechatid	=	$match[1][0];
	// 更新文档
	$result		=	$visitcollection->insert($_GET);
	echo json_encode($result);
?>
