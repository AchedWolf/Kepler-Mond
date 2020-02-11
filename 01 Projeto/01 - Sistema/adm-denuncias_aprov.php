<head>
	<meta charset="utf-8">
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
</head>
<body>
<?php
include "conecta.php";
session_start();

$id_denunciado = $_POST['id_denunciado'];
$login_den = $_POST['login_den'];
$tipo_denunciado = $_POST['tipo_denunciado'];
$tempo_ban = str_replace("T"," ",$_POST['tempo_ban']);

$tempo_ban_format1 = explode(" ",$tempo_ban);
$data = $tempo_ban_format1[0];
$data_format1 = explode("-",$data);
$dia = $data_format1[2];
$mes = $data_format1[1];
$ano = $data_format1[0];

$hora_final = $tempo_ban_format1[1];
$data_final = $dia."/".$mes."/".$ano;
$tempo_ban_final = $data_final." ".$hora_final;

if($tipo_denunciado == "u"){
	$consulta = $db->prepare("UPDATE usuario SET excluido = 's', tempo_ban = ? WHERE login = ?");
	$consulta->bindParam(1,$tempo_ban_final, PDO::PARAM_STR);
	$consulta->bindParam(2,$id_denunciado, PDO::PARAM_STR);
	$consulta->execute();
	$num_linhas = $consulta->rowCount();
	
	$consulta_den = $db->prepare("DELETE FROM denuncias WHERE id_denunciado = ?");
	$consulta_den->bindParam(1,$id_denunciado, PDO::PARAM_STR);
	$consulta_den->execute();
	$num_linhas_den = $consulta_den->rowCount();
	
	if($num_linhas > 0)
	{
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "O usuário foi banido com sucesso.",
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
				text: "Ocorreu um erro ao banir o usuário. Tente novamente.",
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
}
else if($tipo_denunciado == "i"){
	$consulta = $db->prepare("UPDATE instituicao SET excluido = 's', tempo_ban = ? WHERE id_inst = ?");
	$consulta->bindParam(1,$tempo_ban_final, PDO::PARAM_STR);
	$consulta->bindParam(2,$id_denunciado, PDO::PARAM_STR);
	$consulta->execute();
	$num_linhas = $consulta->rowCount();
	
	$consulta_den = $db->prepare("DELETE FROM denuncias WHERE id_denunciado = ?");
	$consulta_den->bindParam(1,$id_denunciado, PDO::PARAM_STR);
	$consulta_den->execute();
	$num_linhas_den = $consulta_den->rowCount();
	
	if($num_linhas > 0)
	{
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "A instituição foi banida com sucesso.",
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
				text: "Ocorreu um erro ao banir a instituição. Tente novamente.",
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
}
?>
</body>