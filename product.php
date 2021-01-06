<?php
session_start();
require_once"db/config.php";
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <?php include"navbar.php"; ?>
    <div class="container-fluid mt-3">
        <div class="tb1 mt-2">
            <h5 class="text-center">Add Watch</h5>
            <table class="table">
                <thead>
                    <tr>

                        <div class="alert alert-success alert-success d-none" id="pmsg" role="alert">
                        </div>
                    </tr>
                    <tr>
                        <th scope="col" width="11%">
                            <!-- <label for="user_id">user id</label> -->
                            <input type="text" class="form-control fieldadd" id="user_id"
                                value="<?php echo $_SESSION['id']; ?>" hidden>
                        </th>
                        <th scope="col" width="11%">
                            <label for="title">Watch Title</label>
                            <input type="text" class="form-control fieldadd" id="title" placeholder="product title">
                        </th>
                        <th scope="col" width="11%">
                            <label for="description">Watch description</label>
                            <input type="text" class="form-control fieldadd" id="description"
                                placeholder="product description">
                        </th>

                        <th scope="col" width="11%">
                            <label for="seeking">Seeking</label>
                            <input type="text" class="form-control fieldadd" id="seeking"
                                placeholder="Enter what do you want ">
                        </th>

                        <th scope="col" width="11%">
                            <button class="btn btn-sm btn-success" type="button" id="add"
                                onclick="addproduct()">Add</button>
                        </th>

                    </tr>

                </thead>
            </table><br>

        </div>
    </div>
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-6 col-12">
                <h5 class="text-center">
                    your added products
                </h5>
                <div class="row" id="table-data">
                    <div class="col-lg-4 mt-2  border border-dark rounded p-3">
                        <img class="bd-placeholder-img rounded-circle d-flex m-auto" width="140" height="140"
                            src="img/logo.png" alt="img1">
                        <hr>
                        <h4 class="text-center">'.$row['title'].'</h4>
                        <p>Description: '.$row['description'].'</p>
                        <p>Seeking: '.$row['seeking'].'</p>
                        <p><small>Posted on: '.$row['submitted'].'</small></p>
                        <div class="d-flex">
                            <label for="offer">Your offer</label>
                            <input type="text  fieldadd offer" placeholder="Enter offer ">
                            <button class="btn btn-sm btn-info edit-btn" data-toggle="modal" data-target="#exampleModal"
                                data-eid="'.$row['wid'].'">Send</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <h5 class="text-center">Your offers</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    product
                                </th>
                                <th scope="col">Offer</th>
                                <th scope="col">from</th>
                                <th scope="col">oper.</th>
                            </tr>
                        </thead>
                        <tbody id="table-offer">
                            <tr>
                                    <th scope="col">product</th>
                                    <th scope="col">Offer</th>
                                    <th scope="col">from</th>
                                    <th scope="col"><button class="bt btn-sm btn-danger">Accept & <br> message</button></th>
                            </tr>

                        </tbody>
                    </table>

            </div>
        </div>
    </div>




    <script src="js/jquery.js"></script>
    <script type="text/javascript">
    function addproduct() {

        var user_id = jQuery('#user_id').val();
        var title = jQuery('#title').val();
        var description = jQuery('#description').val();
        var seeking = jQuery('#seeking').val();
        $.ajax({
            url: "ajax-product-add.php",
            type: "POST",
            data: 'user_id=' + user_id + '&title=' + title + '&description=' + description +
                '&seeking=' + seeking,
            success: function(data) {
                alert(data);
                if (data == 'correct') {
                    $('#pmsg').html('Watch added');
                    $('#pmsg').removeClass('d-none');
                    $('#pmsg').removeClass('alert-danger');
                    $('.fieldadd').html('');
                } else {

                }
            }
        });

        loadtable();
    }

    $(document).ready(function() {
        function loadtable() {
            $.ajax({
                url: "ajax-fetch-own-product.php",
                type: "POST",
                success: function(data) {
                    $("#table-data").html(data);
                }
            });
        }
        loadtable();

        $(document).on("click", ".edit-btn", function() {
            var from_user_id = $(this).data('eid');
            var offer_id = $(this).data('oid');
            alert(from_user_id);
            alert(offer_id);
            // $('#activityID').val(movieid);

        });
    });

    $(document).ready(function() {
        function loadoffer() {
            $.ajax({
                url: "ajax-fetch-offer.php",
                type: "POST",
                success: function(data) {
                    alert(data);
                    $("#table-offer").html(data);
                }
            });
        }
        loadoffer();

        // $(document).on("click", ".edit-btn", function() {
        //     var prodid = $(this).data('eid');
        //     alert(prodid);
        // $('#activityID').val(movieid);

        // });
    });
    </script>

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