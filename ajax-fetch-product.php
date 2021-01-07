<?php
session_start();
$id = $_SESSION['id'];
include"db/config.php";
$sql="SELECT * FROM watch where (user_id != '$id') ORDER BY wid DESC";
$result = mysqli_query($conn, $sql);
$no=mysqli_num_rows($result);
$output = "";
$output = "<div class='h4'>Total products for you: <span class='badge bg-success'>$no </span></div>";
if(mysqli_num_rows($result)>0){
 $output.='<br>';
while($row = mysqli_fetch_assoc($result)){
  $output.='<div class="col-lg-4 mt-2  border border-dark rounded p-3">
  <img class="bd-placeholder-img rounded-circle d-flex m-auto" width="140" height="140" src="img/logo.png"
      alt="img1"><hr>
  <h4 class="text-center">'.$row['title'].'</h4>
  <p >Description: '.$row['description'].'</p>
  <p >Seeking: '.$row['seeking'].'</p>
  <p ><small>Posted on: '.$row['submitted'].'</small></p>';
  $ww_id = $row['wid'];
  $check = "SELECT oid FROM offer where ( accepted = TRUE AND watch_id='$ww_id')";
  $con_check = mysqli_query($conn, $check);
  if(mysqli_num_rows($con_check)>0){
      $output.= '<p>Offer: <strong class="text-success">Unavailable</strong> (Someone got this)</p>';
  }
  else{
      $output.= '<p>Offer: <strong class="text-danger">active</strong></p>';
  }
  $output.='<button type="button" class="btn btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-eid="'.$row['wid'].'">
  Send offer
</button>
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




