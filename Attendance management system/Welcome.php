<!--if($username=="$result.['name']"){
    echo '<form action="" method="post">
    <img src="'.$result['dp'].'/>
    <input type="file" name="edit">
    <input type="submit" value="upload">
    
    </form>';-->
<?php
session_start();

if(!isset($_SESSION['Loggedin'])||$_SESSION['Loggedin']!=true){
    header('location: Login.php');
    exit;
    
}

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Welcome-<?php echo $_SESSION['username']?></title>
</head>
<body>
<?php
include 'Utilities/navbar.php';
include 'Utilities/dbconnect.php';

//Grading code----------------------------------------------------
$username=$_SESSION['username'];
$sql="SELECT * FROM `attendance` WHERE `Status`=1&& `Name`='$username'";
$reaction=mysqli_query($conn,$sql);

$presentarr=array();
$i=0;
while($rec=mysqli_fetch_assoc($reaction)){
$presentarr[$i]=$rec["Date"];
$i+=1;
}

$value=count($presentarr);


$graddate=date("t");


if ($graddate=30||$graddate=31){
    
  

    $cal=30-$value;
    
    switch($cal){
      case ($cal<9):
        $sql="UPDATE `users` SET `Grade` = 'A' WHERE `users`.`Name` = '$username'";
      $r1=mysqli_query($conn,$sql);
      break;

      case 9:
      $sql="UPDATE `users` SET `Grade` = 'A' WHERE `users`.`Name` = '$username'";
      $r1=mysqli_query($conn,$sql);
      break;
      
    
    case 12:
      $sql="UPDATE `users` SET `Grade` = 'B' WHERE `users`.`Name` = '$username'";
      $r2=mysqli_query($conn,$sql);
    break;
    case 14:
      $sql="UPDATE `users` SET `Grade` = 'C' WHERE `users`.`Name` = '$username'";
      $r3=mysqli_query($conn,$sql);
    break;
    default:
      
      $sql="UPDATE `users` SET `Grade` = 'D' WHERE `users`.`Name` = '$username'";
      $r4=mysqli_query($conn,$sql);
      break;
    }
}
elseif($graddate=28){
  switch($cal){
    case 11:
    $sql="UPDATE `users` SET `Grade` = 'A' WHERE `users`.`Name` = '$username'";
    $r1=mysqli_query($conn,$sql);
break;
  
  case 14:
    $sql="UPDATE `users` SET `Grade` = 'B' WHERE `users`.`Name` = '$username'";
    $r2=mysqli_query($conn,$sql);
break;
  
  case 17:
    $sql="UPDATE `users` SET `Grade` = 'C' WHERE `users`.`Name` = '$username'";
    $r3=mysqli_query($conn,$sql);
break;
  default:
    $sql="UPDATE `users` SET `Grade` = 'D' WHERE `users`.`Name` = '$username'";
    $r4=mysqli_query($conn,$sql);
break;
  }
}


//End of grades
?>
<?php 
if ($_SERVER['REQUEST_METHOD']=='POST'){


     $username=$_SESSION['username'];
    
    

     $sql="SELECT * FROM `users` WHERE `Name`='$username'";
     $output=mysqli_query($conn,$sql);
     
    $filename=$_FILES["change"]['name'];
    $from=$_FILES["change"]['tmp_name'];
 
    
     $folder="images/".$filename;
     
    move_uploaded_file($from,$folder);
    $username=$_SESSION['username'];
    
    $sql="UPDATE `users` SET `dp` = '$folder' WHERE `users`.`Name` ='$username'";
    $run=mysqli_query($conn,$sql);
    

}
?>
<?php $sql="SELECT * FROM `attendance`WHERE Name='$username'";
    $res=mysqli_query($conn,$sql);
    $arr=array();
    $i=0;
  while($resar=mysqli_fetch_assoc($res)){
  $arr[$i]=$resar["Date"];
  $i+=1;
  }
  
  $checkdate=date(end($arr));
 
  $stop_date = date('Y-m-d ', strtotime($checkdate . ' +1 day'));
  

  $current=date("Y-m-d");
  if($current==$checkdate){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Attendance marked successfully visit tomorrow</strong> 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  ?>

    <div class="container text-center">
    <h2 class="mt-10">Welcome <?php echo $_SESSION['username']?></h2>
    <!--Describing variable here then div for user panel-->
    <?php
    $username=$_SESSION['username'];
    ?>
    <div id="userpanel">
    <h3>Attendance Marking </h3>

       <?php

$data="SELECT * FROM `users` WHERE `Name`='$username'";


$final=mysqli_query($conn,$data);
$result=mysqli_fetch_assoc($final);
$image=$result["dp"];



    
echo '<img src="'.$image.'" alt='.$username.'" width="500" height="300"/>';
    
?>
<form action="/Login/welcome.php" method='post' enctype="multipart/form-data">

    <input type="file" class="form-control my-2" id="Picture_update"  name="change" >
    <input class="btn btn-primary my-2" type="submit" value="Upload">
    </form>

  
  
  <?php
  $sql="SELECT * FROM `attendance`WHERE Name='$username'";
  $res=mysqli_query($conn,$sql);
  $arr=array();
  $i=0;
while($resar=mysqli_fetch_assoc($res)){
$arr[$i]=$resar["Date"];
$i+=1;
}

$checkdate=date(end($arr));

$stop_date = date('Y-m-d ', strtotime($checkdate . ' +1 day'));


$current=date("Y-m-d");
  if ($current==$checkdate){
  
    //Buttons    
    echo' <form style="display:inline" action="Present.php"  method="post">
    <input type="hidden" id="usatt">
    <input class="btn btn-primary my-3" type="submit" id="pr" disabled="disabled" value="Mark Present" >
    </form>';
    
    }
    else{
      echo '<form style="display:inline" action="Present.php" method="post">
      <input type="hidden" id="usatt">
      <input class="btn btn-primary" type="submit" id="pr" value="Mark Present" >
      </form>';
      
     
    }
    
    ?>




  <!-- Button trigger modal -->
<button type="button" id="sr"class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
View </button>
<button type="button" style="display:inline;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#leave">
  Request Leave
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Attendance</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/Login/record.php" method='post'>
  <div class="mb-3">
    <label for="from" class="form-label">From</label>
    <input type="date" name="from"class="form-control" id="from" >
   
  <div class="mb-3">
    <label for="to" class="form-label">To</label>
    <input type="date" class="form-control" name="to" id="to">
  </div>
 
  <button type="submit" id="dtbtn"class="btn btn-primary">Submit</button>
</form>
      </div>
      
    </div>
  </div>
</div>

    </div>

    </div>
    <!--MODAL end------------------------------------------------------------------->
   <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="leave" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request Leave</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/Login/Leave.php" method='post'>
      <div class="form-floating">
      
  <textarea class="form-control" name="request" placeholder="Enter your request here" id="floatingTextarea"></textarea>
  <label for="floatingTextarea"></label>
</div>
  

  <button style="display:inline;" type="submit" class="btn btn-primary my-3 ">Submit</button>
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</form>

      </div>
     
    </div>
  </div>
</div>
     <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
    <script>
    var check=document.getElementById("pr");
    var io=check.addEventListener('click', (e)=>{
      
      (function(){
        alert("You attendance is marked successfully");
      return true;
      })();
      
     
    }
    );
    </script>

</body>
</html>