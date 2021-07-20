
<?php
session_start();


if(!isset($_SESSION['Loggedin'])||$_SESSION['Loggedin']!=true){
    header('location: Login.php');
    exit;
}



include 'Utilities/dbconnect.php';




if ($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST)){
  
echo var_dump($_FILES);}
    }

/*$username=$_SESSION['username'];

    $filename=$_FILES["change"]['name'];
     $from=$_FILES["change"]['tmp_name'];

   
    $folder="images/".$filename;
    
   move_uploaded_file($from,$folder);
   
$sql="UPDATE `users` SET `dp` = 'image/cut.jpg' WHERE `users`.`S.No` = '$username'";
$run=mysqli_query($conn,$sql);

if($run){
    echo "query running";
}
else{
    echo "query not running";
}
}
}
?>;*/