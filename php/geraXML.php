<?php
	include("conexao.php");
	
	$mySQL = new MySql();
	$mySQL->connect();
	$mySQL->executeQuery("SELECT * FROM marker WHERE 1");
	$mySQL->disconnect();

	// Start XML file, create parent node
	$dom = new DOMDocument("1.0");
	$node = $dom->createElement("markers");
	$parnode = $dom->appendChild($node);

	header("Content-type: text/xml");

	// Iterate through the rows, adding XML nodes for each
	while ($row = @mysql_fetch_assoc($mySQL->getResult())) {
		// Add to XML document node
		$node = $dom->createElement("marker");
		$newnode = $parnode->appendChild($node);
		$newnode->setAttribute("name", utf8_encode($row['name']));
		$newnode->setAttribute("address", utf8_encode($row['address']));
		$newnode->setAttribute("lat", utf8_encode($row['lat']));
		$newnode->setAttribute("lng", utf8_encode($row['lng']));
		$newnode->setAttribute("type", utf8_encode($row['type']));
		$newnode->setAttribute("price", utf8_encode($row['price']));
	}
	
	echo $dom->saveXML();
?>