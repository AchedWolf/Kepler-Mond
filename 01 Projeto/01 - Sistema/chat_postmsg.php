<?php
	include "conecta.php";
	session_start();
	
	/*$consulta_users = $db->prepare('SELECT * FROM usuario WHERE excluido = \'n\' AND login != ? ORDER BY RANDOM() LIMIT 8;');
	$consulta_users->bindParam(1,$_SESSION['login'], PDO::PARAM_STR);
	$consulta_users->execute();
	$num_linhas_users = $consulta_users->rowCount();*/
	
	$msg_chat_1 = $_GET['msg_chat'];
	if($msg_chat_1 == null){ $msg_chat = "aa"; }
	else{ $msg_chat = $msg_chat_1; }
	
	$user_recebe = $_GET['user_recebe'];
	$user_envia = $_SESSION['login'];
	
	$consulta_msg = $db->prepare("INSERT INTO chat VALUES(nextval('chat_id_msg_seq'::regclass), ?, ?, ?, ?, 'n')");
	$consulta_msg->bindParam(1,$msg_chat, PDO::PARAM_STR);
	$consulta_msg->bindParam(2,$user_envia, PDO::PARAM_STR);
	$consulta_msg->bindParam(3,$user_recebe, PDO::PARAM_STR);
	$consulta_msg->bindParam(4,date("d/m/y H:i:s"), PDO::PARAM_STR);
	$consulta_msg->execute();
	
	$num_linhas_msg = $consulta_msg->rowCount();
?>