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
	
		<!--Menu do Centro - INICIO -->
		<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;">
	
		<?php 
		include "conecta.php";
		
		$consulta_priv = $db->prepare('SELECT * FROM paginas');
		$consulta_priv->execute();
		
		$num_linhas_priv = $consulta_priv->rowCount();
		
		if($num_linhas_priv < 1)
		{ ?>
			Algo deu errado.
		<?php }
		
		else{
			$linha_priv = $consulta_priv->fetch(PDO::FETCH_ASSOC);
			
			if($linha_priv['sobre']=='s' && ($_SESSION['tipo']==0 || $_SESSION['tipo']==NULL)){ ?>
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
				if($linha_priv['sobre']=='s' && $_SESSION['tipo']==1){ ?>
					<div style="background-color:black;color:white;padding:10px;width:950px;border-radius:8px;">
					Está página se encontra privada para usuários comuns.
					</div><br>
				<?php } ?>
		
		<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
			<h2>Sobre<?php if($_SESSION['tipo']==1){ ?><a href="adm-pgs.php"><img src="imagens/config.png" style="float:right;" title="Configurar Páginas"></a><?php } ?></h2><hr class="est1">
			
			<h4>Foto Coorporativa da Equipe:</h4>
			<img src="imagens/foto-equipe.jpg" height="400px" class="img-normal"><br>
			
			<i>(Da parte esquerda para direita em pé: Vinicius Puchille, Pedro Bincoleto, Matheus Parmegiani, Diego Peralta. Sentados: Denis Líbano, Karen 
			Murakawa, Mozart Mattar.)</i><br><br>
			<div id="sobre-texto">
			<h4>Introdução:</h4>
				O projeto é a automatização de um telescópio do IPMET e desenvolvimento de um site em que o usuário pode agendar um horário para controlar o 
				telescópio remotamente, para fins acadêmicos ou pessoais. É necessário estar logado para realizar agendamento, sendo que ao 
				faze-lo, usuários membros de instituições de ensino, ou grupos de estudo, têm um período maior de dias para escoher. O telescópio 
				fica disponível ao público, caso o horário em questão esteja livre.<br><br>

			<h4>Maiores Problemas:</h4>
				Os problemas encontrados pelo grupo foram, principalmente o serviço de streaming por falta de conhecimento sobre o assunto e a necessidade do 
				usuário ter a opção de fazer o download do vídeo transmitido, a mudança de posição do telescópio que irá mudar como ele deve se movimentar para 
				transmitir o astro, a necessidade de um aviso caso a vista esteja indisponível no momento como em dias nublados por exemplo e o envolvimento de 
				outras áreas como mecânica e eletrônica necessárias para a automatização do telescópio.<br><br>
			</div>
			<h4>Logomarca:</h4>
			<img src="imagens/logo.png" height="98px"><br><br>
			
			<h4>Desenvolvedores:</h4>
			<div id="sobre-areadev">
				<div id="sobre-dev">
				<a href="perfil.php?userp=140242">
					<div id="sobre-dev-fotod"><img src="imagens/sobre/denis.jpg" class="sobre-dev-fotoc" height="98px"></div>
				</a>
					<div id="sobre-dev-txt">
						<font class="sobre-dev-txtAno"><b>73A</b></font> <font>05</font>
						<a href="perfil.php?userp=denis"> Denis Libano</a><br>
						<div id="linha-iim" style="margin-top:10px;">
							<div id="icon-img-menor" style="background-image: url('imagens/email.png');margin-left:2px;margin-top:2px;margin-right:5px;" title="E-Mail"></div>denis.gabriel.libano@gmail.com
						</div>
					</div>
				</div>
				
				<div id="sobre-dev">
				<a href="perfil.php?userp=diego">
					<div id="sobre-dev-fotod"><img src="imagens/sobre/diego.jpg" class="sobre-dev-fotoc" height="98px"></div>
				</a>
					<div id="sobre-dev-txt">
						<font class="sobre-dev-txtAno"><b>73A</b></font> <font>06</font>
						<a href="perfil.php?userp=diego"> Diego Peralta</a><br>
						<div id="linha-iim" style="margin-top:10px;">
							<div id="icon-img-menor" style="background-image: url('imagens/email.png');margin-left:2px;margin-top:2px;margin-right:5px;" title="E-Mail"></div>diego1001001@gmail.com
						</div>
					</div>
				</div>
				
				<div id="sobre-dev">
				<a href="perfil.php?userp=karen">
					<div id="sobre-dev-fotod"><img src="imagens/sobre/karen.jpg" class="sobre-dev-fotoc" height="98px"></div>
				</a>
					<div id="sobre-dev-txt">
						<font class="sobre-dev-txtAno"><b>73A</b></font> <font>16</font>
						<a href="perfil.php?userp=karen"> Karen Murakawa</a><br>
						<div id="linha-iim" style="margin-top:10px;">
							<div id="icon-img-menor" style="background-image: url('imagens/email.png');margin-left:2px;margin-top:2px;margin-right:5px;" title="E-Mail"></div>karenmurak08@gmail.com
						</div>
					</div>
				</div>
				
				<div id="sobre-dev">
				<a href="perfil.php?userp=theucp">
					<div id="sobre-dev-fotod"><img src="imagens/sobre/matheus.jpg" class="sobre-dev-fotoc" height="98px"></div>
				</a>
					<div id="sobre-dev-txt">
						<font class="sobre-dev-txtAno"><b>73A</b></font> <font>22</font>
						<a href="perfil.php?userp=theucp"> Matheus Parmegiani</a><br>
						<div id="linha-iim" style="margin-top:10px;">
							<div id="icon-img-menor" style="background-image: url('imagens/email.png');margin-left:2px;margin-top:2px;margin-right:5px;" title="E-Mail"></div>matheus.parmegiani@gmail.com
						</div>
					</div>
				</div>
				
				<div id="sobre-dev">
				<a href="perfil.php?userp=mozartmt">
					<div id="sobre-dev-fotod"><img src="imagens/sobre/mozart.jpg" class="sobre-dev-fotoc" height="98px"></div>
				</a>
					<div id="sobre-dev-txt">
						<font class="sobre-dev-txtAno"><b>73A</b></font> <font>23</font>
						<a href="perfil.php?userp=mozartmt"> Mozart Mattar</a><br>
						<div id="linha-iim" style="margin-top:10px;">
							<div id="icon-img-menor" style="background-image: url('imagens/email.png');margin-left:2px;margin-top:2px;margin-right:5px;" title="E-Mail"></div>mozartraulmt@gmail.com
						</div>
					</div>
				</div>
				
				<div id="sobre-dev">
				<a href="perfil.php?userp=pedro@pedro">
					<div id="sobre-dev-fotod"><img src="imagens/sobre/pedro.jpg" class="sobre-dev-fotoc" height="98px"></div>
				</a>
					
					<div id="sobre-dev-txt">
						<font class="sobre-dev-txtAno"><b>73A</b></font> <font>25</font>
						<a href="perfil.php?userp=pedro@pedro"> Pedro Bincoleto</a><br>
						<div id="linha-iim" style="margin-top:10px;">
							<div id="icon-img-menor" style="background-image: url('imagens/email.png');margin-left:2px;margin-top:2px;margin-right:5px;" title="E-Mail"></div>pabcosta300@gmail.com
						</div>
					</div>
				</div>
				
				<div id="sobre-dev" style="margin-bottom:35px;">
				<a href="perfil.php?userp=puchille">
					<div id="sobre-dev-fotod"><img src="imagens/sobre/vinicius.jpg" class="sobre-dev-fotoc" height="98px"></div>
				</a>	
					<div id="sobre-dev-txt">
						<font class="sobre-dev-txtAno"><b>73A</b></font> <font>30</font>
						<a href="perfil.php?userp=puchille"> Vinicius Puchille</a><br>
						<div id="linha-iim" style="margin-top:10px;">
							<div id="icon-img-menor" style="background-image: url('imagens/email.png');margin-left:2px;margin-top:2px;margin-right:5px;" title="E-Mail"></div>vini.puchille@gmail.com
						</div>
					</div>
				</div>
			</div>
			
			<br><br>
			
			<div id="sobre-areadev">
				<div id="sobre-dev">
					<a href="perfil.php?userp=??">
						<div id="sobre-dev-fotod"><img src="imagens/sobre/lucas.jpg" class="sobre-dev-fotoc" height="98px"></div>
					</a>
					<div id="sobre-dev-txt">
						<font class="sobre-dev-txtAno" style="border-color:red;"><b>53A</b></font> <font>00</font>
						<a href="perfil.php?userp=??"> Lucas Sampaio</a><br>
						<div id="linha-iim" style="margin-top:10px;">
							<div id="icon-img-menor" style="background-image: url('imagens/email.png');margin-left:2px;margin-top:2px;margin-right:5px;" title="E-Mail"></div>
							??@gmail.com
						</div>
					</div>
				</div>
				
				<div id="sobre-dev">
					<a href="perfil.php?userp=??">
						<div id="sobre-dev-fotod"><img src="imagens/sobre/vicenzo.jpg" class="sobre-dev-fotoc" height="98px"></div>
					</a>
					<div id="sobre-dev-txt">
						<font class="sobre-dev-txtAno" style="border-color:red;"><b>53A</b></font> <font>00</font>
						<a href="perfil.php?userp=??"> Vicenzo Kanamura</a><br>
						<div id="linha-iim" style="margin-top:10px;">
							<div id="icon-img-menor" style="background-image: url('imagens/email.png');margin-left:2px;margin-top:2px;margin-right:5px;" title="E-Mail"></div>
							??@gmail.com
						</div>
					</div>
				</div>
			</div>
			
			<br><br>
			
			<div id="sobre-areadev">
				<div id="sobre-dev">
					<a href="perfil.php?userp=??">
						<div id="sobre-dev-fotod"><img src="imagens/404.png" class="sobre-dev-fotoc" height="98px"></div>
					</a>
					<div id="sobre-dev-txt">
						<a href="perfil.php?userp=??">
							<div style="height:20px;padding-top:9px;">
							Demilson Quintão
							</div><br>
						</a>
						<div id="linha-iim" style="margin-top:10px;">
							<div id="icon-img-menor" style="background-image: url('imagens/email.png');margin-left:2px;margin-top:2px;margin-right:5px;" title="E-Mail"></div>
							quintao@ipmet.unesp.br
						</div>
					</div>
				</div>
			</div>

		</div>
		<!--Menu do Centro - FIM -->
			<?php }
		}			?>
	
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
</body>
</html>