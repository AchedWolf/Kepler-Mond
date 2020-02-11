<head>
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
</head>
<body>
<?php
	try{
		include("conecta.php");
		require_once("phpmailer/class.phpmailer.php");
		$Email = strip_tags(filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING));

		// Define o horário
		date_default_timezone_set("America/Sao_Paulo");
		$codigo = base64_encode($Email);
		$data_expirar = date('Y/m/d H:i:s', strtotime('+1 day'));
		//$data_expirar = "2017-08-29";

		$sql = "INSERT INTO codigo_email VALUES(nextval('codigo_email_id_seq'::regclass), ?, ?, null, 'n')";
		$consulta = $db->prepare($sql);
		$consulta->bindParam(1,$codigo, PDO::PARAM_STR);
		$consulta->bindParam(2,$data_expirar, PDO::PARAM_STR);
		$consulta->execute();


		$sql = "SELECT nome, sobrenome FROM usuario WHERE email = ?;";
		$consulta = $db->prepare($sql);
		$consulta->bindParam(1,$Email, PDO::PARAM_STR);
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();

		if($num_linhas > 0)
		{
			$linha = $consulta->fetch(PDO::FETCH_ASSOC);
			$Nome = $linha['nome']. " " .$linha['sobrenome'];
			// Variável que junta os valores acima e monta o corpo do email

			//$Vai = "Nome: $Nome\n\nE-mail: $Email\n\nTelefone: $Fone\n\nMensagem: $Mensagem\n";

			define('GUSER', 'projeto.kepler@gmail.com');	// <-- Insira aqui o seu GMail
			define('GPWD', 'kepler123');		// <-- Insira aqui a senha do seu GMail

			function smtpmailer($para, $de, $de_nome, $assunto, $corpo) { 
				global $error;
				try{
					$nome_completo =  $Nome."".$Sobrenome;
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
												Olá ' . $GLOBALS['Nome'] . '.
												<br><br>
												Enviamos um link para você cadastrar sua nova senha, ele expira em 24 horas.
												<br>
												Para cadastrá-la clique no botão abaixo:
												<br><br><center>
												<a href="http://200.145.153.172/kepler/Kepler/altera_senha_email.php?codigo='. $GLOBALS['codigo'] .'" class = "botao" 
														style = "background-color: #4CAF50; border: none;
										    			color: white; padding: 15px 32px; text-align: center;
										    			text-decoration: none; display: inline-block;
										    			font-size: 16px; margin: 4px 2px; cursor: pointer;">
										    			Cadastrar nova senha
										    	</a></center>
												<br>
												Caso o botão não funcione, utilize o endereço abaixo para cadastrar sua nova senha:
												<br><br><center>
												<a href="http://200.145.153.172/kepler/Kepler/altera_senha_email.php?codigo='. $GLOBALS['codigo'] .'" id = "link" style = "float: center;">
													http://200.145.153.172/kepler/Kepler/altera_senha_email.php?codigo='. $GLOBALS['codigo'] .'
												</a></center>
												<br>
												Caso não tenha solicitado a recuperação da sua senha, apenas ignore este e-mail e 
												<br>continue utilizando sua senha atual.
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
						$error = 'afdasfMail error: '.$mail->ErrorInfo; 
						/*echo "<meta http-equiv='refresh' content='0; url=login.php'>";
						echo '$error<script language="javascript">alert("Erro ao enviar o e-mail!");</script>';*/
						echo '<script type="text/javascript">
							swal({
							title: "",
							text: "Ocorreu um erro ao enviar o e-mail. Tente mais tarde.",
							type: "error",
							showCancelButton: false,
							confirmButtonColor: "#3085d6",
							confirmButtonText: "Ok",
							closeOnConfirm: false,
						},
						function(){
							window.location.assign("login.php");
							}
						);</script>';
						//return false;
					} else {
						/*echo "<meta http-equiv='refresh' content='0; url=login.php'>";
						echo '<script language="javascript">alert("E-mail enviado com sucesso!");</script>';*/
						
						echo '<script type="text/javascript">
							swal({
							title: "",
							text: "E-mail enviado com sucesso!",
							type: "success",
							showCancelButton: false,
							confirmButtonColor: "#3085d6",
							confirmButtonText: "Ok",
							closeOnConfirm: false,
						},
						function(){
							window.location.assign("login.php");
							}
						);</script>';
						//return true;
					}
				}
				catch (phpmailerException $e) {
		  			/*echo "<meta http-equiv='refresh' content='0; url=login.php'>";
					echo '<script language="javascript">alert("E-mail inserido n\u00e3o existe!");</script>';*/
					echo '<script type="text/javascript">
							swal({
							title: "",
							text: "E-mail inserido n\u00e3o existe!",
							type: "error",
							showCancelButton: false,
							confirmButtonColor: "#3085d6",
							confirmButtonText: "Ok",
							closeOnConfirm: false,
						},
						function(){
							window.location.assign("login.php");
							}
						);</script>';
				}
				
			}

			/* Insira abaixo o email que irá receber a mensagem, o email que irá enviar (o mesmo da variável GUSER), 
			o nome do email que envia a mensagem, o Assunto da mensagem e por último a variável com o corpo do email.*/
			
			if (smtpmailer($Email, 'projeto.kepler123', '', 'Recuperação de senha')) {

				/*echo "<meta http-equiv='refresh' content='0; url=login.php'>";
				echo '<script language="javascript">alert("E-mail enviado com sucesso!");</script>';*/
				
				echo '<script type="text/javascript">
					swal({
					title: "",
					text: "E-mail enviado com sucesso!",
					type: "success",
					showCancelButton: false,
					confirmButtonColor: "#3085d6",
					confirmButtonText: "Ok",
					closeOnConfirm: false,
				},
				function(){
					window.location.assign("login.php");
					}
				);</script>';

			}
			if (!empty($error))
			{
				/*echo "<meta http-equiv='refresh' content='0; url=login.php'>";
				echo '<script language="javascript">alert("Erro ao enviar o e-mail. Contacte os administradores do sistema!");</script>';*/
				echo '<script type="text/javascript">
							swal({
							title: "",
							text: "Erro ao enviar o e-mail. Contacte os administradores do sistema!",
							type: "error",
							showCancelButton: false,
							confirmButtonColor: "#3085d6",
							confirmButtonText: "Ok",
							closeOnConfirm: false,
						},
						function(){
							window.location.assign("login.php");
							}
						);</script>';
			}
		}
		else
		{	
			/*echo "<meta http-equiv='refresh' content='0; url=login.php'>";
			echo '<script language="javascript">alert("Esse e-mail n\u00e3o est\u00e1 cadastrado no sistema!");</script>';*/
			echo '<script type="text/javascript">
							swal({
							title: "",
							text: "Esse e-mail n\u00e3o est\u00e1 cadastrado no sistema!",
							type: "error",
							showCancelButton: false,
							confirmButtonColor: "#3085d6",
							confirmButtonText: "Ok",
							closeOnConfirm: false,
						},
						function(){
							window.location.assign("login.php");
							}
						);</script>';
		}
	}catch(Exception $e)
	{
		/*echo "<meta http-equiv='refresh' content='0; url=login.php'>";
		echo '<script language="javascript">alert("E-mail enviado com sucesso!");</script>';*/
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Erro ao enviar o e-mail",
				type: "success",
				showCancelButton: false,
				confirmButtonColor: "#3085d6",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("login.php");
				}
			);</script>';
	}
?>
</body>