<?php 
  include "db/config.php";
  if(isset($_POST['oid']) && isset($_POST['w_id'])){
      
        $oid = $_POST['oid'];
        $w_id = $_POST['w_id'];

        $check = "SELECT oid FROM offer where ( accepted = TRUE AND watch_id='$w_id'  )";
  $con_check = mysqli_query($conn, $check);
  if(mysqli_num_rows($con_check)>0){
      echo 'You have already accepted Offer on this watch';
  }
  else{
                $updatequery = "UPDATE offer SET accepted = TRUE WHERE oid = '$oid'";

                $iquery = mysqli_query($conn,$updatequery);
                if($iquery){
                echo'correct';
                }
                else{
                    echo'incorrect';
                }
                }
                
            }
            else{
                echo "error ";
}
?>