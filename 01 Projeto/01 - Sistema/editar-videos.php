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
	<?php

	include "cabecalho.php"; 
	include "conecta.php";
	
	$id_video=$_GET['id_video'];
	
	$sql="SELECT * FROM videos WHERE id_video=?";
	$consulta = $db->prepare($sql);
	$consulta->bindParam(1,$id_video, PDO::PARAM_INT);
	$consulta->execute();
	$num_linhas = $consulta->rowCount();

			
			
	$linha = $consulta->fetch(PDO::FETCH_OBJ);
	
	?>
		
		<!--Menu da Esquerda - INICIO -->
		<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;">
		<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
		<?php if($_SESSION['tipo'] == 1){ ?>
			<h2>Editar Vídeo</h2><hr class="est1">
			<form action="videos-enviar.php" method="post" id="myForm">
			<h4>Id do vídeo:</h4>
				<input type="text" name="id-up" style="width:565px;" placeholder="ID do Vídeo" value="<?php echo $id_video; ?>" readonly><br><br>
			<h4>Titulo do vídeo:</h4>
				<input pattern="[a-zA-Z0-9 ]+" type="text" name="titulo-up" id="link" style="width:565px;" placeholder="Título do video" value="<?php echo $linha->nome; ?>" readonly" required><br><br>
			<h4>Descrição do vídeo:</h4>			
				<textarea pattern="[a-zA-Z0-9 ]+" rows="10" cols="88" name="desc-up" style="width:565px;padding:5px;resize:vertical;display:initial;margin-bottom:10px;" placeholder="Descrição do vídeo" maxlength="300"><?php echo $linha->descr; ?></textarea>

				<input type="hidden" id="linkyoutube1" name="linkyoutube1">

			<h4>Preview:</h4>	
				<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $linha->ytlink; ?>" frameborder="0" id="ytlink" style="border:1px solid black;width:560px;height:315px;" allowfullscreen></iframe>
				
				<div class="modal-footer" style="width:560px;">
				<a href="adm-astros"><button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button></a>
				<button onclick="confirmaEdt(<?php echo $id_video; ?>)" type="button" class="btn btn-default pull-right" style="width:90px;">Salvar</button>
				
				
			<script>
				function confirmaEdt(){
					
					swal({
								  title: "Você tem certeza?",
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
									document.getElementById("myForm").submit();
								  //swal("Deleted!", "Your imaginary file has been deleted.", "success");
								  
								});
						
						
				
				// function confirmaEdt(posicao){
					// // swal({
					  // // title: "Você tem certeza?",
					  // // text: "Salvar",
					  // // type: "info",
					  // // showCancelButton: true,
					  // // confirmButtonColor: '#00aa66',
					  // // cancelButtonColor: '#dd3300',
					  // // confirmButtonText: 'Sim',
					  // // cancelButtonText: 'Não',
					  // // confirmButtonClass: 'btn btn-success',
					  // // cancelButtonClass: 'btn btn-cancel',
					  // // buttonsStyling: false
					// // },
					// // function(){
						// // window.location.assign("astros-enviar?id_astro="+posicao+"");
					  // // //swal("Deleted!", "Your imaginary file has been deleted.", "success");
					  
					// // });
						
						
				// // }
				}
				</script>
				</div>
				
			</form>
			
		</div>
		<?php
		}

		else{ ?><br><font style="color:red;font-weight:bold;">Você não possui permissão para visualizar esta página.</font><?php } ?>
		</div>
		<!-- TOPO - FIM -->
	
	</div>
	<?php include "rodape.php"; ?>
</html>
</body>