<?php
session_start();
include"db/config.php";
$id= $_SESSION['id'];

$sql="SELECT offer.offer, u.name, w.title, offer.user_id, offer.oid FROM offer 
    INNER JOIN user u on  offer.user_id = u.uid 
    INNER JOIN watch w on  offer.watch_id = w.wid  
    where watch_id in(select wid from watch where user_id = '$id')  ";

$result = mysqli_query($conn, $sql);
$no=mysqli_num_rows($result);
$output = "";
if(mysqli_num_rows($result)>0){
 $output='<br>';
while($row = mysqli_fetch_assoc($result)){
    // $output.=$row['offer'];
    // $output.=$row['name'];
    // $output.=$row['title'];
    // $output.=$row['user_id'];
  $output.=' <tr>
 <input type="text" value="'.$row['user_id'].'" hidden>
  <td scope="col">'.$row['title'].'</td>
  <td scope="col">'.$row['offer'].'</td>
  <td scope="col">'.$row['name'].'</td>
  <td scope="col"><button type="button" class="btn btn-sm btn-danger edit-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-oid="'.$row['oid'].'" data-eid="'.$row['user_id'].'">
  Accept
</button>
</td>
</tr>';
//   <h4 class="text-center">'.$row['offer'].'</h4>';
//   <p >Description: '.$row['description'].'</p>
//   <p >Seeking: '.$row['seeking'].'</p>
//   <p ><small>Posted on: '.$row['submitted'].'</small></p>
// </div>';
// // $output.= '<tr>
// <td scope="row">'.$row['pid'].'</td>
// <td>'.$row['pname'].'</td>
// <td widtd="15%">'.$row['pdesc'].'</td>
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

