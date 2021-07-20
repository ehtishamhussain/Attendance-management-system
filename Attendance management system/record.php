
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Record</title>
  </head>


<body>




<?php
session_start();

if(!isset($_SESSION['Loggedin'])||$_SESSION['Loggedin']!=true){
    header('location: Login.php');
    exit;
}
?>
<?php
include 'Utilities/dbconnect.php';
$username=$_SESSION['username'];

//$num=mysqli_num_rows($output); 
//echo $num;

//while($rec=mysqli_fetch_assoc($output)){



?>
<table class="table table-hover">
    <thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Date</th>
    <th scope="col">Status</th>
  </tr>
</thead>
  
<tbody>   

<tr> 

<?php 

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $fdate=$_POST["from"];
    $ldate=$_POST["to"];
    $sql="SELECT * FROM `attendance` WHERE `Name`='$username'&& `Status`=1&& Date BETWEEN '$fdate' AND '$ldate'";
    $output=mysqli_query($conn,$sql);
    $arrdate=array();
    $arrpresent=array();
    $i=1;
     
    
    while($rec=mysqli_fetch_assoc($output)){
    $arrdate[$i]=$rec["Date"];
    $arrpresent[$i]="Present";
    
    
    echo '<th scope="row">'. $i.'</th>
    <td>'.$arrdate[$i].'</td>
    <td>'.$arrpresent[$i].'</td>
    </tr>';
        $i+=1;
    }


    
    }
   ?>


  
    </tbody>
</table>


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