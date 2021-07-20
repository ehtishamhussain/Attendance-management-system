<?php
if ($_SERVER['REQUEST_METHOD']=='POST'){
    include 'Utilities/dbconnect.php';
    $username=$_POST['hid'];
    $start_date=date($_POST['fromatt']);
    $end_date=date($_POST['toatt']);
   
   echo $username;




while (strtotime($start_date) <= strtotime($end_date)) {
    $sql="SELECT * FROM `attendance`WHERE 'Name'='$username'";
    $res=mysqli_query($conn,$sql);

    
    $sql="DELETE FROM `attendance` WHERE `Name`='$username'&&`Date`='$start_date';
    ";
$result=mysqli_query($conn,$sql);
    $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
    }
    if($res&&$result){
        header('Location:adminhome.php');
    }
}
   
?>