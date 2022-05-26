<?php

$hn = "localhost";
$un = "root";
$pn = "";
$dbn = "grnd_db";

$con = new mysqli($hn, $un,$pn,$dbn);

if(!$con){
    echo "Error";
}

?>