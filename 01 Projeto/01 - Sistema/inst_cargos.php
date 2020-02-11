<?php
session_start(); 
include "conecta.php";

		$id_inst = $_GET['i'];
		
		$consulta_inst = $db->prepare('SELECT * FROM instituicao WHERE id_inst = ? AND excluido = \'n\'');
		$consulta_inst->bindParam(1,$id_inst, PDO::PARAM_STR);
		$consulta_inst->execute();
		$num_linhas_inst = $consulta_inst->rowCount();
		
		$consulta_relacao = $db->prepare('SELECT * FROM relacao WHERE id_inst = ? AND login = ?');
		$consulta_relacao->bindParam(1,$id_inst, PDO::PARAM_STR);
		$consulta_relacao->bindParam(2,$_SESSION['login'], PDO::PARAM_STR);
		$consulta_relacao->execute();
		$num_linhas_relacao = $consulta_relacao->rowCount();
		$linha_relacao = $consulta_relacao->fetch(PDO::FETCH_ASSOC);
		
		$linha_inst = $consulta_inst->fetch(PDO::FETCH_ASSOC);
?> <html>
<head>
	<link href="css/estilo23.css" rel="stylesheet" type="text/css">
	<link href="estilo23.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	
	<link rel="icon" href="imagens/logomarca.png">
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<title><?php if($num_linhas_inst < 1){ echo "Kepler"; } else{ echo "Editar ".$linha_inst['nome_inst']." - Kepler"; } ?></title>	
</head>

<body style="font-family: 'Raleway', sans-serif;">
	<script type="text/javascript">
	
	function definir_usuario_selecionado(login)
	{
		
	}
	
	 function mensagem_confirmacao()
	 {
		 var acao=document.getElementById('acao_instituicao').value;
		 var mensagem="";var botao="";
		 
		 if(acao=="tornar_comum")
		 {
			 mensagem="tornar o(s) usuário(s) selecionado(s) membro(s) comum(ns)";
			 botao="Alterar";
		 }
		 else if(acao=="tornar_mod")
		 {
			 mensagem="tornar o(s) usuário(s) selecionado(s) moderador(es)";
			  botao="Alterar";
		 }
		 else if(acao=="tornar_adm")
		 {
			  mensagem="tornar o(s) usuário(s) selecionado(s) administrador(es)";
			   botao="Alterar";
		 }
		 else if(acao=="kick")
		 {
			 mensagem="kickar o(s) usuário(s) selecionado(s)";
			  botao="Kickar";
		 }
		 else
		 {
			swal({
				  title: "",
				  text: "\u00c9 necess\u00e1rio selecionar a a\u00e7\u00e3o.",
				  type: "warning",
				  showCancelButton: false,
				  confirmButtonClass: "btn-danger",
				  confirmButtonText: "OK",
				  closeOnConfirm: true
				},
				function(){
				console.log("ERRO!");
				});
				 return;
			
		 }
			 
			swal({
			  title: "",
			  text: "Você deseja realmente "+mensagem+"  ?",
			  type: "warning",
			  showCancelButton: true,
			   confirmButtonClass: "btn-danger",
			  confirmButtonText: botao,
			  cancelButtonText: "Cancelar",
			  closeOnConfirm: true,
			  closeOnCancel: true
			},
			function(isConfirm) {
			  if (isConfirm) {
				document.getElementById('inst_cargos').submit();
			  } else {
				console.log("CANCELOU");
			  }
			});
			
	 }
	 
	 function definir_acao(acao)
	 {
		 document.getElementById('acao_instituicao').value=acao;
	 }
	</script>
	
	<?php include "cabecalho.php";
	
	if($num_linhas_inst < 1){ include "404.php"; }
		else if($num_linhas_relacao < 1 || $linha_relacao['tipo'] != 1){ ?><div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;"><div id="cont-centro" style="margin-left:0px">Você não faz parte desta instituição ou não possui permissões para visualizar esta página.</div><?php }
		else{
		?>
		
		<?php			
		//Selecionar membros comuns.
		$consulta_membros  = $db->prepare("SELECT * FROM relacao,usuario WHERE relacao.id_inst = ? AND relacao.login = usuario.login AND relacao.tipo = 0 ORDER BY relacao.login;");
		$consulta_membros->bindParam(1,$linha_inst['id_inst'], PDO::PARAM_STR);
		$consulta_membros->execute();
		$num_linhas_membros = $consulta_membros->rowCount();
		
		//Selecionar membros administradores.
		$consulta_membros_adm  = $db->prepare("SELECT * FROM relacao,usuario WHERE relacao.id_inst = ? AND relacao.login = usuario.login AND relacao.tipo = 1 ORDER BY relacao.login;");
		$consulta_membros_adm->bindParam(1,$linha_inst['id_inst'], PDO::PARAM_STR);
		$consulta_membros_adm->execute();
		$num_linhas_membros_adm = $consulta_membros_adm->rowCount();
			
		//Selecionar membros moderadores.
		$consulta_membros_mod  = $db->prepare("SELECT * FROM relacao,usuario WHERE relacao.id_inst = ? AND relacao.login = usuario.login AND relacao.tipo = 2;");
		$consulta_membros_mod->bindParam(1,$linha_inst['id_inst'], PDO::PARAM_STR);
		$consulta_membros_mod->execute();
		$num_linhas_membros_mod = $consulta_membros_mod->rowCount();
		?>
		
		<!--Menu da Esquerda - INICIO -->
		<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;">
	<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
		<h2>Gerenciar Cargos</h2>
		<a href="inst_edit.php?i=<?php echo $linha_inst['id_inst']; ?>" style="float:left;">Editar Instituição</a>
		
		<form method="post" action="inst_cargos_enviar.php" id="inst_cargos">
		<div style="margin-top:10px;padding:10px;border:1px solid #dbdbdb;border-radius:2px;float:left;width:100%;">
				<h4 style="margin-top:0px;"><b>Membros</b>
				<a href="inst_membros.php?i=<?php echo $linha_inst['id_inst']; ?>" style="float:right;font-size:14px">Ver Todos <?php echo "(".($num_linhas_membros+$num_linhas_membros_adm).")"; ?></a></h4>
				<?php
				if($num_linhas_membros > 0 || $num_linhas_membros_adm > 0){
					if($num_linhas_membros_adm > 0){
						echo '<span style="font-size:13px;font-weight:bold;">Administradores</span><br>';
						while($linha_membros_adm = $consulta_membros_adm->fetch(PDO::FETCH_OBJ)){ ?>
							<label style="font-weight:normal;margin-right:15px;color:red;"><input type="checkbox" name="membros[]" value="<?php echo $linha_membros_adm->login; ?>" <?php if($linha_membros_adm->login == $_SESSION['login']){ echo "disabled"; } else { echo "onClick='definir_usuario_selecionado(".$linha_membros_adm->login.")'";} ?> ><span style="margin-left:2px;"><?php echo $linha_membros_adm->login; ?></span></label>
						<?php }
					}
					
					if($num_linhas_membros_mod > 0){
						echo '<br><span style="font-size:13px;font-weight:bold;">Moderadores</span><br>';
						while($linha_membros_mod = $consulta_membros_mod->fetch(PDO::FETCH_OBJ)){ ?>
							<label style="font-weight:normal;margin-right:15px;"><input type="checkbox" name="membros[]" value="<?php echo $linha_membros_mod->login; ?>" <?php if($linha_membros_mod->login == $_SESSION['login']){ echo "disabled"; } else { echo "onClick='definir_usuario_selecionado(".$linha_membros_adm->login.")'";} ?>><span style="margin-left:2px;"><?php echo $linha_membros_mod->login; ?></span></label>
						<?php }
					}
					
					if($num_linhas_membros > 0){
						echo '<br><span style="font-size:13px;font-weight:bold;">Usuários<span><br>';
						while($linha_membros = $consulta_membros->fetch(PDO::FETCH_OBJ)){ ?>
							<label style="font-weight:normal;margin-right:15px;"><input type="checkbox" name="membros[]" value="<?php echo $linha_membros->login; ?>" onClick="definir_usuario_selecionado(<?php echo $linha_membros_adm->login ?>)" ><span style="margin-left:2px;"><?php echo $linha_membros->login; ?></span></label>
							<?php
						}
					}
				}
					
				else{
					echo "Esta instituição não possui membros. Talvez ela tenha sido abandonada. :(";
				} ?>

				<hr class="est1">
				<span style="font-size:13px;font-weight:bold;">Ação</span><br>
				<label style="font-weight:normal;margin-right:15px;"><input type="radio" name="acao_cargo" value="tornar_comum" onClick="definir_acao('tornar_comum')"><span style="margin-left:2px;">Tornar Comum(s)</span></label>
				<label style="font-weight:normal;margin-right:15px;"><input type="radio" name="acao_cargo" value="tornar_mod" onClick="definir_acao('tornar_mod')"><span style="margin-left:2px;">Tornar Moderador(es)</span></label>
				<label style="font-weight:normal;margin-right:15px;"><input type="radio" name="acao_cargo" value="tornar_adm" onClick="definir_acao('tornar_adm')"><span style="margin-left:2px;">Tornar Admin(s)</span></label>
				<label style="font-weight:normal;margin-right:15px;"><input type="radio" name="acao_cargo" value="kick" onClick="definir_acao('kick')"><span style="margin-left:2px;">Kickar</span></label>
		</div>
		
		<div style="float:left;margin-top:10px">
			<a href="instituicao.php?i=<?php echo $linha_inst['id_inst']; ?>"><input type="button" value="Cancelar"></a>
			<input type="button" onClick="mensagem_confirmacao()" value="Salvar Alterações">
		</div>
		
		<input type="hidden" name="id_inst" value="<?php echo $linha_inst['id_inst']; ?>">
		<input type="hidden" name="acao_instituicao" id="acao_instituicao" value="">
		</form>
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
	</div>
		
		<?php 
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
</body>
</html>