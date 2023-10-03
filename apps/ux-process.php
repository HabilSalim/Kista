<div class="row mx-4">
    <div class="col-12">
        <?php
        include "include.php";
        $comment;
        $reply;
        $uplaod;
        $csqr = mysqli_query($dbc, "SELECT `commentid` FROM `comment` WHERE `userid`");
        $rsqr = mysqli_query($dbc, "SELECT `replyid` FROM `reply` WHERE `userid`");
        $psqr = mysqli_query($dbc, "SELECT `productid` FROM `product` WHERE `userid`");
        if (mysqli_num_rows($csqr) == 0) {
            $comment = 0;
        } else {
            $comment = mysqli_num_rows($csqr);
            while (mysqli_fetch_array($takecomment)) {
                ?>
                <div class="mx-2 my-3 p-3 shadow text-white rounded" style="background-color: #0c1432;">
                    <img class="rounded-circle me-2 " src="Images/Habil5.png" width="40" alt="Ngoupayou"> <?php echo $takecomment['repliername']?>
                    <p class="mx-5 my-3">Comment</p>
                    <div class="text-end">Date</div>
                </div>
                <?php
            }
            ;
        }
        if (mysqli_num_rows($rsqr) == 0) {
            $reply = 0;
        } else {
            $reply = mysqli_num_rows($rsqr);
        }
        if (mysqli_num_rows($psqr) == 0) {
            $uplaod = 0;
        } else {
            $uplaod = mysqli_num_rows($psqr);
        }
        ?>
    </div>
</div>