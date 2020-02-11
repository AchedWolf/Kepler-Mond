
<?php

session_start();

if($_SESSION['logado'] == 1)
{
	$tipo = $_POST['tipo3'];
	$img_modo = $_POST['img_modo'];
	$nome = $_POST['nome-up'];
	$id = $_POST['id-up'];
	$num_agen = $_POST['num-up'];

	$raio = $_POST['raio-up'];

	$descr = $_POST['desc-up'];
	$fonte = $_POST['fonte-up'];
	
	
	if($img_modo == 'url'){
		$img = $_POST['imgperfil_txt'];
	}
	else if($img_modo == 'default'){
		$img = "imagens/perfil-default.png";
	}
	else if($img_modo == 'file'){
		$destino = './imagens/'.$tipo.'/' . $nome . ".jpg";	
		$arquivo_tmp = $_FILES['img-file']['tmp_name'];
	
		/*$size = getimagesize($arquivo_tmp);

		$width = 200;
		$height = 200;

		$src = imagecreatefromstring(file_get_contents($arquivo_tmp));
		$dst = imagecreatetruecolor($width, $height);
		imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
		imagedestroy($src);
		imagepng($dst, $destino);*/ //adjust format as needed

		if(move_uploaded_file($arquivo_tmp, $destino))
		{
			$img = "imagens/".$tipo."/" . $nome . ".jpg";
			echo $img;
		}
	}
	
		include "conecta.php";
		$consulta = $db->prepare('UPDATE astros SET nome=?,descr=?,num_agen=?,raio=?,fonte=?,tipo=? WHERE id_astro=?');
		$consulta->bindParam(1,$nome, PDO::PARAM_STR);
		$consulta->bindParam(2,$descr, PDO::PARAM_STR);
		$consulta->bindParam(3,$num_agen, PDO::PARAM_INT);
		$consulta->bindParam(4,$raio, PDO::PARAM_INT);
		$consulta->bindParam(5,$fonte, PDO::PARAM_STR);
		$consulta->bindParam(6,$tipo, PDO::PARAM_INT);
		$consulta->bindParam(7,$id, PDO::PARAM_INT);
		$consulta->execute();
		echo "<meta http-equiv='refresh' content='0; url=adm-astros.php'>";
}
?>
