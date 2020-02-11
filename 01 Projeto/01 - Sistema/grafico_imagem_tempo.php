<?php
	//incluindo a classe phplot
	#include ('conecta.php');
	include('phplot-6.2.0/phplot.php');	
	
	$domingo = $_GET['domingo'];
	$segunda = $_GET['segunda'];
	$terca = $_GET['terca'];
	$quarta = $_GET['quarta'];
	$quinta = $_GET['quinta'];
	$sexta = $_GET['sexta'];
	$sabado = $_GET['sabado'];

	//Matriz utilizada para gerar os graficos 
	$data = array(
	  array('Domingo', $domingo), array('Segunda', $segunda),
	  array('Terça', $terca), 	array('Quarta', $quarta),
	  array('Quinta', $quinta), 	array('Sexta', $sexta),
	  array('Sábado', $sabado),
	);

	$plot = new PHPlot(800, 600);
	$plot->SetImageBorderType('plain');

	$plot->SetFontTTF('title', 'fonts/arial.ttf', 14);
	$plot->SetFontTTF('y_label', 'fonts/arial.ttf', 7);
	$plot->SetFontTTF('x_label','fonts/arial.ttf', 11);
	$plot->SetFontTTF('y_title','fonts/arial.ttf', 11);
	$plot->SetPlotType('bars');
	$plot->SetDataType('text-data');
	$plot->SetDataValues($data);
	$plot->SetShading(0);

	$plot->SetTitle('Tempo médio de uso do sistema');
	$plot->SetYTitle('Horas de uso');
	$plot->SetYDataLabelPos('plotin');

	$plot->SetXTickLabelPos('none');
	$plot->SetXTickPos('none');

	$plot->DrawGraph();

?>

