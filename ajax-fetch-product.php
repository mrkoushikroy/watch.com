<?php
session_start();
$id = $_SESSION['id'];
include"db/config.php";
$sql="SELECT * FROM watch where user_id != '$id' ORDER BY wid DESC";
$result = mysqli_query($conn, $sql);
$no=mysqli_num_rows($result);
$output = "";
if(mysqli_num_rows($result)>0){
 $output='<br>';
while($row = mysqli_fetch_assoc($result)){
  $output.='<div class="col-lg-4 mt-2  border border-dark rounded p-3">
  <img class="bd-placeholder-img rounded-circle d-flex m-auto" width="140" height="140" src="img/logo.png"
      alt="img1"><hr>
  <h4 class="text-center">'.$row['title'].'</h4>
  <p >Description: '.$row['description'].'</p>
  <p >Seeking: '.$row['seeking'].'</p>
  <p ><small>Posted on: '.$row['submitted'].'</small></p>
  
  <button type="button" class="btn btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-eid="'.$row['wid'].'">
  Send offer
</button>
</div>';
// $output.= '<tr>
// <th scope="row">'.$row['pid'].'</th>
// <td>'.$row['pname'].'</td>
// <td width="15%">'.$row['pdesc'].'</td>
// <td>'.$row['psupplier'].'</td>
// <td>'.$row['ptype'].'</td>
// <td>'.$row['punit'].'</td>
// <td>'.$row['ppp'].'</td>
// <td>'.$row['pquant'].'</td>
// <td>'.$row['psp'].'</td>
// <td>'.$row['plocation'].'</td>';

// $output.= "<td><button class='btn btn-info edit-btn'  data-toggle='modal' data-target='#exampleModal' data-eid='".$row['pid']."'>Edit</button></td></tr>";
}
$output.= '<br>';
mysqli_close($conn);
echo $output;
}
else{
    echo '<div class="alert alert-danger text-center h4" role="alert">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No movies found!&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </div>';
}

?>




