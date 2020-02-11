<?php
    $auto = $_POST['auto']; // Modo de funcionamento
   
    if($auto == 'ON')
    {
        $tipo = $_POST['tipo']; // Tipo do astro
        $nome = $_POST['nome']; // Nome do astro
        $ajaz = $_POST['ajaz']; // Ajuste azimutal
        $ajel = $_POST['ajel']; // Ajuste elevação
    }
    else
    {	
        $az = $_POST['az']; // Posição azimutal
        $el = $_POST['el']; // Posição elevação
    }

    $p = fopen("comando.txt",'w+'); // Abrir conexão
        
    if($auto == "ON")
    {   
        // Dados = auto|tipo|nome|ajuste az|ajuste el
        fwrite($p,$auto."\r\n");
        fwrite($p,$tipo."\r\n");
        fwrite($p,$nome."\r\n");
        fwrite($p,$ajaz."\r\n");
        fwrite($p,$ajel);
    }
    else
    {
        fwrite($p,$auto."\r\n");
        fwrite($p,$az."\r\n");
        fwrite($p,$el);
    }

    fclose($p); //Fecha conexão

    if(chmod("comando.txt", 0777))
    {
	echo 'Permissão modificada com sucesso.';
    }
    else
    {
	echo 'Não foi possível alterar permissão';
    }
    
    echo $arquivo;
?>
