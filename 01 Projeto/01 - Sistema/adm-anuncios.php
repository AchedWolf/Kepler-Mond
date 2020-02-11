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
	
	<link rel="icon" href="imagens/logomarca.png">
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<title>Kepler</title>
</head>

<body style="font-family: 'Raleway', sans-serif;">
	<?php include "cabecalho.php"; ?>
		
		<!--Menu da Esquerda - INICIO -->
		<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;">
		<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
		<?php if($_SESSION['tipo'] == 1){ ?>
			<a href="adm.php" title="Voltar ao Menu"><div id="icon-img" style="background-image: url('imagens/voltar.png');height:30px;margin-right:7px;float:left;margin-top:20px;"></div></a>
				<script>
						function restante(){
							document.getElementById("areanum").innerHTML = (1000 - document.getElementById("desctxt").value.length);
						}
						
						function anuncio_img(){
							document.getElementById("desctxt").value = (document.getElementById("desctxt").value + "<img src='LINK_DA_IMAGEM_AQUI'></img>");
						}
				</script>
			<h2>Área do Administrador</h2><hr class="est1">
			<!-- INICIO - ANUNCIO POPUP -->
						<a href="#primary" data-toggle="modal" class="btn btn-primary btn3d" style="width:140px;color:white;margin-bottom:10px;margin-top:-2px;">Inserir</a>
						<!-- Modal -->
						<div class="modal fade" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body" style="color:black;">
										<form action="anuncio-enviar.php" method="post">
										<input pattern="[a-zA-Z0-9 ]+" type="text" name="titulo" id="titulo" style="width:565px;" placeholder="Título" maxlength="32" value="<?php echo $_POST['titulo']; ?>"><br><br>
										
										<textarea pattern="[a-zA-Z0-9 ]+" onkeyup="restante()" rows="10" cols="88" name="desc" id="desctxt" style="width:565px;padding:5px;resize:vertical;margin-bottom:5px;" placeholder="Insira o conteúdo do anúncio..." maxlength="1000" required><?php echo $_POST['desc']; ?></textarea>
										<br><b>Caracteres restantes:</b> <span id="areanum">1000</span>
										
										<br><img src="imagens/icone-imagem.png" height="40px" title="Inserir Imagem" style="cursor:pointer;" onclick="anuncio_img()">
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
										<input type="submit" class="btn btn-default pull-right" style="width:90px" value="Publicar">
										</form>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
						<!-- FIM - ANUNCIO POPUP -->
			
			<?php
			include "conecta.php";
			
			$consulta = $db->prepare('SELECT * FROM anuncios ORDER BY id_anuncio');
			$consulta->execute();
			
			$num_linhas = $consulta->rowCount();
			
			if($num_linhas < 1)
			{ ?>
				Este usuário não existe. :(
			<?php }
			else
			{ ?>
			
			<!-- TABELA - td = resultado; th = titulo -->
			<table style="border:1px solid;padding:5px;font-size:13px;width:960px;table-layout: fixed;">
				<tr style="border:1px solid;padding:5px;background-color:#F2F2F2;">
					<th style="border:1px solid;padding:5px;width:30px;">
						ID
					</th>
					<th style="border:1px solid;padding:5px;width:100px;">
						Data
					</th>
					<th style="border:1px solid;padding:5px;width:100px;">
						Autor
					</th>
					<th style="border:1px solid;padding:5px;width:300px;">
						Título
					</th>
					<th style="border:1px solid;padding:5px;width:380px;">
						Conteúdo
					</th>
				</tr>
				<?php 
				while($linha = $consulta->fetch(PDO::FETCH_OBJ))
				{
					if($linha->excluido == 's'){  ?><tr style="border:1px solid;padding:5px;"><?php }
					else { ?><tr style="border:1px solid;padding:5px;"><?php } ?>
						<td style="border:1px solid;padding:5px;">
							<center><?php echo $linha->id_anuncio; ?></center>
						</td>
						<td style="border:1px solid;padding:5px;">
							<?php echo $linha->data; ?>
						</td>
						<td style="border:1px solid;padding:5px;">
							<?php echo $linha->login; ?>
						</td>
						<td style="border:1px solid;padding:5px;">
							<?php echo $linha->titulo; ?>
						</td>
						<td style="border:1px solid;padding:5px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="<?php echo $linha->descr; ?>">
							<?php echo $linha->descr; ?>
						</td>
						<td style="border:1px solid;" width="30px">
							<?php $resul = $linha->id_anuncio; ?>
								<p onclick="confirmaExc(<?php echo $linha->id_anuncio; ?>)"><img src="imagens/delete.png" style="cursor: pointer;"></p>
							<script>
							function confirmaExc(posicao){
								
									swal({
								  title: "Você tem certeza?",
								  text: "Desativar/Ativar",
								  type: "warning",
								  showCancelButton: true,
								  confirmButtonColor: '#00aa66',
								  cancelButtonColor: '#dd3300',
								  confirmButtonText: 'Sim',
								  cancelButtonText: 'Não',
								  confirmButtonClass: 'btn btn-success',
								  cancelButtonClass: 'btn btn-cancel',
								  buttonsStyling: false
								},
								function(){
									window.location.assign("adm-exclui.php?id_anuncio="+posicao+"");
								  //swal("Deleted!", "Your imaginary file has been deleted.", "success");
								  
								});
									
									
							}
							</script>
							<a href="" title="Ativar/Desativar">
							</td>
					</tr>
				<?php 
				} ?>
			</table>
			<?php 
			} ?>
			
		<?php } 
		else{ ?><br><font style="color:red;font-weight:bold;">Você não possui permissão para visualizar esta página.</font><?php } ?>
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
</html>
</body>