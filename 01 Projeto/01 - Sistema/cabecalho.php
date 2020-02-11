<?php
	#session_start();
	ini_set(session.cookie_lifetime,"0");
	if($_SESSION['logado'] == 1)
	{
		// Inicia uma sessão.
		// Verifica se $_SESSION['ultimoClick'] esta setada e não esta vazia.
		// Caso esteja, ele verifica o tempo que o usuario levou entre um clique e outro.
		// Caso não, ele seta a sessão e dá o valor do tempo time() atual.
		date_default_timezone_set("America/Sao_Paulo");
		$horario = date('H:i:s');		
		$str_time = $horario;
		sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
		$tempoAtual = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;

		$_SERVER['PHP_SELF'] = str_replace("/kepler/Kepler/", "", $_SERVER['PHP_SELF']);

		if (isset($_SESSION['tempo_uso']) && !empty($_SESSION['tempo_uso']) ) 
		{
			// Faz uma condição entre o tempo do ultimo click e o tempo atual.
			// Caso dê maior que 60 segundos, redireciona para a pagina desejada.
			// Caso não de maior, apenas atualiza o valor do ultimo clique para o valor atual.
			if (($tempoAtual - $_SESSION['tempo_uso']) > '30000' AND $_SESSION['desconectar_usuario'] == 's') 
			{
				$_SESSION['desconectar_forcado'] = 's';
				$_SESSION['tempo_uso'] = $tempoAtual;
				header("Location:logout.php");
				exit();
			}
			else
			{
				$_SESSION['pagina'] += 1;
				$_SESSION['tempo_uso'] = $tempoAtual;
				$_SESSION['desconectar_usuario'] = 's';
				if($_SERVER['PHP_SELF'] == 'livestream.php' OR $_SERVER['PHP_SELF'] == 'assistir.php')
				{
					$_SESSION['desconectar_usuario'] = 'n';
				}
			}
		}
		else
		{
			$_SESSION['pagina'] += 1;
			$_SESSION['tempo_uso'] = $tempoAtual;
			$_SESSION['desconectar_usuario'] = 's';
			if($_SERVER['PHP_SELF'] == 'livestream.php' OR $_SERVER['PHP_SELF'] == 'assistir.php')
			{
				$_SESSION['desconectar_usuario'] = 'n';
			}
		}
	}
?>
<script  type="text/javascript" src="js/jquery.js"></script>
<script src="js/jquery.elevatezoom.js" type="text/javascript"></script>

<div id="fixo1" style="z-index:+2">
	<div id="logo"><a href="index.php"><img src="imagens/logo.png" height="40px" style="margin-top:5px;margin-bottom:8px;" class="giro"></a></div>
	
	<div id="botao-bf">
		<a href="sobre-geral.php" class="botao-bft">Sobre</a>
	</div>
	
	<div id="botao-bf">
		<a href="agendamento.php" class="botao-bft">Agendar</a>
	</div>
	
	<div id="botao-bf">
		<a href="comunidade.php" class="botao-bft">Comunidade</a>
	</div>
	
	<div id="botao-bf">
		<a href="ajuda.php" class="botao-bft">Ajuda</a>
	</div>
	
	<div id="botao-bf">
		<a href="videos.php" class="botao-bft">Vídeos</a>
	</div>

	<div id="botao-bf">
		<a href="anuncios.php" class="botao-bft">Anúncios</a>
	</div>
	
	<div id="fixo1-dir" style="font-family: 'Raleway', sans-serif;background-color:black;display: table-cell;vertical-align: middle;
	position:relative;color:white;float:right;margin-top:4px;margin-right:110px;min-width:180px;max-width:270px;
	min-height:47px;max-height:47px;text-align:right;word-wrap:inherit;line-height:46px;">
		<?php if($_SESSION['logado'] == 1){ ?>
		
		<?php
			include "conecta.php";
			
			$consulta_convites = $db->prepare('SELECT * FROM inst_convites,instituicao WHERE inst_convites.para_login = ? AND inst_convites.id_inst = instituicao.id_inst;');
			$consulta_convites->bindParam(1,$_SESSION['login'], PDO::PARAM_STR);
			$consulta_convites->execute();
			
			$num_linhas_convites = $consulta_convites->rowCount();
		?>
		
		<script>
		//Mostra o número de notificações do usuário no título da página.
		setTimeout(function (){
			document.title = "<?php if($num_linhas_convites>0){ ?>(<?php echo $num_linhas_convites; ?>) <?php } ?> "+document.title;
		}, 500);
		</script>
		
		 <?php 
		if($num_linhas_convites > 0){ ?>
		<div class="badge" onclick="notif_fade()" id="notif_icon"><?php echo $num_linhas_convites; ?></div>
		<?php 
		} ?>
		 <input type="hidden" id="notif_acao" value="notif_show">
		
		<a href="perfil.php?userp=<?php echo $_SESSION['login']; ?>" style="word-wrap:inherit;display:inline;">
			<font style="height:10px;max-height:10px;background-color:transparent;color:white;border:0px;min-width:137px;
			max-width:227px;text-align:right;margin-top:10px;word-wrap:inherit;margin-right:2px;" height="10px"><?php echo $_SESSION['nome']; ?></font>
			
			<div style="background-image: url('<?php echo $_SESSION['avatar']; ?>');background-size:40px;background-repeat: no-repeat;
			background-position: center;background-color:black;float:right;margin-right:4px;margin-left:5px;margin-top:0px; height:40px; width:40px; border: 1px solid black; 
			cursor:pointer;border-radius:100px;"></div>
		</a>
		
		<!--INICIO - DROPDOWN DIREITA-->
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<button type="button" class="dropdown-toggle" data-toggle="dropdown" style="height:46px;background-color:black;border:1px solid black;
				font-size:15px;float:right;margin-right:-60px;">
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" style="margin-right:-60px;margin-top:2px;">
				<?php if($_SESSION['tipo'] == 1) { ?>
					<li><a style="color:orange" href="adm.php">Área do<br>Administrador</a></li>
					<li class="divider"></li>
				<?php } ?>
					<li><a href="perfil.php?userp=<?php echo $_SESSION['login']; ?>">Ver Perfil</a></li>
					<li><a href="instituicoes.php?userp=<?php echo $_SESSION['login']; ?>">Instituições</a></li>
					<li class="divider"></li>
					<li><a href="livestream.php">Streaming</a></li>
					<li class="divider"></li>
					<li><a href="perfil-edit.php">Configurações</a></li>
					<li class="divider"></li>
					<li><a href="logout.php">Sair</a></li>
				</ul>
			</li>
		 </ul>
		 
		 <script>
		 function notif_fade() {
			if(document.getElementById("notif_acao").value == "notif_fade"){
				document.getElementById("notif_allpopup").style = "display:none;";
				document.getElementById("notif_acao").value = "notif_show";
			}
			else if(document.getElementById("notif_acao").value == "notif_show"){
				document.getElementById("notif_allpopup").style = "";
				document.getElementById("notif_acao").value = "notif_fade";
			}
		 };
		 </script>
		 
		 <div id="notif_acao" value="notif_show"></div>
		 
			<?php 
			if($num_linhas_convites > 0){ ?>
			<div id="notif_allpopup" style="display:none;overflow:hidden;"><?php
				while($linha_convites = $consulta_convites->fetch(PDO::FETCH_OBJ)){
					?>
					<form action="inst-convaceita.php" method="post" id="notif_<?php echo $linha_convites->id_inst; ?>">
					<input type="hidden" name="de_login" value="<?php echo $linha_convites->de_login; ?>">
					<input type="hidden" name="id_inst" value="<?php echo $linha_convites->id_inst; ?>">
					<input type="hidden" name="res_<?php echo $linha_convites->id_inst; ?>" id="res_<?php echo $linha_convites->id_inst; ?>">
					
					<div name="notif_popup" style="margin-top:10px;width:350px;background-color:white;height:100px;
					box-shadow: 5px 5px 15px #a5a4a4;color:black;line-height:normal;overflow:hidden;">
						<div style="background-image: url('<?php echo $linha_convites->avatar_inst; ?>');background-size:100px;background-repeat: no-repeat;
						background-position: center;background-color:black;float:left;height:100px;width:90px;
						cursor:pointer;"></div>
						<div style="font-size:13px;background-color:white;width:242px;float:left;height:55px;padding:10px;text-align:left;word-wrap:break-word;">
							<span><div id="icon-img" style="background-image: url('imagens/users.png');height:25px;"></div></span>
							<span><?php echo "<b>".$linha_convites->de_login."</b> te convidou para fazer parte de <b>".$linha_convites->nome_inst."</b>."; ?></span>
						</div>
						<div style="background-color:white;width:242px;float:left;height:45px;padding:10px;text-align:left;word-wrap:break-word;">
							<a style="float:left;color:white;background-color:#2E64FE;border-radius:3px;padding:3px;" href="#" onclick="document.getElementById('res_<?php echo $linha_convites->id_inst; ?>').value = 's';document.getElementById('notif_<?php echo $linha_convites->id_inst; ?>').submit();">Aceitar</a>
							<a style="float:right;color:white;background-color:#DF0101;border-radius:3px;padding:3px;" href="#" onclick="document.getElementById('res_<?php echo $linha_convites->id_inst; ?>').value = 'n';document.getElementById('notif_<?php echo $linha_convites->id_inst; ?>').submit();">Recusar</a>
						</div>
					</div>
					</form>
					<?php 
				} ?>
			</div><?php
			}
			?>
		 <!--FIM - DROPDOWN DIREITA-->
		 <?php } //fim logado
		 
		 else{ ?>
			 <div id="botao-bf" style="float:right;text-align:right;margin-top:-4px;">
				<a href="login.php" class="botao-bft">Login</a>
			</div>
		 <?php } ?>
	</div>
</div><br><br><br><br>