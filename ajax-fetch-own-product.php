<?php
session_start();
$id = $_SESSION['id'];
include"db/config.php";
$sql="SELECT * FROM watch where user_id = '$id' ORDER BY wid DESC";
$result = mysqli_query($conn, $sql);
$no=mysqli_num_rows($result);
$output = "";
$output = "<div class='h6'>Total added products: <span class='badge bg-success'>$no </span> </div>";
if(mysqli_num_rows($result)>0){
 $output.='<br>';
while($row = mysqli_fetch_assoc($result)){
  $output.='<div class="col-6 mt-2  border border-dark rounded p-3">
  <h4 class="text-center">'.$row['title'].'</h4>
  <p >Description: '.$row['description'].'</p>
  <p >Seeking: '.$row['seeking'].'</p>
  <p ><small>Posted on: '.$row['submitted'].'</small></p>
</div>';
}
$output.= '<br>';
mysqli_close($conn);
echo $output;
}
else{
    echo '<div class="alert alert-danger text-center h4" role="alert">No Product found!</div>';
}

?>



