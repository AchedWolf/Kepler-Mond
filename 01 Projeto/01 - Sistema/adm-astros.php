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
<body style="font-family: 'Raleway', sans-serif;">
	<?php include "cabecalho.php"; ?>
		
		<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;">
		<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
		<?php if($_SESSION['tipo'] == 1){ ?>
			<a href="adm.php" title="Voltar ao Menu"><div id="icon-img" style="background-image: url('imagens/voltar.png');height:30px;margin-right:7px;float:left;margin-top:20px;"></div></a>
			<h2>Área do Administrador</h2><hr class="est1">
			<a href="#primary" data-toggle="modal" class="btn btn-primary btn3d" style="width:140px;color:white;margin-bottom:10px;margin-top:-2px;">Inserir</a>
			<!-- Modal -->
			<div class="modal fade" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<form action="astros-enviar.php" method="post" enctype="multipart/form-data">
						<div class="modal-body" style="color:black;">
								<h3 style="margin-top:0px;">Inserir Astro</h3><hr class="est1">
								
								<span>Nome: <font color="red" style="font-weight:bold;">*</font></span> <br><input pattern="[a-zA-Z0-9 ]+" type="text" name="nome" id="link" style="width:230px;" required><br><br>
								<span>Classificação: <font color="red" style="font-weight:bold;">*</font></span> <br>
								<select name="tipo4" class="cad" style="margin-bottom:8px;" required>
									<option value="satelite">Satélite</option>
									<option value="planeta">Planeta</option>
									<option value="estrela">Estrela</option>
									<option value="cometa">Cometa</option>						
									<option value="asteroide">Asteróide</option>
								</select><br>
								
								<hr class="est1">
								
								<span>Descrição:</span> <br><textarea pattern="[a-zA-Z0-9 ]+" rows="10" cols="88" name="descr" style="padding:5px;width:460px;resize:vertical;display:initial;" placeholder="Insira uma descrição para o astro..." maxlength="300"></textarea>
								<br><br>
									
								<input type="hidden" name="num" style="width:60px;" title="nº de agendamentos" value="0">
									
								<span>Raio:</span> <br><input pattern="[a-zA-Z0-9]+" type="number" name="raio" id="link" style="width:100px;padding:5px;" min="0" value="0" required> km<br><br>
								
								<span>Fonte:</span> <br><input pattern="https?://.+" type="url" name="fonte" style="width:460px;margin-bottom:8px;" placeholder="URL da página"><br>
								
								<hr class="est1">
								
								<span>Imagem:</span> <br>
								
								<div style="float:left;margin-bottom:10px;width:100%;">
									<div style="width:100%;float:left;background-color:black;margin-bottom:10px;margin-top:5px;">
										<div id="imgperfil" name="imgperfil" style="background-image: url('imagens/404.png');background-size:contain;background-repeat: no-repeat;background-position:center;background-color:black;height:148px;width:100%;border: 1px solid #bdbdbd; float:left;"></div>
									</div>
									
									<input type="hidden" name="MAX_FILE_SIZE" value="3000000"> <!-- Tamanho máximo de 3MB -->
									
									<div style="width:100%;float:left;">
										<div id="sel-img" style="margin-left:25px;float:left;width:50%;height:110px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
											<center>
											<input type="file" accept="image/jpeg, image/png" id="img-file" name="img-file" onchange="readURL(this);" style="width:120px">
											<input type="button" style="margin-top:5px;" value="Enviar" id="enviar-file" onclick="img_uploadFILE();"></center>
											<center><font size="2px" style="margin-top:5px;">A imagem deve possuir <br>no máximo 3 MB.</font></center>
										</div>
										<div id="sel-img" style="margin-right:25px;float:right;width:50%;height:110px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
											<center>
											<input pattern="https?://.+" type="text" placeholder="URL da imagem aqui." id="img-url" name="img-url"><br>
											<input type="button" style="margin-top:5px;" value="Enviar" id="enviar-url" onclick="img_uploadURL();contem();">
											</center>
										</div>
									</div>
								</div>
								<center><input type="button" style="width:150px" value="Remover" onclick="img_previewDEFAULT();img_uploadDEFAULT();"></center>
								
								<input type="hidden" id="imgperfil_txt" name="imgperfil_txt">
								<input type="hidden" id="img_modo" name="img_modo">
						</div>
						<div class="modal-footer">
							<button type="reset" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
							<input type="submit" class="btn btn-default pull-right" style="width:90px;padding:5px;" value="Inserir">
						</div>
							</form>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div>
			<div id="adm-pesq" style="float:left;border:1px solid #BDBDBD;border-radius:8px;padding:10px;margin-bottom:10px;width:960px;">
					<form action="adm-astros.php" method="post">

					<input type="image" src="imagens/search.png" style="height:55px;width:55px;margin-left:7px;float:right;">
					<h4 style="margin-top:0px;font-weight:bold;">Pesquisar</h4>
					<!-- NOME DA TABELA -->

					<input name="id" type="text" style="margin-right:10px;height:32px;width:45px;" placeholder="ID">

					<select name="tipo" style="padding:5px;height:32px;margin-right:10px;width:100px;">
						<option selected disabled style="font-weight:bold">Tipo</option>
						<option value="estrela">Estrela</option>
						<option value="planeta">Planeta</option>
						<option value="cometa">Cometa</option>
						<option value="asteroide">Asteróide</option>
						<option value="satelite">Satélite</option>						
					</select>
					
					<input name="nome" type="text" style="margin-right:10px;height:32px;width:290px;padding:5px;" placeholder="Nome contém...">
					
					<input name="descr" type="text" style="margin-right:10px;height:32px;width:290px;padding:5px;" placeholder="Descrição contém...">
					
					<select name="status" style="padding:5px;height:32px;margin-top:5px;">
						<option selected disabled style="font-weight:bold">Status</option>
						<option value="n">Ativo</option>
						<option value="s">Excluído</option>
					</select>
					
					Nº de Agendamentos
					
					<input name="num_agen_min" type="number" style="margin-right:10px;height:32px;width:70px;padding:5px;margin-top:5px;margin-left:28px;" min="0">
					até
					<input name="num_agen_max" type="number" style="margin-right:32px;height:32px;width:70px;padding:5px;margin-left:10px;" min="1"> 
					
					Raio(Km)
					
					<input name="raio_min" type="number" style="margin-right:10px;height:32px;width:70px;padding:5px;margin-left:19px;"  min="0">
					até
					<input name="raio_max" type="number" style="margin-right:10px;height:32px;width:70px;padding:5px;margin-left:10px;" min="1"> 
					
					</form>
				</div>
			<?php
			
			include "conecta.php";

			$id_astro=$_POST['id_astro'];
			$tipo=$_POST['tipo'];
			$nome=$_POST['nome'];
			$descr=$_POST['descr'];
			$excluido=$_POST['status'];
			$num_agen_min=$_POST['num_agen_min'];
			$num_agen_max=$_POST['num_agen_max'];
			$raio_min=$_POST['raio_min'];
			$raio_max=$_POST['raio_max'];
			
			
			if($tipo!="estrela" and $tipo!="satelite" and $tipo!="cometa" and $tipo!="asteroide" and $tipo!="planeta")
			{
				$tipo=$_GET['tipo'];
			}
			 
			$sql="SELECT * FROM astros WHERE nome iLIKE '%".$nome."%'";

			if($id_astro>0)
			{
				$sql=$sql." AND id_astro=".$id_astro;
			}
			if(!empty($excluido))
			{
			$sql=$sql."  AND  excluido='".$excluido."'";
			}
			if(!empty($descr))
			{
			$sql=$sql."  AND descr iLike '%".$descr."%'";
			}
			if($raio_min>0)
			{
			$sql=$sql."  AND  raio>=".$raio_min;
			}
			if($raio_max>0)
			{
			$sql=$sql."  AND  raio<=".$raio_max;
			}
			if($num_agen_min>0)
			{
			$sql=$sql."  AND  num_agen>=".$num_agen_min;
			}
			if($num_agen_max>0)
			{
			$sql=$sql."  AND  num_agen<=".$num_agen_max;
			}
			if(!empty($fonte))
			{
			$sql=$sql." AND fonte='".$fonte."'";
			}
			if(!empty($tipo))
			{
			$sql=$sql." AND tipo='".$tipo."'";
			}
			$sql=$sql." ORDER BY id_astro";


			$consulta = $db->prepare($sql);
			$consulta->execute();

			$num_linhas = $consulta->rowCount();

			if($num_linhas < 1)
			{ ?>
				<br>Nenhum resultado encontrado.
			<?php }
			else
			{
			?>

					<!-- TABELA - td = resultado; th = titulo -->
					<table style="border:1px solid;padding:5px;font-size:13px;width:960px;table-layout: fixed;">
					<tr style="border:1px solid;padding:5px;background-color:#F2F2F2;">
						<th style="border:1px solid;padding:5px;width:60px;">
							Status
						</th>
						<th style="border:1px solid;padding:5px;width:60px;">
							Tipo
						</th>
						<th style="border:1px solid;padding:5px;width:25px;">
							ID
						</th>
						<th style="border:1px solid;padding:5px;width:160px;">
							Nome
						</th>
						<th style="border:1px solid;padding:5px;width:236px;">
							Descrição
						</th>
						<th style="border:1px solid;padding:5px;width:45px;">
							Num. agen.
						</th>
						<th style="border:1px solid;padding:5px;width:100px;">
							Raio (km)
						</th>
						<th style="border:1px solid;padding:5px;width:176px;">
							Fonte
						</th>
					</tr>
					<?php
					while($linha = $consulta->fetch(PDO::FETCH_OBJ))
					{
						?><tr style="border:1px solid;padding:5px;">
							<td style="border:1px solid;padding:5px;">
								<?php if($linha->excluido == 'n'){ echo "<font color='green'>Ativo</font>"; } else{ echo "<font color='red'>Excluído</font>";; } ?>
							</td>
							<td style="border:1px solid;padding:5px;">
								<?php
								if($linha->tipo == 'estrela'){ echo "Estrela"; }
								else if($linha->tipo == 'planeta'){ echo "Planeta"; }
								else if($linha->tipo == 'satelite'){ echo "Satélite"; }
								else if($linha->tipo == 'cometa'){ echo "Cometa"; }
								else if($linha->tipo == 'asteroide'){ echo "Asteróide"; }
								?>
							</td>
							<td style="border:1px solid;padding:5px;">
								<center><?php echo $linha->id_astro; ?></center>
							</td>
							<td style="border:1px solid;padding:5px;" title="<?php echo $linha->nome; ?>">
								<?php echo $linha->nome; ?>
							</td>
							<td style="border:1px solid;padding:5px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="<?php echo $linha->descr; ?>">
								<?php echo $linha->descr; ?>
							</td>
							<td style="border:1px solid;padding:5px;">
								<?php echo number_format($linha->num_agen); ?>
							</td>
							<td style="border:1px solid;padding:5px;">
								<?php echo number_format($linha->raio); ?>
							</td>
							<td style="border:1px solid;padding:5px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
								<a href="<?php echo $linha->fonte; ?>" title="<?php echo $linha->fonte; ?>"><?php echo $linha->fonte; ?></a>
							</td>
							<td style="border:1px solid;" width="30px" style="cursor:pointer;">
								<a href="editar-astros.php?id_astro=<?php echo $linha->id_astro; ?>" title="Editar Dados">
									<img src="imagens/config2.png">
								</a>
							</td>
							<td style="border:1px solid;" width="30px" style="cursor:pointer;">
							<?php $resul = $linha->id_astro; ?>
								
								<?php if($linha->excluido == 'n'){ ?> <span onclick="confirmaExc(<?php echo $linha->id_astro; ?>)" title="Exclusão Lógica" style="cursor:pointer;"><img src="imagens/delete.png"></span> <?php } else { ?> <span onclick="confirmaExc1(<?php echo $linha->id_astro; ?>)" title="Ativação" style="cursor:pointer;"><img src="imagens/sim.png"></span> <?php } ?>
							<script>
							function confirmaExc(posicao){
								swal({
								  title: "Você tem certeza que deseja excluir o astro em questão?",
								  text: "",
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
									window.location.assign("adm-exclui.php?id_astro="+posicao+"");
								  //swal("Deleted!", "Your imaginary file has been deleted.", "success");
								});
							}
							function confirmaExc1(posicao){
								swal({
								  title: "Você tem certeza que deseja ativar o astro em questão?",
								  text: "",
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
									window.location.assign("adm-exclui.php?id_astro="+posicao+"");
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
				
			}
		}

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