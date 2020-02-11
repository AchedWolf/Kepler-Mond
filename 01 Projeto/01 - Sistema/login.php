<?php session_start(); ?>
<html>
<head>
	<link href='css/estilo23.css' rel='stylesheet' type='text/css'>
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
		
		<!--Menu do Centro - INICIO -->
		<div id="mae" style="width:1010px;max-width:1010px;background-color:red;margin: 0 auto;"><div id="cont-centro" style="padding-top:3px;margin-left:0px;">
		<?php if($_SESSION['logado']!=1){ ?>
			<div id="login-esquerda">
				<h3>Login</h3>
				Entre com uma conta já existente.<br><br>
				
				<form action="login-enviar.php" method="post">
					<input type="text" name="login" id="login" placeholder="Nome de usuário" size="64" maxlength="64" required style="margin-bottom:6px"><br>
					<input type="password" name="senha" id="senha" placeholder="Senha" size="64" maxlength="64" required><br><br>
					
					<input type="submit" class="btn btn-primary btn3d" style="width:165px;margin-bottom:-35px;" value="Login">
				</form><br><br>
				
				<a href="" data-toggle="modal" data-target="#myModal" style="color:#337AB7">Esqueceu sua senha?</a>
				  <!-- Modal -->
				<div class="modal fade" id="myModal" role="dialog">
				    <div class="modal-dialog">
				      <!-- Modal content-->
				      <div class="modal-content">
					        <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal">&times;</button>
						        <h4 class="modal-title">Recuperar senha</h4>
					        </div>
					        <div class="modal-body">
					        	<form action = "envia_email.php" method = "post">
					        		Insira abaixo o e-mail utilizado ao cadastrar a sua conta.
					        		<br>
					        		Dentre de 10 minutos você receberá um e-mail que irá orientá-lo.
					        		<br><br>
									<input name="email" type="email" placeholder="E-mail" size="65" maxlength="65" onload="document.form.nomebotao.focus()" 
									style="width:250px;padding:5px;" required>
					        </div>
					        <div class="modal-footer">
					        		<input type = "reset" class="btn btn-default" value = "Limpar" 
										style = "width: 100px; float: left">
					        		<input type = "submit" class="btn btn-default" value = "Enviar"
					        			style = "width: 100px; float: right;">
					        	</form>
					        </div>
				    	</div> 
				    </div>
				</div>


			</div>
			
			<div id="login-direita">
				<h3>Cadastre-se</h3>
				Não possui uma conta? Crie uma agora mesmo!<br><br>
				Criando uma conta, você terá acesso a diversas funções, como reservar um horário que deseja para assistir um astro direto do nosso telescópio, além de 
				ser capaz de controlá-lo!<br>
				<br><form action="cadastro.php"><input type="submit" class="btn btn-primary btn3d" style="width:165px;margin-bottom:-35px;" value="Cadastrar-se"></form>
			</div>
		<?php }
		else{
			echo '<script type="text/javascript">window.location = "index.php"</script>';
		}?>
		</div>
		<!--Menu do Centro - FIM -->
	
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
		<!-- TOPO - FIM -->
	
	</div>
	<?php include "rodape.php"; ?>
</html>
</body>