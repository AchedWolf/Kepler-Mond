<?php session_start(); ?> <html>
<head>
	<link rel="icon" href="imagens/logomarca.png">
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<title>Kepler</title>
</head>

<body style="font-family: 'Raleway', sans-serif;" onload="playPause();videotempo()">
		
	<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;">
		
			<script type="text/javascript" src="jquery-1.4.1.min.js"></script>

	        <script type="text/javascript">
                
                // ----------------------------- Criação dos campos -----------------------------
                flag = false;
                estado = "";
                
                function apear_auto ()
                {
                    estado = "ON";
                    document.getElementById('move').disabled = false;
                    
                    excluir("lb2","controle");
                    excluir("ataz","controle");
                    excluir("lb4","controle");
                    excluir("atel","controle");
                    excluir("lb6","controle");
                    excluir("movi","controle");
					excluir("seta_cim","cim");
                    excluir("seta_esq","esq");
					excluir("seta_dir","dir");
					excluir("seta_bai","bai");
					
                    auto.style.backgroundColor = "black";
                    auto.style.color = "white";
                    manual.style.backgroundColor = "white";
                    manual.style.color = "black";
                    
                    // Tipo
                    var input = document.createElement("p"); 
                    input.name = "lb1";
                    input.id = "lb1";
                    document.getElementById("controle").appendChild(input);
                    document.getElementById("lb1").innerHTML = "Tipo de astro:";
                    
                    var input = document.createElement("INPUT");
                    input.type = "text";
                    input.name = "tipo";
                    input.id = "tipo";
                    input.value = tipo;
					input.style = "width:180; heigth:20;";
                    document.getElementById("controle").appendChild(input);   
                    
                    // Nome
                    var input = document.createElement("p"); 
                    input.name = "lb3";
                    input.id = "lb3";
                    document.getElementById("controle").appendChild(input);
                    document.getElementById("lb3").innerHTML = "Nome de astro:";
                    
                    var input = document.createElement("INPUT");
                    input.type = "text";
                    input.name = "nome";
                    input.id = "nome";
                    input.value = nome;
                    input.style = "width:180; heigth:20;";
                    document.getElementById("controle").appendChild(input); 
                    
                    // Ajuste Az
                    var input = document.createElement("p"); 
                    input.name = "lb5";
                    input.id = "lb5";
                    document.getElementById("controle").appendChild(input);
                    document.getElementById("lb5").innerHTML = "Ajuste do Azimute:";
                    
                    var input = document.createElement("INPUT");
                    input.type = "number";
                    input.name = "ajaz";
                    input.id = "ajaz";
                    input.max = "20";
                    input.min = "-20";
                    input.value = ajaz;
                    input.style = "width:180; heigth:20;";
                    document.getElementById("controle").appendChild(input);
                    
                    // Ajuste El
                    var input = document.createElement("p"); 
                    input.name = "lb7";
                    input.id = "lb7";
                    document.getElementById("controle").appendChild(input);
                    document.getElementById("lb7").innerHTML = "Ajuste da Elevacao:";
                    
                    var input = document.createElement("INPUT");
                    input.type = "number";
                    input.name = "ajel";
                    input.id = "ajel";
                    input.max = "20";
                    input.min = "-20";
                    input.value = ajel;
                    input.style = "width:180; heigth:20;";
                    document.getElementById("controle").appendChild(input);

					flag = true;
                }                   
                
                function apear_manual ()
                {         
                    estado = "OFF";
		            document.getElementById('move').disabled = false;  
                    
                    excluir("lb1","controle");
                    excluir("tipo","controle");
                    excluir("lb3","controle");
                    excluir("nome","controle");
                    excluir("lb5","controle");
                    excluir("ajaz","controle");
                    excluir("lb7","controle");
                    excluir("ajel","controle");
                    
                    manual.style.backgroundColor = "black";
                    manual.style.color = "white";
                    auto.style.backgroundColor = "white";
                    auto.style.color = "black";
                    manual.disable = true;
                    
                    // Az
                    var p = document.createElement("p");
                    p.name = "lb2";
                    p.id = "lb2";
                    document.getElementById("controle").appendChild(p);
                    document.getElementById("lb2").innerHTML = "Az:";
                    
                    var number = document.createElement("INPUT");
                    number.type = "number";
                    number.name = "ataz";
                    number.id = "ataz";
                    number.max = "180";
                    number.min = "-180";
                    number.value = az;
                    number.style = "width:180; heigth:20;";
                    document.getElementById("controle").appendChild(number);    
                    
                    // El
                    var p = document.createElement("p");
                    p.name = "lb4";
                    p.id = "lb4";
                    document.getElementById("controle").appendChild(p);
                    document.getElementById("lb4").innerHTML = "El:";
                    
                    var number = document.createElement("INPUT");
                    number.type = "number";
                    number.name = "atel";
                    number.id = "atel";
                    number.max = "90";
                    number.min = "0";
                    number.value = el;
                    number.style = "width:180; heigth:20;";
                    document.getElementById("controle").appendChild(number); 
                    
                    // Movimento
                    var p = document.createElement("p");
                    p.name = "lb6";
                    p.id = "lb6";
                    document.getElementById("controle").appendChild(p);
                    document.getElementById("lb6").innerHTML = "Movimento:";
                    
                    var number = document.createElement("INPUT");
                    number.type = "number";
                    number.name = "movi";
                    number.id = "movi";
                    number.value = mov;
                    number.style = "width:180; heigth:20;";
                    document.getElementById("controle").appendChild(number);
                    
                    // Seta cima
                    var img = document.createElement("IMG");
                    img.id = "seta_cim";
                    img.src = "imagens\\cima.jpg";
                    img.style = "width:40; height:40; float:center;";
                    img.onclick = "cima();";
                    document.getElementById("cim").appendChild(img);
                    
                    // Seta esquerda
                    var img = document.createElement("IMG");
                    img.id = "seta_esq";
                    img.src = "imagens\\esquerda.jpg";
                    img.style = "width:40; height:40; float:center;";
                    img.onclick = "esquerda();";
                    document.getElementById("esq").appendChild(img);
                    
                    // Seta direita
                    var img = document.createElement("IMG");
                    img.id = "seta_dir";
                    img.src = "imagens\\direita.jpg";
                    img.style = "width:40; height:40; float:center;";
                    img.onclick = "direita();";
                    document.getElementById("dir").appendChild(img);
                    
                    // Seta baixo
                    var img = document.createElement("IMG");
                    img.id = "seta_bai";
                    img.src = "imagens\\baixo.jpg";
                    img.style = "width:40; height:40; float:center;";
                    img.onclick = "baixo();";
                    document.getElementById("bai").appendChild(img);
                    
                    flag = true;
                }
            
                function excluir (elemento,loc)
                {
                    if(flag)
                    {
                        d = parent.document.getElementById(loc);
                        d_nested = parent.document.getElementById(elemento);
                        throwaway = d.removeChild(d_nested);
                    }
                }
                
                // ----------------------------- Fim criação dos campos -----------------------------
		
		        // ----------------------------------------- Movimentação ---------------------------------------

                function mover ()
                {   
                    alert("Inicia a movimentacao");
                    
                    url_mov = 'Salvar_v1.php';
                    
                    if(estado == "OFF")
                    {
                        ataz = document.getElementById("ataz").value;
                        atel = document.getElementById("atel").value;

                        var dados = "auto="+estado+"&az="+ataz+"&el="+atel;        
                        
                        $.ajax({
                            type: 'POST',
                            url: url_mov,
                            async: true,
                            data: dados,
                            success: function(){
                                alert("Movendo para:\n Az: " + ataz + "  El: " + atel);
                            },
                            error: function (request, status, erro) {
                                alert("Problema ocorrido: " + status + "\nDescricao: " + erro);
                                //Abaixo está listando os header do conteudo que você requisitou, só para confirmar se você setou os header e dataType corretos
                                alert("Informacoes da requisicao: \n" + request.getAllResponseHeaders());
                            }
                            //timeout:2000
                        });
                    }
                    else
                    {
                        tipo = document.getElementById("tipo").value;
                        nome = document.getElementById("nome").value;
                        ajaz = document.getElementById("ajaz").value;
                        ajel = document.getElementById("ajel").value;  
                        
                        var dados = "auto="+estado+"&tipo="+tipo+"&nome="+nome+"&ajaz="+ajaz+"&ajel="+ajel;
                        
                        alert(dados);
                        
                        $.ajax({
                            type: 'POST',
                            url: url_mov,
                            async: true,
                            data: dados,
                            success: function(){
                                alert("Movendo para:\n" + nome);
                            },
                            error: function (request, status, erro) {
                                alert("Problema ocorrido: " + status + "\nDescricao: " + erro);
                                //Abaixo está listando os header do conteudo que você requisitou, só para confirmar se você setou os header e dataType corretos
                                alert("Informacoes da requisicao: \n" + request.getAllResponseHeaders());
                            }
                            //timeout:2000
                        });                    }
                   
		 
                }

                // -------------------------------------- Fim Movimentação ---------------------------------------

                
                // ----------------------------- Movimentação parcial -----------------------------
            
                var az = 0;
                var el = 0;
                var mov = 1;
                var ataz = 0;
                var atel = 0;
                var tipo = "";
                var nome = "";
                var ajaz = 0; 
                var ajel = 0;
            
                function direita () // Incremento azimutal
                {
                    mov = document.getElementById("movi").value;

                    az = parseFloat(az) + parseFloat(mov);

                    consist();
                }

                function esquerda () // Decremento azimutal
                {
                    mov = document.getElementById("movi").value;

                    az = az - mov;

                    consist();
                }

                function cima () // Incremento elevação  
                {
                    mov = document.getElementById("movi").value;

                    el = parseFloat(el) + parseFloat(mov);

                    consist();
                }

                function baixo () // Decremento elevação
                {
                    mov = document.getElementById("movi").value;

                    el = el - mov;

                    consist();
                }

                function consist()
                {
                    if(az > 180)
                        az = 180;
                    if(az < -180)
                        az = -180;

                    if(el > 90)
                        el = 90;
                    if(el < 0)
                        el = 0;

                    document.getElementById("ataz").value = az;
                    document.getElementById("atel").value = el;
                }

                function atl_mov () 
                {
                    mov = document.getElementById("movi").value;
                }
            
                // ----------------------------- Fim movimentação parcial -----------------------------
            </script>

		<!--Menu do Controle - INICIO -->
		<div id="live-contcontrol" style="position:fixed;padding:10px;border:1px solid black;width:200px;background-color:white;float:left;border: 1px solid #D8D8D8;border-radius:8px;margin-left:-20px;">
			<span style="font-weight:bold;">Controle</span><br>
            <div id="botao">
                <input type="button" value="Auto" id="auto" onclick="apear_auto()" style="width:85px">
                <input type="button" value="Manual" id="manual" onclick="apear_manual()" style="width:85px">
            </div>
            
            <div id="controle"><br></div>
            <div id="setas" style = "float:right">
                <div id="cim" onclick="cima();" style="width:170px; float:right; padding-left: 50px; margin-top: 10px;"></div><br>
                <div id="esq" onclick="esquerda();" style="width:40px; float:left; padding-left: 10px;"></div>
		          <div id="dir" onclick="direita();" style="width:40px; float:right; padding-right: 80px;"></div><br>
                <div id="bai" onclick="baixo();" style="width:170px; float:right; padding-left: 50px; padding-bottom: 10px;"></div>
            </div><br>
			<div id="btn_mov"> <input type="button" onclick="mover();" disabled value="Mover" id="move"> </div>		
		
        </div>
            <!--Menu do Controle - FIM -->
    </div>
</body>
</html>