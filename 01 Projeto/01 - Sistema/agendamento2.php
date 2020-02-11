<?php session_start(); ?> 
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
	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  	<link rel="stylesheet" href="/resources/demos/style.css">
  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<script>
	
	
 	 $( function() {
   	 $("#datepicker-instituicao").datepicker({
						altField: "#input_date",
						dateFormat: 'dd-mm-yy',
						minDate: -0, 
						maxDate: "+30D",
						onSelect: function () {
   							 //defined your own method here
							$('#manha,#tarde,#noite').removeClass('hide');
							var button = $('#manha');
							var button1 = $('#tarde');
							var button2 = $('#noite');
							button.prop('disabled', false);
							button1.prop('disabled', false);
							button2.prop('disabled', false);
   							 }
						});
  		} );
 	 $( function() {
   	 $("#datepicker-usuario").datepicker({
						altField: "#input_date",
						dateFormat: 'dd-mm-yy',
						minDate: -0, 
						maxDate: "+7D",
						onSelect: function () {
   							 //defined your own method here
							$('#manha,#tarde,#noite').removeClass('hide');
							var button = $('#manha');
							var button1 = $('#tarde');
							var button2 = $('#noite');
							button.prop('disabled', false);
							button1.prop('disabled', false);
							button2.prop('disabled', false);
   							 }
						});
  		} );

		
		
		
		
	 function changemanha(){
	var data= document.getElementById("input_date").value;
	$('#cont-direita').load('horario.php?periodo=manha&data='+data);
	var button = $('#manha');
	var button1 = $('#tarde');
	var button2 = $('#noite');	
	
	
	button.prop('disabled', true);
	button1.prop('disabled', false);
	button2.prop('disabled', false);
	}
	

	function changetarde(){
		
	var data= document.getElementById("input_date").value;	
	$('#cont-direita').load('horario.php?periodo=tarde&data='+data);
	var button = $('#manha');
	var button1 = $('#tarde');
	var button2 = $('#noite');	

	
	button.prop('disabled', false);
	button1.prop('disabled', true);
	button2.prop('disabled', false);
	}

	function changenoite(){
	var data= document.getElementById("input_date").value;
	$('#cont-direita').load('horario.php?periodo=noite&data='+data);
	var button = $('#manha');
	var button1 = $('#tarde');
	var button2 = $('#noite');	

	button.prop('disabled', false);
	button1.prop('disabled', false);
	button2.prop('disabled', true);
	}
  	
	
	
	
	</script>
	<?php
	session_start();
	?>

	<link rel="icon" href="imagens/logomarca.png">
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<title>Kepler</title>
</head>

<body style="font-family: 'Raleway', sans-serif;">
	<?php include "cabecalho.php"; ?>
		
		<!--Menu da Esquerda - INICIO -->
		<div id="mae" style="width:1010px;max-width:1010px;background-color:red;margin: 0 auto;"><div id="cont-esquerda" style="margin-left:0px;">
				<?php
				include"conecta.php";
				if($_SESSION['logado']==1)
				{
					$login=$_SESSION['login'];					
					$consulta = $db->prepare('SELECT login,nome_inst,instituicao.excluido FROM relacao,instituicao where login = ? and instituicao.excluido = "n" and relacao.id_inst=instituicao.id_inst');
					$consulta->bindParam(1,$login, PDO::PARAM_STR);
					$consulta->execute();
					$num_linhas = $consulta->rowCount();
					if($num_linhas>0)
					{
				?>
		
			<div id="item-esquerda">
				<div id="ie-titulo">
			
				<form action="horario.php" method="get">
				<p>Date: <input type="text" id="input_date" name="data"  disabled></p>
				</div>
				<div id="ie-cont">
				<div id="datepicker-instituicao"></div>
				</div>
			</div>
				<?php
					}
					else
					{
				?>
			<div id="item-esquerda">
				<div id="ie-titulo">
			
				<form action="horario.php" method="get">
				<p>Date: <input type="text" id="input_date" name="data"  disabled></p>
				</div>
				<div id="ie-cont">
				<div id="datepicker-usuario"></div>
				</div>
			</div>
				<?php
					}
				?>

<button id="manha" type="button" hidden="hidden" class="btn btn-primary btn3d hide" style="width:240px;margin-bottom:-11px" onclick="changemanha();">Manhã</button>
<br><br>
<button id="tarde" type="button" hidden="hidden" class="btn btn-primary btn3d hide" style="width:240px;margin-bottom:-11px" onclick="changetarde();">Tarde</button>
<br><br>
<button id="noite" type="button" hidden="hidden" class="btn btn-primary btn3d hide" style="width:240px;margin-bottom:-11px" onclick="changenoite();">Noite</button>

			<?php
			}
			else
			{
			?>
			<!--voce esta perdido-->
			
			<?php
					echo '<script type="text/javascript">
					swal({
					title: "",
					text: "\u00c9 necess\u00e1rio realizar o login.",
					type: "warning",
					showCancelButton: false,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Ok",
					closeOnConfirm: false,
				},
				function(){
					window.location.assign("login.php");
					}
				);</script>';
				return;
			}
			?>
		</div>
		<!--Menu da Esquerda - FIM -->
			
		<!--Menu do Centro - INICIO -->
		<div id="cont-direita">
		
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
