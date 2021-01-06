<?php 
  include "db/config.php";
  if(isset($_POST['title']) && isset($_POST['user_id']) && isset($_POST['description']) && isset($_POST['seeking']) ){
      
        $title = $_POST['title'];
        $user_id = $_POST['user_id'];
        $description = $_POST['description'];
        $seeking = $_POST['seeking'];
        

                $insertquery = "insert into watch(user_id, title, description, seeking) values('$user_id','$title', '$description', '$seeking')";

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