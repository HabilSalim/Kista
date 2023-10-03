<?php
session_start();
include "apps/include.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Collapsible sidebar using Bootstrap 4</title>
    <link rel="icon" type="image/png" sizes="32x32" href="./Images/Habil5.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Dashboard</h3>
            </div>

            <ul class="list-unstyled ">
                <li>
                    <a href="ux.php">
                        <i class="fa-sharp fa-solid fa-comment-dots"></i>
                        Home
                    </a>
                </li>
                <li>
                    <a href="comment.php">
                        <i class="fa-sharp fa-solid fa-comment-dots"></i>
                        Comments
                    </a>
                </li>
                <li style="color: #0c1432;background: #fff;">
                    <a href="reply.php">
                        <i class="fa-solid fa-users"></i>
                        Replies
                    </a>
                </li>
                <li>
                    <a href="upload.php">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        Uploads
                    </a>
                </li>
            </ul>
        </nav>

        <style>
            p {
                margin: 0;
                color: white;
            }

            .text-col {
                border-bottom: 2px solid rgb(176, 175, 175);
            }
        </style>
        <!-- Page Content  -->
        <div id="content">
            <?php
            include "apps/ux-navbar.php";
            ?>

            <div class="row mx-4">
                <?php
                $repsql = mysqli_query($dbc, "SELECT `content`, `commentid`, `userid`, `replydate` FROM `reply` WHERE `userid`='$id' ");
                if (mysqli_num_rows($repsql) == null) {
                    echo '<h2 class="text-muted">No Reply Found for ' . $_SESSION['username'] . ' !<?h2>';
                } else {
                    while ($data = mysqli_fetch_array($repsql)) {
                        $commentid=$data['commentid'];
                        $comsql=mysqli_query($dbc,"SELECT `userid` FROM `comment` WHERE `commentid`='$commentid'");
                        $user_info = mysqli_fetch_array($comsql);
                        $commenerid=$user_info['userid'];
                        $comentersql=mysqli_query($dbc,"SELECT `username` FROM `user` WHERE `userid`='$commenerid'");
                        $user_info = mysqli_fetch_array($comentersql);
                        ?>
                        <div class="col-12">
                            <div class="mx-2 my-3 p-4 shadow text-white rounded" style="background-color: #0c1432;">
                                <img class="rounded-circle me-2 " src="<?php echo $userimg ?>" width="40" alt="<?php echo $name ?>"> <?php echo $name ?>
                                <p class="mx-5 my-3">
                                    <?php echo $data['content'] ?>
                                </p>
                                <div class="row">
                                    <div class="col-6 text-start">Replied to <?php echo $user_info['username'] ?></div>
                                    <div class="text-end col-6">
                                        <?php echo $data['replydate'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ;
                }
                ;
                ?>


            </div>
        </div>
    </div>

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(document).ready(function () {
                var t = 0;
                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                });

            });
        });
    </script>
</body>

</html>