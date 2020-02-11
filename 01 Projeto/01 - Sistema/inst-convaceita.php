<?php
session_start();
include "conecta.php";
	
	$de_login = $_POST['de_login']; //quem manda.
	$para_login = $_SESSION['login']; //quem recebe.
	$id_inst = $_POST['id_inst']; //id da instituicao.
	$r = $_POST['res_'.$id_inst]; //resultado do convite; aceitou ou recusou.
	
	if($r == 's'){ //se aceitou convite
		$consulta_del = $db->prepare('DELETE FROM inst_convites WHERE de_login = ? AND para_login = ? AND id_inst = ?;');
		$consulta_del->bindParam(1,$de_login, PDO::PARAM_STR);
		$consulta_del->bindParam(2,$para_login, PDO::PARAM_STR);
		$consulta_del->bindParam(3,$id_inst, PDO::PARAM_INT);
		$consulta_del->execute();
		$num_linhas_del = $consulta_del->rowCount();
		
		$consulta_ins = $db->prepare("INSERT INTO relacao VALUES(?, 0, ?, nextval('relacao_seq'::regclass))");
		$consulta_ins->bindParam(1,$id_inst, PDO::PARAM_STR);
		$consulta_ins->bindParam(2,$para_login, PDO::PARAM_STR);
		$consulta_ins->execute();
		$num_linhas_ins = $consulta_ins->rowCount();
		
		if($num_linhas_ins > 0 && $num_linhas_del > 0){
			echo "<meta http-equiv='refresh' content='0; url=instituicao.php?i=".$_POST['id_inst']."'>";
			echo '<script language="javascript">window.history.back();</script>';
		}
		else{
			echo "<meta http-equiv='refresh' content='0; url=instituicao.php?i=".$_POST['id_inst']."'>";
			echo '<script language="javascript">alert("Ocorreu um erro. Tente novamente mais tarde.")</script>';
			echo '<script language="javascript">window.history.back();</script>';
		}
	}
	
	else if($r == 'n'){ //se recusou convite
		$consulta_del = $db->prepare('DELETE FROM inst_convites WHERE de_login = ? AND para_login = ? AND id_inst = ?;');
		$consulta_del->bindParam(1,$de_login, PDO::PARAM_STR);
		$consulta_del->bindParam(2,$para_login, PDO::PARAM_STR);
		$consulta_del->bindParam(3,$id_inst, PDO::PARAM_INT);
		$consulta_del->execute();
		$num_linhas_del = $consulta_del->rowCount();
		
		if($num_linhas_del > 0 && $num_linhas_del > 0){
			echo "<meta http-equiv='refresh' content='0; url=instituicao.php?i=".$_POST['id_inst']."'>";
			echo '<script language="javascript">window.history.back();</script>';
		}
		else{
			echo "<meta http-equiv='refresh' content='0; url=instituicao.php?i=".$_POST['id_inst']."'>";
			echo '<script language="javascript">alert("Ocorreu um erro. Tente novamente mais tarde.")</script>';
			echo '<script language="javascript">window.history.back();</script>';
		}
	}
	
	else{
		echo "id_inst: ".$id_inst."<br>";
		echo "de_login: ".$de_login."<br>";
		echo "para_login: ".$para_login."<br>";
		echo "res: ".$r."<br>";
	}
?>