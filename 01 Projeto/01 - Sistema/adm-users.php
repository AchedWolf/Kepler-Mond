<?php header('Content-Type: text/html; charset=UTF-8');session_start(); ?> <html>
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
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  	<link rel="stylesheet" href="/resources/demos/style.css">
  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<script>
	
	
 	 $( function() {
   	 $("#datepicker").datepicker({
						dateFormat: 'dd/mm/yy',
						changeMonth: true,
						changeYear: true,
						yearRange: "-500:+0"
					
						});
	 $("#datepicker").mask("99/99/9999");
  		} );
	</script>
	
	<link rel="icon" href="imagens/logomarca.png">
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<title>Kepler</title>
</head>

<body style="font-family: 'Raleway', sans-serif;">
	<?php include "cabecalho.php"; ?>
		
		<!--Menu da Esquerda - INICIO -->
		<div id="mae" style="width:1010px;max-width:1010px;background-color:red;margin: 0 auto;">
		<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
		<?php if($_SESSION['tipo'] == 1){ ?>
			<a href="adm.php" title="Voltar ao Menu"><div id="icon-img" style="background-image: url('imagens/voltar.png');height:30px;margin-right:7px;float:left;margin-top:20px;"></div></a>
			<h2>Área do Administrador</h2><hr class="est1">
			
			<h4 style="height:25px;"><b>Usuários</b></h4>
			
			<?php
			
			include "conecta.php";
			
			$limite = 10;

			# Se pg não existe atribui 1 a variável pg
			$pg = (isset($_GET['pg'])) ? (int)$_GET['pg'] : 1;

			# Atribui a variável inicio o inicio de onde os registros vão ser
			# mostrados por página, exemplo 0 à 10, 11 à 20 e assim por diante
			$inicio = ($pg * $limite) - $limite;

			
			$login=$_POST['login'];
			if(empty($login))
			{
			$login=$_GET['login'];	
			}
			
			
			$nome=$_POST['nome'];
			$sobrenome=$_POST['sobrenome'];
			$cpf=$_POST['cpf'];
			$email=$_POST['email'];
			$cidade=$_POST['cidade'];
			$estado=$_POST['estado'];
			$data=$_POST['data'];
			$status=$_POST['status'];
			
			$tipo=$_POST['tipo'];
			
			if($tipo!=1 and $tipo!=2)
			{
				$tipo=$_GET['tipo'];
			}
			
			$sql="SELECT * FROM usuario";
			
			
			$sql=$sql." WHERE login like '%".$login."%' AND  nome like '%".$nome."%' AND  sobrenome like '%".$sobrenome."%'";
			if(!empty($cpf))
			{
			$sql=$sql."  AND  data_nasc='".$cpf."'";
			
			}
			if(!empty($data))
			{
			$sql=$sql."  AND  data_nasc='".$data."'";
			
			}
			$sql=$sql." AND  email like '%".$email."%'";
			if(!empty($cidade))
			{
			$sql=$sql."  AND  estado='".$cidade."'";
			
			}
			if(!empty($estado))
			{
			$sql=$sql."  AND  estado='".$estado."'";
			
			}
			
			if(!empty($status))
			{
			$sql=$sql."  AND  excluido='".$status."'";
			
			}
			if($tipo==1)
			{
				
			$sql=$sql."  AND  tipo=".$tipo."";
			
			}
			else if($tipo==2)
			{
				
				$sql=$sql."  AND  tipo=0";
			}
			
			
			$sqle=$sql." ORDER BY login LIMIT ".$limite. "  OFFSET ". $inicio;
						
			$consulta_usuario = $db->prepare($sqle);
			$consulta_usuario->execute();
			
			$num_linhas_usuario = $consulta_usuario->rowCount();
			
			if($num_linhas_usuario < 1)
			{ ?>
				Este usuário não existe. :(
			<?php }
			else
			{ ?>
			
			<div id="adm-pesq" style="float:left;border:1px solid #BDBDBD;border-radius:8px;padding:10px;margin-bottom:10px;width:960px">
				<form action="adm-users.php" method="post" accept-charset="UTF-8">
				
				<input type="image" src="imagens/search.png" style="height:55px;width:55px;margin-left:7px;float:right;">
				<h4 style="margin-top:0px;font-weight:bold;">Pesquisar</h4>
				<!-- NOME DA TABELA -->
				<input name="tabela" type="hidden" value="usuario">
				
				<input name="login" type="text" style="margin-right:10px;height:32px;" placeholder="Nome de Usuário">
				
				<input name="nome" type="text" style="margin-right:10px;height:32px;width:240px" placeholder="Nome contém...">
				
				<input name="sobrenome" type="text" style="margin-right:10px;height:32px;width:240px" placeholder="Sobrenome contém...">
				
				<input name="cpf" type="text" style="margin-right:10px;height:32px;" placeholder="CPF">
				
				
				
				<input name="email" type="text" style="margin-right:10px;height:32px;" placeholder="E-Mail">
				
				<input name="cidade" type="text" style="margin-right:10px;height:32px;width:148px" placeholder="Cidade">
				
				<select name="estado" class="cad" style="margin-right:10px;height:32px;width:78px;" >
							<option selected disabled style="font-weight:bold">Estado</option>
							<option value="AC">AC</option>
							<option value="AL">AL</option>
							<option value="AM">AM</option>
							<option value="AP">AP</option>						
							<option value="BA">BA</option>
							<option value="CE">CE</option>
							<option value="DF">DF</option>
							<option value="ES">ES</option>
							<option value="GO">GO</option>
							<option value="MA">MA</option>
							<option value="MG">MG</option>
							<option value="MS">MS</option>
							<option value="MT">MT</option>
							<option value="PA">PA</option>
							<option value="PB">PB</option>
							<option value="PE">PE</option>
							<option value="PI">PI</option>
							<option value="PR">PR</option>
							<option value="RJ">RJ</option>
							<option value="RN">RN</option>						
							<option value="RO">RO</option>
							<option value="RR">RR</option>
							<option value="RS">RS</option>
							<option value="SC">SC</option>
							<option value="SE">SE</option>
							<option value="SP">SP</option>
							<option value="TO">TO</option>
						</select>
						
				<input name="data" type="text" class="cad-data" style="margin-right:10px;height:32px;width:137px;" id="datepicker" placeholder="Data" readonly>
				
				<!--
				<select name="nvl_acad" style="padding:5px;height:32px;margin-right:10px;margin-top:10px;">
					<option selected disabled style="font-weight:bold">Nvl. Acadêmico</option>
					<option value="nvl1">...</option>
				</select>
				-->			
				<select name="status" style="padding:5px;height:32px;margin-top:10px;margin-right:10px;">
					<option selected disabled style="font-weight:bold">Status</option>
					<option value="n">Ativo</option>
					<option value="s">Excluído</option>
				</select>
				
				<select name="tipo" style="padding:5px;height:32px;margin-top:10px;margin-right:10px;">
					<option selected disabled style="font-weight:bold">Tipo</option>
					<option value="1">Admin</option>
					<option value="2">Usuario</option>
				</select>
												
				</form>
			</div>
			
			<!-- TABELA - td = resultado; th = titulo -->
			<table style="border:1px solid;padding:5px;font-size:13px;width:960px;table-layout: fixed;">
				<tr style="border:1px solid;padding:5px;background-color:#F2F2F2;">
					<th style="border:1px solid;padding:5px;width:60px;">
						Status
					</th>
					<th style="border:1px solid;padding:5px;width:100px;">
						Nome de Usuário
					</th>
					<th style="border:1px solid;padding:5px;width:150px;">
						Nome Completo
					</th>
					<th style="border:1px solid;padding:5px;width:60px;">
						Tipo
					</th>
					<th style="border:1px solid;padding:5px;width:100px;">
						Data de Nasc.
					</th>
					<th style="border:1px solid;padding:5px;width:235px;">
						E-Mail
					</th>
					<th style="border:1px solid;padding:5px;width:150px;">
						Cidade/Estado
					</th>
				</tr>
				<?php 
				while($linha_usuario = $consulta_usuario->fetch(PDO::FETCH_OBJ))
				{
					if($linha_usuario->excluido == 's'){  ?><tr style="border:1px solid;padding:5px;"><?php }
					else { ?><tr style="border:1px solid;padding:5px;"><?php } ?>
						<td style="border:1px solid;padding:5px;">
							<?php if($linha_usuario->excluido == 'n'){ echo "<font color='green'>Ativo</font>"; } else if($linha_usuario->excluido == 'ns' && $linha_usuario->tempo_ban==NULL){ echo "<font color='red'>Inativo</font>"; } else{ echo "<font color='red'>Banido</font>"; } ?>						
						</td>
						<td style="border:1px solid;padding:5px;">
							<?php echo '<a href="perfil.php?userp='.$linha_usuario->login.'" target="_blank">'.$linha_usuario->login.'</a>'; ?>
						</td>
						<td style="border:1px solid;padding:5px;">
							<?php echo $linha_usuario->nome." ".$linha_usuario->sobrenome; ?>
						</td>
						<td style="border:1px solid;padding:5px;">
							<?php if($linha_usuario->tipo == 1){ echo "<font style='color:red;font-weight:bold;text-shadow: 0px 1px 1px #A4A4A4;'>Admin</font>"; } else{ echo "Usuário"; } ?>						
						</td>
						<td style="border:1px solid;padding:5px;">
							<?php echo $linha_usuario->data_nasc; ?>
						</td>
						<td style="border:1px solid;padding:5px;">
							<?php echo $linha_usuario->email; ?>
						</td>
						<td style="border:1px solid;padding:5px;">
							<?php if($linha_usuario->cidade!=NULL  && $linha_usuario->estado!=NULL){ echo $linha_usuario->cidade.", ".$linha_usuario->estado; } else { echo "NULO."; } ?>
						</td>
						<td style="border:1px solid;" width="30px">
						<?php if($linha_usuario->excluido == 'n')
						{ 
						?>
						<a href="#aprovar<?php echo $linha_usuario->login; ?>" title="Banir usuário" data-toggle="modal"><img src="imagens/nao.png"></a>
							<!-- Modal -->
							<div class="modal fade" id="aprovar<?php echo $linha_usuario->login; ?>"" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-body" style="color:black;">
											<h3 style="margin-top:-3px;">Confirmar Banimento</h3><hr class="est1">
											<?php  echo "O usuário";  ?> de nome <b><?php echo $linha_usuario->login; ?></b> receberá um banimento até:
											<br>
											
											<form action="adm-exclui.php" method="get">
												<input type="hidden" name="login" value="<?php echo $linha_usuario->login; ?>">
												<input type="datetime-local" name="tempo_ban" style="padding:5px;margin-top:3px;" min="<?php echo date("Y-m-d")."T".date("h:i"); ?>" required><br>
											
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
											<input type="submit" class="btn btn-default pull-right" style="width:100px;" value="Banir">
											</form>
										</div>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
							<!-- FIM - APROVAR POPUP -->
						<?php 
						} 
						else
						{ 
						?>
						<a onclick='confirmaBan("<?php echo $linha_usuario->login; ?>")'><img src="imagens/sim.png" title="Ativar Usuário" style="cursor: pointer;"></a>
						<? 
						} 
						?>		
								
								<a onclick='confirmaExc("<?php echo $linha_usuario->login; ?>")'><img src="imagens/delete.png" title="Excluir Permanentemente" style="cursor: pointer;"></a>
							<script>
							function confirmaBan(posicao){
									swal({
								  title: "Você tem certeza?",
								  text: "Desativar/Ativar",
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
									window.location.assign("adm-exclui.php?login="+posicao+"");
								  //swal("Deleted!", "Your imaginary file has been deleted.", "success");
								  
								});
									
								
							}
							function confirmaExc(posicao){
									swal({
								  title: "Você tem certeza que deseja excluir PERMANENTEMENTE?",
								  type: "error",
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
									window.location.assign("adm-exclui.php?login="+posicao+"&excluir=sim");
								  //swal("Deleted!", "Your imaginary file has been deleted.", "success");
								  
								});
									
								
							}
							</script>
							<a href="" title="Ativar/Desativar">
							</td>
					</tr>
				<?php 
			}} ?>
			</table>
			<?php 
			}
					$query_Total = $db->prepare($sql);
					$query_Total->execute();
		
					$query_result = $query_Total->fetchAll(PDO::FETCH_ASSOC);

					# conta quantos registros tem no banco de dados
					$query_count =  $query_Total->rowCount(PDO::FETCH_ASSOC);

					# calcula o total de paginas a serem exibidas
					$qtdPag = ceil($query_count/$limite);
					

					# Cria os links para navegação das paginas
					echo "<div class='relax h30'></div>";
					# echo '<a href="busca?pg=1">PRIMEIRA PÁGINA</a>&nbsp;';
					echo '<ul id="paginacao">';
					$pg_ant=$pg-1;
					echo "<center> ";
					if($pg_ant>=1)
					{
					echo "<a class='anterior' href='adm-users.php?pg=$pg_ant'>Anterior</a> ";
					}
					if($qtdPag>1)
					{
					if($qtdPag > 1 && $pg <= $qtdPag){

						for($i = 1; $i <= $qtdPag; $i++){

								if($i == $pg){

										echo " <a class='ativo'>".$i."</a> ";

								} else {

										echo " <a href='adm-users.php?pg=$i'>".$i."</a> ";

								}

						}

													}				
				$pgProx=$pg+1;
				if($pgProx<=$qtdPag)
				{
				echo "<a class='proxima' href='adm-users.php?pg=$pgProx'>Próxima</a> </center>";
				}
					}
?>
			
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