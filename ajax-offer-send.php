<?php
session_start();
require_once"db/config.php";
if(isset($_POST["watch_id"]) && isset($_POST["user_id"]) && isset($_POST["offer"]) )
{
    $watch_id =mysqli_real_escape_string($conn, $_POST['watch_id']);
    $user_id =mysqli_real_escape_string($conn, $_POST['user_id']);
    $offer =mysqli_real_escape_string($conn, $_POST['offer']);

    if(empty($watch_id) && empty($user_id) && empty($offer)){
        echo 'Enter all fields';
    }
    else {
        $check = "SELECT * FROM offer where watch_id='$watch_id' AND accepted=TRUE";
        $con_check = mysqli_query($conn, $check);
        if(mysqli_num_rows($con_check)>0){
            echo 'Offer already accepted on this watch, try another watch';
        }
        else{
        $offerup = "insert into offer(user_id, watch_id, offer, accepted) values('$user_id','$watch_id','$offer', false)";
        $con_update= mysqli_query($conn, $offerup);
        if($con_update){
            echo 'correct';
        }
        else{
            echo 'incorrect';
            
        }
    }

    }

    }
          ?>