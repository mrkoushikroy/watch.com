<?php 
  include "db/config.php";
  if(isset($_POST['from_user_id']) && isset($_POST['to_user_id']) && isset($_POST['offerid']) && isset($_POST['text']) ){
      
        $from_user_id = $_POST['from_user_id'];
        $to_user_id = $_POST['to_user_id'];
        $offerid = $_POST['offerid'];
        $text = $_POST['text'];
        

                $insertquery = "insert into message(from_user_id, to_user_id, offer_id, text) values('$from_user_id','$to_user_id', '$offerid', '$text')";

                $iquery = mysqli_query($conn,$insertquery);
                if($iquery){
                echo'correct';
                }
                else{
                    echo'incorrect';
                }
                
            }
            else{
                echo "error ";
}
?>