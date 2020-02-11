<?php session_start(); ?> <html>
<head>
	<link href='css/estilo23.css' rel='stylesheet' type='text/css'>
	<link href='css/estilo06.css' rel='stylesheet' type='text/css'>
	
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
		<div id="mae" style="width:1010px;max-width:1010px;background-color:red;margin: 0 auto;"><div id="cont-esquerda" style="margin-left:0px;">
		
		<script>
	var astro = "";
	function limpaestrela()
	{
				$('#lista').empty();
				var newOption = $('<option disabled selected value="">Selecione uma opção</option>');
				$('#lista').append(newOption);
	
				<?php
					include "conecta.php";
					$consulta = $db->prepare("select id_astro, nome, tipo from astros where tipo='estrela' and excluido='n' order by nome");
					$consulta->execute();
	
						while($linha=$consulta->fetch(PDO::FETCH_OBJ))
						{
					?>
						var newOption = $('<option value="<?php echo"".$linha->id_astro; ?>"><?php echo"".$linha->nome; ?></option>');
						$('#lista').append(newOption);
						
					<?php
							
						}
					?>
					astro="estrela";
					<?php
					
					?>
	}
	function limpaplaneta()
	{
				$('#lista').empty();
				var newOption = $('<option disabled selected value="">Selecione uma opção</option>');
				$('#lista').append(newOption);
				
				
				
				
				<?php
				include "conecta.php";
					$consulta = $db->prepare("select id_astro, nome, tipo from astros where tipo='planeta' and excluido='n' order by nome");
					$consulta->execute();
					while($linha=$consulta->fetch(PDO::FETCH_OBJ))
					{
			
		
					?>
					var newOption = $('<option value="<?php echo"".$linha->id_astro; ?>"><?php echo"".$linha->nome; ?></option>');
					$('#lista').append(newOption);
					
					<?php
					}
				?>
				astro="planeta";
					
	}
	function limpaasteroide(){
				$('#lista').empty();
				var newOption = $('<option disabled selected value="">Selecione uma opção</option>');
				$('#lista').append(newOption);
				
				
				
				
				
				<?php
				include "conecta.php";
					$consulta = $db->prepare("select id_astro, nome, tipo from astros where tipo='asteroide' and excluido='n' order by nome");
					$consulta->execute();
				while($linha=$consulta->fetch(PDO::FETCH_OBJ))
					{
			
		
					?>
					var newOption = $('<option value="<?php echo"".$linha->id_astro; ?>"><?php echo"".$linha->nome; ?></option>');
					$('#lista').append(newOption);
					
					<?php
					}
				?>
				
				astro = "asteroide";	
				
	}
	function limpasatelite()
	{
				$('#lista').empty();
				var newOption = $('<option disabled selected value="">Selecione uma opção</option>');
				$('#lista').append(newOption);
				<?php
				include "conecta.php";
					$consulta = $db->prepare("select id_astro, nome, tipo from astros where tipo='satelite' and excluido='n' order by nome");
					$consulta->execute();
					while($linha=$consulta->fetch(PDO::FETCH_OBJ))
					{
			
		
					?>
					var newOption = $('<option value="<?php echo"".$linha->id_astro; ?>"><?php echo"".$linha->nome; ?></option>');
					$('#lista').append(newOption);
					
					<?php
					}
				?>
				astro = "satelite";
				
	}
	function limpacometa()
	{
				$('#lista').empty();
				var newOption = $('<option disabled selected value="">Selecione uma opção</option>');
				$('#lista').append(newOption);
				<?php
				include "conecta.php";
					$consulta = $db->prepare("select id_astro, nome, tipo from astros where tipo='cometa' and excluido='n' order by nome");
					$consulta->execute();
					while($linha=$consulta->fetch(PDO::FETCH_OBJ))
					{
			
		
					?>
					var newOption = $('<option value="<?php echo"".$linha->id_astro; ?>"><?php echo"".$linha->nome; ?></option>');
					$('#lista').append(newOption);
					
					<?php
					}
				?>
				astro = "cometa";
				
	}			
	function Recarrega(){
		var e = document.getElementById("lista");
		var id_astro = e.options[e.selectedIndex].value;
		$('#cont-direita').load('mostra_planeta.php?id_astro='+id_astro+'&astro='+astro+'');
		
				
				}
	
	</script>
		
			<div id="item-esquerda">
				<div id="ie-titulo">
					<button id="asteroide" type="button" class="btn btn-primary btn3d " style="width:240px;margin-bottom:-11px" onclick="limpaasteroide();">Asteróide</button>
					<br><br>
					<button id="cometa" type="button" class="btn btn-primary btn3d " style="width:240px;margin-bottom:-11px" onclick="limpacometa();">Cometa</button>
					<br><br>
					<button id="estrela" type="button" class="btn btn-primary btn3d " style="width:240px;margin-bottom:-11px" onclick="limpaestrela();">Estrela</button>
					<br><br>
					<button id="planeta" type="button" class="btn btn-primary btn3d " style="width:240px;margin-bottom:-11px" onclick="limpaplaneta();">Planeta</button>
					<br><br>
					<button id="satelite-natural" type="button" class="btn btn-primary btn3d " style="width:240px;margin-bottom:-11px" onclick="limpasatelite();">Satélite Natural</button>
					<br><br>
				</div>
				
				<div id="ie-cont">
					
					<select  id="lista" onChange="Recarrega()">
					<option selected disabled>Selecione um astro</option>
					</select>
					
				</div>
			</div>
			
		</div>
		<!--Menu da Esquerda - FIM -->
			
		<!--Menu do Centro - INICIO -->
		<div id="cont-direita">
			
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