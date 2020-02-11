<?php   
    $arq = "atual.txt"; // Nome do arquivo
    $p = fopen($arq,"r"); // Abre conexão

    $ler = fread($p,filesize($arq)); // Le os dados
    
    echo json_encode($ler); // Envia para o Javascript

    fclose($p); // Fecha conexão
?>