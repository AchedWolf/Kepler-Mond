<head>
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<?php 
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;
		require_once("PHPMailer/src/Exception.php");
		require_once("PHPMailer/src/PHPMailer.php");
		require_once("PHPMailer/src/SMTP.php");
	?>
</head>
<body>
<?php

session_start();
include "conecta.php";

if($_SESSION['logado']==1)
{	

	if($nome_instituicao==NULL||$nome_instituicao=="")
	{
		echo '<script type="text/javascript">
						swal({
						title: "",
						text: "N\u00e3o foi poss\u00edvel enviar a solicita\u00e7\u00e3o ao sistema. Tente novamente mais tarde.",
						type: "error",
						showCancelButton: false,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Ok",
						closeOnConfirm: false,
					},
					function(){
						window.location.assign("frm_cadastro_instituicao.php");
						}
					);</script>';
		return;
	}
		
	$consulta_usuario=$db->prepare("SELECT * FROM usuario where login=?");
	$consulta_usuario->bindParam(1,$_SESSION['login'],PDO::PARAM_STR);
	$consulta_usuario->execute();
	$linha = $consulta_usuario->fetch(PDO::FETCH_ASSOC);
	$nome_usuario=$linha['nome'];
	$sobrenome_usuario=$linha['sobrenome'];
	
	$consulta_adm_inst=$db->prepare("SELECT * FROM relacao where tipo=3");
	$consulta_adm_inst->execute();
	$linha_adm_inst = $consulta_adm_inst->fetch(PDO::FETCH_ASSOC);
	
	$consulta_dados_adm_inst=$db->prepare("SELECT * FROM usuario where login=?");
	$consulta_dados_adm_inst->bindParam(1,$linha_adm_inst['login'],PDO::PARAM_STR);
	$consulta_dados_adm_inst->execute();
	$linha_dados_adm_inst = $consulta_dados_adm_inst->fetch(PDO::FETCH_ASSOC);
	$nome_adm=$linha_dados_adm_inst['nome'];
	$sobrenome_adm=$linha_dados_adm_inst['sobrenome'];
	$email_adm=$linha_dados_adm_inst['email'];

	/* Inclui a classe do phpmailer */ 
	//require_once("phpmailer/class.phpmailer.php");
	//require_once("phpmailer/class.smtp.php");
	/* Cria uma Instância da classe */
	$mail = new PHPMailer();

	$assunto = 'Sistema Kepler - Avaliação da Instituição de Ensino '.$nome_instituicao;
	$mensagem = '
									<html lang = "pt-br">
									<head>
										<meta charset = "utf-8">
									</head>
									<center>
										<div id = "mae" style = "background-color: white;
												width:700px;
												height:450px;
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
												Olá, Administrador(a).
												<br><br>
												<div style="text-align:justify;line-height:1.5;width:610px">
												'.$nome_usuario.' '.$sobrenome_usuario.' demonstra interesse em cadastrar a Instituição de Ensino '.$nome_instituicao.' no sistema.
												</div>
												<br><br>
												Equipe Kepler.
												<br><br><br><br>
												<div style="margin-left:200px">
													<a href="http://kepler.ipmet.unesp.br/login.php" class = "botao" 
															style = "background-color: #4CAF50; border: none;
															color: white; padding: 15px 32px; text-align: center;
															text-decoration: none; display: inline-block;
															font-size: 16px; margin: 4px 2px; cursor: pointer;">
															Acessar o sistema
													</a>
												</div>
												
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
	$seu_email = 'projeto.kepler@gmail.com';
	$seu_nome = 'Kepler';
	$sua_senha = 'kepler123';
	
	/* Se for do Gmail o servidor é: smtp.gmail.com */
	$host_do_email = 'smtp.gmail.com';
	 
	/* Configura os destinatários (pra quem vai o email) */
	$mail->AddAddress($email_adm, $nome_adm);
	// $mail->AddAddress('email@email.com');
	// $mail->AddCC('email@email.com', 'Nome da pessoa'); // Copia
	// $mail->AddBCC('email@email.com', 'Nome da pessoa'); // Cópia Oculta
	
	$mail->AddEmbeddedImage('imagens/logo.png', 'logoimg');
	
	/* Define que é uma conexão SMTP */
	$mail->IsSMTP();
	/* Define o endereço do servidor de envio */
	$mail->Host = $host_do_email;
	/* Utilizar autenticação SMTP */ 
	$mail->SMTPAuth = true;
	/* Protocolo da conexão */
	//$mail->SMTPSecure = "ssl";
	$mail->SMTPSecure = "tls";
	/* Porta da conexão */
	//$mail->Port = "465";
	$mail->Port = "587";
	//$mail->Port = "25";
	/* Email ou usuário para autenticação */
	$mail->Username = $seu_email;
	/* Senha do usuário */
	$mail->Password = $sua_senha;
	 
	/* Configura os dados do remetente do email */
	$mail->From = $seu_email; // Seu e-mail
	$mail->FromName = $seu_nome; // Seu nome
	 
	/* Configura a mensagem */
	$mail->IsHTML(true); // Configura um e-mail em HTML
	 
	/*   
	 * Se tiver problemas com acentos, modifique o charset
	 * para ISO-8859-1  
	 */
	$mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)
	 
	/* Configura o texto e assunto */
	$mail->Subject  = $assunto; // Assunto da mensagem
	$mail->Body = $mensagem; // A mensagem em HTML
	$mail->AltBody = trim(strip_tags($mensagem)); // A mesma mensagem em texto puro
	 
	/* Configura o anexo a ser enviado (se tiver um) */
	//$mail->AddAttachment("foto.jpg", "foto.jpg");  // Insere um anexo
	 
	/* Envia o email */
	$email_enviado = $mail->Send();
	 
	/* Limpa tudo */
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();
	
	/* Mostra se o email foi enviado ou não */

	if ($email_enviado) {
	
		//echo "<script type='text/javascript'>alert('Email enviado com sucesso !!!')</script>";
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
		//echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>";
	
	 
	} else {

	 //echo " .<br /><br />";
	 //echo "<b>Informações do erro:</b> <br />" . $mail->ErrorInfo;
	 echo '<script type="text/javascript">
				swal({
				title: "",
				text: "N\u00e3o foi possível enviar o e-mail.\nInformações do erro:'.$mail->ErrorInfo.'",
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
	}
	
}
else
{
	
	echo '<script type="text/javascript">
				swal({
				title: "",
				text: "\u00c9 necess\u00e1rio realizar o login.",
				type: "error",
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
?>
</body>