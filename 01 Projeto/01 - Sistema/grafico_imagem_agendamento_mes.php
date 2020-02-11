<?php
	//incluindo a classe phplot
	#include ('conecta.php');
	include('phplot-6.2.0/phplot.php');	

	$asteroide = $_GET['asteroide'];
	$estrela = $_GET['estrela'];
	$planeta = $_GET['planeta'];
	$satelite = $_GET['satelite'];
	$cometa = $_GET['cometa'];

	$num_asteroide = $_GET['tipo_asteroide'];
	$num_estrela = $_GET['tipo_estrela'];
	$num_planeta = $_GET['tipo_planeta'];
	$num_satelite = $_GET['tipo_satelite'];
	$num_cometa = $_GET['tipo_cometa'];
	

	$data = array(
	  array('', $asteroide),
	  array('', $estrela),
	  array('', $planeta),
	  array('', $satelite),
	  array('', $cometa),
	);

	$plot = new PHPlot(800,600);
	$plot->SetImageBorderType('plain');
	$plot->SetDataType('text-data-single');
	$plot->SetFontTTF('title', 'fonts/arial.ttf', 14);
	$plot->SetFontTTF('legend','fonts/arial.ttf', 11);
	$plot->SetFontTTF('generic','fonts/arial.ttf', 11);
	$plot->SetDataValues($data);
	$plot->SetPlotType('pie');


	$colors = array('red', 'green', 'blue', 'yellow', 'cyan');
	$legenda = array('Asteroide ('.$num_asteroide .')' , 'Estrela('.$num_estrela.')', 'Planeta('.$num_planeta.')', 'Satelite('.$num_satelite.')', 'Cometa('.$num_cometa.')');
	$plot->SetTitle('Todos agendamentos realizados');
	$plot->SetDataColors($colors);
	$plot->SetLegend($legenda);
	$plot->SetShading(0);
	$plot->SetLabelScalePosition(0.2);

	$plot->DrawGraph();
?>