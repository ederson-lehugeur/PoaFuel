<?php
//require("phpsqlajax_dbinfo.php");

// Start XML file, create parent node

$doc = new DOMDocument('1.0');
$node = $doc->createElement("markers");
$parnode = $doc->appendChild($node);

// Opens a connection to a MySQL server
$connection=mysqli_connect('localhost', 'root', '','postos');
if (!$connection) {
  die('Not connected : ' . mysqli_error());
}

// Select all the rows in the markers table
$query = "SELECT * FROM marker WHERE 1";
$result = mysqli_query($connection,$query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  $node = $doc->createElement("marker");
  $newnode = $parnode->appendChild($node);

  	  $newnode->setAttribute("name", utf8_encode($row['name']));
	  $newnode->setAttribute("address", utf8_encode($row['address']));
	  $newnode->setAttribute("lat", utf8_encode($row['lat']));
	  $newnode->setAttribute("lng", utf8_encode($row['lng']));
	  $newnode->setAttribute("type", utf8_encode($row['type']));
	  $newnode->setAttribute("price", utf8_encode($row['price']));
}

echo $doc->saveXML();

?>