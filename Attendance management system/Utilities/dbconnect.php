<?php

$server="localhost";
$username="root";
$password="";
$database="ehti";

$conn=mysqli_connect($server,$username,$password,$database);
if (!$conn){
    echo "Sorry for inconvenience we are facing technical issue";
}

?>