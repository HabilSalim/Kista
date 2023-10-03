<?php
session_start();
include "navbar.php";
if (isset($_SESSION['userid'])){
  echo '<div class="text-end mt-3"><a href="ux.php"<button class="btn btn-info text-white mb-1" >Dashboard</button></a></div>';
 };
  ?>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
<link rel="stylesheet" type="text/css" href="css/mdb.css">

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/mdb.js"></script>
<script src="js/bootstrap.js"></script>

<div class="container grid gap-3">
  <div class="row ">
    <?php
    include "apps/include.php";

    $qry = mysqli_query($dbc, "SELECT `productid`, `userid`, `productname`, `productimg`, `productquantity`, `productprice`, `productdate` FROM `product`");
    while ($data = mysqli_fetch_array($qry)) {
      $ppid=$data['productid'];
      $usid=$data['userid'];
      $com_number;
    $slcomentqry = mysqli_query($dbc, "SELECT `commentid` FROM `comment` WHERE `productid`='$ppid'");
    if(mysqli_num_rows($slcomentqry)==null){
      $com_number=0;
    }else{
      $com_number=mysqli_num_rows($slcomentqry);
    }
    ?>
      <div class="col-lg-3 card-imgs col-md-4 col-sm-6 mt-3"data-id="<?php echo $data['productid']?>">
        <div class="card p-2 shadow ">
          <img src="<?php echo $data["productimg"] ?>" class="card-img-top rounded " style="height:200px;object-fit: cover;" />
          <div class="card-body ">

            <h5 class="card-title">
              <?php echo $data["productname"] ?>
            </h5>
            <p class="card-text">
              <?php echo $data["productprice"] ?> FCFA
            </p>
            <p class="card-text">
              <?php echo $data["productquantity"] ?> units
            </p>
            <div class="row">
              <div class="col-7">
                <p class="card-text">Comments: <?php echo $com_number?></p>
                <p class="card-text">By 
                  <?php
                  $d=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT `username` FROM `user` WHERE `userid`='$usid'"));
                  echo $d['username'];
                ?></p>
              </div>
              <div class="col-5">
                <p class="card-text text-end">
                  <?php echo $data["productdate"] ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php
    }
    ?>
  </div>
</div>
<style>
  .card-imgs:hover{
    cursor:pointer;
  }
</style>
<script>
  $(".card-imgs").click(function(){
    var id= $(this).attr("data-id");
 window.location.href="product-card.php?id="+id;
  });
</script>
<!---- Cards ---->