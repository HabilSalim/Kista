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
    <link rel="stylesheet" href="css/bootstrap.css" crossorigin="anonymous">
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
                <li>
                    <a href="reply.php">
                        <i class="fa-solid fa-users"></i>
                        Replies
                    </a>
                </li>
                <li style="color: #0c1432;background: #fff;">
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
            include "apps/ux-navbar.php"; ?>
            <div class="row mx-4">

                <div class="text-end mt-2">
                    <button class="btn btn-info text-white rounded-circle" style="width:40px;" id="upload">UP</button>
                </div>

                <div class="uplaod-form w-100 position-fixed mt-5" style="display:none">
                    <div style="z-index:400;margin-right:35vh">
                        <form class="w-25 mx-auto shadow bg-light p-3 rounded"
                            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
                            enctype="multipart/form-data">
                            <div class="text-end">
                                <button type="button" id="btn-close" class="btn-close close-upload btn-close-dark"
                                    aria-label="Close"></button>
                            </div>
                            <div class="mb-3 fs-5 text-muted">Uploads Product</div>
                            <div class="input-group mb-3">
                                <input type="text" name="productname" class="form-control" placeholder="Product name"
                                    required>
                            </div>
                            <div class="input-group mb-3">
                                <input type="number" name="productprice" class="form-control"
                                    placeholder="Product price in FCFA" required>
                            </div>
                            <div class="input-group mb-3">
                                <input type="number" name="productquantity" class="form-control"
                                    placeholder="Product quantity" required>
                            </div>
                            <div class="input-group mb-3">
                                <input type="file" name="picture" class="form-control" id="inputGroupFile02" required>
                            </div>
                            <button type="submit" name="upload-product" class="btn btn-info text-black">Upload</button>
                        </form>
                    </div>
                </div>
                <?php
                function x($data)
                {
                    $data = filter_var($data, FILTER_SANITIZE_STRING);
                    $data = trim($data);
                    $data = addslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                ;
                function makeID($name)
                { //generate id
                    $nametoupper = strtoupper($name);
                    $result = "";
                    $firstletter = explode(" ", $nametoupper);

                    foreach ($firstletter as $word) {
                        $result = str_shuffle($result . substr($word, 0, 2));
                    }
                    $result = $result . rand(10000000, 99999999);
                    return $result;
                }
                if (isset($_POST['upload-product'])) {
                    $productname = $_POST['productname'];
                    $userid = $_SESSION['userid'];
                    $useremail = $_SESSION['useremail'];
                    $productprice = $_POST['productprice'];
                    $productquantity = $_POST['productquantity'];
                    $productid = makeID($productname);
                    $imgname = $_FILES['picture']['name'];
                    $image = $_FILES['picture']["tmp_name"];
                    $date = date("Y-m-d H-i-s");
                    $location = "Accounts/" . $useremail . "/" . $imgname;
                    $slsql = mysqli_query($dbc, "SELECT  `productname` FROM `product` WHERE `userid`='$userid'");
                    global $verify;
                    while ($data = mysqli_fetch_array($slsql)) {
                        if ($data['productname'] == $productname) {
                            $verify = 1;
                            exit();
                        }
                    };
                    if (!$verify == 1) {
                        if (move_uploaded_file($image, $location)) { // Store picture in folder
                            $sql = mysqli_query($dbc, "INSERT INTO `product`(`productid`, `userid`, `productname`, `productimg`, `productquantity`, `productprice`, `productdate`) VALUES ('$productid','$userid','$productname','$location','$productquantity','$productprice','$date')");
                        }
                        echo '<script>alert("exist!")</script>';
                    } else {
                        echo '<script>alert("Product already exist!")</script>';
                    }
                }
                $id = $_SESSION['userid'];
                $com_number;
                $qry = mysqli_query($dbc, "SELECT `productid`, `userid`, `productname`, `productimg`, `productquantity`, `productprice`, `productdate` FROM `product` WHERE `userid`='$id'");
                if (mysqli_num_rows($qry) == null) {
                    echo '<h2 class="text-muted">No Uplaod Found !<?h2>';
                } else {
                    while ($values = mysqli_fetch_array($qry)) {
                        $productid = $values['productid'];
                        $comqry = mysqli_query($dbc, "SELECT `commentid` FROM `comment` WHERE `productid`='$productid'");
                        if (mysqli_num_rows($comqry) == null) {
                            $com_number = 0;
                        } else {
                            $com_number = mysqli_num_rows($comqry);
                        }

                        ?>
                        <div class="col-12 col-sm-6 col-md-6 col-xl-4 mb-5 products">
                            <div class="mx-2 p-4 shadow text-white rounded" style="background-color: #0c1432;">
                                <div class="text-center">
                                    <img class="rounded-3" src="<?php echo $values["productimg"] ?>"
                                        style="height:200px;object-fit: cover;" width="100%" alt="product">
                                </div>
                                <p class="my-3 text-start">
                                    <?php echo $values["productname"] ?>
                                </p>
                                <p class="my-3 text-start">
                                    <?php echo $values["productprice"] ?> FCFA
                                </p>

                                <div class="row">
                                    <div class="col-4 text-start">
                                        <?php echo $values["productquantity"] ?> Units
                                    </div>
                                    <div class="text-end col-8">
                                        <?php echo $values["productdate"] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
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
            var t = 0;
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
            $("#sidebarCollapse").click(function () {
                if (t == 0) {
                    $(".products").removeClass("col-sm-6");
                    t = 1;
                } else {
                    $(".products").addClass("col-sm-6");
                    t = 0;
                }
            })
            $("#upload").click(function () {
                $(".uplaod-form").show("slow")
            })
            $("#btn-close").click(function () {
                $(".uplaod-form").hide("slow")
            })

        });
    </script>

</body>

</html>