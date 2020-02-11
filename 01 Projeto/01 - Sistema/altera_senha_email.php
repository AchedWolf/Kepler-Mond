<?php session_start(); 
include("conecta.php");
?>

<html>
<head>
	<link href='css/estilo22.css' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<link rel="icon" href="imagens/logomarca.png">
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<title>Kepler</title>
</head>
<?php
	include("cabecalho.php");
?>

<body style="font-family: 'Raleway', sans-serif;">	
	<div id="mae" style="width:1010px;max-width:1010px;background-color:red;margin: 0 auto;margin-top:50px;">
		<div id="cont-centro" style="padding-top:3px;margin-left:0px; min-height:358px;">
					
		<script type="text/javascript">
			function verificar()
			{
				var nova_senha=document.getElementById('nova_senha').value;
				var confirm_nova_senha=document.getElementById('confirm_nova_senha').value;
				if(nova_senha != confirm_nova_senha)
				{
					document.getElementById("senha_msg").style = "color:red;";
					document.getElementById("senha_msg").innerHTML = "<br>As senhas não coincidem. Por favor, digite-as corretamente.";
				document.getElementById("salvar").style = "opacity:0.5;color:#E4E4E4;pointer-events: none;";
					return false;
				}
				document.getElementById("senha_msg").style = "color:green;";
				document.getElementById("senha_msg").innerHTML = "<br>As senhas coincidem.";
				document.getElementById("salvar").style = "";
				return true;
			}
		</script>

<?php
$entrou = 0;
if(isset($_GET['codigo']) and $_SESSION['logado'] != 1)
{
	$entrou = 1;
	$codigo = $_GET['codigo'];
	$email_codigo = base64_decode($codigo);
	$_SESSION['email'] = $email_codigo;
	$_SESSION['codigo'] = $codigo;

	$sql ="SELECT * FROM codigo_email WHERE codigo = ? AND data > NOW() AND excluido = 'n';";
	$consulta = $db->prepare($sql);
	$consulta->bindParam(1,$codigo, PDO::PARAM_STR);
	$consulta->execute();
	$num_linhas = $consulta->rowCount();


	
	if($num_linhas > 0)
	{
		$linha_resultado = $consulta->fetch(PDO::FETCH_ASSOC);
		$_SESSION['id'] = $linha_resultado['id'];

?> 
		<h2>Alterar senha</h2>
		<form method="POST" action="confirma_senha_email.php">			
			<div style="width:960px;float:left;border: 1px solid #D8D8D8;border-radius: 2px;padding:10px;">
				<br>
				<div style="float:right">
					<img src="imagens/chave_vector.png" height="100px">
				</div>
				<div id="cad-linha" style="margin-bottom:10px;">
					<div id="cad-esquerda">Nova Senha<font color="red" size="3px" style="font-weight:bold;">*</font>:</div>
					<div id="cad-direita"><input type="password" name="nova_senha" id="nova_senha" size="64" maxlength="64" pattern=".{5,}" required></div>
				</div>
				<div id="cad-linha" style="margin-bottom: -10px;">
					<div id="cad-esquerda">Confirme sua nova senha<font color="red" size="3px" style="font-weight:bold;">*</font>:</div>
					<div id="cad-direita"><input type="password" name="confirmacao_nova_senha" id="confirm_nova_senha"  size="64" maxlength="64" pattern=".{5,}" onkeyup="verificar()" required></div><br><br>
					<font size="2px">A nova senha deve conter, no mínimo, 5 caracteres.</font>
				</div>
				<div id="cad-linha">
					<span style="color:red" id="senha_msg"></span>
				</div>
			</div>
		
		<div style="float:left;margin-top:10px">
			<a href="login.php" class="btn btn-primary btn3d" style="width:165px;margin-bottom:-65px;color: white;">Cancelar</a>
			<input type="submit" value="Salvar Dados" class="btn btn-primary btn3d" style="width:165px;margin-bottom:-65px;">
		</div>
		</div>
		</form>
	</div>
<?php
	}
	else{
?>
	<div>
		<br>
		Este link parece estar expirado.
		<br>Se deseja alterar a sua senha novamente, por favor, realize o mesmo processo, indo à página de login, através do botão abaixo, e clicando em "Esqueceu sua senha?" para receber um e-mail com as instruções.
	</div><br><br>
	<a href="login.php" class="btn btn-primary btn3d" style="width:165px;margin-bottom:-65px;color: white;">Login</a>
<?php
	}
}
if($_SESSION['logado'] == 1)
{
	$entrou = 1;
?>
	<div style="font-size:16px;">
		<br>
		Parece que você já está logado em sua conta.
		<br>Caso queira alterar sua senha, clique no botão abaixo e preencha os campos com seus dados.
	</div><br>
	<a href="perfil-senha.php" class="btn btn-primary btn3d" style="width:165px;margin-bottom:-65px;color: white;">Alterar senha</a>
	
<?php
}
if($entrou == 0)
{
?>
	<font style="color:red;font-weight:bold;">
	<br>
		Você não possui permissão para visualizar esta página.
	</font>
<?php
}

?>
</div>
</div>
<?php

	include("rodape.php");
?>
	
		<!-- TOPO - INICIO -->
		<a onclick="scrollToTop(400);" style="display:block;">
			<div id="voltaraotopo" title="Voltar ao Topo">
				<img src="imagens/topo.png" height="50px" class="floating">
			</div>
		</a>
		<script>
		function scrollToTop(scrollDuration) {
		const   scrollHeight = window.scrollY,
		        scrollStep = Math.PI / ( scrollDuration / 15 ),
		        cosParameter = scrollHeight / 2;
		var     scrollCount = 0,
		        scrollMargin,
		        scrollInterval = setInterval( function() {
		            if ( window.scrollY != 0 ) {
		                scrollCount = scrollCount + 1;  
		                scrollMargin = cosParameter - cosParameter * Math.cos( scrollCount * scrollStep );
		                window.scrollTo( 0, ( scrollHeight - scrollMargin ) );
		            } 
		            else clearInterval(scrollInterval); 
		        }, 15 );
		}
		</script>
		</div>
		
		<!-- TOPO - FIM -->
	</div>	
	<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();   
	});
	</script>
</body>
</html>