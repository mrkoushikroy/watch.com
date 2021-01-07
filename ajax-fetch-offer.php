<?php
session_start();
include"db/config.php";
$id= $_SESSION['id'];

$sql="SELECT offer.offer, u.name, offer.watch_id, w.title, offer.user_id, offer.oid FROM offer 
    INNER JOIN user u on  offer.user_id = u.uid 
    INNER JOIN watch w on  offer.watch_id = w.wid  
    where watch_id in(select wid from watch where user_id = '$id')  ";

$result = mysqli_query($conn, $sql);
$no=mysqli_num_rows($result);
$output = "";
$output = "<div class='h6'>Total offers for you: <span class='badge bg-success'>$no </span> </div>";
if(mysqli_num_rows($result)>0){
 $output.='<tr>
 <th scope="col">
     product
 </th>
 <th scope="col">Offer</th>
 <th scope="col">from</th>
 <th scope="col">oper.</th>
</tr>';
while($row = mysqli_fetch_assoc($result)){
  $output.=' <tr>
 <input type="text" value="'.$row['user_id'].'" hidden>
  <td scope="col">'.$row['title'].'</td>
  <td scope="col">'.$row['offer'].'</td>
  <td scope="col">'.$row['name'].'</td>
  <td scope="col"><button type="button" class="btn btn-sm btn-danger edit-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-wid="'.$row['watch_id'].'" data-oid="'.$row['oid'].'" data-eid="'.$row['user_id'].'">
  Accept & <br> message
</button>
</td>
</tr>';
}
$output.= '<br>';
mysqli_close($conn);
echo $output;
}
else{
  echo '<div class="alert alert-danger text-center h4" role="alert">No Offer found!</div>';
}

?>