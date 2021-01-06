<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Watch.com official!</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
  <div class="container-fluid">
  <a href="/" class="navbar-brand">
                    <img class="rounded-circle" width="50" height="50" src="img/logo.png"
                        alt=""></a>
    <a class="navbar-brand" href="/">WATCH.com</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <?php
                            if(isset($_SESSION['id'])){ ?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="product.php">Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="message.php">Messages</a>
        </li>
        <?php
                            }
                            ?>
      </ul>
      <form class="d-flex">
      <?php
                            if(isset($_SESSION['id'])){
                                echo '<a type="button" class="btn btn-info mr-2 text-light"><i class="fa fa-user-circle" aria-hidden="true"></i> Welcome ' .$_SESSION["name"]. '</a>&nbsp;
                                <a href="logout.php" type="button" class="btn mr-2 btn-sm btn-primary"><i class="fa fa-power-off" aria-hidden="true"></i></a>';
                               
                         }
                        else{
                            echo'<a href="login.php" type="button" class="btn mr-2  btn-info">Login</a>
                            <a href="register.php" type="button" class="btn mr-2  btn-info">Signup</a>';

                        }
                        ?>
      </form>
    </div>
  </div>
</nav>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    
  </body>
</html>

