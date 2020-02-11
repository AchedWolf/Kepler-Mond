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
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
</head>
<body>
<?php
	session_start();
	include "conecta.php";
	include"cabecalho.php";
	
	$login_den = $_SESSION['login'];
	$motivo_den = $_POST['motivo_den'];
	$descr_den = $_POST['descr_den'];
	$id_denunciado = $_POST['id_denunciado'];
	$tipo_denunciado = $_POST['tipo_denunciado'];
	$data_den = date("d/m/Y");
	
	//Usuário
	if($tipo_denunciado == "u"){
		$consulta = $db->prepare('INSERT INTO denuncias VALUES(nextval(\'denuncias_id_den_seq\'::regclass), ?, ?, ?, ?, ?, ?);');
		$consulta->bindParam(1,$login_den, PDO::PARAM_STR);
		$consulta->bindParam(2,$motivo_den, PDO::PARAM_STR);
		$consulta->bindParam(3,$descr_den, PDO::PARAM_STR);
		$consulta->bindParam(4,$id_denunciado, PDO::PARAM_STR);
		$consulta->bindParam(5,$tipo_denunciado, PDO::PARAM_STR);
		$consulta->bindParam(6,$data_den, PDO::PARAM_STR);
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		 if($num_linhas > 0)
		 {		
		echo '<script type="text/javascript">swal({
				title: "Obrigado!",
				text: "Sua den\u00fancia foi enviada com sucesso. Ela ser\u00e1 avaliada pela STAFF e voc\u00ea ser\u00e1 contatado.",
				type: "success",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
				},
				function(){
					
						//window.open("perfil.php?userp='.$id_denunciado.',"_self");
						window.location.assign("perfil.php?userp='.$id_denunciado.'");
				});</script>';
		//	echo "<meta http-equiv='refresh' content='0; url=perfil.php?userp=".$id_denunciado."'>";
		}
		else{
				echo '<script type="text/javascript">swal({
				title: "Erro",
				text: "Ocorreu um erro ao enviar a sua den\u00fancia. Tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
				},
				function(){
					
						//window.open("perfil.php?userp='.$id_denunciado.',"_self");
						window.location.assign("perfil.php?userp='.$id_denunciado.'");
				});</script>';
		}
	}
	
	//Instituição
	else if($tipo_denunciado == "i"){
		$consulta = $db->prepare('INSERT INTO denuncias VALUES(nextval(\'denuncias_id_den_seq\'::regclass), ?, ?, ?, ?, ?, ?);');
		$consulta->bindParam(1,$login_den, PDO::PARAM_STR);
		$consulta->bindParam(2,$motivo_den, PDO::PARAM_STR);
		$consulta->bindParam(3,$descr_den, PDO::PARAM_STR);
		$consulta->bindParam(4,$id_denunciado, PDO::PARAM_INT);
		$consulta->bindParam(5,$tipo_denunciado, PDO::PARAM_STR);
		$consulta->bindParam(6,$data_den, PDO::PARAM_STR);
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{		
			$url="";
			
			if(ISSET($_POST['adm']))
			{
				$url="adm-instituicoes.php";
			}
			else
			{
				$url="perfil.php?userp=".$login_den;
			}
		
		echo '<script type="text/javascript">swal({
				title: "Obrigado!",
				text: "Sua den\u00fancia foi enviada com sucesso. Ela ser\u00e1 avaliada pela STAFF e voc\u00ea ser\u00e1 contatado.",
				type: "success",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
				},
				function(){
					
						//window.open("perfil.php?userp='.$id_denunciado.',"_self");
						window.location.assign("'.$url.'");
				});</script>';}
		else{
			echo '<script type="text/javascript">swal({
				title: "Erro",
				text: "Ocorreu um erro ao enviar a sua den\u00fancia. Tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
				},
				function(){
					
						//window.open("perfil.php?userp='.$id_denunciado.',"_self");
						window.location.assign("'.$url.'");
				});</script>';
		}
	}
	
?>
<div id="mae" style="width:1010px;max-width:1010px;background-color:red;margin: 0 auto;"> 
	
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
</body>