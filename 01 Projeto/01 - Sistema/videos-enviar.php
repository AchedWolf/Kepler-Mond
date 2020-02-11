<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
</head>
<?php
	session_start();

		include "conecta.php";
		
		$nome_up = $_POST['titulo-up'];
		$desc_up = $_POST['desc-up'];
		$id_up = $_POST['id-up'];
		
		if(!empty($nome_up))//editar dados video
		{
			$consulta = $db->prepare('UPDATE videos SET nome=?,descr=? WHERE id_video=?');
			$consulta->bindParam(1,$nome_up, PDO::PARAM_STR);
			$consulta->bindParam(2,$desc_up, PDO::PARAM_STR);
			$consulta->bindParam(3,$id_up, PDO::PARAM_INT);
			$consulta->execute();
			$num_linhas = $consulta->rowCount();
			if($num_linhas > 0)
				{			
					echo "<meta http-equiv='refresh' content='0; url=adm-videos.php'>";
					echo '<script language="javascript">alert("O vídeo foi editado com sucesso.")</script>';
				}
				else{
					echo "<meta http-equiv='refresh' content='0; url=adm-videos.php'>";
					echo '<script language="javascript">alert("Ocorreu um erro ao editar o vídeo. Tente novamente mais tarde.")</script>';
				}
		}
		else//Publicar novo vídeo.
		{
		
		$data_pub = date("d/m/Y");
		$ytlink = $_POST['link'];
		$horario = date("H:i:m");
		
		//INICIO - JSON
		$video_json = file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=statistics%2C+snippet&id='.$ytlink.'&key=AIzaSyBW3Czh3MKsIsv3HlE7HFq4-nJ5sxvbX6o');
		$video_json = json_decode($video_json, true);
		//FIM - JSON
		
			foreach ($video_json['items'] as $data){
				$nome = "{$data['snippet']['title']}";
				$img_cover = "{$data['snippet']['thumbnails']['default']['url']}";
				$views = "{$data['statistics']['viewCount']}";
			}
		
		//Verica se vai pegar descrição do vídeo do YouTube ou customizada.
		$desctipo = $_POST['desctipo'];
		
		if($desctipo == "0"){ //Descrição Customizada
			$desc = nl2br(ucfirst($_POST['desc'])); //nl2br permite pular linha.
		}
		else{ //Descrição do vídeo no YouTube
			foreach ($video_json['items'] as $data){
				$desc = nl2br(ucfirst("{$data['snippet']['description']}"));
			}
		}
		
		$consulta = $db->prepare('INSERT INTO videos VALUES(nextval(\'videos_data_pub_seq\'::regclass), ?, ?, ?, ?, ?, 0, ?,?);');
		$consulta->bindParam(1,$nome, PDO::PARAM_STR);
		$consulta->bindParam(2,$desc, PDO::PARAM_STR);
		$consulta->bindParam(3,$data_pub, PDO::PARAM_STR);
		$consulta->bindParam(4,$views, PDO::PARAM_STR);
		$consulta->bindParam(5,$ytlink, PDO::PARAM_STR);
		$consulta->bindParam(6,$horario, PDO::PARAM_STR);
		$consulta->bindParam(7,$img_cover, PDO::PARAM_STR);
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{			
			echo "<meta http-equiv='refresh' content='0; url=videos.php'>";
			echo '<script language="javascript">alert("O vídeo foi registrado com sucesso.")</script>';
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=videos.php'>";
			echo '<script language="javascript">alert("Ocorreu um erro ao registrar o vídeo. Tente novamente mais tarde.")</script>';
			echo "nome: ".$nome."<br>";
			echo "desc: ".$desc."<br>";
			echo "data_pub: ".$data_pub."<br>";
			echo "views: ".$views."<br>";
			echo "ytlink: ".$ytlink."<br>";
			echo "horario: ".$horario."<br>";
			echo "img_cover: ".$img_cover."<br>";
		}	
		}
	?>