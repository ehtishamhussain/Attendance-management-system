<?php
if ($_SERVER['REQUEST_METHOD']=='POST'){
    include 'Utilities/dbconnect.php';
    
    $username=$_POST['hid'];
    $start_date=date($_POST['fromatt']);
    $end_date=date($_POST['toatt']);
    
    





while (strtotime($start_date) <= strtotime($end_date)) {
    $sql="SELECT * FROM `attendance`WHERE 'Name'='$username'";
    $res=mysqli_query($conn,$sql);

    
    $sql="INSERT INTO `attendance` ( `Name`, `Date`, `Status`, `lev`) VALUES ( '$username', '$start_date', '1', '0')";
$result=mysqli_query($conn,$sql);
    $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
    }
    if($res&&$result){
        header('Location:adminhome.php');
    }

} 
?>