<?php 

session_start();

include('Utilities/dbconnect.php');
$username=$_SESSION['username'];

if($_SERVER['REQUEST_METHOD']=='POST'){


$sql="INSERT INTO `attendance` ( `Name`, `Date`, `Status`, `lev`) VALUES ( '$username', current_timestamp(), '0', '0')";
    $result=mysqli_query($conn,$sql);
    if($result){
        header('Location:Welcome.php');
    }
}
    ?>