<?php
    include("conecta.php");
    require_once("phpmailer/class.phpmailer.php");
    #convite de instituição (sweet alert)

    date_default_timezone_set("America/Sao_Paulo");
    $data_consulta = date('Y-m-d');
    
    $sql = "SELECT login FROM agendamento WHERE data_agen = ?";
	$consulta = $db->prepare($sql);
    $consulta->bindParam(1,$data_consulta, PDO::PARAM_STR);
    $consulta->execute();

    $num_linhas = $consulta->rowCount();
	
	if($num_linhas > 0)
	{
		while($linha_email = $consulta->fetch(PDO::FETCH_OBJ))
		{
			$sql_email = "SELECT nome, sobrenome, email FROM usuario WHERE login = ?";
			$consulta_email = $db->prepare($sql_email);
			$consulta_email->bindParam(1,$linha_email->login, PDO::PARAM_STR);
			$consulta_email->execute();
			$dados = $consulta_email->fetch(PDO::FETCH_ASSOC);
			
			# CONFIGURAÇÃO DO E-MAIL
					
			echo $linha_email->login."<br>";
			$Nome = $dados['nome']. " " .$dados['sobrenome'];
			$Email = $dados['email'];
			define('GUSER', 'projeto.kepler@gmail.com');	// <-- Insira aqui o seu GMail
			define('GPWD', 'kepler123');		// <-- Insira aqui a senha do seu GMail

			function smtpmailer($para, $de, $de_nome, $assunto, $corpo) { 
				global $error;
			
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
									alçfjkaslçdf
								</center>
								</html>
								';
				$phpmail->Body = utf8_decode($body);
				$mail->AddAddress($para);
				$mail->Send();			
			}			
			smtpmailer($Email, 'projeto.kepler123', '', 'Recuperação de senha');				
		}
	}
    echo $num_linhas; 
?>