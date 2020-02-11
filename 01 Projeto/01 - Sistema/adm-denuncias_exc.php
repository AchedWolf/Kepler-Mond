<head>
	<meta charset="utf-8">
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
</head>
<body>
<?php
include "conecta.php";
session_start();

$id_den = $_GET['id_den'];

	$consulta = $db->prepare("DELETE FROM denuncias WHERE id_den = ?");
	$consulta->bindParam(1,$id_den, PDO::PARAM_INT);
	$consulta->execute();
			
	$num_linhas = $consulta->rowCount();
	
	if($num_linhas > 0)
	{
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Denúncia excluída com sucesso.",
				type: "success",
				showCancelButton: false,
				confirmButtonColor: "#3085d6",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				history.back();
				}
			);</script>';
	}
	else{
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao excluir a denúncia. Tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#d33",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				history.back();
				}
			);</script>';
	}
?>
</body>