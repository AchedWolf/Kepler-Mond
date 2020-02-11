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
			
	
	<link rel="icon" href="imagens/logomarca.png">
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<title>Kepler</title>
</head>

<body style="font-family: 'Raleway', sans-serif;">
	<?php
	include "cabecalho.php"; 
	include "conecta.php";
	
	$id_astro = $_GET['id_astro'];
	
	$consulta = $db->prepare("SELECT * FROM astros WHERE id_astro=?");
	$consulta->bindParam(1,$_GET['id_astro'], PDO::PARAM_INT);
	$consulta->execute();
	
	$num_linhas = $consulta->rowCount();
	

	?>
		
	<!--Menu da Esquerda - INICIO -->
	<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;">
	<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
	<?php
	 if($_SESSION['tipo'] == 1){
		if($num_linhas < 1){
		include "404.php";
		}
		else{
			$linha = $consulta->fetch(PDO::FETCH_OBJ);
	
	?>
		<h2>Editar Astro</h2><hr class="est1">
		
			<script>
			function img_uploadURL(){ document.getElementById('img_modo').value = 'url'; }
			function img_uploadFILE(){ document.getElementById('img_modo').value = 'file'; }
			function img_uploadDEFAULT(){ document.getElementById('img_modo').value = 'default'; }
			
			function contem(){
				document.getElementById('imgperfil').style="background-image: url('"+document.getElementById('img-url').value+"');background-size:contain;background-repeat: no-repeat;background-position:center;background-color:black;height:148px;width:100%;border: 1px solid #bdbdbd; float:left;')";
				document.getElementById('imgperfil_txt').value=document.getElementById('img-url').value;
			}
			
			function img_previewDEFAULT(){
				document.getElementById('imgperfil').style="background-image: url('imagens/404.png');background-size:contain;background-repeat: no-repeat;background-position:center;background-color:black;height:148px;width:100%;border: 1px solid #bdbdbd; float:left;')";
			}
			
			function contem1(){
				var files = document.getElementById("img-file").files;
				
				for (var i = 0; i < files.length; i++)
				{
					document.getElementById('imgperfil').style="background-image: url('"+files[i].name+"');background-size:contain;background-repeat: no-repeat;background-position:center;background-color:black;height:148px;width:100%;border: 1px solid #bdbdbd; float:left;')";
				}
				
			}
			
			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#imgperfil').attr('style', "background-image: url('"+e.target.result+"');background-size:contain;background-repeat: no-repeat;background-position:center;background-color:black;height:148px;width:100%;border: 1px solid #bdbdbd; float:left;')");
					}

					reader.readAsDataURL(input.files[0]);
				}
			}
			</script>
		
			<div id="ast-form" style="width:100%;float:left;">
				<form action="astros-enviar.php" enctype="multipart/form-data" id="myForm" method="post">
								<span>Nome: <font color="red" style="font-weight:bold;">*</font></span> <br><input pattern="[a-zA-Z0-9 ]+" type="text" value="<?php echo $linha->nome; ?>" name="nome_up" id="link" style="width:230px;" required><br><br>
								<span>Classificação: <font color="red" style="font-weight:bold;">*</font></span> <br>
								<select name="tipo4" class="cad" style="margin-bottom:8px;" required>
									<option value="satelite" <?php if($linha->tipo=='satelite'){ echo "selected"; } ?>>Satélite</option>
									<option value="planeta" <?php if($linha->tipo=='planeta'){ echo "selected"; } ?>>Planeta</option>
									<option value="estrela" <?php if($linha->tipo=='estrela'){ echo "selected"; } ?>>Estrela</option>
									<option value="cometa" <?php if($linha->tipo=='cometa'){ echo "selected"; } ?>>Cometa</option>						
									<option value="asteroide" <?php if($linha->tipo=='asteroide'){ echo "selected"; } ?>>Asteróide</option>
								</select><br>
								
								<hr class="est1">
								
								<span>Descrição:</span> <br><textarea pattern="[a-zA-Z0-9 ]+" rows="10" cols="88" name="descr_up" style="padding:5px;width:460px;resize:vertical;display:initial;" placeholder="Insira uma descrição para o astro..." maxlength="1000"><?php echo $linha->descr; ?></textarea>
								<br><br>
									
								<input type="hidden" name="num_up" style="width:60px;" title="nº de agendamentos" value="<?php echo $linha->num_agen; ?>">
								<input type="hidden" name="id_up" style="width:60px;" title="nº de agendamentos" value="<?php echo $linha->id_astro; ?>">
									
								<span>Raio:</span> <br><input pattern="[a-zA-Z0-9]+" value="<?php echo $linha->raio; ?>" type="number" name="raio_up" id="link" style="width:100px;padding:5px;" min="1"> km<br><br>
								
								<span>Fonte:</span> <br><input pattern="https?://.+" value="<?php echo $linha->fonte; ?>" type="url" name="fonte_up" style="width:460px;margin-bottom:8px;" placeholder="URL da página"><br>
								
								<hr class="est1">
								
								<span>Imagem:</span> <br>
								
								<div style="float:left;margin-bottom:10px;width:100%;">
									<div style="width:100%;float:left;background-color:black;margin-bottom:10px;margin-top:5px;">
									<?php $imagem = $linha->img;?>
										<div id="imgperfil" name="imgperfil" style="background-image: url('<?php echo $imagem; ?>');background-size:contain;background-repeat: no-repeat;background-position:center;background-color:black;height:148px;width:100%;border: 1px solid #bdbdbd; float:left;"></div>
									</div>
									<input type="hidden" name="MAX_FILE_SIZE" value="3000000"> <!-- Tamanho máximo de 3MB -->
									
									<div style="width:100%;float:left;">
										<div id="sel-img" style="float:left;width:50%;height:110px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
											<center>
											<input type="file" accept="image/jpeg, image/png" id="img-file" name="img-file" onchange="readURL(this);" style="width:120px">
											<input type="button" style="margin-top:5px;" value="Enviar" id="enviar-file" onclick="img_uploadFILE();"></center>
											<center><font size="2px" style="margin-top:5px;">A imagem deve possuir <br>no máximo 3 MB.</font></center>
										</div>
										<div id="sel-img" style="margin-left:25px;float:left;width:50%;height:110px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
											<center>
											<input pattern="https?://.+" type="text" placeholder="URL da imagem aqui." id="img-url" name="img-url"><br>
											<input type="button" style="margin-top:5px;" value="Enviar" id="enviar-url" onclick="img_uploadURL();contem();">
											</center>
										</div>
									</div>
								</div>
								<input type="button" style="width:150px" value="Remover" onclick="img_previewDEFAULT();img_uploadDEFAULT();">
								<input type="hidden" id="imgperfil_txt" name="imgperfil_txt">
								<input type="hidden" id="img_modo" name="img_modo">
								<input type="hidden" id="img_carrega" name="img_carrega" value="<?php echo $imagem; ?>">
			</div>
								
			<div id="linha" style="width:960px;float:left;">
				<br>
				<a href="adm-astros"><button type="button" class="btn btn-default pull-left">Cancelar</button></a>
				<input type="submit" class="btn btn-default pull-right" style="width:90px;">
				</form>
	
							
			</div>
			</form>
		

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
		<?php
		}
		else{ ?><br><font style="color:red;font-weight:bold;">Você não possui permissão para visualizar esta página.</font><?php } ?>
		<!-- TOPO - FIM -->
		</div>
	</div>
	<?php include "rodape.php"; ?>
</body>
</html>