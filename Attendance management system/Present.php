<?php
session_start();

include('Utilities/dbconnect.php');
$username=$_SESSION['username'];


if($_SERVER['REQUEST_METHOD']=='POST'){


    
    
    $sql="SELECT * FROM `attendance`WHERE 'Name'='$username'";
        $res=mysqli_query($conn,$sql);

        
        $sql="INSERT INTO `attendance` ( `Name`, `Date`, `Status`, `lev`) VALUES ( '$username', current_timestamp(), '1', '0')";
    $result=mysqli_query($conn,$sql);
    
    
    if($res&&$result){
        header('Location:Welcome.php');
        
    }
    
}

  
?>
