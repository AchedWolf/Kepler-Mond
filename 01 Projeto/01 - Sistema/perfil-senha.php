<?php session_start(); ?> <html>
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

<body style="font-family: 'Raleway', sans-serif;">
	<?php include "cabecalho.php"; ?>
	
	<div id="mae" style="width:1010px;max-width:1010px;background-color:red;margin: 0 auto;">
		<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
		<h2>Alterar senha</h2>
		
		<?php
		include "conecta.php";
		$consulta = $db->prepare('SELECT * FROM usuario WHERE login = ? AND excluido = \'n\';');
		$consulta->bindParam(1,$_SESSION['login'], PDO::PARAM_STR);
		$consulta->execute();	
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas < 1)
		{
			echo "Nenhum usuário encontrado";
		}
		else
		{
			$linha_usuario = $consulta->fetch(PDO::FETCH_ASSOC);
		?>
		
		<script type="text/javascript">
			function verificar()
			{
				var nova_senha=document.getElementById('nova_senha').value;
				var confirm_nova_senha=document.getElementById('confirm_nova_senha').value;
				if(nova_senha != confirm_nova_senha)
				{
					document.getElementById("senha_msg").style = "color:red;";
					document.getElementById("senha_msg").innerHTML = "As senhas não coincidem. Por favor, digite-as corretamente.";
				document.getElementById("salvar").style = "opacity:0.5;color:#E4E4E4;pointer-events: none;";
					return false;
				}
				document.getElementById("senha_msg").style = "color:green;";
				document.getElementById("senha_msg").innerHTML = "As senhas coincidem.";
				document.getElementById("salvar").style = "";
				return true;
			}
		</script>
		<form method="POST" action="perfil-alterar-senha.php">			
			<div style="width:960px;float:left;border: 1px solid #D8D8D8;border-radius: 2px;padding:10px;">
				<div style="float:right">
					<img src="imagens/chave_vector.png" height="100px">
				</div>
				<div id="cad-linha" style="margin-bottom:5px;">
					<div id="cad-esquerda">Senha Atual<font color="red" size="3px" style="font-weight:bold;">*</font>:</div>
					<div id="cad-direita"><input  type="password" name="senha_atual" id="senha_atual" size="64" maxlength="64" required></div>
					<br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha" style="margin-bottom:10px;">
					<div id="cad-esquerda">Nova Senha<font color="red" size="3px" style="font-weight:bold;">*</font>:</div>
					<div id="cad-direita"><input  type="password" name="nova_senha" id="nova_senha" size="64" maxlength="64" required></div>
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">Confirme sua Nova Senha<font color="red" size="3px" style="font-weight:bold;">*</font>:</div>
					<div id="cad-direita"><input  type="password" name="confirmacao_nova_senha" id="confirm_nova_senha"  size="64" maxlength="64" onkeyup="verificar()" required></div><br><br>
					<font size="2px">A nova senha deve conter, no mínimo, 5 caracteres.</font>
				</div><br>
				<div id="cad-linha">
					<span style="color:red" id="senha_msg"></span>
				</div>
			</div>
		
		<div style="float:left;margin-top:10px">
			<a href="perfil-edit.php"><input type="button" value="Cancelar"></a>
			<input type="submit" value="Salvar Dados" id="salvar" style="opacity:0.5;color:#E4E4E4;pointer-events: none;">
		</div>
		</div>
		</form>
	</div>
	<?php } ?>
	
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
	<?php include "rodape.php"; ?>
	
	<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();   
	});
	</script>
</body>
</html>