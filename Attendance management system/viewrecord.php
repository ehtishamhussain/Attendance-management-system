
<?php
include 'Utilities/dbconnect.php';
$username=$_SESSION['username'];




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
    $sql="SELECT * FROM `attendance` WHERE `Name`='$username'&&`Status`=1&& Date BETWEEN '$fdate' AND '$ldate'";
    $output=mysqli_query($conn,$sql);
    $arrdate=array();
    $arrpresent=array();
    $i=0;
     
    
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