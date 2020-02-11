<?php session_start(); ?> <html>
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
	<link rel="icon" href="imagens/logomarca.png">
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<title>Kepler</title>
	<script>
 	 $( function() {
   	 $("#datepicker").datepicker({
						dateFormat: 'dd/mm/yy',
						changeMonth: true,
						changeYear: true,
						yearRange: "-114:-7",
						minDate: "-100Y", 
						maxDate: "+30D +0M -4Y"
						});
	 $("#datepicker").mask("99/99/9999");
  		} );

	</script>
	
</head>

<body style="font-family: 'Raleway', sans-serif;">
	<?php 
		include "cabecalho.php"; 
	?>
	<div id="mae" style="width:1010px;max-width:1010px;background-color:red;margin: 0 auto;"><div id="cont-centro" style="padding-top:3px;margin-left:0px;">
		<?php
			if($_SESSION['logado'] != 1)
			{
		?>
		<h2>Cadastro</h2>
		
		<div id="cad-ambos" style="background-color:transparent;
		min-height:500px;
		max-height:580px;
		min-width:960px;
		max-width:960px;
		float:left;margin-bottom:5px;">
		<form action="confirma-cadastro.php" enctype="multipart/form-data" method="POST">
			<div style="background-color:transparent;width:450px;float:right;border:1px solid #D8D8D8;border-radius:2px;padding:10px;">
				<div id="cad-avatarbox"><div id="imgperfil" name="imgperfil" style="background-image: url('imagens/perfil-default.png');background-size:148px;background-repeat: no-repeat;background-position: center;background-color:black;width:148px;height:148px;border: 1px solid #bdbdbd; float:left;"></div></div>
				Avatar<br>
				<input type="hidden" name="MAX_FILE_SIZE" value="3000000"> <!-- Tamanho máximo de 3MB -->
				<div id="sel-img" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
					<center>
					<input type="file" accept="image/jpeg, image/png" id="img-file" name="img-file" onchange="readURL(this);" style="width:120px">
					<input type="button" style="margin-top:5px;" value="Enviar" id="enviar-file" onclick="img_uploadFILE();"></center>
					<center><font size="2px" style="margin-top:5px;">A imagem deve possuir <br>no máximo 3 MB.</font></center>
				</div><br>
				<div id="sel-img">
					<center>
					<input pattern="https?://.+" type="text" placeholder="URL da imagem aqui." id="img-url" name="img-url">
					<input type="button" style="margin-top:5px;" value="Enviar" id="enviar-url" onclick="img_uploadURL();contem();">
					</center>
				</div><br>
				<input type="button" style="width:150px" value="Remover" onclick="img_previewDEFAULT();img_uploadDEFAULT();"><br>
				<input type="hidden" id="imgperfil_txt" name="imgperfil_txt" value="<?php echo $linha_usuario['avatar']; ?>">
				<input type="hidden" id="img_modo" name="img_modo" value="<?php echo $linha_usuario['avatar']; ?>">
			</div>

			<script>
			function img_uploadURL(){ document.getElementById('img_modo').value = 'url'; }
			function img_uploadFILE(){ document.getElementById('img_modo').value = 'file'; }
			function img_uploadDEFAULT(){ document.getElementById('img_modo').value = 'default'; }
			
			function contem(){
				document.getElementById('imgperfil').style="background-image: url('"+document.getElementById('img-url').value+"');background-size:148px;background-repeat: no-repeat;background-position: center;background-color:black;width:148px;height:148px;border: 1px solid #bdbdbd; float:left;')";
				document.getElementById('imgperfil_txt').value=document.getElementById('img-url').value;
			}
			
			function img_previewDEFAULT(){
				document.getElementById('imgperfil').style="background-image: url('imagens/perfil-default.png');background-size:148px;background-repeat: no-repeat;background-position: center;background-color:black;width:148px;height:148px;border: 1px solid #bdbdbd; float:left;')";
			}
			
			function contem1(){
				var files = document.getElementById("img-file").files;
				
				for (var i = 0; i < files.length; i++)
				{
					document.getElementById('imgperfil').style="background-image: url('"+files[i].name+"');background-size:148px;background-repeat: no-repeat;background-position: center;background-color:black;width:148px;height:148px;border: 1px solid #bdbdbd; float:left;')";
				}
				
			}
			
			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#imgperfil').attr('style', "background-image: url('"+e.target.result+"');background-size:148px;background-repeat: no-repeat;background-position: center;background-color:black;width:148px;height:148px;border: 1px solid #bdbdbd; float:left;')");
					}

					reader.readAsDataURL(input.files[0]);
				}
			}

			function validatePassword(){
			var pass = document.getElementById('password');
			var passi = document.getElementById('senha');
					var p = pass.value;
					var q = passi.value;
					if (p != q)
					{
						swal({
							title: "",
							text: "Sua senhas devem ser iguais!",
							type: "error",
							showCancelButton: false,
							confirmButtonColor: "#DD6B55",
							confirmButtonText: "Ok",
							closeOnConfirm: false,
							});
						document.getElementById('password').value = "";
						document.getElementById('password').focus;
						
					}
			}

			function validateEmail(){
			var pass = document.getElementById('email2');
			var passi = document.getElementById('email');
					var p = pass.value;
					var q = passi.value;
					if (p != q)
					{
						swal({
							title: "",
							text: "Os e-mails inseridos devem ser iguais!",
							type: "error",
							showCancelButton: false,
							confirmButtonColor: "#DD6B55",
							confirmButtonText: "Ok",
							closeOnConfirm: false,
							});
						document.getElementById('email2').value = "";
						document.getElementById('email2').focus;
						
					}
			}

			</script>
			
			<div id="cad-dados" style="min-height:600px;max-height:750px;">
				<div id="cad-linha">
					<div id="cad-esquerda">Nome de Usuário<font color="red" size="3px" style="font-weight:bold;">*</font>:</div>
					<div id="cad-direita">
						<input pattern="[a-zA-Z0-9 ]+" name="usuario" type="text" value = "<?php echo $_SESSION['usuario'];?>" size="64" maxlength="64" placeholder="Nome de usuário" required>
					</div>
					
					<?php
						if($_SESSION['msg_usuario'] == "existe")
						{
							echo "<p style = \"color : red; margin-bottom: -38px;\">Nome de usuáiro já existe!</p>";
						}
						elseif($_SESSION['msg_usuario'] == "existe1")
						{
							echo "<p style = \"color : red; margin-bottom: -38px; font-size: 12px;\">Nome de usuário deve ser minúsculo!</p>";
						}
					?>
					<br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">Nome Completo<font color="red" size="3px" style="font-weight:bold;">*</font>:</div>
					<div id="cad-direita" style="max-width:400px;"><input pattern="[a-zA-Z0-9 ]+" name="nome" type="text" value = "<?php echo $_SESSION['nome'];?>" size="30" maxlength="30" placeholder="Nome" style="width:130px;margin-right:5px;" required><input pattern="[a-zA-Z0-9 ]+" name="sobrenome" type="text" value = "<?php echo $_SESSION['sobrenome'];?>" size="50" maxlength="50" placeholder="Sobrenome" style="width:130px;" required></div><br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">Senha<font color="red" size="3px" style="font-weight:bold;">*</font>:
					</div>
					<div id="cad-direita"><input id="senha" name="senha" type="password" size="64" maxlength="64" placeholder="Senha" required>
					</div>
					<div id="icon-img" style="background-image: url('imagens/info.png');
							margin-left:0px;margin-right:-15px;cursor:pointer;float:left;height:30px;" title="Sua senha deve conter, no mínimo, 5 caracteres.">
					</div>
					<!--<a href="#"  data-placement="right" title="Sua senha deve conter, no mínimo, 5 caracteres."><img src="imagens/info.png" height="30px"></a> -->
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">Confirme sua Senha<font color="red" size="3px" style="font-weight:bold;">*</font>:</div>
					<div id="cad-direita"><input id="password" type="password" size="64" maxlength="64" onblur="validatePassword()" placeholder="Confirmar senha" required>
					</div>
					<br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">Data de Nascimento<font color="red" size="3px" style="font-weight:bold;">*</font>:</div>
					<div id="cad-direita">
						<input name="data" type="text" value="<?php echo $_SESSION['data_nasc'];?>" class="cad-data" style="margin-right:10px;height:32px;" id="datepicker" placeholder="Data" readonly>
					</div>
					<br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">E-mail<font color="red" size="3px" style="font-weight:bold;">*</font>:
					</div>
					<div id="cad-direita">
						<input pattern="[a-zA-Z0-9]{@}+" id = "email" name="email" type="text" value = "<?php echo $_SESSION['email'];?>" placeholder="E-mail" size="64" maxlength="64">
					</div>
					<?php
						if($_SESSION['msg_email'] == "existe")
						{
							echo "<p style = \"color : red; margin-top: 10px; ;margin-bottom: -30px;\">E-mail já existe!</p>";
						}
						if($_SESSION['msg_email'] == "existe2")
						{
							echo "<p style = \"color : red; margin-top: -8x; ;margin-bottom: -30px;\">Formato de e-mail inválido!</p>";
						}
						if($_SESSION['msg_email_retorna'] != null)
						{
							echo "<p style = \"color : red; margin-top: -8x; ;margin-bottom: -30px;\">".$_SESSION['msg_email_retorna']."!</p>";
						}
					?>
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">Confirmar e-mail<font color="red" size="3px" style="font-weight:bold;">*</font>:
					</div>
					<div id="cad-direita">
						<input pattern="[a-zA-Z0-9]{@}+" id = "email2" name="email" type="text" onblur="validateEmail()" value = "<?php echo $_SESSION['email'];?>" placeholder="Confirmar e-mail" size="64" maxlength="64">
					</div>
					<br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<script type="text/javascript">
					function alterar_captcha()
					{
						img=document.getElementById('img_captcha');
						img.src="captcha.php";
					}
				</script>
				<div id="cad-linha">
					<center>
					<div id="icon-img" style="background-image: url('imagens/atualizar.png');
							margin-left:0px;margin-right:-15px;cursor:pointer;float:left;" title="Atualizar" onClick="alterar_captcha()">
					</div>
					<img name="img_captcha" id="img_captcha" src="captcha.php" alt="Código captcha"><br>		
					<br>
					<?php
						if($_SESSION['msg'] == "existe")
						{
							echo "<p style = \"color : red; margin-bottom: -20px;\">Preencha o captcha corretamente!</p>";
						}
					?>
					<br>Insira os caracteres acima:<br>
					<input type="text" name = "captcha" size="10" maxlength="8" style="width:100px">
					</center>
					<br><hr class="est1" style="margin-top:-10px;margin-bottom:8px;">
				</div>
			</div>
		</div>
		<?php
			unset($_SESSION['usuario']);
			unset($_SESSION['nome']);
			unset($_SESSION['sobrenome']);
			unset($_SESSION['data']);
			unset($_SESSION['email']);
			unset($_SESSION['msg']);
			unset($_SESSION['msg_usuario']);
			unset($_SESSION['msg_email']);
			unset($_SESSION['msg_email_retorna']);
		?>
		<input type="submit" value="Finalizar" style = "margin-left:10px; margin-top: -35px;">
		</form>
	<?php
		}
		else{ 
	?>
	<!--<h2>Cadastro</h2><hr class="est1">
	<div style="background-color:black;padding:10px;border-radius:7px;">
		<font style="color:white;">Você parece já ter realizado login, sendo assim, não pode acessar a página Cadastro.<br>Tente novamente após fazer <a href="logout.php" style="color:white;">Logout</a>.</font>
	</div>-->
	<?php echo '<script type="text/javascript">window.location = "index.php"</script>'; ?>
	
	<?php 
			} 
	?>		
	
	</div>
	
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
	<?php 
		include "rodape.php"; 
	?>
	
	<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();   
	});
	</script>
</body>
</html>