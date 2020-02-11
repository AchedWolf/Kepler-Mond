<?php

session_start();
include "conecta.php";

$id_astro = $_GET['id_astro'];
$tipo_astro = $_GET['astro'];
$_SESSION['id_astro'] = $_GET['id_astro'];
$_SESSION['tipo_astro'] = $_GET['astro'];

$sql = "SELECT * FROM astros WHERE id_astro=?";
$consulta = $db->prepare($sql);
$consulta->bindParam(1,$id_astro, PDO::PARAM_STR);
$consulta->execute();
$num_linhas = $consulta->rowCount();

		if($num_linhas < 1)
		{
			include "404.php";
		}
		else
		{
	
$linha = $consulta->fetch(PDO::FETCH_ASSOC);

    function page_title($url) {
        $fp = file_get_contents($url);
        if (!$fp) 
            return null;

        $res = preg_match("/<title>(.*)<\/title>/siU", $fp, $title_matches);
        if (!$res) 
            return null; 

        // Clean up title: remove EOL's and excessive whitespace.
        $title = preg_replace('/\s+/', ' ', $title_matches[1]);
        $title = trim($title);
        return $title;
    }
		
?>

<img height="300px" id="img_astro" src="<?php echo $linha['img']; ?>" style="background-color:black;border:1px solid #bdbdbd;border-radius:8px;margin-bottom:20px;margin-right:20px;float:left;">

<div id="live-nomeastro"><img src="imagens/planeta.png"><font size="4px" style="padding-left:7px;"><u><?php echo ucwords($linha['nome']); ?></u></font></div>
<div id="live-descastro" style="overflow:hidden">
	<?php echo ucfirst($linha['descr']); ?>
	<br><br><b><?php $linha['fonte']; ?></b> Disponível em: &lt<i><a href="<?php echo $linha['fonte']; ?>"><?php echo $linha['fonte']; ?></a></i>&gt.
	
	<?php if($linha['raio']> 1){ ?>
	<hr class="est1">
	<b>Raio:</b><br> <?php echo $linha['raio']." km"; ?>
		<?php }} ?>
</div>
		
<br><br>
<div style="background-color:white;float:left;width:100%;margin-top:10px;margin-bottom:10px;">
	<a href="agendamento2.php" type="button" class="btn btn-primary btn3d" style="color:white; width:180px; margin-bottom:-11px" onclick="Enviar();">Agendar</a>
</div>
