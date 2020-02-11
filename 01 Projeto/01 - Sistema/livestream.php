<?php session_start(); ?> <html>
<head>
	<link href='css/estilo23.css' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<link rel="icon" href="imagens/logomarca.png">
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<title>Kepler</title>
</head>

<body style="font-family: 'Raleway', sans-serif;" onload="playPause();videotempo()">
	<?php include "cabecalho.php"; ?>
	
			<?php
			include "conecta.php";
			
			$consulta_livestream = $db->prepare('SELECT * FROM livestream');
			$consulta_livestream->execute();
			
			$num_linhas_livestream = $consulta_livestream->rowCount();
			
			if($num_linhas_livestream < 1)
			{ ?>
				Algo deu errado.
			<?php } 
			
			else{ $linha_livestream = $consulta_livestream->fetch(PDO::FETCH_ASSOC); }?>
		
	<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;">
	
		<?php		
		$consulta_livestream = $db->prepare('SELECT * FROM livestream');
		$consulta_livestream->execute();
		
		$num_linhas_livestream = $consulta_livestream->rowCount();
		
		if($num_linhas_livestream < 1)
		{ ?>
			Algo deu errado.
		<?php }
		
		else{
			$linha_livestream = $consulta_livestream->fetch(PDO::FETCH_ASSOC);
			
			if($linha_livestream['privado']=='s' && ($_SESSION['tipo']==0 || $_SESSION['tipo']==NULL)){ ?>
				<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
					<h2>
						<i>Ops!</i>
						<?php if($_SESSION['tipo']==1){ ?><a href="adm-stream.php"><img src="imagens/config.png" style="float:right;" title="Configurar Streaming"></a><?php } ?>
					</h2>
					<hr class="est1">
					<div style="background-color:black;color:white;padding:10px;width:950px;border-radius:8px;">Est√° p√°gina foi configurada como privada por um administrador, talvez ela esteja em manuten√ß√£o no momento. Tente novamente mais tarde, pode ser que ela j√° esteja dispon√≠vel.</div>
					
					<br>
					<center><img src="imagens/manutencao.jpg" height="300px"></center>
				</div>
			<?php 
			}
			
			else{
				if($linha_livestream['privado']=='s' && $_SESSION['tipo']==1){ ?>
					<div style="background-color:black;color:white;padding:10px;width:950px;border-radius:8px;">
					Est√° p√°gina se encontra privada para usu√°rios comuns.
					</div><br>
				<?php } ?>
		
			<script type="text/javascript" src="jquery-1.4.1.min.js"></script>

	        <script type="text/javascript">
                
                // ----------------------------- CriaÁ„o dos campos -----------------------------
                flag = false;
                estado = "";
                tipos = ["Selecione uma op√ß√£o","Asteroide","Cometa","Estrela","Planeta","Satelite"];

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

                    var input = document.createElement("select");
                    input.name = "tipo";
                    input.id = "tipo";
		    input.style = "width:180; heigth:20;";
                    document.getElementById("controle").appendChild(input);

		    document.getElementById("tipo").onchange = function () {
			var atx = document.getElementById('tipo');
			var apw = atx.options[atx.selectedIndex].text;

			if(apw == 'Asteroide')
			{
				limpaasteroide();
			}
			else if(apw == 'Cometa')
			{
				limpacometa();
			}
			else if(apw == 'Estrela')
			{
				limpaestrela();
			}
			else if(apw == 'Planeta')
			{
				limpaplaneta();
			}
			else if(apw == 'Satelite')
			{
				limpasatelite();
			}
			else
			{
				$('nome').empty();
				var newOption = $('<option disabled selected value="">Selecione uma op√ß√£o</option>');
				$('nome').append(newOption);
			}
		    }

		    for (var i = 0; i < tipos.length; i++)
		    {
			var option = document.createElement("option");
			option.value = tipos[i];
			option.text = tipos[i];
			input.appendChild(option);
		    }

                    // Nome
                    var input = document.createElement("p"); 
                    input.name = "lb3";
                    input.id = "lb3";
                    document.getElementById("controle").appendChild(input);
                    document.getElementById("lb3").innerHTML = "Nome de astro:";
                    
                    var input = document.createElement("select");
                    input.name = "nome";
                    input.id = "nome";
                    input.style = "width:180; heigth:20;";
                    document.getElementById("controle").appendChild(input); 
		
		    var newOption = $('<option disabled selected value="">Selecione uma op√ß√£o</option>');
		    $('nome').append(newOption);
                    
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
                
                // ----------------------------- Fim criaÁ„o dos campos -----------------------------

		// --------------------------------- AtualizaÁ„o de campos

	function limpaestrela()
	{
				$('#nome').empty();
				var newOption = $('<option disabled selected value="">Selecione uma op√ß√£o</option>');
				$('#nome').append(newOption);
	
				<?php
					include "conecta.php";
					$consulta = $db->prepare("select id_astro, nome, tipo from astros where tipo='estrela' and excluido='n' order by nome");
					$consulta->execute();
	
						while($linha=$consulta->fetch(PDO::FETCH_OBJ))
						{
					?>
						var newOption = $('<option value="<?php echo"".$linha->id_astro; ?>"><?php echo"".$linha->nome; ?></option>');
						$('#nome').append(newOption);
						
					<?php
							
						}
					?>
	}
	function limpaplaneta()
	{
				$('#nome').empty();
				var newOption = $('<option disabled selected value="">Selecione uma op√ß√£o</option>');
				$('#nome').append(newOption);
				
				
				
				
				<?php
				include "conecta.php";
					$consulta = $db->prepare("select id_astro, nome, tipo from astros where tipo='planeta' and excluido='n' order by nome");
					$consulta->execute();
					while($linha=$consulta->fetch(PDO::FETCH_OBJ))
					{
			
		
					?>
					var newOption = $('<option value="<?php echo"".$linha->id_astro; ?>"><?php echo"".$linha->nome; ?></option>');
					$('#nome').append(newOption);
					
					<?php
					}
				?>
								
	}
	function limpaasteroide(){
				$('#nome').empty();
				var newOption = $('<option disabled selected value="">Selecione uma op√ß√£o</option>');
				$('#nome').append(newOption);
				
				
				
				
				
				<?php
				include "conecta.php";
					$consulta = $db->prepare("select id_astro, nome, tipo from astros where tipo='asteroide' and excluido='n' order by nome");
					$consulta->execute();
				while($linha=$consulta->fetch(PDO::FETCH_OBJ))
					{
			
		
					?>
					var newOption = $('<option value="<?php echo"".$linha->id_astro; ?>"><?php echo"".$linha->nome; ?></option>');
					$('#nome').append(newOption);
					
					<?php
					}
				?>
				
							
	}
	function limpasatelite()
	{
				$('#nome').empty();
				var newOption = $('<option disabled selected value="">Selecione uma op√ß√£o</option>');
				$('#nome').append(newOption);
				<?php
				include "conecta.php";
					$consulta = $db->prepare("select id_astro, nome, tipo from astros where tipo='satelite' and excluido='n' order by nome");
					$consulta->execute();
					while($linha=$consulta->fetch(PDO::FETCH_OBJ))
					{
			
		
					?>
					var newOption = $('<option value="<?php echo"".$linha->id_astro; ?>"><?php echo"".$linha->nome; ?></option>');
					$('#nome').append(newOption);
					
					<?php
					}
				?>
							
	}
	function limpacometa()
	{
				$('#nome').empty();
				var newOption = $('<option disabled selected value="">Selecione uma op√ß√£o</option>');
				$('#nome').append(newOption);
				<?php
				include "conecta.php";
					$consulta = $db->prepare("select id_astro, nome, tipo from astros where tipo='cometa' and excluido='n' order by nome");
					$consulta->execute();
					while($linha=$consulta->fetch(PDO::FETCH_OBJ))
					{
			
		
					?>
					var newOption = $('<option value="<?php echo"".$linha->id_astro; ?>"><?php echo"".$linha->nome; ?></option>');
					$('#nome').append(newOption);
					
					<?php
					}
				?>
							
	}
		
		// ----------------------------------------- MovimentaÁ„o ---------------------------------------

                function mover ()
                {                       
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
                                //Abaixo est· listando os header do conteudo que vocÍ requisitou, sÛ para confirmar se vocÍ setou os header e dataType corretos
                                alert("Informacoes da requisicao: \n" + request.getAllResponseHeaders());
                            }
                            //timeout:2000
                        });
                    }
                    else
                    {
			var teste1 = document.getElementById('tipo');
			var teste2 = document.getElementById('nome');

			if(teste1.options[teste1.selectedIndex].text != "Selecione uma op√ß√£o"){
				if(teste2.options[teste2.selectedIndex].text != "Selecione uma op√ß√£o"){

                        tipo = teste1.options[teste1.selectedIndex].text;
                        nome = teste2.options[teste2.selectedIndex].text;
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
                                //Abaixo est· listando os header do conteudo que vocÍ requisitou, sÛ para confirmar se vocÍ setou os header e dataType corretos
                                alert("Informacoes da requisicao: \n" + request.getAllResponseHeaders());
                            }
                            //timeout:2000
                        });                    
			 }
			else
			{
				alert("Selecione um astro");
			}
			}
			else
			{
				alert("Selecione um tipo de astro");
		   	}
		     }
                  
                }

                // -------------------------------------- Fim MovimentaÁ„o ---------------------------------------

                
                // ----------------------------- MovimentaÁ„o parcial -----------------------------
            
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
		    az = document.getElementById("ataz").value;
                    az = parseFloat(az) + parseFloat(mov);

                    consist();
                }

                function esquerda () // Decremento azimutal
                {
                    mov = document.getElementById("movi").value;
		    az = document.getElementById("ataz").value;
                    az = az - mov;

                    consist();
                }

                function cima () // Incremento elevaÁ„o  
                {
                    mov = document.getElementById("movi").value;
		    el = document.getElementById("atel").value;
                    el = parseFloat(el) + parseFloat(mov);

                    consist();
                }

                function baixo () // Decremento elevaÁ„o
                {
                    mov = document.getElementById("movi").value;
		    el = document.getElementById("atel").value;
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
            
                // ----------------------------- Fim movimentaÁ„o parcial -----------------------------
            </script>
			
			<?php
			$consulta_agr = $db->prepare('SELECT agendamento.id_agen,agendamento.data_agen,agendamento.hora_agen,agendamento.id_astro,agendamento.tipo_astro,
			usuario.login,usuario.avatar,
			astros.nome,astros.descr,astros.img,astros.fonte,astros.tipo,astros.id_astro 
			FROM agendamento,usuario,astros WHERE agendamento.data_agen = ? AND agendamento.hora_agen = ? AND usuario.login = agendamento.login AND astros.id_astro = agendamento.id_astro');
			$consulta_agr->bindParam(1,date("Y-m-d"), PDO::PARAM_STR);
			$consulta_agr->bindParam(2,date("H"), PDO::PARAM_STR);
			$consulta_agr->execute();
			
			$num_linhas_agr = $consulta_agr->rowCount();
			
			if($num_linhas_agr < 1)
			{ ?>
				<div id="cont-centro" style="padding-top:3px;margin-left:0px;background-color:white;">
				<h2>
					<div id="icon-img" style="background-image: url('imagens/camera.png');height:30px;margin-right:7px;"></div>
					Transmitindo: <font color="red">OFFLINE</font>
					<?php if($_SESSION['tipo']==1){ ?><a href="adm-stream.php"><img src="imagens/config.png" style="margin-left:400px;" title="Configurar Streaming"></a><?php } ?>
				</h2><hr class="est1">
				<center style="margin-top:15%">
					Parece que ningu√©m reservou este hor√°rio para transmiss√£o. Voc√™ pode pegar este hor√°rio e controlar o telesc√≥pio agora mesmo!<br>
					<a href="agendamento.php"><u>Fa√ßa isso clicando aqui</u></a>!
				</center>
				</div>
			<?php }
			
			else{
				$linha_agr = $consulta_agr->fetch(PDO::FETCH_ASSOC);
			?>
		
		<?php 
		//Se o usu√°rio logado reservou esse hor√°rio, ele v√™ o controle.
		if($_SESSION['login'] == $linha_agr['login']){ 
		?>
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
		<?php } ?>
		
		<?php
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
		
		<!-- Menu do Centro - INICIO -->
		<div id="cont-centro" style="<?php if($_SESSION['login'] == $linha_agr['login']){ ?>padding-top:3px;background-color:white;width:800px;float:left;<?php } else{ echo "padding-top:3px;margin-left:0px;background-color:white;"; }?>">
			<div id="live-transmitindo" style="float:left;">
				<h2 style="width:750px">
					<div id="icon-img" style="background-image: url('imagens/camera.png');height:30px;margin-right:7px;"></div>
					Transmitindo: <font color="red"><?php echo $linha_agr['nome']; ?></font>
					<?php if($_SESSION['tipo']==1){ ?><a href="adm-stream.php"><img src="imagens/config.png" style="float:right;" title="Configurar Streaming"></a><?php } ?>
				</h2><hr class="est1" <?php if($_SESSION['login'] == $linha_agr['login']){ echo 'style="width:750px"'; } else{ echo 'style="width:100%"'; } ?>>
				Reservado por: 
				<a href="perfil.php?userp=<?php echo $linha_agr['login']; ?>">
					<img style="background-image:url('<?php echo $linha_agr['avatar']; ?>');background-size:25px;height:25px;width:25px;" height="25px" class="avatar-peq"><?php echo $linha_agr['login']; ?>
				</a>
			</div><br><br><br><br><br><br>
			
			<!-- INICIO - PLAYER DE V√çDEO -->
			<iframe width="640" height="360" src="https://www.youtube.com/embed/live_stream?channel=UCwzV55c_KN-hMauYrdPqlEA" frameborder="0" allowfullscreen></iframe>

			<!-- FIM - PLAYER DE V√çDEO -->
			
			<br><br>
			<div style="width:100%;float:left;">
				<div id="live-nomeastro" <? if($_SESSION['login'] != $linha_agr['login']){ echo 'style="width:90%"'; } ?>>
					<div id="icon-img" style="background-image: url('imagens/planeta.png');margin-bottom:5px;"></div>
					<font size="4px" style="padding-left:7px;"><u><?php echo $linha_agr['nome']; ?></u></font>
				</div>
				<div id="live-descastro" <? if($_SESSION['login'] != $linha_agr['login']){ echo 'style="width:90%"'; } ?> style="overflow:hidden;">
					<?php echo ucfirst($linha_agr['descr']); ?>
					<br><br><b><?php echo page_title($linha_agr['fonte']); ?></b> Dispon√≠vel em: &lt<i><a target="_blank" href="<?php echo $linha_agr['fonte']; ?>"><?php echo $linha_agr['fonte']; ?></a></i>&gt.
				</div>
			</div>
			
			<div style="float:left;margin-top:10px;width:100%;font-size:20px;padding:10px;border:1px solid #bdbdbd;border-radius:7px;">
				<center><b>Tempo Restante:</b> <span id="live_restante" style="font-family:'Lucida Console', Monaco, monospace">...</span></center>
			</div>
			
			<script>
			var hoje = new Date();
			roundMinutes(hoje); // ex: 05:00

			function roundMinutes(hoje) {

				hoje.setHours(hoje.getHours() + Math.ceil(hoje.getMinutes()/60));
				hoje.setMinutes(0);

				return hoje;
			}
			
			var countDownDate = hoje;
			
			var x = setInterval(function(){
			//Pega o dia e hor√°rio de hoje:
			  var now = new Date().getTime();

			  //Calcula o tempo de diferen√ßa:
			  var distance = countDownDate - now;

			  //Calcula h, m, s:
			  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

			  //Display no id="live_restante":
			  document.getElementById("live_restante").innerHTML = hours + "h "
			  + minutes + "m " + seconds + "s ";

			  //Se chegar a 0:
			  if (distance < 0) {
				clearInterval(x);
				document.getElementById("live_restante").innerHTML = "ESGOTADO.";
				alert("A streaming deste astro acabou. Por favor, atualize a p√°gina!");
			  }
			}, 1000);
			</script>
			
		</div>
		<!-- Menu do Centro - FIM -->
		<?php } //FIM DO ELSE: SE HOR√ÅRIO ESTIVER RESERVADO.
			}
		} ?>
	
	<!-- TOPO - INICIO -->
		<a onclick="scrollToTop(400);" style="display:block;">
			<div id="voltaraotopo" title="Voltar ao Topo">
				<img src="imagens/topo.png" height="50px" class="floating">
			</div>
		</a>
		<script>
		function scrollToTop(scrollDuration) {
		const   scrollHeight = window.scrollY,
		        scrollStep = Math.PI / ( scrollDuration / 15 ),
		        cosParameter = scrollHeight / 2;
		var     scrollCount = 0,
		        scrollMargin,
		        scrollInterval = setInterval( function() {
		            if ( window.scrollY != 0 ) {
		                scrollCount = scrollCount + 1;  
		                scrollMargin = cosParameter - cosParameter * Math.cos( scrollCount * scrollStep );
		                window.scrollTo( 0, ( scrollHeight - scrollMargin ) );
		            } 
		            else clearInterval(scrollInterval); 
		        }, 15 );
		}
		</script>
		<!-- TOPO - FIM -->
    
    </div>
	<?php include "rodape.php"; ?>
</body>
</html>
