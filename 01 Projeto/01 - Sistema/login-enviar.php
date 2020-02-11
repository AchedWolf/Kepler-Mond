<?php
	session_start();
	include "conecta.php";
?>
<html>
<head>
	<link rel="icon" href="imagens/logomarca.png">
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<title>Kepler</title>
</head>

<body>
	<?php
		$login = $_POST['login'];
		$loginpdo = strtolower($login);
		$senha1 = $_POST['senha'];
		$senha2 = md5($_POST['senha']);
		
		$sql = "SELECT * FROM usuario WHERE (login = ?) OR (email = ?);";
		$consulta = $db->prepare($sql);
		$consulta->bindParam(1,$loginpdo, PDO::PARAM_STR);
		$consulta->bindParam(2,$loginpdo, PDO::PARAM_STR);
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
		
		if($num_linhas > 0)
		{
			//Se usuário estiver banido.
			if($linha['excluido'] == 's' && $linha['tempo_ban'] != NULL){
				if($linha['tempo_ban'] > date('d/m/Y H:i')){
					echo '<script type="text/javascript">
						swal({
						text: "Esta conta de usu\u00e1rio foi banida até '.$linha['tempo_ban'].' por violar uma de nossas regras. Se ela pertencia a você e deseja saber mais informações sobre o banimento, contate um dos administradores.",
						title: "Usu\u00e1rio Banido",
						type: "info",
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
				else if($linha['tempo_ban'] < date('d/m/Y H:i')){
					$consulta_ban = $db->prepare('UPDATE usuario SET excluido = \'n\', tempo_ban = null WHERE login = ?');
					$consulta_ban->bindParam(1,$loginpdo, PDO::PARAM_STR);
					$consulta_ban->execute();
					
					$_SESSION['logado'] = 1;
					$_SESSION['login'] = $linha['login'];
					$_SESSION['tipo'] = $linha['tipo'];
					$_SESSION['email'] = $linha['email'];
					$_SESSION['nome'] = $linha['nome'];
					$_SESSION['sobrenome'] = $linha['sobrenome'];
					$_SESSION['avatar'] = $linha['avatar'];
					
					
					date_default_timezone_set("America/Sao_Paulo");
					$diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
					$dataaaa = date('Y/m/d H:i:s');
					$diasemana_numero = date('w', strtotime($dataaaa));
					
					$horario = date('H:i:s');
					
					$str_time = $horario;
					sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
					$time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
						
					/* Marcar como excluido na tabela REGISTROS. Procedimento feito caso o usuario tenha fechado o navegador ou a aba sem fazer logout.
					*/
					$sqll ="SELECT tempo_total FROM registros WHERE login = ? AND excluido = 'n'";
					$consulta = $db->prepare($sqll);
					$consulta->bindParam(1, $login, PDO::PARAM_STR);
					$consulta->execute();
					$linha = $consulta->rowCount();
					$resultado = $consulta->fetch(PDO::FETCH_OBJ);
					
					if($linha > 0)
					{
						$entrou = $resultado->segundos;
						$tempo_fim = $resultado->tempo_total;
						$sqll ="UPDATE registros SET excluido  = 's' WHERE login = ? AND excluido = 'n'";
						$altera = $db->prepare($sqll);
						$altera->bindParam(1, $login, PDO::PARAM_STR);
						$altera->execute();
					}	


					$sqll ="INSERT INTO registros values(nextval('registros_id_horario_seq'::regclass), ?, ?, null, ?, 'n');";
					$insere = $db->prepare($sqll);
					$insere->bindParam(1,$_SESSION['login'], PDO::PARAM_STR);
					$insere->bindParam(2,$time_seconds, PDO::PARAM_STR);
					$insere->bindParam(3,$diasemana[$diasemana_numero], PDO::PARAM_STR);
					$insere->execute();
					
					echo "<meta http-equiv='refresh' content='0; url=index.php'>";
				}
				else{
					echo '<script type="text/javascript">
						swal({
						title: "",
						text: "Parece que ocorreu um erro. Por favor, tente novamente.",
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

			# Conta não confirmada pelo e-mail
			else if($linha['excluido'] == "ns")
			{
				echo '<script type="text/javascript">
						swal({
						title: "",
						text: "\u00c9 necess\u00e1rio realizar a confirma\u00e7\u00e3o de cadastro para efetuar o login. Entre no seu e-mail cadastrado para fazer a confirma\u00e7\u00e3o.",
						type: "error",
						showCancelButton: false,
						confirmButtonColor: "#3085d6",
						confirmButtonText: "Ok",
						closeOnConfirm: false,
					},
					function(){
						window.location.assign("login.php?login='.$login.'");
						}
					);</script>';
			}
			
			//Se logou normalmente.
			else if($senha1 == $linha['senha'] || $senha2 == $linha['senha'])
			{
				$_SESSION['logado'] = 1;
				$_SESSION['login'] = $linha['login'];
				$_SESSION['tipo'] = $linha['tipo'];
				$_SESSION['email'] = $linha['email'];
				$_SESSION['nome'] = $linha['nome'];
				$_SESSION['sobrenome'] = $linha['sobrenome'];
				$_SESSION['avatar'] = $linha['avatar'];
				
				
				date_default_timezone_set("America/Sao_Paulo");
				$diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
				$dataaaa = date('Y/m/d H:i:s');
				$diasemana_numero = date('w', strtotime($dataaaa));
				
				$horario = date('H:i:s');
				
				$str_time = $horario;
				sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
				$time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
					
				/* Marcar como excluido na tabela REGISTROS. Procedimento feito caso o usuario tenha fechado o navegador ou a aba sem fazer logout.
				*/
				$sqll ="SELECT tempo_total FROM registros WHERE login = ? AND excluido = 'n'";
				$consulta = $db->prepare($sqll);
				$consulta->bindParam(1, $login, PDO::PARAM_STR);
				$consulta->execute();
				$linha = $consulta->rowCount();
				$resultado = $consulta->fetch(PDO::FETCH_OBJ);
				
				if($linha > 0)
				{
					$entrou = $resultado->segundos;
					$tempo_fim = $resultado->tempo_total;
					$sqll ="UPDATE registros SET excluido  = 's' WHERE login = ? AND excluido = 'n'";
					$altera = $db->prepare($sqll);
					$altera->bindParam(1, $login, PDO::PARAM_STR);
					$altera->execute();
				}	


				$sqll ="INSERT INTO registros values(nextval('registros_id_horario_seq'::regclass), ?, ?, null, ?, 'n');";
				$insere = $db->prepare($sqll);
				$insere->bindParam(1,$_SESSION['login'], PDO::PARAM_STR);
				$insere->bindParam(2,$time_seconds, PDO::PARAM_STR);
				$insere->bindParam(3,$diasemana[$diasemana_numero], PDO::PARAM_STR);
				$insere->execute();
				
				echo "<meta http-equiv='refresh' content='0; url=index.php'>";
			}
			//Se usuário existe a senha estiver incorreta.
			else{
				/*echo "<meta http-equiv='refresh' content='0; url=login.php?login='".$login."'>";
				echo '<script language="javascript">alert("Senha incorreta. Por favor, tente novamente.");</script>';*/
				echo '<script type="text/javascript">
					swal({
					title: "",
					text: "Senha incorreta. Por favor, tente novamente.",
					type: "error",
					showCancelButton: false,
					confirmButtonColor: "#3085d6",
					confirmButtonText: "Ok",
					closeOnConfirm: false,
				},
				function(){
					window.location.assign("login.php?login='.$login.'");
					}
				);</script>';
			}
				
		}
		//Se não foi encontrado o nome de usuário.
		else{
			/*echo "<meta http-equiv='refresh' content='0; url=login.php?login='".$login."'>";
			echo '<script language="javascript">alert("Este usuário não existe. Por favor, tente novamente.");</script>';*/
			echo '<script type="text/javascript">
					swal({
					title: "",
					text: "Parece que este usu\u00e1rio n\u00e3o existe. Por favor, tente novamente.",
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
		
	?>
</body>
</html>