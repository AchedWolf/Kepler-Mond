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

<body style="font-family: 'Raleway', sans-serif;">
	<?php include "cabecalho.php"; ?>
	
		<?php
		include "conecta.php";
		$user = $_GET['userp'];
		$userpdo = strtolower($user);
		
		$consulta_u = $db->prepare('SELECT * FROM usuario WHERE login = ? AND excluido = \'n\'');
		$consulta_u->bindParam(1, $userpdo, PDO::PARAM_STR);
		$consulta_u->execute();
		
		$num_linhas_u = $consulta_u->rowCount();
		
		if($num_linhas_u < 1)
		{ 
			include "404.php";
		}
		else
		{
			$linha_usuario = $consulta_u->fetch(PDO::FETCH_ASSOC); ?>
	
		<!--Menu da Esquerda - INICIO -->
		<div id="mae" style="width:1010px;max-width:1010px;background-color:red;margin: 0 auto;">
		<div id="cont-esquerda" style="margin-left:0px;"style="margin-left:0px;">
			<h4>Visualizando instituições de:</h4>
			<div id="item-esquerda-comp" style="padding-bottom:12px;padding-top:-10px;overflow:hidden;">
				<div style="width:100%;float:left;height:55px;overflow:hidden;">
					<a href="perfil.php?userp=<?php echo $linha_usuario['login']; ?>">						
						<div style="background-image: url('<?php echo $linha_usuario['avatar']; ?>');background-size:55px;background-repeat: no-repeat;
						background-position:center;background-color:black;height:55px;width:55px;float:left;margin-right:5px;border:1px solid #bdbdbd;
						border-radius:7px;"></div>
					</a>
						
						<?php 
						if($linha_usuario['tipo']!=0){ ?>
						<div id="usuario-pgperfil" style="font-size:20px;margin-top:2px;float:left;">
							<?php if ($linha_usuario['tipo'] == 5){ ?><font style="border-radius:3px;color:white;background-color:#11aa2a;padding:3px;font-size:11px;font-weight:bold;cursor:pointer" title="Moderador do Banco">Moderador do Banco</font><?php } ?>
							<?php if ($linha_usuario['tipo'] == 4){ ?><font style="border-radius:3px;color:white;background-color:#f2b50e;padding:3px;font-size:11px;font-weight:bold;cursor:pointer" title="Moderador de Instituições">Moderador de Instituições</font><?php } ?>
							<?php if ($linha_usuario['tipo'] == 3){ ?><font style="border-radius:3px;color:white;background-color:#9023c6;padding:3px;font-size:11px;font-weight:bold;cursor:pointer" title="Moderador da Streaming">Moderador da Streaming</font><?php } ?>
							<?php if ($linha_usuario['tipo'] == 2){ ?><font style="border-radius:3px;color:white;background-color:#000000;padding:3px;font-size:11px;font-weight:bold;cursor:pointer" title="Programador">Programador</font><?php } ?>
							<?php if ($linha_usuario['tipo'] == 1){ ?><font style="border-radius:3px;color:white;background-color:#e80202;padding:3px;font-size:11px;font-weight:bold;cursor:pointer" title="Administrador">Administrador</font><?php } ?>
						</div><br>
						<?php } ?>
						
						
						<a href="perfil.php?userp=<?php echo $linha_usuario['login']; ?>">	
							<font style="font-size:14px;overflow:hidden;"><?php echo $linha_usuario['nome']." ".$linha_usuario['sobrenome']; ?></font>
						</a><br>
					<font size="2px" style="overflow:hidden;"><?php echo "@".$linha_usuario['login']; ?></font>
				</div>
				
				<?php if($linha_usuario['link_user'] != null){ ?>
				<div style="width:100%;float:left;height:35px;border-style:solid none none none;border-width:1px;border-color:#bdbdbd;margin-top:5px;margin-bottom:2px;">
					<a href="<?php echo $linha_usuario['link_user']; ?>"><div id="rod-social" style="background-image: url('imagens/link.png');margin-top:5px;" title="Website"></div></a>
				</div>
				<?php } ?>
			</div>
		<?php if($_SESSION['logado']==1&&$_SESSION['login']==$linha_usuario['login']){ ?>
			<a href="frm_cadastro_instituicao.php" class="btn btn-primary btn3d" style="color:white;margin-left:5%;">Cadastrar Instituição de Ensino</a>
		<?php }?>
		</div>
		<!--Menu da Esquerda - FIM -->
		
		<?php
			
			$consulta_i = $db->prepare("SELECT * FROM relacao,instituicao WHERE relacao.login = ? AND relacao.id_inst = instituicao.id_inst AND instituicao.excluido = 'n';");
			$consulta_i->bindParam(1, $userpdo, PDO::PARAM_STR);
			$consulta_i->execute();
			
			$num_linhas_i = $consulta_i->rowCount(); //pra fazer o foreach.
			
			if($num_linhas_i < 1){
				 ?>
				<div id="cont-direita" style="border: 1px solid #D8D8D8;border-radius:8px;padding:20px;">
					<h2 style="margin-top:0px">Instituições (<?php echo $num_linhas_i; ?>)</h2>
					Este usuário não participa de nenhuma instituição.			
				</div>
				 <?php
			}
			 
			else{
				//$linha_inst = $consulta_i->fetch(PDO::FETCH_ASSOC);
				//$result_i = $consulta_i -> fetchAll();
			?>
				<div id="cont-direita" style="border: 1px solid #D8D8D8;border-radius: 8px;border-radius:8px;padding:20px;">
					<h2 style="margin-top:0px">Instituições (<?php echo $num_linhas_i; ?>)</h2>
					<?php
					while($linha_inst = $consulta_i->fetch(PDO::FETCH_OBJ)){
						?>
						<div id="inst-cartao" style="border: 1px solid #D8D8D8;height:98px;width:310px;text-align:left;float:left;padding:10px;margin:7px;overflow:hidden;text-overflow: ellipsis;">
							
							<a href="instituicao.php?i=<?php echo $linha_inst->id_inst; ?>" title="<?php echo $linha_inst->nome_inst; ?>">
							<div style="background-image: url('<?php echo $linha_inst->avatar_inst; ?>');background-size:75px;background-repeat: no-repeat;
							background-position: center;background-color:transparent;width:75px;height:75px;float:left;margin-right:10px;"></div>
							</a>
							
							<a href="instituicao.php?i=<?php echo $linha_inst->id_inst; ?>">
								<font size="3px" style="font-weight:bold;display:inline;"><?php echo $linha_inst->nome_inst; ?></font>
							</a>
							<?php if($linha_inst->login == $_SESSION['login']){ ?><a onclick="confirmaSaida('<?php echo $linha_inst->login; ?>',<?php echo $linha_inst->id_inst; ?>);" style="float:right;top:0;cursor: pointer;"><font size="2px">Sair</font></a><?php } ?> <br>
							<font size="2px"><?php echo $linha_inst->sobre_inst; ?></font>
						</div> <?php
					}
					?>	
				</div>
		<?php }
		} ?>
	<!-- Script sweet alert - INICIO -->
	<script>
							function confirmaSaida(login,inst){
								swal({
								  title: "Você tem certeza que deseja sair da instituição?",
								  type: "warning",
								  showCancelButton: true,
								  confirmButtonColor: '#00aa66',
								  cancelButtonColor: '#dd3300',
								  confirmButtonText: 'Sim',
								  cancelButtonText: 'Não',
								  confirmButtonClass: 'btn btn-success',
								  cancelButtonClass: 'btn btn-cancel',
								  buttonsStyling: false
								},
								function(){
									window.location.assign("inst_sair.php?login="+login+"&id_inst="+inst);
								  //swal("Deleted!", "Your imaginary file has been deleted.", "success");
								});
							}
	</script>
	<!-- Script sweet alert - FIM -->
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