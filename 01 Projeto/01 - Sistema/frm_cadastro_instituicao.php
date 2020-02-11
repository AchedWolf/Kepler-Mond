<?php session_start(); ?> <html>
<head>
	
	<link href='css/estilo16.css' rel='stylesheet' type='text/css'>
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
	
<script type="text/javascript">
	
	function verificar()
	{
		//CONFIRMAR E-MAIL
		var teste_email=confirmar_email();	
		if(teste_email==false)
		{
			document.getElementById("msg_erro_email").innerHTML="Os endereços de e-mail são diferentes.";
			document.getElementById("ajuste_erro_email").innerHTML="<br><br>";
			document.getElementById("email_instituicao").focus();
			return false;
		}
		
		return true;
	}
	
	function controle_teclas()
	{
		var tecla = window.event.keyCode;
		if(tecla==13)//ENTER
		{
			document.getElementById('form_cadastro').submit();
		}
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
	
	
	//VERIFICAR O TELEFONE
	function consistencia_telefone()
	{
		var keyCode = (e.keyCode ? e.keyCode : e.which);
		if (!(keyCode > 47 && keyCode < 58)) {
			e.preventDefault();
		}
		var num_caracteres=document.getElementById("telefone_instituicao").value;
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
	
	function confirmar_email()
	{
		var email=document.getElementById('email_instituicao').value;
		var confirma_email=document.getElementById('confirmar_email_instituicao').value;
		
		if(email==confirma_email)
			return true;
		else
			return false;
	}
	
	
	</script>
	

	<?php include "cabecalho.php"; ?>
	
	
	<div id="mae" style="width:1010px;max-width:1010px;background-color:red;margin: 0 auto;"><div id="cont-centro" style="padding-top:3px;margin-left:0px;">
	<?php if($_SESSION['logado'] == 1){?>
		<h2>Cadastro de Instituição de Ensino</h2>
		
		<form name="cadastro_instituicao" id="form_cadastro" onsubmit="return verificar();" method="POST" action="cadastro_instituicao.php" enctype="multipart/form-data">
		<div id="cad-avatar">
			<div id="cad-avatarbox"><div id="imgperfil" name="imgperfil" style="background-image: url('imagens/perfil-default.png');background-size:148px;background-repeat: no-repeat;background-position: center;background-color:black;width:148px;height:148px;border: 1px solid #bdbdbd; float:left;"></div></div>
			Avatar<br>
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
			
			<div id="sel-img" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
				<center><input type="file" accept="image/jpeg, image/png" name="imagem_user" id="imagem_user" onChange="preview_imagem(this)" style="width:130px">
				<input type="button" style="margin-top:5px;" value="Enviar" id="enviar-file"></center>
				<center><font size="2px" style="margin-top:5px;">A imagem deve possuir <br>no máximo 3 MB.</font></center>
			</div><br>
			<div id="sel-img">
				<center><input type="text" placeholder="URL da imagem aqui." id="img-url" name="img-url">
				<input type="button" style="margin-top:5px;" value="Enviar" id="enviar-url" onclick="contem();"></center>
			</div><br>
			<input type="button" style="width:150px" value="Remover" onclick="imagem_padrao();avatar('default')"><br>
		</div>
	
		<script>
		function contem(){
			if(document.getElementById('img-url').value!=null&&document.getElementById('img-url').value!=undefined&&document.getElementById('img-url').value!="")
			{
				document.getElementById('imgperfil').style="background-image: url('"+document.getElementById('img-url').value+"');background-size:148px;background-repeat: no-repeat;background-position: center;background-color:black;width:148px;height:148px;border: 1px solid #bdbdbd; float:left;";
				avatar('url');
			}
			else
			{
				document.getElementById('imgperfil').src='imagens/perfil-default.png';
				avatar('default');
			}
		}
		
		function preview_imagem(input) {
			avatar("arquivo");
				if (input.files && input.files[0]) {
					document.getElementById('img-url').value="";
					var reader = new FileReader();

					reader.onload = function (e) {
						document.getElementById('imgperfil').style="background-image: url('"+e.target.result+"');background-size:148px;background-repeat: no-repeat;background-position: center;background-color:black;width:148px;height:148px;border: 1px solid #bdbdbd; float:left;";
					}

					reader.readAsDataURL(input.files[0]);
					
				}
				else
				{
					alert("Erro!");
				}
	}
	
		function imagem_padrao()
		{
			document.getElementById('imgperfil').style="background-image: url('imagens/perfil-default.png');background-size:148px;background-repeat: no-repeat;background-position: center;background-color:black;width:148px;height:148px;border: 1px solid #bdbdbd; float:left;";

		}
		
		</script>
		
		<div id="cad-dados">
		<fieldset>
			<div id="cad-linha">
				<div id="cad-esquerda">Nome da Instituição<font color="red" size="3px" style="font-weight:bold;">*</font>:</div>
				<div id="cad-direita"><input type="text" style="width:300px;" name="nome_instituicao" id="nome_instituicao" maxlength="100" onkeypress="controle_teclas()" required></div>&nbsp;&nbsp;&nbsp;<br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
			</div>

			<div id="cad-linha">
				<div id="cad-esquerda">Endereço:</div>
				<div id="cad-direita"><input type="text" style="width:300px;" name="endereco_instituicao" id="endereco_instituicao" maxlength="110" onkeypress="controle_teclas()" ></div><br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
			</div>
			<div id="cad-linha">
				<div id="cad-esquerda">Bairro:</div>
				<div id="cad-direita"><input type="text" style="width:300px;" name="bairro_instituicao" id="bairro_instituicao" maxlength="50" onkeypress="controle_teclas()" ></div><br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
			</div>
<div id="cad-linha">
				<div id="cad-esquerda">Cidade:</div>
				<div id="cad-direita"><input type="text" style="width:300px;" name="cidade_instituicao" id="cidade_instituicao" maxlength="100" onkeypress="controle_teclas()" ></div><br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
			</div>
<div id="cad-linha">
				<div id="cad-esquerda">Estado:</div>
				
				<div id="cad-direita">
				<select name="estado_instituicao" id="estado_instituicao" class="cad">
					<option value="AC">AC</option>
					<option value="AL">AL</option>
					<option value="AM">AM</option>
					<option value="AP">AP</option>						
					<option value="BA">BA</option>
					<option value="CE">CE</option>
					<option value="DF">DF</option>
					<option value="ES">ES</option>
					<option value="GO">GO</option>
					<option value="MA">MA</option>
					<option value="MG">MG</option>
					<option value="MS">MS</option>
					<option value="MT">MT</option>
					<option value="PA">PA</option>
					<option value="PB">PB</option>
					<option value="PE">PE</option>
					<option value="PI">PI</option>
					<option value="PR">PR</option>
					<option value="RJ">RJ</option>
					<option value="RN">RN</option>						
					<option value="RO">RO</option>
					<option value="RR">RR</option>
					<option value="RS">RS</option>
					<option value="SC">SC</option>
					<option value="SE">SE</option>
					<option value="SP">SP</option>
					<option value="TO">TO</option>
				</select>
					</div>
				<br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
			</div>
		
			<div id="cad-linha">
				<div id="cad-esquerda">Telefone<font color="red" size="3px" style="font-weight:bold;">*</font>:</div>
				<div id="cad-direita"><input type="text" style="width:120px;" name="telefone_instituicao" id="telefone_instituicao"  pattern="\([0-9]{2}\) [0-9]{4,6}-[0-9]{3,4}$" onkeypress="return mascara_telefone(this, '#### #####-####',event)" maxlength="15" required oninvalid="setCustomValidity('Número de telefone inválido. Por favor, redigite.')" onchange="try{setCustomValidity('')}catch(e){}"></div><br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				
			</div>

			<div id="cad-linha">
				<div id="cad-esquerda">E-mail<font color="red" size="3px" style="font-weight:bold;">*</font>:</div>
				<div id="cad-direita"><input type="email" style="width:250px;" name="email_instituicao" id="email_instituicao" maxlength="50" onkeypress="controle_teclas()"  required></div><br><br>
			</div>
			
			<div id="cad-linha">
				<div id="cad-esquerda">Confirmar E-mail<font color="red" size="3px" style="font-weight:bold;">*</font>:</div>
				<div id="cad-direita"><input type="email" style="width:250px;" name="confirmar_email_instituicao" id="confirmar_email_instituicao" maxlength="50" onChange="confirmar_email()" onkeypress="controle_teclas()" required>
									  <div id="msg_erro_email" style="color:red;padding-top:5px;text-align:justify;line-height:1.5;width:250px"></div>
				</div><br>
				<div id="ajuste_erro_email"></div>
				<hr class="est1" style="margin-top:25px;margin-bottom:8px;">
			</div>
			
			<div id="cad-linha">
				<div id="cad-esquerda">Website:</div>
				<div id="cad-direita"><input type="website" style="width:250px;" name="website_instituicao" id="website_instituicao" maxlength="50" onkeypress="controle_teclas()" ></div><br><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
			</div>
			
			<div id="cad-linha">
				<div id="cad-esquerda">Outras Informações:</div>
				<div id="cad_instituicao_sobre_instituicao"><textarea  name="sobre_instituicao" id="sobre_instituicao" maxlength="300" style="width:290px;height:150px; margin-bottom: -20px;"></textarea></div>
			</div>
			
			
</fieldset>

<input type="hidden" name="avatar_inst" id="avatar_inst" value="default">
<br><br>
<script type="text/javascript">
	function alterar_captcha()
	{
		img=document.getElementById('img_captcha');
		img.src="captcha.php";
	}
</script>
			<hr class="est1" style="margin-top:-10px;margin-bottom:8px;">
			<div id="cad-linha">
				<center>
					<div id="icon-img" style="background-image: url('imagens/atualizar.png');
							margin-left:0px;margin-right:-15px;cursor:pointer;float:left;" title="Atualizar" onClick="alterar_captcha()"></div>
					<img name="img_captcha" id="img_captcha" src="captcha.php" alt="Código captcha"><br>		
					<br>Insira os caracteres acima:<br>
					<input type="text" name = "captcha" size="10" maxlength="10" style="width:100px" onkeypress="controle_teclas()" >
				</center>
				
				<div id="cad_instituicao_botao">
					<div id="cad_instituicao_entre_divs" style="color:red">
					</div>
					
					<button onclick="history.back()" style="padding:5px;width:168px;">Cancelar</button>
				
					<input type="submit" value="Enviar">
			</div>
			</div>
		
			
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
		
		<!-- TOPO - FIM -->
	<?php 
		}
		else 
		{
			echo "<script type='text/javascript'>alert('É necessário realizar o login.')</script>";
			echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=login.php'>";
		}		
	
	?>
	</div>
	<?php include "rodape.php"; ?>
	
	<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();   
	});
	</script>
</body>
</html>
