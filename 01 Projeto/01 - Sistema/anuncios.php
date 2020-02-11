<?php session_start(); ?> <html>
<head>
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

		$limite = 5;		
		$pg = (isset($_GET['pg'])) ? (int)$_GET['pg'] : 1;
		# Atribui a variável inicio o inicio de onde os registros vão ser
		# mostrados por página, exemplo 0 à 10, 11 à 20 e assim por diante
		$inicio = ($pg * $limite) - $limite;
	?>
	
	<div id="mae" style="width:1010px;min-width:1010px; background-color:white;margin: 0 auto;">
		<script type="text/javascript">
			function exibir_conteudo(nome_div)
			{
				if(document.getElementById(nome_div).style.display=='none')
				{
					document.getElementById(nome_div).style.display='block';
					document.getElementById('icone_'+nome_div).className='glyphicon glyphicon-chevron-up';
				}
				else
				{
					document.getElementById(nome_div).style.display='none';
					document.getElementById('icone_'+nome_div).className='glyphicon glyphicon-chevron-down';
				}
			}
			
			function alterar_cor_div(nome_div)
			{
				document.getElementById(nome_div).style.color='grey';
			}
			
			function retornar_cor_original(nome_div)
			{
				document.getElementById(nome_div).style.color='black';
			}
			function restante(){
				document.getElementById("areanum").innerHTML = (1000 - document.getElementById("desctxt").value.length);
			}
			
			function anuncio_img(){
				document.getElementById("desctxt").value = (document.getElementById("desctxt").value + "<img src='LINK_DA_IMAGEM_AQUI'></img>");
			}
		</script>

		<div id="cont-centro" style="padding-top:3px;margin-left:0px; min-height: 100px;">
		<h2>Anúncios</h2><hr class="est1">

			<?php
				$consulta_a = $db->prepare('SELECT anuncios.id_anuncio,anuncios.data,anuncios.login,anuncios.titulo,anuncios.descr,usuario.login,usuario.avatar FROM anuncios,usuario WHERE anuncios.login=usuario.login ORDER BY id_anuncio LIMIT '.$limite. '  OFFSET '. $inicio);
				$consulta_a->execute();
				
				$num_linhas_a = $consulta_a->rowCount();
				
				//Abas dos anúncios com o ID de cada.
				$consulta_b = $db->prepare('SELECT * FROM anuncios ORDER BY id_anuncio LIMIT '.$limite. '  OFFSET '. $inicio);
				$consulta_b->execute();
				$tr = $consulta_b->rowCount();

				$contador = 1;
			
			?>
			<div style="width:100%;float:left;margin-bottom:20px;">
			<?php
			
			while($linha_a = $consulta_a->fetch(PDO::FETCH_OBJ))
			{ ?>
			
			<div id="anuncio<?php echo $contador;?>" style="color:black;padding:15px;border:1px solid #bdbdbd;float:left;margin-bottom:20px;width:100%;">	
				<div style="width:100%;float:left;border:1px solid #bdbdbd;padding:5px;margin-bottom:10px;padding-left:10px;">
					<b>Anúncio #<?php echo $linha_a->id_anuncio; ?></b>
				</div>
				<div style="width:100%;float:left;">
					<div id="anuncio-por">Publicado por:
						<a href="perfil.php?userp=<?php echo $linha_a->login; ?>"><?php echo $linha_a->login; ?></a>
					</div>
					<div id="postado-ha"><img src="imagens/tempo.png" height="20px" style="margin-right:4px; margin-bottom:1px"><?php echo $linha_a->data; ?></div><br><br>
					<h2 style="margin-top:0px;" title="<?php echo $linha_a->titulo; ?>"><?php echo $linha_a->titulo; ?></h2>
					<?php echo $linha_a->descr; ?>
				</div>
			</div><br><br>
			
			<?php
				$contador++;
			}
			?>
			</div>
			<?php
			
			$sql = "SELECT * FROM anuncios";
			$query_Total = $db->prepare($sql);
			$query_Total->execute();

			$query_result = $query_Total->fetchAll(PDO::FETCH_ASSOC);

			# conta quantos registros tem no banco de dados
			$query_count =  $query_Total->rowCount(PDO::FETCH_ASSOC);
			# calcula o total de paginas a serem exibidas
			$qtdPag = ceil($query_count/$limite);

			# Cria os links para navegação das paginas
			echo "<div class='relax h30'>";
			# echo '<a href="busca?pg=1">PRIMEIRA PÁGINA</a>&nbsp;';
			echo '<ul id="paginacao">';
			$pg_ant=$pg-1;
			echo "<center> ";
			if($pg_ant>=1)
			{
			echo "<a class='anterior' style='align-self: flex-end;' href='anuncios.php?pg=$pg_ant'>Anterior</a> ";
			}
			if($qtdPag>1)
			{
				if($qtdPag > 1 && $pg <= $qtdPag){
					for($i = 1; $i <= $qtdPag; $i++){
						if($i == $pg){
							echo " <a class='ativo' style='align-self: flex-end;'>".$i."</a> ";
						} 
						else {
							echo " <a href='anuncios.php?pg=$i' style='align-self: flex-end;'>".$i."</a> ";
						}

					}
				}				
				$pgProx=$pg+1;
				if($pgProx<=$qtdPag)
				{
				echo "<a class='proxima' href='anuncios.php?pg=$pgProx'>Próxima</a> </center></div>";
				}
			}
			?>	
		</div>
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
	</div>
	<?php include "rodape.php"; ?>
</html>
</body>