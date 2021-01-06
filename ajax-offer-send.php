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
          ?>