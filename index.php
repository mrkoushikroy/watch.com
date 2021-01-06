<?php
session_start();
require_once"db/config.php";
$id = $_SESSION['id'];
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

    <div class="container mt-3">
        <h2 class="text-center">Watches</h2>
        <div class="row" id="table-data">

        </div>

    </div>


    <!-- Button trigger modal -->


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
                <!-- <label for="user_id">user_id</label> -->
                <input type="text" class="form-control" id="user_id" name="user_id"  value="<?php echo $id; ?>">
            </div>
            <div class="form-group">
                <!-- <label for="offer">watch_id</label> -->
                <input type="text" class="form-control" id="watch_id" name="watch_id">
            </div>
            <div class="form-group">
                <label for="offer">Enter offer</label>
                <input type="text" class="form-control" id="offer" name="offer" placeholder="Enter offer">
            </div>
            <button type="button" class="btn btn-primary" onclick="modalsubmit()">Submit</button>
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
    $(document).ready(function() {
        function loadtable() {
            $.ajax({
                url: "ajax-fetch-product.php",
                type: "POST",
                success: function(data) {
                    $("#table-data").html(data);
                }
            });
        }
        loadtable();

        $(document).on("click", ".edit-btn", function() {
            var prodid = $(this).data('eid');
            // alert(prodid);
            $('#watch_id').val(prodid);

        });
    });

    function modalsubmit() {
        var watch_id = jQuery('#watch_id').val();
        var user_id = jQuery('#user_id').val();
        var offer = jQuery('#offer').val();
        $.ajax({
                url: "ajax-offer-send.php",
                type: "POST",
                data: 'watch_id='+watch_id+'&user_id='+user_id+'&offer='+offer,
          success: function(data){
              alert(data);
              if(data == "correct"){
                jQuery('#frm_error').removeClass('d-none');
                jQuery('#frm_error').removeClass('alert-danger');
                jQuery('#frm_error').html('offer send successfully');
              }
              else{
                jQuery('#frm_error').removeClass('d-none');
                jQuery('#frm_error').removeClass('alert-success');
                jQuery('#frm_error').html('You have already send offer');
              }
            }
            });
        }

    </script>

        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity = "sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
    crossorigin = "anonymous" >
    </script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>

</html>