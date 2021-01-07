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
    <div class="container">

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

            <div class="col-lg-5 ml-1 col-12">
                <h5 class="text-center">Your offers</h5>
                <table class="table ">
                    <thead >
                        
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send offer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success alert-danger d-none" role="alert" id="frm_error"></div>
                    <form method="post">
                        <div class="form-group">
                                        <div class="alert alert-success text-center d-none" id="alert_accept" role="alert">
                                        
                                        </div>
                            <!-- <label for="user_id">offer_id</label> -->
                            <input type="text" class="form-control" id="offer_id" hidden>
                            <input type="text" class="form-control" id="w_id" hidden>
                        </div>
                            <label for="">Are you sure want to accept ? </label>
                        <button type="button" class="btn btn-success" id="accept" onclick="Accept()">Accept</button>

                        <hr><div class="form-group">
                            <input type="text" class="form-control" id="from_user_id" name="from_user_id" placeholder="from user i.e. seesion user" value="<?php echo $_SESSION['id']; ?>" hidden>
                            <input type="text" class="form-control" id="to_user_id" name="to_user_id" placeholder="Enter message" hidden>
                            <input type="text" class="form-control" id="offerid" name="offerid" placeholder="Enter message" hidden>
                            <label for="message">Your Message</label>
                            <input type="text" class="form-control my-1" id="text" name="text " placeholder="Enter message">
                        </div>
                        <button type="button" class="btn btn-primary mt-2" id="textbtn" onclick="Message()">Send</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
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
                // alert(data);
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
            var to_user_id = $(this).data('eid');
            var offer_id = $(this).data('oid');
            var wa_id = $(this).data('wid');
            $('#offer_id').val(offer_id);
            $('#offerid').val(offer_id);
            $('#w_id').val(wa_id);
            $('#to_user_id').val(to_user_id);
        });
    });

    $(document).ready(function() {
        function loadoffer() {
            $.ajax({
                url: "ajax-fetch-offer.php",
                type: "POST",
                success: function(data) {
                    // alert(data);
                    $("#table-offer").html(data);
                }
            });
        }
        loadoffer();

    });

    function Accept() {
        var oid = $('#offer_id').val();
        var w_id = $('#w_id').val();
        // alert(oid);
        $.ajax({
            url: "ajax-accept-offer.php",
            type: "POST",
            data: 'oid=' + oid+'&w_id='+w_id,
            success: function(data) {
                // alert(data);
                if (data == 'correct') {
                    $('#accept').html('accepted');
                    $('#alert_accept').removeClass('d-none');
                    $('#alert_accept').html('Offer accepted.. please send a message to the buyer');

                }
                else{
                    $('#alert_accept').removeClass('d-none');
                    $('#alert_accept').html(data);
                }
            }
        });
    }

    function Message() {
        var offerid = $('#offerid').val();
        var from_user_id = $('#from_user_id').val();
        var to_user_id = $('#to_user_id').val();
        var text = $('#text').val();
        $('#alert_accept').html('');
        $.ajax({
            url: "ajax-message.php",
            type: "POST",
            data: 'from_user_id=' + from_user_id+'&to_user_id='+to_user_id+'&offerid='+offerid+'&text='+text,
            success: function(data) {
                // alert(data);
                if (data == 'correct') {
                    $('#textbtn').html('Sent');
                    $('#alert_accept').removeClass('d-none');
                    $('#alert_accept').html('Message sent successfully');
                }
                else{
                    $('#alert_accept').removeClass('d-none');
                    $('#alert_accept').html('message not sent');
                }
            }
        });
    }
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
<?php
}
else{
  header('location:login.php');
}
?>