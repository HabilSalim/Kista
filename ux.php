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
                <li style="color: #0c1432;background: #fff;">
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
                <li>
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
           
            <div class="row">
                <div class="col-12 col-sm-6 mt-4 col-md-6 col-lg-4 box">
                    <div class="mx-2 border rounded">
                        <p class="p-2 text-center fw-bold text-col" style="background-color: 0c1432;font-size:40px;">
                            <?php
                            $comment_num;
                            if (mysqli_num_rows(mysqli_query($dbc, "SELECT `commentid` FROM `comment` WHERE  `userid`='$id'")) == null) {
                                $comment_num = 0;
                                echo $comment_num;
                            } else {
                                echo mysqli_num_rows(mysqli_query($dbc, "SELECT `commentid` FROM `comment` WHERE  `userid`='$id'"));
                            }
                            ?>
                        </p>
                        <p class="p-4 text-center fw-bold" style="font-size:25px;">Comments</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 mt-4 col-md-6 col-lg-4 box">
                    <div class="mx-2 border rounded">
                        <p class="p-2 text-center fw-bold text-col" style="background-color: 0c1432;font-size:40px;">
                            <?php
                            $reply_num;
                            if (mysqli_num_rows(mysqli_query($dbc, "SELECT `replyid` FROM `reply` WHERE `userid`='$id'")) == null) {
                                $reply_num = 0;
                                echo $reply_num;
                            } else {
                                echo mysqli_num_rows(mysqli_query($dbc, "SELECT `replyid` FROM `reply` WHERE `userid`='$id'"));
                            }
                            ?>
                        </p>
                        <p class="p-4 text-center fw-bold" style="font-size:25px;">Replies</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 mt-4 col-md-6 col-lg-4 box">
                    <div class="mx-2 border rounded">
                        <p class="p-2 text-center fw-bold text-col" style="background-color: 0c1432;font-size:40px;">
                            <?php
                            $upload_num;
                            if (mysqli_num_rows(mysqli_query($dbc, "SELECT `productid` FROM `product` WHERE `userid`='$id'")) == null) {
                                $upload_num = 0;
                                echo $upload_num;
                            } else {
                                echo mysqli_num_rows(mysqli_query($dbc, "SELECT `productid` FROM `product` WHERE `userid`='$id'"));
                            }
                            ?>
                        </p>
                        <p class="p-4 text-center fw-bold" style="font-size:25px;">Uploads</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            var t = 0;
            var v = 0;
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
            $("#sidebarCollapse").click(function () {
                if (t == 0) {
                    $(".box").removeClass("col-sm-6");
                    t = 1;
                } else {
                    $(".box").addClass("col-sm-6");
                    t = 0;
                }
            })
        });
    </script>
</body>

</html>