<head>
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<link href='css/estilo23.css' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  	<link rel="stylesheet" href="/resources/demos/style.css">
  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
</head>
<body>

<?php

session_start();
include "conecta.php";
require_once("phpmailer/class.phpmailer.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function captcha()
{
	if($_SESSION['captcha'] != $_POST['captcha'])
	{
		return false;	
	}
	return true;
}

function usuarioMaiusculo()
{
	$teste = $_POST['usuario'];
	if(preg_match('/^[^a-z]*$/', $teste{0})) 
	{
		return false;
	} 
	else 
	{
		return true;
	}
}

$usuario = $_POST['usuario'];
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$senh = $_POST['senha'];
$senha = md5($senh);
$data = $_POST['data'];
$email = $_POST['email'];
$img_modo = $_POST['img_modo'];

$_SESSION['usuario'] = $usuario;
$_SESSION['nome'] = $nome;
$_SESSION['sobrenome'] = $sobrenome;
$_SESSION['data'] = $data;
$_SESSION['email'] = $email;

$_SESSION['msg'] = "";
$_SESSION['msg_usuario'] = "";
$_SESSION['msg_email'] = "";
$erro = 0;
$erro3 = 0;

$sql = "SELECT nome FROM usuario WHERE login = ?;";
$consulta = $db->prepare($sql);
$consulta->bindParam(1,$usuario, PDO::PARAM_STR);
$consulta->execute();
$num_linhas = $consulta->rowCount();
if($num_linhas > 0)
{
	$_SESSION['usuario'] = "";
	$_SESSION['msg_usuario'] = "existe";
	$erro = 1;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
	$_SESSION['email'] = "";
	$_SESSION['msg_email'] = "existe2";
	$erro = 1;
}

$sql = "SELECT nome FROM usuario WHERE email = ?;";
$consulta = $db->prepare($sql);
$consulta->bindParam(1,$email, PDO::PARAM_STR);
$consulta->execute();
$num_linhas = $consulta->rowCount();
if($num_linhas > 0)
{
	$_SESSION['email'] = "";
	$_SESSION['msg_email'] = "existe";
	$erro = 1;
}

if(captcha() == false)
{
	$_SESSION['msg'] = "existe";
	$erro = 1;	
}

if(usuarioMaiusculo() == false)
{
	$_SESSION['usuario'] = "";
	$_SESSION['msg_usuario'] = "existe1";
	$erro = 1;
}

if($erro == 1)
{
	echo"<meta http-equiv='refresh' content='0; url=cadastro.php'>";
	return;
}
#email();
if($erro3 == 1)
{
	echo"<meta http-equiv='refresh' content='0; url=cadastro.php'>";
	return;
}
else
{
	try{
		switch ($img_modo) {
		    case "url":
		        $avatar = $_POST['imgperfil_txt'];
		        break;
		    case "default":
		        $avatar = "imagens/perfil-default.png";
		        break;
		    case "file":
		        $destino = './imagens/avatar_upload/' . $_POST['usuario'] . ".jpg";
				$arquivo_tmp = $_FILES['img-file']['tmp_name'];
				if(move_uploaded_file($arquivo_tmp, $destino)){
					$avatar = "imagens/avatar_upload/" . $_POST['usuario'] . ".jpg";
				}
				else{
					$avatar = $_SESSION['avatar'];
				}
		        break;
			   default:
			    	$avatar = "perfil-default.png";
			    	break;
		}

		try{
			$Email = $email;

			date_default_timezone_set("America/Sao_Paulo");
			$codigo = base64_encode($Email);
			$data_expirar = date('Y/m/d H:i:s', strtotime('+1 day'));
			//$data_expirar = "2017-08-29";
			$sql = "INSERT INTO codigo_email VALUES(nextval('codigo_email_id_seq'::regclass), ?, null, 'n', 'n')";
			$consulta = $db->prepare($sql);
			$consulta->bindParam(1,$codigo, PDO::PARAM_STR);
			$consulta->execute();
			// Variável que junta os valores acima e monta o corpo do email

			//$Vai = "Nome: $Nome\n\nE-mail: $Email\n\nTelefone: $Fone\n\nMensagem: $Mensagem\n";

			define('GUSER', 'projeto.kepler@gmail.com');	// <-- Insira aqui o seu GMail
			define('GPWD', 'kepler123');		// <-- Insira aqui a senha do seu GMail

			function smtpmailer($para, $de, $de_nome, $assunto, $corpo) { 
				global $error;
				try{
					require_once("PHPMailer/src/Exception.php");
					require_once("PHPMailer/src/PHPMailer.php");
					require_once("PHPMailer/src/SMTP.php");
					$mail = new PHPMailer(true);
					$mail->CharSet = 'UTF-8';
					$phpmail->Body = utf8_decode($body);
					$mail->IsHTML(true);
					$mail->IsSMTP();		// Ativar SMTP
					$mail->SMTPDebug = 0;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
					$mail->SMTPAuth = true;		// Autenticação ativada
					$mail->SMTPSecure = 'tls';	// SSL REQUERIDO pelo GMail
					$mail->Host = 'smtp.gmail.com';	// SMTP utilizado
					$mail->Port = 587;  		// A porta 587 deverá estar aberta em seu servidor
					$mail->Username = GUSER;
					$mail->Password = GPWD;
					$mail->From = "projeto.kepler@gmail.com";
					$mail->FromName = "Kepler";
					$mail->Subject = $assunto;
					$mail->Body = $corpo;
					$mail->AddEmbeddedImage('imagens/logo.png', 'logoimg');

					$mail->Body = '
										<style type = "text/css">
										#mae{
											background-color: white;
											width:700px;
											height:600px;
											border-style: none;
											}
										#topo{
											background-color: black;
											width: 700px;
											height: 72px;
										}
										#corpo_email{
											width: 700px;
											margin-left: 60px;
											margin-top: 50px;
											text-align: left;
										}
										.botao{
											background-color: #4CAF50;
											border: none;
											color: white;
											padding: 15px 32px;
											text-align: center;
											text-decoration: none;
											display: inline-block;
											font-size: 16px;
											margin: 4px 2px;
											cursor: pointer;
										}
										#link{
											float: center;
										}
										</style>
									<html lang = "pt-br">
									<head>
										<meta charset = "utf-8">
									</head>
									<center>
										<div id = "mae"style = "background-color: white;
												width:700px;
												height:600px;
												border-style: none;">
											<div id = "topo" style = "background-color: black;
														width: 700px;
														height: 72px;">
												<img src="cid:logoimg" width="200px" style = "float : left">
											</div>
											<div id = "corpo_email" style = "width: 700px;
														margin-left: 60px;
														margin-top: 50px;
														text-align: left;">
												Olá ' . $GLOBALS['nome'] . ' '.$GLOBALS['sobrenome'].'.
												<br><br>
												Para confirmar seu cadastro clique no botão abaixo:
												<br><br><center>
												<a href="http://200.145.153.172/kepler/Kepler/confirma_email_cadastro?codigo='. $GLOBALS['codigo'] .'" class = "botao" 
														style = "background-color: #4CAF50; border: none;
														color: white; padding: 15px 32px; text-align: center;
														text-decoration: none; display: inline-block;
														font-size: 16px; margin: 4px 2px; cursor: pointer; margin-left: -30px;">
														Confirmar cadastro
												</a></center>
												<br>
												Caso o botão não funcione, utilize o endereço abaixo para confirmar seu cadastro:
												<br><br><br><center>
												<a href="http://200.145.153.172/kepler/Kepler/confirma_email_cadastro.php?codigo='. $GLOBALS['codigo'] .'" id = "link" style = "float: center; margin-left: -20px;">
													http://200.145.153.172/kepler/Kepler/confirma_email_cadastro.php?codigo='. $GLOBALS['codigo'] .'
												</a></center>
												<br><br>
												Equipe Kepler.
											</div>
											<br>
											<br>
											<div id = "topo" style = "background-color: black;
														width: 700px;
														height: 72px;">
											</div>
										</div>
									</center>
									</html>
									';
					$phpmail->Body = utf8_decode($body);
					$mail->AddAddress($para);

					if(!$mail->Send()) {
						$_SESSION['msg_email_retorna'] == "Erro ao enviar o e-mail";
						$erro3 = 1;
						//return false;
					} else {
						$_SESSION['msg_email_retorna'] == "E-mail enviado com sucesso";
						//return true;
					}
				}
				catch (phpmailerException $e) {
					$_SESSION['msg_email_retorna'] == "E-mail inserido não existe";
					$erro3 = 1;
				}
				
			}

			/* Insira abaixo o email que irá receber a mensagem, o email que irá enviar (o mesmo da variável GUSER), 
			o nome do email que envia a mensagem, o Assunto da mensagem e por último a variável com o corpo do email.*/
			
			if (smtpmailer($Email, 'projeto.kepler123', '', 'Confirmar cadastro')) {
				//e-mail enviado
				$_SESSION['msg_email_retorna'] == "E-mail enviado com sucesso";

			}
			if (!empty($error))
			{
				$_SESSION['msg_email_retorna'] == "Erro ao enviar o e-mail. Contacte os administradores do sistema";
				$erro3 = 1;
			}
		}
		catch(Exception $e)
		{		
			$_SESSION['msg_email_retorna'] == "Erro ao enviar o e-mail";
			$erro3 = 1;
		}

		$sql ="INSERT INTO usuario  VALUES(?,?,NULL,?,NULL,0,?,'ns',?,?,'Nada Informado',NULL,0,?,NULL,NULL,NULL);";
		$consulta = $db->prepare($sql);
		$consulta->bindParam(1,$usuario, PDO::PARAM_STR);
		$consulta->bindParam(2,$nome, PDO::PARAM_STR);
		$consulta->bindParam(3,$data, PDO::PARAM_STR);
		$consulta->bindParam(4,$email, PDO::PARAM_STR);
		$consulta->bindParam(5,$sobrenome, PDO::PARAM_STR);
		$consulta->bindParam(6,$senha, PDO::PARAM_STR);
		$consulta->bindParam(7,$avatar, PDO::PARAM_STR);
		$consulta->execute();

		session_destroy();
		
		//echo "<meta http-equiv='refresh' content='0; url=login.php'>";
		echo '<script type="text/javascript">
				swal({
				title: "Cadastro realizado com sucesso!",
				text: "Favor entrar no seu e-mail para confirmar o cadastro.",
				type: "success",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("login.php");
				}
			);</script>';
		
	}
	catch(Exception $e)
	{
		echo '<script type="text/javascript">
			swal({
				title: "",
				text: "Ocorreu um erro ao tentar cadastr\u00e3-lo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("login.php");
				}
			));</script>';
		echo "<meta http-equiv='refresh' content='0; url=cadastro.php'>";
	}
	
}
?>
</body>