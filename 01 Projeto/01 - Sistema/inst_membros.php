<?php
session_start(); 
include "conecta.php";
		$id_inst = $_GET['i'];
		
		$consulta_inst = $db->prepare('SELECT * FROM instituicao WHERE id_inst = ? AND excluido = \'n\'');
		$consulta_inst->bindParam(1,$id_inst, PDO::PARAM_STR);
		$consulta_inst->execute();
		
		$num_linhas_inst = $consulta_inst->rowCount();
		
		$linha_inst = $consulta_inst->fetch(PDO::FETCH_ASSOC);
?> <html>
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
	<title><?php if($num_linhas_inst < 1){ echo "Kepler"; } else{ echo "".$linha_inst['nome_inst']." - Kepler"; } ?></title>
</head>

<body style="font-family: 'Raleway', sans-serif;">
	<?php include "cabecalho.php"; ?>
	
		<?php
		
		if($num_linhas_inst < 1){ include "404.php"; }
		else
		{
		?>
		
		<!--Menu da Esquerda - INICIO -->
		<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;">
	
		<?php 
		//Verificar se o usuário logado faz parte da instituição.
		$consulta_relacao = $db->prepare('SELECT * FROM relacao WHERE id_inst = ? AND login = ?');
		$consulta_relacao->bindParam(1,$id_inst, PDO::PARAM_STR);
		$consulta_relacao->bindParam(2,$_SESSION['login'], PDO::PARAM_STR);
		$consulta_relacao->execute();
		$num_linhas_relacao = $consulta_relacao->rowCount();
		
		$linha_relacao = $consulta_relacao->fetch(PDO::FETCH_ASSOC);
		
		/////////////////////////////////////////////////////////////////////
		
		//Verificar se a página está privada.
		$consulta_priv = $db->prepare('SELECT * FROM paginas');
		$consulta_priv->execute();
		$num_linhas_priv = $consulta_priv->rowCount();
		
		if($num_linhas_priv < 1)
		{ include "404.php"; }
		
		else{
			$linha_priv = $consulta_priv->fetch(PDO::FETCH_ASSOC);
			
			if($linha_priv['instituicao']=='s' && ($_SESSION['tipo']==0 || $_SESSION['tipo']==NULL)){ ?>
				<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
					<h2>
						<i>Ops!</i>
					</h2>
					<hr class="est1">
					<div style="background-color:black;color:white;padding:10px;width:950px;border-radius:8px;">Está página foi configurada como privada por um administrador, talvez ela esteja em manutenção no momento. Tente novamente mais tarde, pode ser que ela já esteja disponível.</div>
					
					<br>
					<center><img src="imagens/manutencao.jpg" height="300px"></center>
				</div>
			<?php 
			}
			
			else{
				if($linha_priv['instituicao']=='s' && $_SESSION['tipo']==1){ ?>
					<div style="background-color:black;color:white;padding:10px;width:950px;border-radius:8px;">
					Está página se encontra privada para usuários comuns.
					</div><br>
				<?php } ?>
		
		<div id="cont-centro" style="padding-top:3px;margin-left:0px;padding-top:-10px;">
			<h3><a href="instituicao.php?i=<?php echo $linha_inst['id_inst']; ?>" title="Voltar à Instituição"><div id="icon-img" style="background-image: url('imagens/voltar.png');height:30px;margin-right:7px;float:left;margin-top:0px;"></div></a><b><?php echo $linha_inst['nome_inst']; ?></b> - Membros<a href="adm-pgs.php"><img src="imagens/config.png" style="float:right;" title="Configurar Páginas"></a></h3><hr class="est1">
			
			<?php	
			//Selecionar membros comuns.
			$consulta_membros  = $db->prepare("SELECT * FROM relacao,usuario WHERE relacao.id_inst = ? AND relacao.login = usuario.login ORDER BY relacao.login;");
			$consulta_membros->bindParam(1,$linha_inst['id_inst'], PDO::PARAM_STR);
			$consulta_membros->execute();
			$num_linhas_membros = $consulta_membros->rowCount();
			
			if($num_linhas_membros > 0){
				echo '<span style="font-size:13px;font-weight:bold;">Membros<span><br>';
				while($linha_membros = $consulta_membros->fetch(PDO::FETCH_OBJ)){ ?>
					<a href="perfil.php?userp=<?php echo $linha_membros->login; ?>" style="margin-right:5px;margin-bottom:5px;text-decoration: none;">
						<div style="background-image: url('<?php echo $linha_membros->avatar; ?>');background-size:50px;background-repeat: no-repeat;
						background-position:center;background-color:black;height:50px;width:50px;float:left;margin-right:5px;border:1px solid #bdbdbd;" 
						title="<?php echo $linha_membros->login; ?>"></div>
					</a>
				<?php
				}
			}
			?>
		</div><?php } //fim do ELSE ?>
		<!--Menu do Centro - FIM -->
		<?php }
		} ?>
	
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