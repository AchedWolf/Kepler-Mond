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
	<?php include "cabecalho.php"; ?>
		
		<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;">
		<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
		<?php if($_SESSION['tipo'] == 1){ ?>
			<a href="adm-config.php" title="Voltar ao Menu"><div id="icon-img" style="background-image: url('imagens/voltar.png');height:30px;margin-right:7px;float:left;margin-top:20px;"></div></a>
			<h2>Área do Administrador</h2><hr class="est1">
			
			<h4 style="height:25px;"><b>Configurações do Site > Imagens</b></h4>
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
		</script>	
					<div id="imagens"  onClick="exibir_conteudo('imagens_conteudo')">
						<label style="font-size:20px;padding-left:5px;cursor:pointer" onMouseOver="alterar_cor_div('imagens')"  onMouseOut="retornar_cor_original('imagens')">
							
								Diretório: /imagens &nbsp;&nbsp; 
								<span id="icone_ajuda_usuario_conteudo_criar_conta" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>	
							
						</label>
					</div>		
					<div id="imagens_conteudo" style="width:100%;float:left;display:none;">
					<?php
					foreach(glob('imagens/*.{jpg,png,gif}', GLOB_BRACE) as $filename)
					{
						$i++;
						?>	
						<div style="border:1px solid black;padding:10px;margin:19px;width:200px;height:260px;float:left;">
							<div style="border:1px solid black;width:175px;background-color:transparent;height:175px;overflow:hidden;">
								<img src="<?php echo $filename; ?>" style="width:173px;">
							</div>
								<div style="font-size:13px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-top:5px;">
									<b>Nome:</b> <span title="<?php echo $filename; ?>"><?php echo $filename; ?></span><br>
									<?php $tamMB = (filesize($filename) / 1000); ?>
									<b>Tamanho:</b> <span title="<?php echo round($tamMB, 2)." KB";?>"><?php echo round($tamMB, 2)." KB";?></span>
								</div>
						</div>
						<?php
					}
					
					?>
					</div>
					
					<div id="imagens/ajuda"  onClick="exibir_conteudo('imagens/ajuda_conteudo')">
						<label style="font-size:20px;padding-left:5px;cursor:pointer" onMouseOver="alterar_cor_div('imagens/ajuda')"  onMouseOut="retornar_cor_original('imagens/ajuda')">
							
								Diretório: /imagens/ajuda &nbsp;&nbsp; 
								<span id="icone_ajuda_usuario_conteudo_criar_conta" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>	
							
						</label>
					</div>		
					<div id="imagens/ajuda_conteudo" style="width:100%;float:left;display:none;">
					<?php
					foreach(glob('imagens/ajuda/*.{jpg,png,gif}', GLOB_BRACE) as $filename)
					{
						?>	
						<div style="border:1px solid black;padding:10px;margin:19px;width:200px;height:260px;float:left;">
							<div style="border:1px solid black;width:175px;background-color:transparent;height:175px;overflow:hidden;">
								<img src="<?php echo $filename; ?>" style="width:173px;">
							</div>
								<div style="font-size:13px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-top:5px;">
									<b>Nome:</b> <span title="<?php echo $filename; ?>"><?php echo $filename; ?></span><br>
									<?php $tamMB = (filesize($filename) / 1000); ?>
									<b>Tamanho:</b> <span title="<?php echo round($tamMB, 2)." KB";?>"><?php echo round($tamMB, 2)." KB";?></span>
								</div>
						</div>
						<?php
					}
					?>
					</div>
		
					<div id="imagens/sobre"  onClick="exibir_conteudo('imagens/sobre_conteudo')">
						<label style="font-size:20px;padding-left:5px;cursor:pointer" onMouseOver="alterar_cor_div('imagens/sobre')"  onMouseOut="retornar_cor_original('imagens/sobre')">
							
								Diretório: /imagens/sobre &nbsp;&nbsp; 
								<span id="icone_ajuda_usuario_conteudo_criar_conta" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>	
							
						</label>
					</div>		
					<div id="imagens/sobre_conteudo" style="width:100%;float:left;display:none;">
					<?php
					foreach(glob('imagens/sobre/*.{jpg,png,gif}', GLOB_BRACE) as $filename)
					{
						?>	
						<div style="border:1px solid black;padding:10px;margin:19px;width:200px;height:260px;float:left;">
							<div style="border:1px solid black;width:175px;background-color:transparent;height:175px;overflow:hidden;">
								<img src="<?php echo $filename; ?>" style="width:173px;">
							</div>
								<div style="font-size:13px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-top:5px;">
									<b>Nome:</b> <span title="<?php echo $filename; ?>"><?php echo $filename; ?></span><br>
									<?php $tamMB = (filesize($filename) / 1000); ?>
									<b>Tamanho:</b> <span title="<?php echo round($tamMB, 2)." KB";?>"><?php echo round($tamMB, 2)." KB";?></span>
								</div>
						</div>
						<?php
					}
					
					?>
					</div>
			
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