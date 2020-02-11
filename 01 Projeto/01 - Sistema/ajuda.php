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
			
			if($linha_priv['ajuda']=='s' && ($_SESSION['tipo']==0 || $_SESSION['tipo']==NULL)){ ?>
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
				if($linha_priv['ajuda']=='s' && $_SESSION['tipo']==1){ ?>
					<div style="background-color:black;color:white;padding:10px;width:950px;border-radius:8px;">
					Está página se encontra privada para usuários comuns.
					</div><br>
		<?php } }?>
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
		<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
		<h2>Ajuda<?php if($_SESSION['tipo']==1){ ?><a href="adm-pgs.php"><img src="imagens/config.png" style="float:right;" title="Configurar Páginas"></a><?php } ?></h2><hr class="est1">
		<div id="ajuda_usuario" style="color:black">
		
		<!-- Criar Conta -->
			<div id="ajuda_usuario_criar_conta"  onClick="exibir_conteudo('ajuda_usuario_conteudo_criar_conta')" style="width:250px">
				<label style="font-size:20px;padding-left:5px;cursor:pointer" onMouseOver="alterar_cor_div('ajuda_usuario_criar_conta')"  onMouseOut="retornar_cor_original('ajuda_usuario_criar_conta')">
					
						Como criar uma Conta &nbsp;&nbsp; 
						<span id="icone_ajuda_usuario_conteudo_criar_conta" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>	
					
				</label>
			</div>
			<div id="ajuda_usuario_conteudo_criar_conta" style="display:none;padding-left:10px;">
				<h4>Inicialmente, clique na opção <b>Login</b>, localizada no menu superior, na porção direita.
					<br><br><br>
					<center>
						<img src="imagens/ajuda/menu_superior.PNG" style="width:900px;height:50px">
					</center>	
					<br><br><br>
					Após esse procedimento, clique no botão <b>Cadastrar-se</b>, localizado na área <b>Cadastre-se</b>.
					<br><br><br>
					<center>
						<img src="imagens/ajuda/cadastro2.png" style="width:461px;height:209px">
					</center>
					<br><br><br>
					Complete o formulário de Cadastro de Usuário com os seus dados e clique no botão <b>Pronto!</b>.
					<br><br><br>
					<center>
						<img src="imagens/ajuda/form_cadastro.PNG" style="width:800px;height:501px">
					</center>
					<br><br><br>
					Dessa forma, sua conta será criada e você poderá realizar o login no sistema.
				</h4>
			</div>
			<br>
		<!-- Login -->
			<div id="ajuda_usuario_login"  onClick="exibir_conteudo('ajuda_usuario_conteudo_login')" style="width:250px">
				<label style="font-size:20px;padding-left:5px;cursor:pointer" onMouseOver="alterar_cor_div('ajuda_usuario_login')"  onMouseOut="retornar_cor_original('ajuda_usuario_login')">
				
					Como realizar Login &nbsp;&nbsp; 
					<span id="icone_ajuda_usuario_conteudo_login" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
					
				</label>
			</div>
			<div id="ajuda_usuario_conteudo_login" style="display:none;padding-left:10px;">
				<h4>Inicialmente, clique na opção <b>Login</b>, localizada no menu superior, na porção direita.
					<br><br><br>
					<center>
						<img src="imagens/ajuda/menu_superior.PNG" style="width:900px;height:50px">
					</center>	
					<br><br><br>
					Após esse procedimento, complete os campos da área <b>Login</b> com o nome de seu usuário e sua senha e 
					<br><br>
					clique no botão <b>Login</b>.
					<br><br><br>
					<center>
						<img src="imagens/ajuda/login.PNG" style="width:235px;height:270px">
					</center>
					<br><br><br>
					Caso esses dados estejam corretos, você poderá acessar sua conta.
				</h4>
			</div>
			
			<br>
			<!-- Perfil -->
			<div id="ajuda_usuario_perfil"  onClick="exibir_conteudo('ajuda_usuario_conteudo_perfil')" style="width:290px">
				<label style="font-size:20px;padding-left:5px;cursor:pointer" onMouseOver="alterar_cor_div('ajuda_usuario_perfil')"  onMouseOut="retornar_cor_original('ajuda_usuario_perfil')">
			
					Como visualizar seu Perfil &nbsp;&nbsp; 
					<span id="icone_ajuda_usuario_conteudo_perfil" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
					
				</label>
			</div>
			<div id="ajuda_usuario_conteudo_perfil" style="display:none;padding-left:10px;">
				<h4>Após realizar o login, clique na opção que contém seu nome de usuário, juntamente com a imagem de seu  
					<br><br>
					avatar, localizada no menu superior, na porção direita.
					<br><br><br>
					<center>
						<img src="imagens/ajuda/menu_superior_logado.PNG" style="width:900px;height:50px">
					</center>	
					<br><br><br>
					Será exibido um outro menu. Selecione a opção <b>Ver Perfil</b>.
					<br><br><br>
					<center>
						<img src="imagens/ajuda/menu_usuario.PNG" style="width:190px;height:293px">
					</center>	
					<br><br><br>
					Dessa maneira, poderá visualizar o seu perfil.
				</h4>
			</div>
			
			<br>			
			
			<!-- Alterar dados -->
			<div id="ajuda_usuario_alterar_dados"  onClick="exibir_conteudo('ajuda_usuario_conteudo_alterar_dados')" style="width:290px">
				<label style="font-size:20px;padding-left:5px;cursor:pointer" onMouseOver="alterar_cor_div('ajuda_usuario_alterar_dados')"  onMouseOut="retornar_cor_original('ajuda_usuario_alterar_dados')">
				
					Como alterar seus Dados &nbsp;&nbsp; 
					<span id="icone_ajuda_usuario_conteudo_alterar_dados" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
					
				</label>
			</div>
			<div id="ajuda_usuario_conteudo_alterar_dados" style="display:none;padding-left:10px;">
				<h4>Após realizar o login e acessar o seu perfil, clique no botão <b>Editar Dados</b>, localizado à esquerda.
					<br><br><br>
					<center>
						<img src="imagens/ajuda/perfil_editar_dados.PNG" style="width:500px;height:284px">
					</center>	
					<br><br><br>
					Assim que realizar as alterações necessárias, selecione a opção <b>Salvar Dados</b>.
					<br><br><br>
					<center>
						<img src="imagens/ajuda/form_alterar_dados.PNG" style="width:800px;height:624px">
					</center>	
					<br><br><br>
					Dessa maneira, seus dados serão alterados.
				</h4>
			</div>
			
			<br>			
			
			<!-- Alterar senha -->
			<div id="ajuda_usuario_alterar_senha"  onClick="exibir_conteudo('ajuda_usuario_conteudo_alterar_senha')" style="width:280px">
				<label style="font-size:20px;padding-left:5px;cursor:pointer" onMouseOver="alterar_cor_div('ajuda_usuario_alterar_senha')"  onMouseOut="retornar_cor_original('ajuda_usuario_alterar_senha')">
		
					Como alterar sua Senha &nbsp;&nbsp; 
					<span id="icone_ajuda_usuario_conteudo_alterar_senha" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
			
				</label>
			</div>
			<div id="ajuda_usuario_conteudo_alterar_senha" style="display:none;padding-left:10px;">
				<h4>Após realizar o login e acessar o seu perfil, clique no botão <b>Editar Dados</b>, localizado à esquerda.
					<br><br><br>
					<center>
						<img src="imagens/ajuda/perfil_editar_dados.PNG" style="width:500px;height:284px">
					</center>	
					<br><br><br>
					Selecione a opção <b>Alterar Senha</b>.
					<br><br><br>
					<center>
						<img src="imagens/ajuda/alterar_senha.PNG" style="width:500px;height:140px">
					</center>	
					<br><br><br>
					Preencha o formulário com os dados de sua senha atual e de sua nova senha.
					<br><br>
					Ao finalizar, clique no botão <b>Salvar Dados</b>.
					<br><br><br>
					<center>
						<img src="imagens/ajuda/form_alterar_senha.PNG" style="width:800px;height:271px">
					</center>	
					<br><br><br>
					Dessa maneira, sua senha será alterada.
				</h4>
			</div>
			
			<br>			
		
			<!-- Visualização das Instituições nas quais o usuário participa -->
			<div id="ajuda_usuario_visualizar_instituicoes"  onClick="exibir_conteudo('ajuda_usuario_conteudo_visualizar_instituicoes')" style="width:520px">
				<label style="font-size:20px;padding-left:5px;cursor:pointer" onMouseOver="alterar_cor_div('ajuda_usuario_visualizar_instituicoes')"  onMouseOut="retornar_cor_original('ajuda_usuario_visualizar_instituicoes')">
				
					Como visualizar as Instituições das quais participa &nbsp;&nbsp; 
					<span id="icone_ajuda_usuario_conteudo_visualizar_instituicoes" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
					
				</label>
			</div>
			<div id="ajuda_usuario_conteudo_visualizar_instituicoes" style="display:none;padding-left:10px;">
				<h4>Após realizar o login, clique na opção que contém seu nome de usuário, juntamente com a imagem de seu  
					<br><br>
					avatar, localizada no menu superior, na porção direita.
					<br><br><br>
					<center>
						<img src="imagens/ajuda/menu_superior_logado.PNG" style="width:900px;height:50px">
					</center>	
					<br><br><br>
					Será exibido um outro menu. Selecione a opção <b>Instituições</b>.
					<br><br><br>
					<center>
						<img src="imagens/ajuda/menu_usuario_instituicoes.png" style="width:190px;height:293px">
					</center>	
					<br><br><br>
					Dessa maneira, poderá visualizar as instituições das quais participa.
				</h4>
			</div>
			
			<br>			
		<!-- Vídeos do Sistema -->
			<div id="ajuda_usuario_videos"  onClick="exibir_conteudo('ajuda_usuario_conteudo_videos')" style="width:780px">
				<label style="font-size:20px;padding-left:5px;cursor:pointer" onMouseOver="alterar_cor_div('ajuda_usuario_videos')"  onMouseOut="retornar_cor_original('ajuda_usuario_videos')">
			
					Como assistir a vídeos de Streaming do Telescópio transmitidos anteriormente &nbsp;&nbsp; 
					<span id="icone_ajuda_usuario_conteudo_videos" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
				
				</label>
			</div>
			<div id="ajuda_usuario_conteudo_videos" style="display:none;padding-left:10px;">
				<h4>Clique na opção <b>Vídeos</b>, disponibilizada no menu superior, na porção esquerda,
				<br><br><br>
					<center>
						<img src="imagens/ajuda/menu_superior_videos.png" style="width:900px;height:50px">
					</center>	
				<br><br><br>
				 ou no rodapé da página.
				 <br><br><br>
				<center>
						<img src="imagens/ajuda/mapa_site_videos.PNG" style="width:300px;height:186px">
					</center>	
				<br><br><br>
				Escolha o vídeo que deseja assistir e clique no ícone.
				<br><br>
				Caso queira realizar download desse vídeo, escolha o formato e selecione a opção <b>Baixar</b>.
				<br><br><br>
				<center>
						<img src="imagens/ajuda/video_download.png" style="width:200px;height:186px">
					</center>	
				<br><br><br>
				Em seguida, clique no ícone localizado na barra de opções, na parte inferior do vídeo, à direita.
				<br><br><br>
				<center>
						<img src="imagens/ajuda/download_video.PNG" style="width:700px;height:390px">
					</center>	
				<br><br><br>
				
				</h4>
			</div>	
			<br>
			<!-- Astros transmitidos no momento-->
			<div id="ajuda_usuario_astros_atual"  onClick="exibir_conteudo('ajuda_usuario_conteudo_astros_atual')" style="width:780px">
				<label style="font-size:20px;padding-left:5px;cursor:pointer" onMouseOver="alterar_cor_div('ajuda_usuario_astros_atual')"  onMouseOut="retornar_cor_original('ajuda_usuario_astros_atual')">
				
					Como assistir ao vídeo de Streaming do Telescópio transmitido em tempo real&nbsp;&nbsp; 
					<span id="icone_ajuda_usuario_conteudo_astros_atual" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
				
				</label>
			</div>
			<div id="ajuda_usuario_conteudo_astros_atual" style="display:none;padding-left:10px;">
				<h4>Clique no logo do sistema <b>Kepler</b>, localizado no menu superior, na porção esquerda, 
				<br><br><br>
					<center>
						<img src="imagens/ajuda/menu_superior_home.png" style="width:900px;height:50px">
					</center>	
				<br><br><br>
				ou na opção <b>Home</b>, presente no rodapé da página.
				 <br><br><br>
				<center>
						<img src="imagens/ajuda/mapa_site_home.png" style="width:300px;height:186px">
					</center>	
				<br><br><br>
				
				Selecione o botão <b>Assistir</b>, disposto na área <b>Transmitindo</b>, à esquerda na tela.
				<br><br><br>
					<center>
						<img src="imagens/ajuda/transmitindo_index.PNG" style="width:300px;height:146px">
					</center>	
				<br><br><br>
				Dessa forma, poderá assistir ao vídeo de Streaming do Telescópio transmitido em tempo real.
				
				</h4>
			</div>
		
			<br>
			<!-- Programação astros que serão transmitidos-->
			<div id="ajuda_usuario_programacao_transmissao"  onClick="exibir_conteudo('ajuda_usuario_conteudo_programacao_transmissao')" style="width:600px">
				<label style="font-size:20px;padding-left:5px;cursor:pointer" onMouseOver="alterar_cor_div('ajuda_usuario_programacao_transmissao')"  onMouseOut="retornar_cor_original('ajuda_usuario_programacao_transmissao')">
			
					Como visualizar a programação das próximas transmissões&nbsp;&nbsp; 
					<span id="icone_ajuda_usuario_conteudo_programacao_transmissao" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
				
				</label>
			</div>
			<div id="ajuda_usuario_conteudo_programacao_transmissao" style="display:none;padding-left:10px;">
				<h4>Clique no logo do sistema <b>Kepler</b>, localizado no menu superior, na porção esquerda,
				<br><br><br>
					<center>
						<img src="imagens/ajuda/menu_superior_home.png" style="width:900px;height:50px">
					</center>	
				<br><br><br>
				ou na opção <b>Home</b>, presente no rodapé da página.
				 <br><br><br>
				<center>
						<img src="imagens/ajuda/mapa_site_home.png" style="width:300px;height:186px">
					</center>	
				<br><br><br>
				Selecione o botão <b>Ver Programação Completa</b>, disposto no menu <b>Próximas Transmissões</b>, à esquerda na tela.
				 <br><br><br>
				<center>
						<img src="imagens/ajuda/proximas_transmissoes_index.PNG" style="width:300px;height:275px">
					</center>	
				<br><br><br>
				Dessa forma, poderá visualizar a programação das próximas transmissões.
				
				</h4>
			</div>
			<br>
			
			<!-- Agendamento-->
			<div id="ajuda_usuario_agendamento"  onClick="exibir_conteudo('ajuda_usuario_conteudo_agendamento')" style="width:750px">
				<label style="font-size:20px;padding-left:5px;cursor:pointer" onMouseOver="alterar_cor_div('ajuda_usuario_agendamento')"  onMouseOut="retornar_cor_original('ajuda_usuario_agendamento')">
			
					Como agendar data e horário para o controle dos movimentos do telescópio&nbsp;&nbsp; 
					<span id="icone_ajuda_usuario_conteudo_agendamento" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
				
				</label>
			</div>
			<div id="ajuda_usuario_conteudo_agendamento" style="display:none;padding-left:10px;">
				<h4>Após realizar o login, clique na opção <b>Agendar</b>, localizada no menu superior, na porção esquerda,
				<br><br><br>
					<center>
						<img src="imagens/ajuda/menu_superior_logado_agendamento.png" style="width:900px;height:50px">
					</center>	
					<br><br><br>
				ou na opção <b>Agendamento</b>, presente no rodapé da página.
				 <br><br><br>
				<center>
						<img src="imagens/ajuda/mapa_site_agendamento.png" style="width:300px;height:186px">
					</center>	
				<br><br><br>
				Escolha o tipo de corpo celeste que deseja observar e selecione o botão correspondente.
				 <br><br><br>
				<center>
						<img src="imagens/ajuda/agendamento_tipos_astro.PNG" style="width:270px;height:283px">
					</center>	
				<br><br><br>
				Escolha, entre as opções disponíveis, o corpo celeste que queira visualizar através do telescópio.
				 <br><br><br>
				<center>
						<img src="imagens/ajuda/agendamento_astros.png">
					</center>	
				<br><br><br>
				Em seguida, clique no botão <b>Agendar</b>.
				 <br><br><br>
				<center>
						<img src="imagens/ajuda/agendamento_btn_agendar.png" style="width:500px;height:334px">
					</center>	
				<br><br><br>
				Selecione, no calendário, a data dessa observação. 
				 <br><br><br>
				<center>
						<img src="imagens/ajuda/agendamento_calendario.png" style="width:300px;height:318px">
					</center>	
				<br><br><br>
				Após esse procedimento, escolha o período em que esse processo ocorrerá.
				 <br><br><br>
				<center>
						<img src="imagens/ajuda/agendamento_periodo.png">
					</center>
				<br><br><br>
				Para finalizar, selecione o horário.
				 <br><br><br>
				<center>
						<img src="imagens/ajuda/agendamento_horario.png" style="width:800px;height:414px">
					</center>	
				<br><br><br>
				Dessa maneira, o agendamento será realizado com sucesso.
				</h4>
			</div>
			<br>

			
		
		</div>
		<?php 
			
			if($_SESSION['tipo']==1)
			{
				
		?>
		
				<div id="ajuda_adm" style="color:black">
					<h2>Administrador<?php if($_SESSION['tipo']==1){ ?><a href="adm-pgs.php"><img src="imagens/config.png" style="float:right;" title="Configurar Páginas"></a><?php } ?></h2><hr class="est1">
					
					<!-- Publicar Anúncio-->
					
					<div id="ajuda_usuario_publicar_anuncio"  onClick="exibir_conteudo('ajuda_usuario_conteudo_publicar_anuncio')" style="width:300px">
						<label style="font-size:20px;padding-left:5px;cursor:pointer" onMouseOver="alterar_cor_div('ajuda_usuario_publicar_anuncio')"  onMouseOut="retornar_cor_original('ajuda_usuario_publicar_anuncio')">
			
							Como publicar um anúncio&nbsp;&nbsp; 
							<span id="icone_ajuda_usuario_conteudo_publicar_anuncio" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
						
						</label>
					</div>
					<div id="ajuda_usuario_conteudo_publicar_anuncio" style="display:none;padding-left:10px;">
					<h4>Clique no logo do sistema <b>Kepler</b>, localizado no menu superior, na porção esquerda, 
						<br><br><br>
							<center>
								<img src="imagens/ajuda/menu_superior_home.png" style="width:900px;height:50px">
							</center>	
						<br><br><br>
						ou na opção <b>Home</b>, presente no rodapé da página.
						<br><br><br>
							<center>
								<img src="imagens/ajuda/mapa_site_home.png" style="width:300px;height:186px">
							</center>	
						<br><br><br>
						Selecione o botão <b>Publicar</b>, disposto na área <b>Últimos Anúncios</b>.
						<br><br><br>
							<center>
								<img src="imagens/ajuda/btnPublicar_UltimosAnuncios.PNG" style="width:800px;height:72px">
							</center>	
						<br><br><br>
						Complete o formulário com o título e o texto do anúncio. 
						<br><br>
						Se desejar, é possível adicionar imagens. Para isso, selecione a opção <img src="imagens/icone-imagem.png" height="40px" title="Inserir Imagem" style="cursor:pointer;">.
						<br><br>
						Assim que finalizar, clique no botão <b>Publicar</b>.
						<br><br><br>
							<center>
								<img src="imagens/ajuda/form_publicar_anuncio.PNG" style="width:550px;height:403px">
							</center>	
						<br><br><br>
						
						Desse modo, o anúncio será publicado.
					</h4>
					</div>
					<br>
					
					<!-- Acessar Área Administrador-->
					<div id="ajuda_usuario_area_admin"  onClick="exibir_conteudo('ajuda_usuario_conteudo_area_admin')" style="width:410px">
						<label style="font-size:20px;padding-left:5px;cursor:pointer" onMouseOver="alterar_cor_div('ajuda_usuario_area_admin')"  onMouseOut="retornar_cor_original('ajuda_usuario_area_admin')">
			
							Como acessar a Área do Administrador&nbsp;&nbsp; 
							<span id="icone_ajuda_usuario_conteudo_area_admin" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
						
						</label>
					</div>
					<div id="ajuda_usuario_conteudo_area_admin" style="display:none;padding-left:10px;">
					<h4>Após realizar o login, clique na opção que contém seu nome de usuário, juntamente com a imagem de seu  
						<br><br>
						avatar, localizada no menu superior, na porção direita.
						<br><br><br>
							<center>
								<img src="imagens/ajuda/menu_superior_logado.PNG" style="width:900px;height:50px">
							</center>	
					<br><br><br>
						Será exibido um outro menu. Selecione a opção <b>Área do Administrador</b>.
						<br><br><br>
							<center>
								<img src="imagens/ajuda/menu_admin_area_admin.PNG" style="width:190px;height:369px">
							</center>	
						<br><br><br>
						Dessa maneira, poderá visualizar as funcionalidades disponíveis ao administrador.
					</h4>
					</div>
					<br>
				
				<!-- Como visualizar as Estatísticas de uso do Site-->
					<div id="ajuda_usuario_estatisticas"  onClick="exibir_conteudo('ajuda_usuario_conteudo_estatisticas')" style="width:500px">
						<label style="font-size:20px;padding-left:5px;cursor:pointer;" onMouseOver="alterar_cor_div('ajuda_usuario_estatisticas')"  onMouseOut="retornar_cor_original('ajuda_usuario_estatisticas')">
			
							Como visualizar as Estatísticas de Uso do Sistema&nbsp;&nbsp; 
							<span id="icone_ajuda_usuario_conteudo_estatisticas" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
						
						</label>
					</div>
					<div id="ajuda_usuario_conteudo_estatisticas" style="display:none;padding-left:10px;">
					<h4>Após realizar o login, acesse a <b>Área do Administrador</b>.
						<br><br>
						Clique na opção <b>Estatísticas</b>, localizado na seção <b>Geral</b>.
						<br><br>
						
						<br><br><br>
							<center>
								<img src="imagens/ajuda/area_admin_estatisticas.png" style="width:400px;height:166px">
							</center>	
					<br><br><br>
					
						Assim, poderá visualizar as Estatísticas de Uso do Sistema, identificadas em diferentes itens de acordo com 
						<br><br>
						o aspecto abordado.
						
						<br><br><br>
							<center>
								<img src="imagens/ajuda/area_admin_estatisticas_itens.png" style="width:400px;height:297px">
							</center>	
						<br><br><br>
		
							<center>
								<img src="imagens/ajuda/grafico_area_admin_estatisticas.png">
							</center>	
						<br><br><br>
					</h4>
					</div>
					<br>
					
			<!-- Como alterar as Configurações do Site-->
					<div id="ajuda_usuario_configuracoes"  onClick="exibir_conteudo('ajuda_usuario_conteudo_configuracoes')" style="width:460px">
						<label style="font-size:20px;padding-left:5px;cursor:pointer;" onMouseOver="alterar_cor_div('ajuda_usuario_configuracoes')"  onMouseOut="retornar_cor_original('ajuda_usuario_configuracoes')">
			
							Como alterar as Configurações do Sistema&nbsp;&nbsp; 
							<span id="icone_ajuda_usuario_conteudo_configuracoes" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
						
						</label>
					</div>
					<div id="ajuda_usuario_conteudo_configuracoes" style="display:none;padding-left:10px;">
					<h4>Após realizar o login, acesse a <b>Área do Administrador</b>.
						<br><br>
						Clique na opção <b>Configurações do Site</b>, localizado na seção <b>Geral</b>.
					
						<br><br><br>
							<center>
								<img src="imagens/ajuda/area_admin_config_site.PNG">
							</center>	
					<br><br><br>
					
						Será exibido um outro menu. Selecione a área que deseje alterar.
						<br><br>
					<!-- SUBMENU IMAGENS -->
						<div style="padding-left:25px;" id="ajuda_usuario_configuracoes_imagens"  onClick="exibir_conteudo('ajuda_usuario_conteudo_configuracoes_imagens')">
							<label style="cursor:pointer;" onMouseOver="alterar_cor_div('ajuda_usuario_configuracoes_imagens')"  onMouseOut="retornar_cor_original('ajuda_usuario_configuracoes_imagens')" >
								Imagens&nbsp;&nbsp; 
								<span id="icone_ajuda_usuario_conteudo_configuracoes_imagens" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
							</label>
						</div>
						<div id="ajuda_usuario_conteudo_configuracoes_imagens" style="padding-left:50px;display:none;">
							<br>
							Caso escolha a opção <b>Imagens</b>, poderá visualizar os dados das imagens utilizadas no sistema.
							
							<br><br><br>
								<center>
									<img src="imagens/ajuda/area_admin_config_imagem_imagens.PNG" style="width:700px;height:451px">
								</center>	
							<br><br><br>
						</div>
					<br>
						<!-- SUBMENU PAGINAS-->
						
						<div style="padding-left:25px;" id="ajuda_usuario_configuracoes_paginas"  onClick="exibir_conteudo('ajuda_usuario_conteudo_configuracoes_paginas')">
							<label style="cursor:pointer;" onMouseOver="alterar_cor_div('ajuda_usuario_configuracoes_paginas')"  onMouseOut="retornar_cor_original('ajuda_usuario_configuracoes_paginas')" >
								Páginas&nbsp;&nbsp; 
								<span id="icone_ajuda_usuario_conteudo_configuracoes_paginas" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
							</label>
						</div>
						
						<div id="ajuda_usuario_conteudo_configuracoes_paginas" style="padding-left:50px;display:none;">
							<br>
							Caso escolha a opção <b>Páginas</b>, poderá visualizar as principais páginas do sistema e configurar sua 
							<br><br>
							privacidade, tornando-as públicas ou privadas.
							<br><br><br>
								<center>
									<img src="imagens/ajuda/area_admin_config_paginas.PNG" style="width:700px;height:284px">
								</center>	
							<br><br><br>
						</div>
					<br>
						
						<!-- SUBMENU SLIDES -->
						
						<div style="padding-left:25px;" id="ajuda_usuario_configuracoes_slides"  onClick="exibir_conteudo('ajuda_usuario_conteudo_configuracoes_slides')">
							<label style="cursor:pointer;" onMouseOver="alterar_cor_div('ajuda_usuario_configuracoes_slides')"  onMouseOut="retornar_cor_original('ajuda_usuario_configuracoes_slides')" >
								Slides&nbsp;&nbsp; 
								<span id="icone_ajuda_usuario_conteudo_configuracoes_slides" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
							</label>
						</div>
						
						<div id="ajuda_usuario_conteudo_configuracoes_slides" style="padding-left:50px;display:none;">
							<br>
							Caso escolha a opção <b>Slides</b>, poderá gerenciar os slides disponibilizados na página principal.
							<br><br>
							<br>
									<center>
										<img src="imagens/ajuda/area_admin_config_slides.png">
									</center>	
								<br><br><br>
						</div>
					</h4>
					</div>
					<br>
			
			
					<!-- Como Gerenciar a Conta dos Usuários-->
			
					<div id="ajuda_usuario_gerenciar_usuarios"  onClick="exibir_conteudo('ajuda_usuario_conteudo_gerenciar_usuarios')" style="width:700px">
						<label style="font-size:20px;padding-left:5px;cursor:pointer;" onMouseOver="alterar_cor_div('ajuda_usuario_gerenciar_usuarios')"  onMouseOut="retornar_cor_original('ajuda_usuario_gerenciar_usuarios')">
			
							Como acessar a página de gerenciamento da Conta dos Usuários&nbsp;&nbsp; 
							<span id="icone_ajuda_usuario_conteudo_gerenciar_usuarios" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
						
						</label>
					</div>
					<div id="ajuda_usuario_conteudo_gerenciar_usuarios" style="display:none;padding-left:10px;">
					<h4>Após realizar o login, acesse a <b>Área do Administrador</b>.
						<br><br>
						Clique na opção <b>Usuários</b>, localizado na seção <b>Gerenciar Contas</b>.
						<br><br>
			
					
						<br><br>
							<center>
								<img src="imagens/ajuda/area_admin_gerenciar_contas_usuarios.PNG" style="width:500px;height:95px">
							</center>		
						<br><br>
					
		
						Assim, poderá utilizar as funcionalidades disponibilizadas para o gerenciamento das contas dos Usuários.
					
						
						<br><br><br>
							<center>
								<img src="imagens/ajuda/area_admin_usuarios.PNG" style="width:800px;height:326px">
							</center>	
						<br><br><br>
					
		
					</h4>
					</div>
					<br>
			
					
				<!-- Como Gerenciar a Conta dos Administradores-->
			
					<div id="ajuda_usuario_gerenciar_administradores"  onClick="exibir_conteudo('ajuda_usuario_conteudo_gerenciar_administradores')" style="width:750px">
						<label style="font-size:20px;padding-left:5px;cursor:pointer;" onMouseOver="alterar_cor_div('ajuda_usuario_gerenciar_administradores')"  onMouseOut="retornar_cor_original('ajuda_usuario_gerenciar_administradores')">
			
							Como acessar a página de gerenciamento da Conta dos Administradores&nbsp;&nbsp; 
							<span id="icone_ajuda_usuario_conteudo_gerenciar_administradores" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
						
						</label>
					</div>
					<div id="ajuda_usuario_conteudo_gerenciar_administradores" style="display:none;padding-left:10px;">
					<h4>Após realizar o login, acesse a <b>Área do Administrador</b>.
						<br><br>
						Clique na opção <b>Administradores</b>, localizado na seção <b>Gerenciar Contas</b>.
						<br>
				
						<br><br>
							<center>
								<img src="imagens/ajuda/area_admin_gerenciar_contas_administradores.png" style="width:500px;height:95px">
							</center>		
						<br><br><br>
					
			
						Assim, poderá utilizar as funcionalidades disponibilizadas para o gerenciamento das contas dos Administradores.
						<br><br>
				
						<br>
							<center>
								<img src="imagens/ajuda/area_admin_administradores.PNG" style="width:800px;height:325px">
							</center>	
						<br><br><br>
				
					</h4>
					</div>
					<br>
				
					<!-- Como Gerenciar a Conta das Instituições de Ensino-->
				
					<div id="ajuda_usuario_gerenciar_instituicoes"  onClick="exibir_conteudo('ajuda_usuario_conteudo_gerenciar_instituicoes')" style="width:750px">
						<label style="font-size:20px;padding-left:5px;cursor:pointer;" onMouseOver="alterar_cor_div('ajuda_usuario_gerenciar_instituicoes')"  onMouseOut="retornar_cor_original('ajuda_usuario_gerenciar_instituicoes')">
			
							Como acessar a página de gerenciamento da Conta de Instituições de Ensino&nbsp;&nbsp; 
							<span id="icone_ajuda_usuario_conteudo_gerenciar_instituicoes" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
						
						</label>
					</div>
					<div id="ajuda_usuario_conteudo_gerenciar_instituicoes" style="display:none;padding-left:10px;">
					<h4>Após realizar o login, acesse a <b>Área do Administrador</b>.
						<br><br>
						Clique na opção <b>Instituições</b>, localizado na seção <b>Gerenciar Contas</b>.
						
						<br><br><br>
							<center>
								<img src="imagens/ajuda/area_admin_gerenciar_instituicoes.png" style="width:500px;height:95px">
							</center>	
					<br><br><br>
					
					
						Assim, poderá utilizar as funcionalidades disponibilizadas para o gerenciamento das Instituições de Ensino.
						
						<br><br><br>
							<center>
								<img src="imagens/ajuda/area_admin_instituicoes.PNG" style="width:800px;height:374px">
							</center>	
						<br><br><br>
					
					</h4>
					</div>
					<br>
			
			
			<!-- Como Gerenciar os Anúncios-->
			
			
					<div id="ajuda_usuario_gerenciar_anuncios"  onClick="exibir_conteudo('ajuda_usuario_conteudo_gerenciar_anuncios')" style="width:700px">
						<label style="font-size:20px;padding-left:5px;cursor:pointer;" onMouseOver="alterar_cor_div('ajuda_usuario_gerenciar_anuncios')"  onMouseOut="retornar_cor_original('ajuda_usuario_gerenciar_anuncios')">
			
							Como acessar a página de gerenciamento dos Anúncios&nbsp;&nbsp; 
							<span id="icone_ajuda_usuario_conteudo_gerenciar_anuncios" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
						
						</label>
					</div>
					<div id="ajuda_usuario_conteudo_gerenciar_anuncios" style="display:none;padding-left:10px;">
					<h4>Após realizar o login, acesse a <b>Área do Administrador</b>.
						<br><br>
						Clique na opção <b>Anúncios</b>, localizado na seção <b>Ferramentas do Admin</b>.
						<br><br>
			
						<br>
							<center>
								<img src="imagens/ajuda/area_admin_gerenciar_anuncios.PNG" style="width:303px;height:95px">
							</center>	
					<br><br><br>
					
			
						Assim, poderá utilizar as funcionalidades disponibilizadas para o gerenciamento dos Anúncios.
						
						<br><br><br>
							<center>
								<img src="imagens/ajuda/area_admin_anuncios.PNG" style="width:800px;height:320px">
							</center>	
						<br><br><br>
					
					</h4>
					</div>
					<br>
			
					
			<!-- Como Gerenciar as Denúncias-->
			
					<div id="ajuda_usuario_gerenciar_denuncias"  onClick="exibir_conteudo('ajuda_usuario_conteudo_gerenciar_denuncias')" style="width:700px">
						<label style="font-size:20px;padding-left:5px;cursor:pointer;" onMouseOver="alterar_cor_div('ajuda_usuario_gerenciar_denuncias')"  onMouseOut="retornar_cor_original('ajuda_usuario_gerenciar_denuncias')">
			
							Como acessar a página de gerenciamento das Denúncias&nbsp;&nbsp; 
							<span id="icone_ajuda_usuario_conteudo_gerenciar_denuncias" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
						
						</label>
					</div>
					<div id="ajuda_usuario_conteudo_gerenciar_denuncias" style="display:none;padding-left:10px;">
					<h4>Após realizar o login, acesse a <b>Área do Administrador</b>.
						<br><br>
						Clique na opção <b>Denúncias</b>, localizado na seção <b>Ferramentas do Admin</b>.
						
						<br><br><br>
							<center>
								<img src="imagens/ajuda/area_admin_gerenciar_denuncias.png" style="width:303px;height:95px">						
							</center>	
						<br><br><br>
						Assim, poderá utilizar as funcionalidades disponibilizadas para o gerenciamento das Denúncias.
						
						<br><br><br>
							<center>
								<img src="imagens/ajuda/area_admin_denuncias.PNG" style="width:800px;height:161px">
							</center>	
						<br><br><br>
					
					</h4>
					</div>
					<br>
			
						<!-- Como Gerenciar os Vídeos Salvos-->
				
					<div id="ajuda_usuario_gerenciar_videos_salvos"  onClick="exibir_conteudo('ajuda_usuario_conteudo_gerenciar_videos_salvos')" style="width:700px">
						<label style="font-size:20px;padding-left:5px;cursor:pointer;" onMouseOver="alterar_cor_div('ajuda_usuario_gerenciar_videos_salvos')"  onMouseOut="retornar_cor_original('ajuda_usuario_gerenciar_videos_salvos')">
			
							Como acessar a página de gerenciamento dos Vídeos Salvos&nbsp;&nbsp; 
							<span id="icone_ajuda_usuario_conteudo_gerenciar_videos_salvos" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
						
						</label>
					</div>
					<div id="ajuda_usuario_conteudo_gerenciar_videos_salvos" style="display:none;padding-left:10px;">
					<h4>Após realizar o login, acesse a <b>Área do Administrador</b>.
						<br><br>
						Clique na opção <b>Vídeos Salvos</b>, localizado na seção <b>Vídeos</b>.
						
						<br><br><br>
							<center>
								<img src="imagens/ajuda/area_admin_gerenciar_videos_salvos.PNG" style="width:424px;height:95px">
							</center>	
					<br><br><br>
				
						Assim, poderá utilizar as funcionalidades disponibilizadas para o gerenciamento dos Vídeos Salvos.
						
						<br><br><br>
							<center>
								<img src="imagens/ajuda/area_admin_videos_salvos.PNG" style="width:800px;height:320px">
							</center>	
						<br><br><br>
					</h4>
					</div>
					<br>
			
				
				<!-- Como Alterar as Configurações do Streaming-->

					<div id="ajuda_usuario_alterar_streaming"  onClick="exibir_conteudo('ajuda_usuario_conteudo_alterar_streaming')" style="width:700px">
						<label style="font-size:20px;padding-left:5px;cursor:pointer;" onMouseOver="alterar_cor_div('ajuda_usuario_alterar_streaming')"  onMouseOut="retornar_cor_original('ajuda_usuario_alterar_streaming')">
			
							Como acessar a página de alteração das Configurações do Streaming&nbsp;&nbsp; 
							<span id="icone_ajuda_usuario_conteudo_alterar_streaming" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
						
						</label>
					</div>
					<div id="ajuda_usuario_conteudo_alterar_streaming" style="display:none;padding-left:10px;">
					<h4>Após realizar o login, acesse a <b>Área do Administrador</b>.
						<br><br>
						Clique na opção <b>Configurar Streaming</b>, localizado na seção <b>Vídeos</b>.
						<br><br><br>
							<center>
								<img src="imagens/ajuda/area_admin_configurar_streaming.png" style="width:424px;height:95px">
							</center>	
					<br><br><br>
				
						Assim, poderá alterar as Configurações do Streaming.
						
						<br><br><br>
							<center>
								<img src="imagens/ajuda/area_admin_config_streaming.PNG" style="width:450px;height:515px">
							</center>	
						<br><br><br>
				
					</h4>
					</div>
					<br>
					
					<!-- Como Alterar as Configurações dos Astros-->

					<div id="ajuda_usuario_alterar_astros"  onClick="exibir_conteudo('ajuda_usuario_conteudo_alterar_astros')" style="width:700px">
						<label style="font-size:20px;padding-left:5px;cursor:pointer;" onMouseOver="alterar_cor_div('ajuda_usuario_alterar_astros')"  onMouseOut="retornar_cor_original('ajuda_usuario_alterar_astros')">
			
							Como acessar as páginas de gerenciamento dos Astros&nbsp;&nbsp; 
							<span id="icone_ajuda_usuario_conteudo_alterar_astros" class="glyphicon glyphicon-chevron-down" style="font-size:10px"></span>
						
						</label>
					</div>
					<div id="ajuda_usuario_conteudo_alterar_astros" style="display:none;padding-left:10px;">
					<h4>Após realizar o login, acesse a <b>Área do Administrador</b>.
						<br><br>
						Escolha dentre as opções <b>Estrelas</b>, <b>Planetas</b>, <b>Satélites</b>, <b>Cometas</b> e <b>Asteróides</b>, localizadas na seção <b>Astros</b>.
						<br><br><br>
							<center>
								<img src="imagens/ajuda/area_admin_gerenciar_astros.PNG" style="width:826px;height:95px">
							</center>	
					<br><br><br>
				
						Assim, poderá utilizar as funcionalidades disponibilizadas para o gerenciamento dos respectivos tipos de Astros.
					
					</h4>
					</div>
					<br>
	
				</div>	
				</div>
			
		<?php 
			}
		?>
		
			
		</div>
	</div>
		
	
	<?php  }?>
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