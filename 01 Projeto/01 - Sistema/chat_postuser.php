<?php
	include "conecta.php";
	session_start();
	
	/*$consulta_users = $db->prepare('SELECT * FROM usuario WHERE excluido = \'n\' AND login != ? ORDER BY RANDOM() LIMIT 8;');
	$consulta_users->bindParam(1,$_SESSION['login'], PDO::PARAM_STR);
	$consulta_users->execute();
	$num_linhas_users = $consulta_users->rowCount();*/
	
	//MENSAGENS NAO VISUALIZADAS
		$consulta_msgGERAL = $db->prepare('SELECT id_msg,msg,login_envia,login_recebe,visualizado,login FROM chat,usuario 
		WHERE ((chat.login_recebe = ? AND chat.login_recebe = usuario.login)) AND chat.visualizado = \'n\' AND usuario.excluido = \'n\' ORDER BY data;');
		$consulta_msgGERAL->bindParam(1,$_SESSION['login'], PDO::PARAM_STR);
		$consulta_msgGERAL->execute();
		$num_linhas_msgGERAL = $consulta_msgGERAL->rowCount();

	if($_GET['user_recebe'] == $_SESSION['login'] || $_GET['user_recebe'] == "" || $_GET['user_recebe'] == null){ ?>
		<div style="float:left;">
			<b style="background-color:blue;color:white;padding:2px;">Mensagens não lidas:</b><br>
			<?php
			if($num_linhas_msgGERAL > 0){
				while($linha_msgGERAL = $consulta_msgGERAL->fetch(PDO::FETCH_OBJ)){ 
					echo "<span style='cursor:pointer'>".$linha_msgGERAL->login_envia."</span><br>";
				}
			}
			else{
				echo "Você não possui mensagens novas.";
			}
			?>
		</div><br>
	<?php }
	//Se campo for diferente de vazio, ou for diferente do nome do usuário logado:
	else{
		$consulta_user = $db->prepare('SELECT * FROM usuario WHERE login = ? AND excluido = \'n\';');
		$consulta_user->bindParam(1,$_GET['user_recebe'], PDO::PARAM_STR);
		$consulta_user->execute();
		
		$num_linhas_user = $consulta_user->rowCount();
		
		//Verifica se o usuário existe.
		if($num_linhas_user < 1){ ?>
			<div style="float:left;color:red;">
				<span><b>Ops!</b></span><br>
				<span>Esse usuário não existe. Verifique se o nome foi digitado corretamente.</span>
			</div><br>
		<?php $_SESSION['user_recebe'] = "";
		}
		//Se usuário existe:
		else{
			$consulta_msg = $db->prepare('SELECT id_msg,msg,login_envia,login_recebe,visualizado,data,login,avatar FROM chat,usuario 
			WHERE ((chat.login_envia = ? AND chat.login_envia = usuario.login AND chat.login_recebe = ?) 
			OR (chat.login_recebe = ? AND chat.login_recebe = usuario.login AND chat.login_envia = ?)) AND usuario.excluido = \'n\' ORDER BY data;');
			$consulta_msg->bindParam(1,$_SESSION['login'], PDO::PARAM_STR);
			$consulta_msg->bindParam(2,$_GET['user_recebe'], PDO::PARAM_STR);
			$consulta_msg->bindParam(3,$_SESSION['login'], PDO::PARAM_STR);
			$consulta_msg->bindParam(4,$_GET['user_recebe'], PDO::PARAM_STR);
			$consulta_msg->execute();

			$num_linhas_msg = $consulta_msg->rowCount();
			
			//Se há mensagens anteriores entre ambos:
			if($num_linhas_msg > 0){ 
				$_SESSION['user_recebe'] = $_GET['user_recebe'];
				$_SESSION['chat_status'] = "show";
				
				while($linha_msg = $consulta_msg->fetch(PDO::FETCH_OBJ)){ 
					//MENSAGEM RECEBIDA
					if($linha_msg->login_recebe == $_SESSION['login']){ ?>
						<div style="float:left;width:100%;">
							<span title="<?php echo $linha_msg->data; ?>"><b style="color:red;"><?php echo $linha_msg->login_envia; ?></b>: <?php echo $linha_msg->msg; if($linha_msg->visualizado == 'n'){ echo '<b style="background-color:blue;color:white;padding:2px;margin-left:5px;" title="Mensagem não lida.">NOVA</b>'; } ?></span>
						</div><br>
				<?php } 
					//MENSAGEM ENVIADA
					else if($linha_msg->login_envia == $_SESSION['login']){ ?>
						<div style="float:left;width:100%">
							<span title="<?php echo $linha_msg->data; ?>"><b style="color:blue;"><?php echo $linha_msg->login_envia; ?></b>: <?php echo $linha_msg->msg; ?></span>
						</div><br>
				<?php }				
				}
				
				$consulta_visu = $db->prepare('UPDATE chat SET visualizado = \'s\' WHERE visualizado = \'n\' AND login_recebe = ? AND login_envia = ?;');
				$consulta_visu->bindParam(1,$_SESSION['login'], PDO::PARAM_STR);
				$consulta_visu->bindParam(2,$_GET['user_recebe'], PDO::PARAM_STR);
				$consulta_visu->execute();
			}
			else{
				$_SESSION['user_recebe'] = "";
			}
		}
	}
?>