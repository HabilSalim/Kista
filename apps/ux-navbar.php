<script type="text/javascript" src="js/jquery.js"></script>
<?php
$name = $_SESSION['username'];
$slsql = "SELECT `userid`, `useremail`, `userimg` FROM `user` WHERE `username`='$name'";
$slqry = mysqli_query($dbc, $slsql);
$data = mysqli_fetch_array($slqry);
$email = $data['useremail'];
$id = $data['userid'];
$userimg = $data['userimg'];
?>
<nav class="navbar navbar-expand-lg" style="margin-bottom:4px !important;">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-info mb-2">
            <svg class="svg-inline--fa fa-align-left fa-w-14" aria-hidden="true" data-prefix="fas"
                data-icon="align-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                data-fa-i2svg="">
                <path fill="currentColor"
                    d="M288 44v40c0 8.837-7.163 16-16 16H16c-8.837 0-16-7.163-16-16V44c0-8.837 7.163-16 16-16h256c8.837 0 16 7.163 16 16zM0 172v40c0 8.837 7.163 16 16 16h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16zm16 312h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm256-200H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16h256c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16z">
                </path>
            </svg>
        </button>
        <div class="user text-end text-white">
            <span class="btn update-img-btn"><img class="rounded-circle " src="<?php echo $userimg ?>" width="40"
                    alt="<?php $name ?>"></span>
            <span>
                <?php echo $_SESSION['username']; ?>
            </span>
        </div>
    </div>
</nav>
<style>
    .gal:hover {
        text-decoration: underline;
    }
</style>

<form action="apps/process.php" method="post">
    <div class="text-end">
        <p class="position-absolute">Go to <a href="index.php" class="text-info gal">Gallery</a></p>
        <button type="submit" name="logout" class="btn btn-info text-white">Logout</button>
    </div>
</form>

<div class="update-img-form w-100 position-fixed mt-3" style="display:none">
    <div class="" style="z-index:400;margin-right:35vh">
        <form class="w-25 mx-auto  bg-light p-3 rounded" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
            method="post" enctype="multipart/form-data">
            <div class="text-end"><button type="button" class="btn-close btn-close-dark btn-close-form"
                    aria-label="Close"></button>
            </div>
            <div class="mb-3 fs-5 text-muted">Uploads Picture</div>
            <div class="input-group mb-3">
                <input type="file" name="uploadpicture" class="form-control" required>
            </div>
            <button type="submit" name="update-img" id="update-img" class="btn btn-info text-black">Upload</button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        var m = 0;
        $(".update-img-btn").click(function () {
            $(".update-img-form").show("slow");
        })

        $(".btn-close-form").click(function () {
            $(".update-img-form").hide("slow");
        })
        $('#update-img').click(function () {
        });
    });
</script>
<?php
// Update Image
if (isset($_POST["update-img"])) {
    $img = $_FILES['uploadpicture']['name'];
    $pict = $_FILES["uploadpicture"]["tmp_name"];
    $userid = $_SESSION['userid'];
    $location = 'Accounts/' . $_SESSION['useremail'] . '/' . $img;
    if (move_uploaded_file($pict, $location)) {
        $sqlin = mysqli_query($dbc, "UPDATE `user`SET `userimg`='$location' WHERE `userid`='$userid'");
    }
    ; // Store picture in folder

}
?>
