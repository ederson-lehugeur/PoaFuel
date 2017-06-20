<!DOCTYPE html >

<?php  
/*Verifica se há usuario logado*/
session_start();
if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true))
{
	unset($_SESSION['email']);
	unset($_SESSION['senha']);
	header('location:login.php');
}

$logado = $_SESSION['email'];
?>

<!--Criando conexão com banco para criar dados da table-->
<?php
	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "postos";

	$connect = mysqli_connect($host,$user,$password,$database);
	
	$sql = "SELECT * FROM marker WHERE 1 ORDER BY price";
	
	$resultado = mysqli_query($connect,$sql);
?>


  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<link rel="stylesheet" href="css/indexStyle.css">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>PoaFuel</title>
	

  </head>

  	<script>
		function voltarPostos()
		{
			if(document.getElementById("pesquisa").style.visibility = "hidden")
			{
				document.getElementById("pesquisa").style.visibility = "visible";
				document.getElementById("trajeto-texto").style.visibility = "hidden";
			}
		}
		
		function voltarRota()
		{
			if(document.getElementById("pesquisa").style.visibility = "visible")
			{
				document.getElementById("pesquisa").style.visibility = "hidden";
				document.getElementById("trajeto-texto").style.visibility = "visible";
			}
		}
	</script>
	
	
  <body>
 
	<div id="sair">
		<a href="login.php">Sair</a>
	</div>
	
	<div id="map">
	</div>
	
	<div id="logo">
		<img src="logo.PNG" width="300" height="100">
	</div>
	
	<div id="trajeto-texto">
		<input id="botaoVoltarPostos" type="image" src="patata.PNG" onclick="voltarPostos()" width="48" height="48">
		<h1>ROTA</h1>
	</div>
	
  	<div id="pesquisa">
		<input id="botaoVoltarRota" type="image" src="patati.PNG" onclick="voltarRota()" width="48" height="48">
		<h1>POSTOS</h1>
		<!--
  		<div id="barra-pesquisa">
  			<center>
  				<input type="search" name="busca-posto" placeholder="Digite o nome do Posto ou a Rua">
				<button id="botaoPesquisar" type="submit" name="enviar-busca">Pesquisar</button>
  			</center>
  		</div>
  		-->
  	 <br>
  		<div class="w3-responsive">
	<!--Criação da table apresentando todos os postos em ordem de preço-->
		<?php
			$resultado = mysqli_query($connect,$sql);
			
			echo	"<table class=\"w3-table-all w3-centered w3-hoverable\">";
			echo	"<thead>";
			echo	"<tr>";
			echo	"<th>Nome</th>";
			echo	"<th>Preço</th>";
			echo	"<th>Endereço</th>";
			echo	"</tr>";
			echo	"</thead>";
			
			while($dados = mysqli_fetch_array($resultado))
			{
				echo	"<tr>";
				echo	"<td>";
				echo	$dados['name'];
				echo	"</td>";
				echo	"<td>";
				echo	"R$ ";
				echo	number_format($dados['price'],2);
				echo	"</td>";
				echo	"<td>";
				echo	$dados['address'];
				echo	"</td>";
				echo	"</tr>";
				
			}
		?>
		</div>
  	</div>

    <script>
	
	/* Selecionando qual a bandeira do Posto e atribuindo sua imagem adequadamente */
		var customImage = 
		{
			IPIRANGA: 
			{
				url:'Imagens/marker-ipiranga2.PNG'
			},
			MEGAPETRO: 
			{
				url:'Imagens/marker-esso.PNG'
			},
			RAIZEN: 
			{
				url:'Imagens/marker-shell.PNG'
			},
			
			PETROBRAS_DISTRIBUIDORA_SA: 
			{
				url:'Imagens/marker-br.PNG'
			},
			
			BANDEIRA_BRANCA: 
			{
				url:'Imagens/sembandeira.PNG'
			}
			
		};
		
		/* Seta centro do mapa para o Centro de Porto Alegre */
		myLatLng = {lat: -30.0967, lng: -51.2190};
		
		/* Criação do Mapa */
        function initMap()
		{
			var map = new google.maps.Map(document.getElementById('map'),
			{
				center: myLatLng,
				zoom: 13
			});
			
			var directionsDisplay; // Instanciaremos ele mais tarde, que será o nosso google.maps.DirectionsRenderer
			var directionsService = new google.maps.DirectionsService();
			
			directionsDisplay = new google.maps.DirectionsRenderer(); // Instanciando...
			directionsDisplay.setMap(map); // Relacionamos o directionsDisplay com o mapa desejado
			
			var infoWindow = new google.maps.InfoWindow;
			

			/* Carregamento dos dados do banco utilizando XML */
			downloadUrl("conexao.php", function(data) 
			{
				var xml = data.responseXML;
				var markers = xml.documentElement.getElementsByTagName('marker');
				Array.prototype.forEach.call(markers, function(markerElem)
				{
					var name = markerElem.getAttribute('name');
					var address = markerElem.getAttribute('address');
					var type = markerElem.getAttribute('type');
					var point = new google.maps.LatLng
					(
						parseFloat(markerElem.getAttribute('lat')),
						parseFloat(markerElem.getAttribute('lng'))
					);
					var price = markerElem.getAttribute('price');
					
					var infowincontent = document.createElement('div');
					infowincontent.id = "teste";
					
					
					var nome = document.createElement('h1');
					nome.textContent = name;
					infowincontent.appendChild(nome);
					
					
					var imagemLogo = document.createElement('img');
					imagemLogo.src = "ipiranga.jpg";
					imagemLogo.style.position = "relative";
					imagemLogo.style.float = "right";
					infowincontent.appendChild(imagemLogo);
					
					//infowincontent.appendChild(document.createElement('br'));
					
					
					/* Criação do conteudo a ser colocado dentro das InfoWindows */
					var endereco = document.createElement('p');
					endereco.textContent = address
					infowincontent.appendChild(endereco);
					
					var preco = document.createElement('text');
					preco.textContent = 'Preço: R$' + parseFloat(price).toFixed(2);
					infowincontent.appendChild(preco);
			  
					infowincontent.appendChild(document.createElement('br'));
					infowincontent.appendChild(document.createElement('br'));
					var atualizaPreco = document.createElement('button');
					atualizaPreco.textContent = 'Atualizar Preço';
					atualizaPreco.onclick = function()
					{
						if(document.getElementById("campoAltera").type == "number")
						{
							document.getElementById("campoAltera").type = "hidden";
							document.getElementById("enviarAltera").style.visibility = "hidden";
						}
						else
						{
							document.getElementById("campoAltera").type = "number";
							document.getElementById("enviarAltera").style.visibility = "visible";
						}
					}
					infowincontent.appendChild(atualizaPreco);
					
					
					var text4 = document.createElement('button');
					text4.innerHTML = 'Calcular Rota';
					text4.onclick = function()
					{
						var enderecoPartida = myLatLng;
						var enderecoChegada = point;
 
						var request = 
						{ // Novo objeto google.maps.DirectionsRequest, contendo:
							origin: enderecoPartida, // origem
							destination: enderecoChegada, // destino
							travelMode: google.maps.TravelMode.DRIVING // meio de transporte, nesse caso, de carro
						};
		
						directionsService.route(request, function(result, status) 
						{
							if (status == google.maps.DirectionsStatus.OK) 
							{ // Se deu tudo certo
								directionsDisplay.setDirections(result); // Renderizamos no mapa o resultado
								directionsDisplay.setPanel(document.getElementById("trajeto-texto"));
								directionsDisplay.setOptions( { suppressMarkers: true } );
							}
						});
						
						document.getElementById("pesquisa").style.visibility = "hidden";
						document.getElementById("trajeto-texto").style.visibility = "visible";
					};
					
					infowincontent.appendChild(text4);
					
					var formulario = document.createElement('form');
					formulario.id = 'formularioAltera';
					formulario.name = 'formPreco';
					formulario.method = 'POST';
					formulario.action = "atualizaPreco.php";

					var campo = document.createElement('input');
					campo.style.width = '70%';
					campo.style.margin = '10px';
					campo.id = 'campoAltera';
					campo.name = 'valorAlterado';
					campo.placeholder = 'Informe o novo valor';
					campo.type = 'hidden';
					campo.step='0.01';
					formulario.appendChild(campo);

					var idEscondido = document.createElement('input');
					idEscondido.name = 'selecionaMarker';
					idEscondido.value = name;
					idEscondido.style.width = '0';
					idEscondido.style.height = '0';
					idEscondido.style.visibility = 'hidden';
					formulario.appendChild(idEscondido);

					var enviar = document.createElement('button');
					enviar.style.width = '70%';
					enviar.id = 'enviarAltera';
					enviar.style.visibility = 'hidden';
					enviar.type = 'submit';
					enviar.textContent = "Enviar";
					formulario.appendChild(enviar);
					
					
					infowincontent.appendChild(formulario);
					formulario.submit();
					//infowincontent.appendChild(campo);
					//infowincontent.appendChild(enviar);
			  
					/*Criação das Markers */
					var icon = customImage[type] || {};
					var marker = new google.maps.Marker
					({
						map: map,
						position: point,
						icon: icon
					});
					
					/* Criação das Infowindows */
					marker.addListener('click', function()
					{
						infoWindow.setContent(infowincontent);
						infoWindow.open(map, marker);
					});
				});
			});
			
			/*Verifica se o Browser possui Geolicalização, se sim, pega a localização do usuário e insere um Marker na posição*/
			
			
			if (navigator.geolocation) 
			{
				navigator.geolocation.getCurrentPosition(function(position)
				{
					var pos = 
					{
						lat: position.coords.latitude,
						lng: position.coords.longitude
					};
				
					var infowindow = new google.maps.InfoWindow
					({
						content: 'USUARIO RETARDADO ESTA NESTA POSIÇÃO \\/'
					});
			
					var marker = new google.maps.Marker
					({
						position: pos,
						map: map,
						icon: 'Imagens/usuario.PNG'
					});
			
					marker.addListener('click', function()
					{
					infowindow.open(map, marker);
					});

					map.setCenter(pos);
					myLatLng = pos;
				}, function() 
				{
					handleLocationError(true, infoWindow, map.getCenter());
				});
			} /*Caso o Browser não suporte Geolocalização*/
			else 
			{
			  handleLocationError(false, infoWindow, map.getCenter());
			}
			
        }

		function downloadUrl(url, callback) 
		{
			var request = window.ActiveXObject ?
				new ActiveXObject('Microsoft.XMLHTTP') :
				new XMLHttpRequest;

			request.onreadystatechange = function() 
			{
				if (request.readyState == 4) 
				{
					request.onreadystatechange = doNothing;
					callback(request, request.status);
				}
			};

			request.open('GET', url, true);
			request.send(null);
		}

		function doNothing() {}

		function handleLocationError(browserHasGeolocation, infoWindow, pos) 
		{
			infoWindow.setPosition(pos);
			infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
		}
	</script>

	
	
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfykn5A5swYQYfFuI5IeMUaPboOck1KoU&callback=initMap"
    async defer></script>
	
	<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPmvkBo6qD-jEwqICtbM5dYs-v8TcbR0g&callback=initMap"
    async defer></script>-->
  </body>
</html>