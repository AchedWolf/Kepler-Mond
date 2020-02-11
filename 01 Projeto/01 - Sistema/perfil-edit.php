<?php
	session_start();
?>
<html lang="pt-br">
<head>
	<link href="css/estilo23.css" rel="stylesheet" type="text/css">
	<link href="estilo23.css" rel="stylesheet" type="text/css">
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
	<?php include "cabecalho.php";
		include "conecta.php";
		
		$consulta = $db->prepare('SELECT * FROM usuario WHERE login = ? AND excluido = \'n\';');
		$consulta->bindParam(1,$_SESSION['login'], PDO::PARAM_STR);
		$consulta->execute();	
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas < 1)
		{
			include "404.php";
		}
		else
		{
			$linha_usuario = $consulta->fetch(PDO::FETCH_ASSOC);
		?>
	<div id="mae" style="width:1010px;max-width:1010px;background-color:red;margin: 0 auto;">
	<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
		<h2>Editar Perfil</h2>
		<a href="perfil-senha.php" style="float:left;">Alterar senha</a>
		
		
		<div id="cad-ambos" style="background-color:transparent;min-width:960px;max-width:960px;float:left;margin-bottom:10px;margin-top:10px;">
		<form method="POST" enctype="multipart/form-data" action="confirma-perfil.php" style="display:inline;">
			<div style="background-color:transparent;width:450px;float:right;border:1px solid #D8D8D8;border-radius:2px;padding:10px;">
				<div id="cad-avatarbox"><div id="imgperfil" name="imgperfil" style="background-image: url('<?php echo $linha_usuario['avatar']; ?>');background-size:148px;background-repeat: no-repeat;background-position: center;background-color:black;width:148px;height:148px;border: 1px solid #bdbdbd; float:left;"></div></div>
				Avatar<br>
				<input type="hidden" name="MAX_FILE_SIZE" value="3000000"> <!-- Tamanho máximo de 3MB -->
				<div id="sel-img" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
					<center>
					<input type="file" accept="image/jpeg,image/png" id="img-file" name="img-file" onchange="readURL(this);" style="width:120px">
					<input type="button" style="margin-top:5px;" value="Enviar" id="enviar-file" onclick="img_uploadFILE();"></center>
					<center><font size="2px" style="margin-top:5px;">A imagem deve possuir <br>no máximo 3 MB.</font></center>
				</div><br>
				<div id="sel-img">
					<center>
					<input type="text" placeholder="URL da imagem aqui." id="img-url" name="img-url">
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
			</script>
			
			<div style="background-color:transparent;width:500px;float:left;border:1px solid #D8D8D8;border-radius:2px;padding:10px;">
				<input readonly name="login" type="hidden" size="64" maxlength="64" value="<?php echo $linha_usuario['login']; ?>" required>
				<div id="cad-linha">
					<div id="cad-esquerda">Nome Completo<font color="red" size="3px" style="font-weight:bold;">*</font>:</div>
					<div id="cad-direita" style="max-width:400px;"><input pattern="[a-zA-Z0-9]+" type="text" size="32" maxlength="32" placeholder="Nome" name="nome" value="<?php echo $linha_usuario['nome']; ?>" style="width:130px;margin-right:5px;"  required><input pattern="[a-zA-Z0-9 ]+" type="text" size="32" maxlength="32" placeholder="Sobrenome" name="sobrenome" value="<?php echo $linha_usuario['sobrenome']; ?>" style="width:130px;" required></div><br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">CPF:</div>
					<div id="cad-direita"><input name="cpf" type="text" size="14" maxlength="14"
					onkeypress="return mascara(this, '###.###.###-##',event)" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" maxlength="14" value="<?php echo $linha_usuario['cpf']; ?>" oninvalid="setCustomValidity('Número de CPF inválido. Por favor, redigite.')"
					onchange="try{setCustomValidity('')}catch(e){}"></div><br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">Nível Acadêmico:</div>
					<div id="cad-direita">
						<select name="nivel" class="cad" style="width:250px;">							
							<option value="fund_incomp" <?php if($linha_usuario['nvl_acad']=='fund_incomp'){ echo "selected"; } ?>>Ensino fundamental incompleto</option>
							<option value="fund_comp" <?php if($linha_usuario['nvl_acad']=='fund_comp'){ echo "selected"; } ?>>Ensino fundamental completo</option>
							<option value="medio_incomp" <?php if($linha_usuario['nvl_acad']=='medio_incomp'){ echo "selected"; } ?>>Ensino médio incompleto</option>
							<option value="medio_comp" <?php if($linha_usuario['nvl_acad']=='medio_comp'){ echo "selected"; } ?>>Ensino médio completo</option>						
							<option value="sup_incomp" <?php if($linha_usuario['nvl_acad']=='sup_incomp'){ echo "selected"; } ?>>Ensino superior incompleto</option>
							<option value="sup_comp" <?php if($linha_usuario['nvl_acad']=='sup_comp'){ echo "selected"; } ?>>Ensino superior completo</option>
							<option value="pos_comp" <?php if($linha_usuario['nvl_acad']=='pos_comp'){ echo "selected"; } ?>>Pós graduação completa</option>
						</select>
					</div><br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">Cidade:</div>
					<div id="cad-direita"><input pattern="[a-zA-Z0-9 ]+" type="text" size="64" maxlength="64" name="cidade" value="<?php echo $linha_usuario['cidade']; ?>"></div><br>
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">Estado:</div>
					<div id="cad-direita" >
						<select name="estado" class="cad">
							<option value="" <?php if($linha_usuario['estado']==NULL){ echo "selected"; } ?> disabled>[Nenhum]</option>
							<option value="AC" <?php if($linha_usuario['estado']=='AC'){ echo "selected"; } ?>>AC</option>
							<option value="AL" <?php if($linha_usuario['estado']=='AL'){ echo "selected"; } ?>>AL</option>
							<option value="AM" <?php if($linha_usuario['estado']=='AM'){ echo "selected"; } ?>>AM</option>
							<option value="AP" <?php if($linha_usuario['estado']=='AP'){ echo "selected"; } ?>>AP</option>						
							<option value="BA" <?php if($linha_usuario['estado']=='BA'){ echo "selected"; } ?>>BA</option>
							<option value="CE" <?php if($linha_usuario['estado']=='CE'){ echo "selected"; } ?>>CE</option>
							<option value="DF" <?php if($linha_usuario['estado']=='DF'){ echo "selected"; } ?>>DF</option>
							<option value="ES" <?php if($linha_usuario['estado']=='ES'){ echo "selected"; } ?>>ES</option>
							<option value="GO" <?php if($linha_usuario['estado']=='GO'){ echo "selected"; } ?>>GO</option>
							<option value="MA" <?php if($linha_usuario['estado']=='MA'){ echo "selected"; } ?>>MA</option>
							<option value="MG" <?php if($linha_usuario['estado']=='MG'){ echo "selected"; } ?>>MG</option>
							<option value="MS" <?php if($linha_usuario['estado']=='MS'){ echo "selected"; } ?>>MS</option>
							<option value="MT" <?php if($linha_usuario['estado']=='MT'){ echo "selected"; } ?>>MT</option>
							<option value="PA" <?php if($linha_usuario['estado']=='PA'){ echo "selected"; } ?>>PA</option>
							<option value="PB" <?php if($linha_usuario['estado']=='PB'){ echo "selected"; } ?>>PB</option>
							<option value="PE" <?php if($linha_usuario['estado']=='PE'){ echo "selected"; } ?>>PE</option>
							<option value="PI" <?php if($linha_usuario['estado']=='PI'){ echo "selected"; } ?>>PI</option>
							<option value="PR" <?php if($linha_usuario['estado']=='PR'){ echo "selected"; } ?>>PR</option>
							<option value="RJ" <?php if($linha_usuario['estado']=='RJ'){ echo "selected"; } ?>>RJ</option>
							<option value="RN" <?php if($linha_usuario['estado']=='RN'){ echo "selected"; } ?>>RN</option>						
							<option value="RO" <?php if($linha_usuario['estado']=='RO'){ echo "selected"; } ?>>RO</option>
							<option value="RR" <?php if($linha_usuario['estado']=='RR'){ echo "selected"; } ?>>RR</option>
							<option value="RS" <?php if($linha_usuario['estado']=='RS'){ echo "selected"; } ?>>RS</option>
							<option value="SC" <?php if($linha_usuario['estado']=='SC'){ echo "selected"; } ?>>SC</option>
							<option value="SE" <?php if($linha_usuario['estado']=='SE'){ echo "selected"; } ?>>SE</option>
							<option value="SP" <?php if($linha_usuario['estado']=='SP'){ echo "selected"; } ?>>SP</option>
							<option value="TO" <?php if($linha_usuario['estado']=='TO'){ echo "selected"; } ?>>TO</option>
						</select>
					</div><br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">E-Mail<font color="red" size="3px" style="font-weight:bold;">*</font>:
					</div>
					<div id="cad-direita">
						<input pattern="[a-zA-Z0-9]{@}+" type="email" style="padding:5px;width:168px;" size="64" maxlength="64" name="email" value="<?php echo $linha_usuario['email']; ?>" required>
					</div>					
					<br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">Sobre:</div>
					<div id="cad-direita">
						<textarea pattern="[a-z]{1,30}(,[a-z]{1,30})*" name="sobre" rows="5" cols="33" maxlength="5000"><?php echo $linha_usuario['sobre']; ?></textarea>
					</div><br><br><br><br><br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">Website:</div>
					<div id="cad-direita"><input pattern="https?://.+" type="text" size="200" maxlength="200" style="width:250px" name="link_user" value="<?php echo $linha_usuario['link_user']; ?>"></div>
				</div>
			</div>
		</div>
		
		<div style="float:left;margin-top:40px">
			<button style="width:165px;height:34px;" OnClick="history.back()">Cancelar</button>
			<input type="submit" style="width:165px;" value="Salvar Dados">
		</div>
		
		</form>
	</div>
		<?php 
			}
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

		function PermiteNumeros()
		{
			  var tecla = window.event.keyCode;
			  tecla = String.fromCharCode(tecla);
			  if(!((tecla >= "0") && (tecla <= "9")))
			  {
			    window.event.keyCode = 0;
				return false;
			  }
			  return true;
			  
		}

		function mascarafasdf(t, mask, event){
			if(PermiteNumeros())
			{
				var i = t.value.length;
				if(i==0)
				{
					t.value+="(";
				}
				if(i==3)
				{
					t.value+=") ";
				}
				var saida = mask.substring(1,0);
				var texto = mask.substring(i);
				if (texto.substring(0,1) != saida){
					t.value += texto.substring(0,1);
		 		}
		 		return true;
			}
			else
			{
				return false;
			}
		}	
			

	 	function mascara(t, mask,event){
		if(PermiteNumeros())
		{
			var i = t.value.length;
			var saida = mask.substring(1,0);
			var texto = mask.substring(i)
			
			if (texto.substring(0,1) != saida)
			{	
			
				t.value += texto.substring(0,1);
			}
			return true;
		}
		else
		{
			return false;
		}
			
 }
		</script>
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
	<?php include "rodape.php"; ?>
</body>
</html>