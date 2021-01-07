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
                <h2 class="text-center mb-2">Total Watches on WATCH.com</h2><br>
               <?php
                $sql="SELECT * FROM watch ORDER BY wid DESC";
                $result = mysqli_query($conn, $sql);
                $no=mysqli_num_rows($result);
                echo " <div><div class='mt-2  border border-dark rounded p-3'>
                <img class='bd-placeholder-img rounded-circle d-flex m-auto' width='140' height='140' src='img/logo.png'
                    alt='img1'><hr>
                        <div class='h4 text-center'>Total watches: <span class='badge bg-success'>$no </span></div></div>";
                if(mysqli_num_rows($result)<1){

                echo '<div class="alert alert-danger text-center h4" role="alert">No Product found!</div>';
                }

                ?>

            </div>
            </div>
            <div class="col-lg-6 col-12 p-4 ">
                <h2 class="text-center mb-2">Top 3 most-wanted watches</h2><br>
                <?php 
                
                $id= $_SESSION['id'];

                $sql="SELECT watch_id, w.title, count(watch_id) FROM offer o
                    INNER JOIN watch w on  o.watch_id = w.wid  
                    GROUP BY o.watch_id  ORDER BY count(watch_id) DESC LIMIT 3";
                $result = mysqli_query($conn, $sql);
                $no=mysqli_num_rows($result);
                if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                echo '<div class="row d-flex border border-dark p-2 my-2">
                <div class="col-lg-2 col-2 mb-1 comment">
                    <img class="p-2 rounded-circle border border-dark" src="img/logo.png" alt="">
                </div>
                <div class="col-lg-10  col-10  ">
                <b>Watch name: </b><b class="text-primary"> '.$row['title'].'</b>
                    <div>
                        <p> <b>Total offers: </b>'.$row['count(watch_id)'].'</p>
                    </div>
                    </div>
            </div>';
                
                }
                }
                else{
                    echo'<div class="alert alert-danger" role="alert">
                    No top most wanted watches!
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