<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<meta charset="utf-8">
	<title>Cadastro de Instituição</title>
</head>

<body>
	<?php
	include("conecta.php");
	if($_SESSION['logado']!=1)
	{
		//echo "<script type='text/javascript'>alert('É necessário realizar o login.')</script>";
		//echo "<script type='text/javascript'><meta HTTP-EQUIV='refresh' CONTENT='0;URL=login.php'></script>";
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "\u00c9 necess\u00e1rio realizar o login.",
				type: "warning",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("login.php");
				}
			);</script>';
		return;
	}
	if($_SESSION['captcha']!=$_POST['captcha'])
	{
		//echo "<script type='text/javascript'>alert('Captcha inválido. Por favor, redigite.')</script>";
		//echo "<script type='text/javascript'>history.back()</script>";
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Captcha inv\u00e1lido. Por favor, redigite.",
				type: "warning",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				history.back()
				}
			);</script>';
		return;
	}
		
		$nome_instituicao=$_POST['nome_instituicao'];
		$endereco_instituicao=$_POST['endereco_instituicao'];
		$bairro_instituicao=$_POST['bairro_instituicao'];
		$cidade_instituicao=$_POST['cidade_instituicao'];
		$estado_instituicao=$_POST['estado_instituicao'];
		$telefone_instituicao=$_POST['telefone_instituicao'];
		$email_instituicao=$_POST['email_instituicao'];
		$website_instituicao=$_POST['website_instituicao'];
		$avatar_inst="";
		$aux=$_POST['avatar_inst'];
		$sobre_inst=$_POST['sobre_instituicao'];
		$sobre_inst= str_replace("<", " ", $sobre_inst);
		$sobre_inst= str_replace(">", " ", $sobre_inst);
		$ativo='s';
		
	
		if($sobre_inst==null||$sobre_inst==" "||$sobre_inst=="")
		{
			$sobre_inst="Nada Informado";
		}
		
		if($website_instituicao==null||$website_instituicao==" "||$website_instituicao=="")
		{
			$website_instituicao="";
		}
		
		if($aux=="default")
		{
			$avatar_inst="imagens/perfil-default.png";
		}
		elseif($aux=="url")
		{
			$avatar_inst=$_POST['img-url'];
		}
		else
		{
			
			$arquivo=$_POST['imagem_user'];
			$arquivo_nome=$_FILES['imagem_user']['name'];
			$avatar_inst=$arquivo_nome;
		}
		

		$consulta_instituicao=$db->prepare("INSERT INTO instituicao(id_inst,nome_inst,avatar_inst,sobre_inst,endereco_inst,bairro_inst,cidade_inst,estado_inst,telefone_inst,email_inst,link_inst,excluido)  VALUES (nextval('instituicao_id_inst_seq'::regclass),?,?,?,?,?,?,?,?,?,?,'a') RETURNING id_inst");
		$consulta_instituicao->bindParam(1,$nome_instituicao,PDO::PARAM_STR);
		$consulta_instituicao->bindParam(2,$avatar_inst,PDO::PARAM_STR);
		$consulta_instituicao->bindParam(3,$sobre_inst,PDO::PARAM_STR);
		$consulta_instituicao->bindParam(4,$endereco_instituicao,PDO::PARAM_STR);
		$consulta_instituicao->bindParam(5,$bairro_instituicao,PDO::PARAM_STR);
		$consulta_instituicao->bindParam(6,$cidade_instituicao,PDO::PARAM_STR);
		$consulta_instituicao->bindParam(7,$estado_instituicao,PDO::PARAM_STR);
		$consulta_instituicao->bindParam(8,$telefone_instituicao,PDO::PARAM_STR);
		$consulta_instituicao->bindParam(9,$email_instituicao,PDO::PARAM_STR);
		$consulta_instituicao->bindParam(10,$website_instituicao,PDO::PARAM_STR);
		
		try
		{
			$consulta_instituicao->execute();
			//echo "<script type='text/javascript'>alert('Instituição cadastrada com sucesso !!!')</script>";
			//echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>";
		}	
		catch(PDOException $e)
		{
			echo $e->getMessage();
			return;
		}
		
		$linha = $consulta_instituicao->fetch(PDO::FETCH_ASSOC);
		$id_inst=$linha['id_inst'];
		$login=$_SESSION['login'];
		$tipo=1;//Admin
			//login->puxar dados usuario->verificar se diretor já existe (email) -> caso não exista, cadastrar.
		
		if($aux=='arquivo')
		{
			//echo "<script type='text/javascript'>alert('Arquivo')</script>";
			$upload['tamanho'] =3 * 1024 * 1024; // 3Mb
			
			$upload['extensoes'] = array('jpg', 'png');

			/*
			$upload['erros'][0] = 'Não houve erro';
			$upload['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
			$upload['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
			$upload['erros'][3] = 'O upload do arquivo foi feito parcialmente';
			$upload['erros'][4] = 'Não foi feito o upload do arquivo';

			if ($_FILES['imagem_user']['error'] != 0) {
			  die("Não foi possível fazer o upload, erro:" . $upload['erros'][$_FILES['imagem_user']['error']]);
			  exit; // Para a execução do script
			}
			*/
			
			$extensao = strtolower(end(explode('.', $_FILES['imagem_user']['name'])));
			if (array_search($extensao, $upload['extensoes']) === false) {
			  //echo "<script type='text/javascript'>alert('Por favor, envie arquivos com as seguintes extensões: jpg ou png')</script>";
			  //echo "<script type='text/javascript'>history.back()</script>";
				  echo '<script type="text/javascript">
					swal({
					title: "",
					text: "Por favor, envie arquivos com as seguintes extens\u00f5es: jpg ou png.",
					type: "warning",
					showCancelButton: false,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Ok",
					closeOnConfirm: false,
				},
				function(){
					history.back()
					}
				);</script>';
				return;
			}
			if ($upload['tamanho'] < $_FILES['imagem_user']['size']) {
			  //echo "<script type='text/javascript'>alert('O arquivo enviado é muito grande, envie arquivos de até 3Mb.')</script>";
			  //echo "<script type='text/javascript'>history.back()</script>";
			  
			  echo '<script type="text/javascript">
					swal({
					title: "",
					text: "O arquivo enviado ultrapassa o limite de tamanho especificado. Por favor, envie arquivos de at\u00e9 3Mb.",
					type: "warning",
					showCancelButton: false,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Ok",
					closeOnConfirm: false,
				},
				function(){
					history.back()
					}
				);</script>';
				return;
			}
			
			 $nome_final = './imagens/avatar_inst_upload/'.$id_inst.'.jpg';
			 $arquivo_temp=$_FILES['imagem_user']['tmp_name'];
			  
			// Depois verifica se é possível mover o arquivo para a pasta escolhida
			if (move_uploaded_file($arquivo_temp, $nome_final)) {
			  //echo "Upload efetuado com sucesso!";
			
			 $avatar_inst='imagens/avatar_inst_upload/'.$id_inst.'.jpg';
			 
			} else {
			  // Não foi possível fazer o upload, provavelmente a pasta está incorreta
				$avatar_inst='imagens/perfil-default.png';
				 echo "<script type='text/javascript'>alert('Não foi possível realizar o upload da imagem. Tente novamente')</script>";
				 
				 
			}
			

			 $atualizar_avatar=$db->prepare("UPDATE instituicao SET avatar_inst=? WHERE id_inst=?");
			$atualizar_avatar->bindParam(1,$avatar_inst,PDO::PARAM_STR);
			$atualizar_avatar->bindParam(2,$id_inst,PDO::PARAM_INT);
			try
			{
				$atualizar_avatar->execute();
			}	
			catch(PDOException $e)
			{
				echo $e->getMessage();
				return;
			}
		}
		
		$consulta_relacao=$db->prepare("INSERT INTO relacao(id_inst,tipo,login,id_relacao)  VALUES (?,?,?,nextval('relacao_seq'::regclass))");
		$consulta_relacao->bindParam(1,$id_inst,PDO::PARAM_INT);
		$consulta_relacao->bindParam(2,$tipo,PDO::PARAM_INT);
		$consulta_relacao->bindParam(3,$login,PDO::PARAM_INT);
		
		try
		{
			$consulta_relacao->execute();
			include "email_instituicao.php";
			//echo "<script type='text/javascript'>alert('A solicitação foi enviada com sucesso!')</script>";
			
			/*
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "A solicita\u00e7\u00e3o foi enviada com sucesso!",
				type: "success",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("instituicoes.php?userp='.$login.'");
				}
			);</script>';
			return;
			*/
			//echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=instituicoes.php?userp=".$login."'>";
		}	
		catch(PDOException $e)
		{
			echo $e->getMessage();
			return;
		}
	
	
	?>
		
</body>
</html>

