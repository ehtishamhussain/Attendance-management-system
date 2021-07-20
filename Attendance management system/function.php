<?php
session_start();
include 'Utilities/dbconnect.php';
$username=$_SESSION['username'];
function present(){
        
        $p=1;
        $sql="INSERT INTO `attendance` (`S.No`, `Name`, `Date`, `Status`, `lev`) VALUES ( '$username', current_timestamp(), '$p', '0')";
        $result=mysqli_query($conn,$sql);
    
    }
    present();
    ?>