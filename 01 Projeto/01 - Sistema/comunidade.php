
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
	<?php include "cabecalho.php"; 
		$tipo = $_GET['tipo'];
		$pe = $_GET['pe'];

		$limite = 15;		
		$pg = (isset($_GET['pg'])) ? (int)$_GET['pg'] : 1;
		# Atribui a variável inicio o inicio de onde os registros vão ser
		# mostrados por página, exemplo 0 à 10, 11 à 20 e assim por diante
		$inicio = ($pg * $limite) - $limite;
	?>
		
		<!--Menu da Esquerda - INICIO -->
		<div id="mae" style="width:1010px;max-width:1010px;background-color:red;margin: 0 auto;">
		<div id="cont-esquerda" style="margin-left:0px;">
		
			<div id="item-esquerda">
				<div id="ie-titulo">Procurar por:</div>
				<div id="ie-cont">
			<form method="get" action="comunidade.php">
				<label><input <?php if($tipo!="instituicao"){ echo"checked"; } ?> type="radio" name="tipo" value="usuario" ><i>Usuários</i></label><br>
				<label><input <?php if($tipo=="instituicao"){ echo"checked"; }?> type="radio" name="tipo" value="instituicao"><i>Instituições</i></label><br>
			</div>
			</div>
			
		</div>
		<!--Menu da Esquerda - FIM -->
			
		<!--Menu do Centro - INICIO -->
		<div id="cont-direita">
				<input type="text" name="pe" placeholder="Pesquisar..." value = "<?php if(isset($pe)){echo $pe;}?>" style="width:300px;"><input type="submit">
			</form>
			
			<?php
			include "conecta.php";
			

			
			$p_min = strtolower($pe);
			$p = "%".$p_min."%";
			
			if($tipo=="usuario" || $tipo==NULL || $tipo=="" || !isset($tipo))
			{
				$consulta_usuario = $db->prepare('SELECT * FROM usuario WHERE login LIKE ? AND excluido = \'n\' order by nome LIMIT '.$limite. '  OFFSET '. $inicio);
				$consulta_usuario->bindParam(1,$p, PDO::PARAM_STR);
				$consulta_usuario->execute();
				$num_linhas_usuario = $consulta_usuario->rowCount();

				if($num_linhas_usuario < 1){ echo "<br><br>Nada encontrado."; }
				else{ 
				if(!isset($pe) || $pe == NULL || $pe == ""){ echo "<h3>Mostrando usuários:</h3>"; }
				else{ echo "<h3>Mostrando usuários que contém ".$p_min.":</h3>"; }
				
					while($linha_usuario = $consulta_usuario->fetch(PDO::FETCH_OBJ)){ 

						$nome = $linha_usuario->nome." ".$linha_usuario->sobrenome;
					?>
						<a href="perfil.php?userp=<?php echo $linha_usuario->login; ?>" target="_blank"><span><?php echo $nome; ?></span></a><br>
						<?php
					}
				}


				$sql = 'SELECT * FROM usuario WHERE login LIKE ? AND excluido = \'n\' order by nome';
				$query_Total = $db->prepare($sql);
				$query_Total->bindParam(1,$p, PDO::PARAM_STR);
				$query_Total->execute();
				$query_result = $query_Total->fetchAll(PDO::FETCH_ASSOC);
				$query_count =  $query_Total->rowCount(PDO::FETCH_ASSOC);
				$qtdPag = ceil($query_count/$limite);

				# Cria os links para navegação das paginas
				echo "<div class='relax h30' style= 'padding-top: 300px; '>";
				# echo '<a href="busca?pg=1">PRIMEIRA PÁGINA</a>&nbsp;';
				echo '<ul id="paginacao">';
				$pg_ant=$pg-1;
				echo "<center> ";
				if($pg_ant>=1)
				{
				echo "<a class='anterior' style='align-self: flex-end;' href='comunidade.php?tipo=usuario&pe=$pe&pg=$pgProx'>Anterior</a> ";
				}
				if($qtdPag>1)
				{
					if($qtdPag > 1 && $pg <= $qtdPag){
						for($i = 1; $i <= $qtdPag; $i++){
							if($i == $pg){
								echo " <a class='ativo' style='align-self: flex-end;'>".$i."</a> ";
							} 
							else {
								echo " <a href='comunidade.php?tipo=usuario&pe=$pe&pg=$i' style='align-self: flex-end;'>".$i."</a> ";
							}

						}

					}				
					$pgProx=$pg+1;
					if($pgProx<=$qtdPag)
					{
					echo "<a class='proxima' href='comunidade.php?tipo=usuario&pe=$pe&pg=$pgProx'>Próxima</a> </center></div>";
					}
				}
			}
			else if($tipo=="instituicao")
			{
			
				$sql='SELECT * FROM instituicao WHERE nome_inst iLIKE ? AND excluido = \'n\' order by nome_inst LIMIT '.$limite. '  OFFSET '. $inicio;
				$consulta_inst = $db->prepare($sql);
				$consulta_inst->bindParam(1,$p, PDO::PARAM_STR);
				$consulta_inst->execute();
				$num_linhas_inst = $consulta_inst->rowCount();
				if($num_linhas_inst < 1){ echo "<br><br>Nada encontrado."; }
				else{ 	
				if(!isset($pe) || $pe == NULL || $pe == "")
					{ 
						echo "<h3>Mostrando instituições:</h3>"; 
					}
				else{ 
					echo "<h3>Mostrando instituições que contém ".$p_min.":</h3>"; 
				}
				
					while($linha_inst = $consulta_inst->fetch(PDO::FETCH_OBJ)){ ?>
						<a href="instituicao.php?i=<?php echo $linha_inst->id_inst; ?>" target="_blank"><span><?php echo $linha_inst->nome_inst; ?></span></a><br>
						<?php
					}
				}
				$sql = 'SELECT * FROM instituicao WHERE nome_inst iLIKE ? AND excluido = \'n\' order by nome_inst';
				$query_Total = $db->prepare($sql);
				$query_Total->bindParam(1,$p, PDO::PARAM_STR);
				$query_Total->execute();
				$query_result = $query_Total->fetchAll(PDO::FETCH_ASSOC);
				$query_count =  $query_Total->rowCount(PDO::FETCH_ASSOC);
				$qtdPag = ceil($query_count/$limite);

				# Cria os links para navegação das paginas
				echo "<div class='relax h30'>";
				# echo '<a href="busca?pg=1">PRIMEIRA PÁGINA</a>&nbsp;';
				echo '<ul id="paginacao">';
				$pg_ant=$pg-1;
				echo "<center> ";
				if($pg_ant>=1)
				{
				echo "<a class='anterior' style='align-self: flex-end;' href='comunidade.php?tipo=instituicao&pe=$pe&pg=$pgProx'>Anterior</a> ";
				}
				if($qtdPag>1)
				{
					if($qtdPag > 1 && $pg <= $qtdPag){
						for($i = 1; $i <= $qtdPag; $i++){
							if($i == $pg){
								echo " <a class='ativo' style='align-self: flex-end;'>".$i."</a> ";
							} 
							else {
								echo " <a href='comunidade.php?tipo=instituicao&pe=$pe&pg=$i' style='align-self: flex-end;'>".$i."</a> ";
							}

						}

					}				
					$pgProx=$pg+1;
					if($pgProx<=$qtdPag)
					{
					echo "<a class='proxima' href='comunidade.php?tipo=instituicao&pe=$pe&pg=$pgProx'>Próxima</a> </center></div>";
					}
				}	
							
			}
			
			
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