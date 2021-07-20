<?php

require 'Utilities/navbar.php';
include 'Utilities/dbconnect.php';
session_start();


if(!isset($_SESSION['Loggedin'])||$_SESSION['Loggedin']!=true){
    header('location: admin.php');
    exit;
    
}

  ?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Admin Portal</title>
  </head>
  <body>
 
 <!--Modal start-->
 <!-- Button trigger modal -->



  
<table class="table table-hover">
    <thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Name</th>
    <th scope="col">Profile</th>
    <th scope="col">Attendance Grade</th>
    <th scope="col">Actions</th>
  </tr>
</thead>
  
<tbody>   

<tr> 

<?php 


$sql="SELECT * FROM `users`";
$result=mysqli_query($conn,$sql);

    $arrname=array();
    $arrdp=array();
    $arrgrade=array();
    $i=1;
     
    
    while($rec=mysqli_fetch_assoc($result)){
    $arrname[$i]=$rec["Name"];
    $arrdp[$i]=$rec["dp"];
    $arrgrade[$i]=$rec["Grade"];

    
    
    echo '<th scope="row">'. $i.'</th>
    <td>'.$arrname[$i].'</td>
    <td> <img src="'.$arrdp[$i].'" width=100 height=100></td>
    <td>'.$arrgrade[$i].'</td>
    <td> <button  type="button" class="btn btn-primary edat" data-bs-toggle="modal" data-bs-target="#add">
    Add
  </button> <button type="button" class="btn btn-primary edat" data-bs-toggle="modal" data-bs-target="#delete">
  Delete
</button> <button type="button" class="btn btn-primary edat" data-bs-toggle="modal" data-bs-target="#view">
View
</button>
<button type="button" class="btn btn-primary edat" data-bs-toggle="modal" data-bs-target="#check">
 Check Leaves
</button>

 </td>

    </tr>';
        $i+=1;

    

    }


    
    
   ?>


  
    </tbody>
</table>


<!-- Checking leaves modal-->


<!-- Modal -->
<div class="modal fade" id="check" tabindex="-1" aria-labelledby="check" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Check leave requests</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form style="display:inline;" action="adminleave.php" method="post">
<input  style="display:inline;" type="hidden" name="hid" id="hid4">
<input type="submit" style="display:inline;" class="btn btn-primary my-1 edat" value="Proceed">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

</form>
      </div>
      
    </div>
  </div>
</div>
 <!-- Adding attendance Modal -->
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="add" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add">Add Attendance</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="addattendance.php" method='post'>
        <input type="hidden" name="hid" id='hid'>
        <div class="mb-3">
    <label for="from" class="form-label">From</label>
    <input type="Date" class="form-control" id="from" name="fromatt" >

  </div>
  <div class="mb-3">
    <label for="to" class="form-label">To</label>
    <input type="Date" class="form-control" id="to" name="toatt" >

  </div>
  
  
    <input type="submit" class="btn btn-primary my-3" value="Add" >

  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </form>
      </div>
  
    </div>
  </div>
</div>
<!-- Deleting attendance Modal -->
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="delete" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delete">Delete Attendance</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="delattendance.php" method='post'>
      <input type="hidden" name="hid" id="hid2" >
        <div class="mb-3">
    <label for="from" class="form-label">From</label>
    <input type="Date" class="form-control" id="from" name="fromatt" >

  </div>
  <div class="mb-3">
    <label for="to" class="form-label">To</label>
    <input type="Date" class="form-control" id="to" name="toatt" >

  </div>
  
   
    <input type="submit" class="btn btn-primary my-3" value="Delete" >
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      </form>
      
    </div>
  </div>
</div>
<!-- Viewing attendance Modal -->
<div class="modal fade" id="view" tabindex="-1" aria-labelledby="view" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="view">View record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="recordforadmin.php" method='post'>
      <input type="hidden" name="hid" id="hid3" >
        <div class="mb-3">
    <label for="from" class="form-label">From</label>
    <input type="Date" class="form-control" id="from" name="fromatt" >

  </div>
  <div class="mb-3">
    <label for="to" class="form-label">To</label>
    <input type="Date" class="form-control" id="to" name="toatt" >

  </div>
  
   
    <input type="submit" class="btn btn-primary my-3" value="View" >
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
  var check=document.getElementsByClassName("edat");
  
  
  for (var i = 0 ; i < check.length; i++) {
   check[i].addEventListener('click', (e)=>{


    path=e.target.parentNode.parentNode;
    hid.value=path.getElementsByTagName("td")[0].innerText;
    hid2.value=path.getElementsByTagName("td")[0].innerText;
    hid3.value=path.getElementsByTagName("td")[0].innerText;
    hid4.value=path.getElementsByTagName("td")[0].innerText;
console.log(hid.value);

  } ) ; 
}

    </script>
  </body>
  
</html>