<?php
session_start(); 
include "conecta.php";
		$id_inst = $_GET['i'];
		
		$consulta_inst = $db->prepare('SELECT * FROM instituicao WHERE id_inst = ? AND excluido = \'n\'');
		$consulta_inst->bindParam(1,$id_inst, PDO::PARAM_INT);
		$consulta_inst->execute();
		$num_linhas_inst = $consulta_inst->rowCount();
		
		$consulta_relacao = $db->prepare('SELECT * FROM relacao WHERE id_inst = ? AND login = ?');
		$consulta_relacao->bindParam(1,$id_inst, PDO::PARAM_INT);
		$consulta_relacao->bindParam(2,$_SESSION['login'], PDO::PARAM_STR);
		$consulta_relacao->execute();
		$num_linhas_relacao = $consulta_relacao->rowCount();
		$linha_relacao = $consulta_relacao->fetch(PDO::FETCH_ASSOC);
		
		$linha_inst = $consulta_inst->fetch(PDO::FETCH_ASSOC);
?> <html>
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
	<title><?php if($num_linhas_inst < 1){ echo "Kepler"; } else{ echo "Editar ".$linha_inst['nome_inst']." - Kepler"; } ?></title>	
</head>

<body style="font-family: 'Raleway', sans-serif;">
	<?php include "cabecalho.php";
	
	if($num_linhas_inst < 1)
		{ ?>
			<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;"><div id="cont-centro" style="margin-left:0px">
			Esta instituição não existe. :(
			</div>
		<?php }
		else if($num_linhas_relacao < 1 || $linha_relacao['tipo'] != 1){ ?><div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;"><div id="cont-centro" style="margin-left:0px">Você não faz parte desta instituição ou não possui permissões para visualizar esta página.</div><?php }
		else{
		?>
		
		<?php			
		//Selecionar membros comuns.
		$consulta_membros  = $db->prepare("SELECT * FROM relacao,usuario WHERE relacao.id_inst = ? AND relacao.login = usuario.login AND relacao.tipo = 0;");
		$consulta_membros->bindParam(1,$linha_inst['id_inst'], PDO::PARAM_INT);
		$consulta_membros->execute();
		$num_linhas_membros = $consulta_membros->rowCount();
		
		//Selecionar membros administradores.
		$consulta_membros_adm  = $db->prepare("SELECT * FROM relacao,usuario WHERE relacao.id_inst = ? AND relacao.login = usuario.login AND relacao.tipo = 1;");
		$consulta_membros_adm->bindParam(1,$linha_inst['id_inst'], PDO::PARAM_INT);
		$consulta_membros_adm->execute();
		$num_linhas_membros_adm = $consulta_membros_adm->rowCount();
		?>
		
		<!--Menu da Esquerda - INICIO -->
		<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;">
	<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
		<h2>Editar Instituição</h2>
		<a href="inst_cargos.php?i=<?php echo $linha_inst['id_inst']; ?>" style="float:left;">Gerenciar Cargos</a>
		
		<script type="text/javascript">
		function verificar()
		{
			//VERIFICAR TELEFONE
			var teste_telefone=consistencia_telefone();
			if(teste_telefone==false)
			{
				document.getElementById("telefone_inst").focus();
				return false;
			}
			//VERIFICAR CELULAR
			var teste_celular=consistencia_celular();
			if(teste_celular==false)
			{
				document.getElementById("celular_diretor").focus();
				return false;
			}
			//alert("2");
			//VERIFICAR DATA DE NASCIMENTO
			var tentativa=consistencia_data();
			if(tentativa==false)
			{
				document.getElementById("data_de_nascimento_diretor").focus();
				return false;
			}
			//alert("3");
			//VERIFICAR CPF
			var teste_cpf=consistencia_cpf();
			if(teste_cpf==false)
			{
				document.getElementById("cpf_diretor").focus();
				return false;
			}
			//alert("5");
			//VERIFICAR O CAPTCHA
			var teste_captcha=consistencia_captcha();
			if(teste_captcha==false)
			{
				document.getElementById("captcha").focus();
				return false;
			}
			
		
			
			//alert("Dados enviados com sucesso!");
			return true;
			
		}
		
		function PermiteNumeros()
		{
				  var tecla = window.event.keyCode;
				  tecla     = String.fromCharCode(tecla);
				  if(!((tecla >= "0") && (tecla <= "9")))
				  {
					window.event.keyCode = 0;
					return false;
				  }
				  return true;
				  
		}
		
		//MÁSCARA DE TELEFONE E CELULAR
		function mascara_telefone(t, mask,event){
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
	 
		//MÁSCARA DE CPF
		function mascara_cpf(t, mask,event)
		{
			
			var i = t.value.length;
			
				var saida = mask.substring(1,0);
				var texto = mask.substring(i)
				if (texto.substring(0,1) != saida)
				{	
				
						t.value += texto.substring(0,1);
				}
		}
		
		
		//VERIFICAR SE A SENHA E O CONFIRMAR SENHA SÃO IGUAIS
		function consistencia_senha()
		{
			var senha=document.getElementById("senha").value;
			var confirmar_senha=document.getElementById("confirmar_senha").value;
			
			if(senha!=confirmar_senha)
			{
				alert("O conteúdo do campo senha está diferente do conteúdo do campo de confirmar senha. Por favor, confira os dados.");
				return false;
			}
			return true;
			//document.getElementById("senha").focus();
		}
		
		//VERIFICAR O CAPTCHA
		function consistencia_captcha()
		{
			var captcha=document.getElementById("captcha").value;
			
			
			if(captcha!="LUN%BB")
			{
				//alert("Captcha incorreto!");
				document.getElementById('cad_instituicao_entre_divs').innerHTML="Captcha incorreto!";
				return false;
			}
			return true;
			
		}
		
		
		
		//VERIFICAR O TELEFONE
		function consistencia_telefone()
		{
			var keyCode = (e.keyCode ? e.keyCode : e.which);
			if (!(keyCode > 47 && keyCode < 58)) {
				e.preventDefault();
			}
			var num_caracteres=document.getElementById("telefone_inst").value;
			var num=num_caracteres.length;
			console.log(num);
				
			if(num!=15)
			{
					alert("Número de Telefone Inválido! Por favor, redigite.");
					return false;
			}
			return true;
			
		}
		
		
		function avatar(tipo)
		{
			document.getElementById("avatar_inst").value=tipo;
		
		}
		</script>
		
		<div id="cad-ambos" style="background-color:transparent;min-width:960px;max-width:960px;float:left;margin-bottom:10px;margin-top:10px;">
		<form method="POST" enctype="multipart/form-data" action="confirma-inst.php" style="display:inline;">
			<div style="background-color:transparent;width:450px;float:right;border:1px solid #D8D8D8;border-radius:2px;padding:10px;">
				<div id="cad-avatarbox"><div id="avatar_inst" name="avatar_inst" style="background-image: url('<?php echo $linha_inst['avatar_inst']; ?>');background-size:148px;background-repeat: no-repeat;background-position: center;background-color:black;width:148px;height:148px;border: 1px solid #bdbdbd; float:left;"></div></div>
				Avatar<br>
				<input type="hidden" name="MAX_FILE_SIZE" value="3000000"> <!-- Tamanho mÃ¡ximo de 3MB -->
				<div id="sel-img" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
					<center>
					<input type="file" accept="image/jpeg, image/png" id="img-file" name="img-file" onchange="readURL(this);">
					<input type="button" style="margin-top:5px;" value="Enviar" id="enviar-file" onclick="img_uploadFILE();"></center>
					<center><font size="2px" style="margin-top:5px;">A imagem deve possuir <br>no m&aacute;ximo 3 MB.</font></center>
				</div><br>
				<div id="sel-img">
					<center>
					<input pattern="https?://.+" type="text" placeholder="URL da imagem aqui." id="img-url" name="img-url">
					<input type="button" style="margin-top:5px;" value="Enviar" id="enviar-url" onclick="img_uploadURL();contem();">
					</center>
				</div><br>
				<input type="button" style="width:150px" value="Remover" onclick="img_previewDEFAULT();img_uploadDEFAULT();"><br>
				<input type="hidden" id="avatar_inst_txt" name="avatar_inst_txt" value="<?php echo $linha_inst['avatar_inst']; ?>">
				<input type="hidden" id="img_modo" name="img_modo" value="<?php echo $linha_inst['avatar_inst']; ?>">
			</div>
			
			<script>
			function img_uploadURL(){ document.getElementById('img_modo').value = 'url'; }
			function img_uploadFILE(){ document.getElementById('img_modo').value = 'file'; }
			function img_uploadDEFAULT(){ document.getElementById('img_modo').value = 'default'; }
			
			function contem(){
				document.getElementById('avatar_inst').style="background-image: url('"+document.getElementById('img-url').value+"');background-size:148px;background-repeat: no-repeat;background-position: center;background-color:black;width:148px;height:148px;border: 1px solid #bdbdbd; float:left;')";
				document.getElementById('avatar_inst_txt').value=document.getElementById('img-url').value;
			}
			
			function img_previewDEFAULT(){
				document.getElementById('avatar_inst').style="background-image: url('imagens/perfil-default.png');background-size:148px;background-repeat: no-repeat;background-position: center;background-color:black;width:148px;height:148px;border: 1px solid #bdbdbd; float:left;')";
			}
			
			function contem1(){
				var files = document.getElementById("img-file").files;
				
				for (var i = 0; i < files.length; i++)
				{
					document.getElementById('avatar_inst').style="background-image: url('"+files[i].name+"');background-size:148px;background-repeat: no-repeat;background-position: center;background-color:black;width:148px;height:148px;border: 1px solid #bdbdbd; float:left;')";
				}
				
			}
			
			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#avatar_inst').attr('style', "background-image: url('"+e.target.result+"');background-size:148px;background-repeat: no-repeat;background-position: center;background-color:black;width:148px;height:148px;border: 1px solid #bdbdbd; float:left;')");
					}

					reader.readAsDataURL(input.files[0]);
				}
			}
			</script>
			
			<div style="background-color:transparent;width:500px;float:left;border:1px solid #D8D8D8;border-radius:2px;padding:10px;">
				<div id="cad-linha">
					<div id="cad-esquerda">Nome<font color="red" size="3px" style="font-weight:bold;">*</font>:</div>
					<div id="cad-direita" style="max-width:400px;"><input type="text" maxlength="100" placeholder="Nome" name="nome_inst" value="<?php echo $linha_inst['nome_inst']; ?>" style="width:250px;margin-right:5px;" required></div><br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
					<input type="hidden" name="id_inst" value="<?php echo $linha_inst['id_inst']; ?>">
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">Endereço<font color="red" size="3px" style="font-weight:bold;">*</font>:</div>
					<div id="cad-direita"><input type="text" maxlength="64" name="endereco_inst" value="<?php echo $linha_inst['endereco_inst']; ?>" style="width:250px;margin-right:5px;"></div><br>
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">Bairro<font color="red" size="3px" style="font-weight:bold;">*</font>:</div>
					<div id="cad-direita"><input type="text" size="64" maxlength="64" name="bairro_inst" value="<?php echo $linha_inst['bairro_inst']; ?>" style="width:250px;margin-right:5px;"></div><br>
					<hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">Cidade<font color="red" size="3px" style="font-weight:bold;">*</font>:</div>
					<div id="cad-direita"><input type="text" size="64" maxlength="64" name="cidade_inst" value="<?php echo $linha_inst['cidade_inst']; ?>"></div><br>
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">Estado<font color="red" size="3px" style="font-weight:bold;">*</font>:</div>
					<div id="cad-direita" >
						<select name="estado_inst" class="cad">
							<option value="AC" <?php if($linha_inst['estado_inst']=='AC'){ echo "selected"; } ?>>AC</option>
							<option value="AL" <?php if($linha_inst['estado_inst']=='AL'){ echo "selected"; } ?>>AL</option>
							<option value="AM" <?php if($linha_inst['estado_inst']=='AM'){ echo "selected"; } ?>>AM</option>
							<option value="AP" <?php if($linha_inst['estado_inst']=='AP'){ echo "selected"; } ?>>AP</option>						
							<option value="BA" <?php if($linha_inst['estado_inst']=='BA'){ echo "selected"; } ?>>BA</option>
							<option value="CE" <?php if($linha_inst['estado_inst']=='CE'){ echo "selected"; } ?>>CE</option>
							<option value="DF" <?php if($linha_inst['estado_inst']=='DF'){ echo "selected"; } ?>>DF</option>
							<option value="ES" <?php if($linha_inst['estado_inst']=='ES'){ echo "selected"; } ?>>ES</option>
							<option value="GO" <?php if($linha_inst['estado_inst']=='GO'){ echo "selected"; } ?>>GO</option>
							<option value="MA" <?php if($linha_inst['estado_inst']=='MA'){ echo "selected"; } ?>>MA</option>
							<option value="MG" <?php if($linha_inst['estado_inst']=='MG'){ echo "selected"; } ?>>MG</option>
							<option value="MS" <?php if($linha_inst['estado_inst']=='MS'){ echo "selected"; } ?>>MS</option>
							<option value="MT" <?php if($linha_inst['estado_inst']=='MT'){ echo "selected"; } ?>>MT</option>
							<option value="PA" <?php if($linha_inst['estado_inst']=='PA'){ echo "selected"; } ?>>PA</option>
							<option value="PB" <?php if($linha_inst['estado_inst']=='PB'){ echo "selected"; } ?>>PB</option>
							<option value="PE" <?php if($linha_inst['estado_inst']=='PE'){ echo "selected"; } ?>>PE</option>
							<option value="PI" <?php if($linha_inst['estado_inst']=='PI'){ echo "selected"; } ?>>PI</option>
							<option value="PR" <?php if($linha_inst['estado_inst']=='PR'){ echo "selected"; } ?>>PR</option>
							<option value="RJ" <?php if($linha_inst['estado_inst']=='RJ'){ echo "selected"; } ?>>RJ</option>
							<option value="RN" <?php if($linha_inst['estado_inst']=='RN'){ echo "selected"; } ?>>RN</option>						
							<option value="RO" <?php if($linha_inst['estado_inst']=='RO'){ echo "selected"; } ?>>RO</option>
							<option value="RR" <?php if($linha_inst['estado_inst']=='RR'){ echo "selected"; } ?>>RR</option>
							<option value="RS" <?php if($linha_inst['estado_inst']=='RS'){ echo "selected"; } ?>>RS</option>
							<option value="SC" <?php if($linha_inst['estado_inst']=='SC'){ echo "selected"; } ?>>SC</option>
							<option value="SE" <?php if($linha_inst['estado_inst']=='SE'){ echo "selected"; } ?>>SE</option>
							<option value="SP" <?php if($linha_inst['estado_inst']=='SP'){ echo "selected"; } ?>>SP</option>
							<option value="TO" <?php if($linha_inst['estado_inst']=='TO'){ echo "selected"; } ?>>TO</option>
						</select>
					</div><br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">Telefone:</div>
					<div id="cad-direita">
						<input type="text" value="<?php echo $linha_inst['telefone_inst']; ?>" style="width:120px;" name="telefone_inst" id="telefone_inst"  pattern="\([0-9]{2}\) [0-9]{4,6}-[0-9]{3,4}$" onkeypress="return mascara_telefone(this, '#### #####-####',event)" maxlength="15" required oninvalid="setCustomValidity('Número de telefone inválido. Por favor, redigite.')" onchange="try{setCustomValidity('')}catch(e){}">
					</div>
					<br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">E-Mail<font color="red" size="3px" style="font-weight:bold;">*</font>:
					</div>
					<div id="cad-direita">
						<input pattern="[a-zA-Z0-9]{@}+" type="text" size="64" maxlength="64" name="email_inst" value="<?php echo $linha_inst['email_inst']; ?>" style="width:250px;margin-right:5px;" required>
					</div>					
					<br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">Sobre:</div>
					<div id="cad-direita">
						<textarea name="sobre_inst" rows="5" cols="33" maxlength="5000"><?php echo $linha_inst['sobre_inst']; ?></textarea>
					</div><br><br><br><br><br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha">
					<div id="cad-esquerda">Website:</div>
					<div id="cad-direita"><input pattern="https?://.+" type="text" size="200" maxlength="200" style="width:250px" placeholder="URL do site" name="link_inst" value="<?php echo $linha_inst['link_inst']; ?>"></div>
				</div>
			</div>
		</div>
		
		<div style="float:left;margin-top:10px">
			<a href="instituicao.php?i=<?php echo $linha_inst['id_inst']; ?>"><input type="button" value="Cancelar"></a>
			<input type="submit" value="Salvar Dados">
		</div>
		
		</form>
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
	</div>
		
		<?php 
		} ?>
	
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