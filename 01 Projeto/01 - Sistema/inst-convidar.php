<?php
session_start();
include "conecta.php";
	
	$de_login = $_SESSION['login']; //quem manda.
	$para_login = $_POST['para_login']; //quem recebe.
	$id_inst = $_POST['id_inst']; //id da instituicao.
	
		$consulta_sel1 = $db->prepare('SELECT * FROM inst_convites WHERE para_login = ? AND id_inst = ?;');
		$consulta_sel1->bindParam(1,$para_login, PDO::PARAM_STR);
		$consulta_sel1->bindParam(2,$id_inst, PDO::PARAM_INT);
		$consulta_sel1->execute();
		$num_linhas_sel1 = $consulta_sel1->rowCount();
		
		$consulta_sel2 = $db->prepare('SELECT * FROM relacao WHERE login = ? AND id_inst = ?;');
		$consulta_sel2->bindParam(1,$para_login, PDO::PARAM_STR);
		$consulta_sel2->bindParam(2,$id_inst, PDO::PARAM_INT);
		$consulta_sel2->execute();
		$num_linhas_sel2 = $consulta_sel2->rowCount();
		
		if($num_linhas_sel1 > 0 || $num_linhas_sel2 > 0){
			echo "<meta http-equiv='refresh' content='0; url=instituicao.php?i=".$_POST['id_inst']."'>";
			echo '<script language="javascript">alert("Este usuario ja possui um convite semelhante ativo ou ja faz parte desta instituicao.")</script>';		
		}
		else{
			$consulta = $db->prepare('INSERT INTO inst_convites VALUES(?, ?, ?);');
			$consulta->bindParam(1,$de_login, PDO::PARAM_STR);
			$consulta->bindParam(2,$para_login, PDO::PARAM_STR);
			$consulta->bindParam(3,$id_inst, PDO::PARAM_INT);
			$consulta->execute();
			
			$num_linhas = $consulta->rowCount();
			
			if($num_linhas > 0){
				echo "<meta http-equiv='refresh' content='0; url=instituicao.php?i=".$_POST['id_inst']."'>";
				echo '<script language="javascript">alert("O convite foi enviado com sucesso.")</script>';		
			}
			else{
				echo "<meta http-equiv='refresh' content='0; url=instituicao.php?i=".$_POST['id_inst']."'>";
				echo '<script language="javascript">alert("Ocorreu um erro ao convidar este usuário. Tente novamente mais tarde.")</script>';
			}
		}
?>