<?php
    $xml = new DOMDocument();
    $xml->load("./assets/xml/BSIT3EG1G5.xml");
    $lists = $xml->getElementsByTagName("restaurantName");

    $rName = $_REQUEST["rName"];
    $flag=0;
    foreach ($lists as $list){
        $restoName = $list->nodeValue;
        if (strtolower($rName)==strtolower($restoName)){
            $flag=1;
            echo "Already Exist!";
            break;
        }
    }
    if ($flag == 0){
        echo "Available!";
    }
?>