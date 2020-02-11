<?php 
	session_start();
?> 
<html>
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
		
		<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;">
		<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
		<?php if($_SESSION['tipo'] == 1){ ?>
			<a href="adm.php" title="Voltar ao Menu"><div id="icon-img" style="background-image: url('imagens/voltar.png');height:30px;margin-right:7px;float:left;margin-top:20px;"></div></a>
			<h2>Área do Administrador</h2><hr class="est1">
			
			<h4 style="height:25px;"><b>Estatísticas</b></h4>
			
			<div id="tempo_medio"  onClick="exibir_conteudo('tempo_medio1')">
				<label style="font-size:20px;padding-left:5px;cursor:pointer" onMouseOver="alterar_cor_div('tempo_medio')"  onMouseOut="retornar_cor_original('tempo_medio')">
					
						Tempo médio de uso do sistema por dia &nbsp;&nbsp; 
						<span id="icone_tempo_medio1" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>	
					
				</label>
			</div>
			<div id="tempo_medio1" style="display:none;padding-left:10px;">
				<center>
					<img src="grafico_tempo.php" height="550px;" style="margin-bottom: 10px;" />
				</center>
			</div>
			<br>

			<?php
			include "conecta.php";
				?>
				<div id="todos_agendamentos"  onClick="exibir_conteudo('todos_agendamentos1')">
				<label style="font-size:20px;padding-left:5px;cursor:pointer" onMouseOver="alterar_cor_div('todos_agendamentos')"  onMouseOut="retornar_cor_original('todos_agendamentos')">
				
					Todos agendamentos realizados &nbsp;&nbsp; 
					<span id="icone_todos_agendamentos1" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
					
				</label>
			</div>
			<div id="todos_agendamentos1" style="display:none;padding-left:10px;">
				<center>
					<img src="grafico_todos_agendamentos.php" height="550px;" style="margin-bottom: 10px;" />
				</center>
			</div>
			
			<br>

				<div id="agendamento_mes"  onClick="exibir_conteudo('agendamento_mes1')">
				<label style="font-size:20px;padding-left:5px;cursor:pointer" onMouseOver="alterar_cor_div('agendamento_mes')"  onMouseOut="retornar_cor_original('agendamento_mes')">
			
					Agendamentos do último mês &nbsp;&nbsp; 
					<span id="icone_agendamento_mes1" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
					
				</label>
			</div>
			<div id="agendamento_mes1" style="display:none;padding-left:10px;">
				<center>
					<img src="grafico_agendamento_mes.php" height="550px;" style="margin-bottom: 10px;" />
				</center>
			</div>
			<br>
			

				<div id="ajuda_usuario_alterar_dados"  onClick="exibir_conteudo('ajuda_usuario_conteudo_alterar_dados')">
				<label style="font-size:20px;padding-left:5px;cursor:pointer" onMouseOver="alterar_cor_div('ajuda_usuario_alterar_dados')"  onMouseOut="retornar_cor_original('ajuda_usuario_alterar_dados')">
				
					Agendamentos dos últimos 7 dia &nbsp;&nbsp; 
					<span id="icone_ajuda_usuario_conteudo_alterar_dados" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
					
				</label>
			</div>
			<div id="ajuda_usuario_conteudo_alterar_dados" style="display:none;padding-left:10px;">
				<center>
					<img src="grafico_agendamento_sete.php" height="550px;" style="margin-bottom: 10px;" />
				</center>
			</div>
			
			<br>
					

			
		<?php } //se tiver permissao fim
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