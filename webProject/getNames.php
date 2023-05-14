<?php
$xml = new DOMDocument();
$xml->load("./assets/xml/BSIT3EG1G5.xml");
$buffets = $xml->getElementsByTagName("buffet");
$input = strtolower($_GET["q"]); // Use $_GET instead of $_REQUEST for simplicity
$suggestions = [];

foreach ($buffets as $buffet) {
  $rName = $buffet->getElementsByTagName("restaurantName")->item(0)->nodeValue;
  if (trim($input) != "") {
    if ($input == strtolower(substr($rName, 0, strlen($input)))) {
      $suggestions[] = $rName;
    }
  }
}

echo json_encode($suggestions);
?>
