<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
</style>
<?php
include "navbar.php";

?>
<div class="container mt-5">
    <?php
    include "apps/include.php";
    if (isset($_POST['view-replies'])) {
        $commentid = $_POST['commentid'];
        $username = $_POST['name'];
        $sql = mysqli_query($dbc, "SELECT  `content`, `userid`, `replydate` FROM `reply` WHERE `commentid`='$commentid'");
        if (!mysqli_num_rows($sql) == NULL) {
        echo '<h3 class="">Replied to ' . $username . '</h3>';
        while ($reply = mysqli_fetch_array($sql)) {
                $uid = $reply['userid'];
                $usql = mysqli_query($dbc, "SELECT `username`, `userimg` FROM `user` WHERE `userid`='$uid'");
                $user = mysqli_fetch_array($usql)
                    ?>
                <div class="mt-5">
                    <div class="comment border p-3 rounded mt-2">
                        <div class="comment-img">
                            <img src="<?php echo $user['userimg'] ?>" class="rounded-circle me-2" width="50px" alt="<?php echo $user_info['username']; ?>">
                            <span data-comentid="<?php echo $cid; ?>" id="replies-<?php echo ++$digit; ?>-name">
                                <?php echo $user['username'] ?>
                            </span>
                        </div>
                        <div class="comment-content">   
                            <div class="row mt-3">
                                <div class="col-8 col-md-9">
                                    <?php echo $reply['content'] ?>

                                </div>
                                <div class="col-4 col-md-3 text-end">
                                    <p class="comment-date">
                                        <?php echo $reply['replydate'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
            }
        } else {
            echo '<h2 class="text-muted">No Reply Found for '. $username .' !<?h2>';
        }
    }
    ?>
    </div>
</div>