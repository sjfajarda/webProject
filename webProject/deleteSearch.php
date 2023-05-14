<?php
session_start();
$xml = new domDocument("1.0");
$xml->load("./assets/xml/BSIT3EG1G5.xml");
$flag = 0;
$Search = strtolower($_POST["Search"]);
$_SESSION["Search"] = $Search;
$buffets = $xml->getElementsByTagName("buffet");
foreach ($buffets as $buffet) {
    $name = strtolower($buffet->getElementsByTagName("restaurantName")->item(0)->nodeValue);
    if ($Search == $name) {
        $flag = 1;
        $restaurantName = $buffet->getElementsByTagName("restaurantName")->item(0)->nodeValue;
        $basePrice = $buffet->getElementsByTagName("basePrice")->item(0)->nodeValue;
        $serviceOptions = $buffet->getElementsByTagName("serviceOptions")->item(0)->nodeValue;
        $location = $buffet->getElementsByTagName("location")->item(0)->nodeValue;
        $openingHours = $buffet->getElementsByTagName("openingHours")->item(0)->nodeValue;
        $googleReviewRatings = $buffet->getElementsByTagName("googleReviewRatings")->item(0)->nodeValue;
        $picture = $buffet->getElementsByTagName("picture")->item(0)->nodeValue;
        header("location: deleteProcess.php");
        
    }
}
if ($flag == 0)
    echo "<script>alert('There is no such record');window.location='index.php'</script>";
?>