<?php
session_start();
require_once"db/config.php";
if(isset($_SESSION['id'])){
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <?php include"navbar.php"; ?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-6 col-12 p-4 ">
                <h2 class="text-center mb-2">Inbox</h2>
                <?php 
                
                $id= $_SESSION['id'];

                $sql="SELECT m.text, u.name, m.sent FROM message m
                    INNER JOIN user u on  m.from_user_id = u.uid  
                    where to_user_id = '$id'  ";
                $result = mysqli_query($conn, $sql);
                $no=mysqli_num_rows($result);
                if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                echo '<div class="row d-flex border border-dark p-2 mb-2">
                        <div class="col-lg-2 col-2 mb-1 comment">
                            <img class="p-2 rounded-circle border border-dark" src="img/avatar.png" alt="">
                        </div>
                        <div class="col-lg-10  col-10  ">
                        <b>From: </b><b class="text-primary"> '.$row['name'].'</b> <small><span class="badge bg-dark ">'.$row['sent'].'</span></small>
                            <div>
                                <p> <b>Message: </b>'.$row['text'].'</p>
                            </div>
                            </div>
                    </div>';
                    
                }
                }
                else{
                    echo'<div class="alert alert-danger" role="alert">
                    Inbox empty wait for someone to response your offer!
                  </div>';
                }
                ?>



            </div>
            <div class="col-lg-6 col-12 p-4 ">
                <h2 class="text-center mb-2">Outbox</h2>
                <?php 
                
                $id= $_SESSION['id'];

                $sql="SELECT m.text, u.name, m.sent FROM message m
                    INNER JOIN user u on  m.to_user_id = u.uid  
                    where from_user_id = '$id'  ";
                $result = mysqli_query($conn, $sql);
                $no=mysqli_num_rows($result);
                if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                echo '<div class="row d-flex border border-dark p-2 mb-2">
                <div class="col-lg-2 col-2 mb-1 comment">
                    <img class="p-2 rounded-circle border border-dark" src="img/avatar.png" alt="">
                </div>
                <div class="col-lg-10  col-10  ">
                <b>To: </b><b class="text-primary"> '.$row['name'].'</b> <small><span class="badge bg-dark ">'.$row['sent'].'</span></small>
                    <div>
                        <p> <b>Message: </b>'.$row['text'].'</p>
                    </div>
                    </div>
            </div>';
                
                }
                }
                else{
                    echo'<div class="alert alert-danger" role="alert">
                    Outbox empty add product -> accept offer and send message!
                  </div>';
                }
                ?>

            </div>
        </div>
    </div>



    <script src="js/jquery.js"></script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>
<?php
}
else{
  header('location:login.php');
}
?>