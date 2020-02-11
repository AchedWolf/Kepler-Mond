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
	// Tabela Relação
	
	$consulta_relacao=$db->prepare("SELECT * FROM relacao where id_inst=? AND tipo=1");
	$consulta_relacao->bindParam(1,$id_inst,PDO::PARAM_INT);
	try
	{
		$consulta_relacao->execute();
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		return;
	}
	$linha = $consulta_relacao->fetch(PDO::FETCH_ASSOC);
	
	$login=$linha['login'];
	
	//Tabela Usuario
	$consulta_usuario=$db->prepare("SELECT * FROM usuario where login=?");
	$consulta_usuario->bindParam(1,$login,PDO::PARAM_STR);
	try
	{
		$consulta_usuario->execute();
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		return;
	}
	$linha_usuario = $consulta_usuario->fetch(PDO::FETCH_ASSOC);
	
	$nome_usuario=$linha_usuario['nome'];
	$sobrenome_usuario=$linha_usuario['sobrenome'];
	$email_usuario=$linha_usuario['email'];
	
	//Tabela Instituição de Ensino
	$consulta_inst=$db->prepare("SELECT * FROM instituicao where id_inst=?");
	$consulta_inst->bindParam(1,$id_inst,PDO::PARAM_INT);
	try
	{
		$consulta_inst->execute();
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		return;
	}
	$linha_inst = $consulta_inst->fetch(PDO::FETCH_ASSOC);
	
	$nome_instituicao=$linha_inst['nome_inst'];
	
	//Email
	/* Inclui a classe do phpmailer */ 
	//require_once("phpmailer/class.phpmailer.php");
	//require_once("phpmailer/class.smtp.php");
	/* Cria uma Instância da classe */
	$mail = new PHPMailer();

	$assunto = 'Sistema Kepler - Aprovação da Instituição de Ensino '.$nome_instituicao;
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
												Olá, '.$nome_usuario.'.
												<br><br>
												<div style="text-align:justify;line-height:1.5;width:610px">
													Informamos que a Instituição de Ensino <b>'.$nome_instituicao.'</b> foi aprovada pelos administradores do sistema.
												</div>
												<br>
												
												<div style="text-align:justify;line-height:1.5;width:610px">
													Assim, a partir de agora, você poderá acessar o perfil desta Instituição e utilizar as novas funcionalidades disponibilizadas.
												</div>
												<br>
												<div style="text-align:justify;line-height:1.5;width:610px">
													Em caso de dúvida, entre em contato com o suporte técnico através do e-mail <b>projeto.kepler@gmail.com</b>.
												</div>
												<br><br>
												Atenciosamente
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
	$seu_email = 'projeto.kepler@gmail.com';
	$seu_nome = 'Kepler';
	$sua_senha = 'kepler123';
	 
	
	/* Se for do Gmail o servidor é: smtp.gmail.com */
	$host_do_email = 'smtp.gmail.com';
	 
	/* Configura os destinatários (pra quem vai o email) */
	$mail->AddAddress($email_usuario, $nome_usuario);
	//$mail->AddAddress('projeto.kepler@gmail.com', $nome_usuario);
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

	if (!$email_enviado) {
		
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Não foi possível notificar o usuário.\nInformações do Erro: '.$mail->ErrorInfo.'",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-instituicoes.php");
				}
			);</script>';
		return;
	 //echo "Não foi possível enviar o e-mail.<br /><br />";
	 //echo "<b>Informações do erro:</b> <br />" . $mail->ErrorInfo;
	}
	else
	{
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Solicitação de Cadastro de Instituição de Ensino Aprovada com Sucesso",
				type: "success",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-instituicoes.php");
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
				text: "É necessário realizar login.",
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