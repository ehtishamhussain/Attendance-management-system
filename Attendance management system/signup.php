

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Sign up</title>
  </head>
<body>
  <?php
  require 'Utilities/navbar.php';
  
  ?>
  <?php

if ($_SERVER['REQUEST_METHOD']=='POST'){
    include 'Utilities/dbconnect.php';
    $username=$_POST['username'];
    $password=$_POST['Password'];
    $cpassword=$_POST['cpassword'];
    //profile picture settings
    
    $filename=$_FILES["picture"]['name'];
   $from=$_FILES["picture"]['tmp_name'];

   
    $folder="images/".$filename;
    
   move_uploaded_file($from,$folder);

    $sql="SELECT * FROM `users` WHERE Name='$username' ";
    
    $existssql=mysqli_query($conn,$sql);

    $rows=mysqli_num_rows($existssql);
    if($rows>0){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Username already exists.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    
    else{
        if($cpassword==$password){
    $sql="INSERT INTO `users` ( `Name`, `Password`, `Date/time`, `dp`) VALUES ( '$username', '$password', current_timestamp(), '$folder')";
    $result=mysqli_query($conn,$sql);

    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Sucess!</strong> Your account has been created successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> Your password does not match.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }

}
}


?>
  <div class="container">
    <h1 class="text-center mt-5">Sign Up!</h1>
    <form action="/Login/signup.php" method='post' enctype="multipart/form-data">
  <div class="mb-3">
    <label for="username" class="form-label">Enter your full name</label>
    <input type="text" class="form-control" id="username" name="username" >

  </div>
  <div  class="mb-3">
    <label for="Password" class="form-label">Password</label>
    <input type="password" class="form-control" id="Password" name="Password">
  </div>
  <div class="mb-3">
    <label for="Confirm_password" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="Confirm_password"  name="cpassword" aria-describedby="chelp">
    <div id="chelp" class="form-text">Make sure you enter correct password.</div>
  </div>
  <div class="mb-3">
    <label for="Picture_upload" class="form-label">Upload Picture</label>
    <input type="file" class="form-control" id="Picture_upload"  name="picture" >
    
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>
</html>