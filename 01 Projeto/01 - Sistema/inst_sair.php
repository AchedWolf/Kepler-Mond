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
function myFunction(login){
								swal({
								  title: "Você saiu da instituição!",
								  type: "success",
								  confirmButtonColor: '#00aa66',
								  confirmButtonText: 'Ok',
								  confirmButtonClass: 'btn btn-success',
								  buttonsStyling: true
								},
								function(){
									window.location.assign("instituicoes.php?userp="+login);
								  //swal("Deleted!", "Your imaginary file has been deleted.", "success");
								});
							}
</script>
<body onload="myFunction('<?php echo $_SESSION['login']; ?>')" style="font-family: 'Raleway', sans-serif;">
	<?php include "cabecalho.php"; ?>
		
	
		<div id="mae" style="width:1010px;max-width:1010px;background-color:red;margin: 0 auto;">
		<div id="cont-direita">
		<?php
			include "conecta.php";

			$login=$_GET['login'];
			$id_inst=$_GET['id_inst'];
		
			$consulta = $db->prepare("DELETE FROM relacao where login=? AND id_inst=?");
			$consulta->bindParam(1,$login, PDO::PARAM_STR);
			$consulta->bindParam(2,$id_inst, PDO::PARAM_INT);
			$consulta->execute();

			$num_linhas = $consulta->rowCount();
		
		
		
		?>
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