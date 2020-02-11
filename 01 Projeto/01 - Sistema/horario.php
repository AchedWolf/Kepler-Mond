<?php session_start(); ?> <html>
<head>
	<link href='css/estilo06.css' rel='stylesheet' type='text/css'>
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
</head>
<body>
<?php

	$periodo = $_GET['periodo'];
	$data = $_GET['data'];
	$horario= $_GET['horario'];

	$form = date("Y-m-d",strtotime("".$data)); 
	$data_mostra = date("d/m/Y",strtotime("".$data));  	
	include "conecta.php";
	$dia=date('Y-m-d');
	$hora_original = date('H');
	$hora_certa = $hora_original;

	if (isset($periodo)) 
	{
		$consulta = $db->prepare('SELECT * FROM agendamento where data_agen = ? order by hora_agen');
		$consulta->bindParam(1,$form, PDO::PARAM_STR);
		$consulta->execute();
		$min;
		$max;
		
		if($periodo=="manha"){
			$min=0;
			$max=12;
		}
		else if($periodo=="tarde"){
			$min=13;
			$max=18;
		}
		else if($periodo=="noite"){
			$min=19;
			$max=23;
		}
		
		$aux=1;
		$result = $consulta-> fetchAll();

			for($i=$min;$i<=$max;$i++){
				
				foreach( $result as $row ){
					if($row['hora_agen']==$i)
					{
						
							$aux=0;
						
					}
					
					
				}
				
				if($i<$hora_certa && $dia==$form)
				{
					?>
					<div id="agendar-invalido" style="opacity:0.5"><center>
					<?php
					echo "<b>".$i.":00</b>";
					echo"<br>Inválido";
					?>
					</center></div>
					<?php
				}
				else if($aux==0){
					?>
					<div id="agendar-ocupado"><center>
					<?php
					echo "<b>".$i.":00</b>";
					echo"<br>Ocupado";
					?>
					</center></div>
					<?php
				}
				else{
					echo"<a href=\"#\" onclick=confirmaExc('".$i."','".$form."','".$data_mostra."')> ";
					?>
					<script>
							function confirmaExc(horario,data,data_mostra){
								
									swal({
								  title: "Você tem certeza?",
								  text: "Deseja realmente fazer o agendamento às "+horario+" horas na data "+data_mostra+"?",
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
									window.location.assign("horario.php?horario="+horario+"&data="+data);
								  //swal("Deleted!", "Your imaginary file has been deleted.", "success");
								  
								});
									
									
							}
							</script>
					<div id="agendar-livre"><center>
					<?php
					echo "<b>".$i.":00</b>";
					echo"<br> Agendar";
				}
				
				?>
				</center></div></a>
				<?php
				$aux=1;
			}
	}
	
	else if(isset($horario)) {
		$sql="insert into agendamento values(nextval('seq_agen'::regclass),?,?,?,?,?)";
		$consulta = $db->prepare($sql);
		$consulta->bindParam(1,$form, PDO::PARAM_STR);
		$consulta->bindParam(2,$horario, PDO::PARAM_INT);
		$consulta->bindParam(3,$_SESSION['id_astro'], PDO::PARAM_INT);
		$consulta->bindParam(4,$_SESSION['tipo_astro'], PDO::PARAM_STR);
		$consulta->bindParam(5,$_SESSION['login'], PDO::PARAM_STR);
		$consulta->execute();
		
		/*$sql_agen="select num_agend from usuario where login=".$_SESSION['login'];
		$consulta = $db->prepare($sql_agen);
		$consulta->execute();
		
		$num_agend = $consulta->fetch(PDO::FETCH_ASSOC);
		$num_agend['num_agend'];
		
		echo $num_agend;
		$sql_agen="update usuario set num_agend=?";
		$consulta = $db->prepare($sql_agen);
		$consulta->bindParam(1,$num_agend, PDO::PARAM_STR);
		$consulta->execute();*/
		?>
		
		<script>
			//alert("Seu agendamento foi salvo com sucesso.");
		</script>
		<?php
		
		$consulta_updnum = $db->prepare("UPDATE usuario SET num_agend = num_agend+1 WHERE login = ?");
		$consulta_updnum->bindParam(1,$_SESSION['login'], PDO::PARAM_STR);
		$consulta_updnum->execute();
		
		//echo "<meta http-equiv='refresh' content='0; url=index.php'>";
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Seu agendamento foi salvo com sucesso.",
				type: "success",
				showCancelButton: false,
				confirmButtonColor: "#3085d6",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("index.php");
				}
			);</script>';
	}
	?>
		


</body>
</html>