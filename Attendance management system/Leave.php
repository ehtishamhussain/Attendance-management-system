<?php



include "Utilities/dbconnect.php";

if($_SERVER["REQUEST_METHOD"]=='POST'){
    session_start();
$username=$_SESSION['username'];

    $request=$_POST['request'];


$sql="INSERT INTO `lev` ( `Name`, `Date`, `message`) VALUES ( '$username', current_timestamp(), '$request')";
$result=mysqli_query($conn, $sql);

if(isset($_POST)){
    header("Location:Welcome.php");
}
}
?>