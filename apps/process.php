<?php

include "include.php";
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
        $result = str_shuffle($result . substr($word, 0, 3));
    }
    $result = $result . rand(10000000, 99999999);
    $result_firts = substr($result, 0, 7);
    $result_last = substr($result, -7);
    $result = $result_firts . $result_last;
    return $result;
}

// SignUp
if (isset($_POST["signup"])) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    } else {
        $res = "logout";
        echo json_encode($res);
        echo 'Please, logout before signing in again! Go to your <a href="../ux.php">interface</a>!';
        // header('location: ../login.php');
        exit();
    }

    $name = x($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $email = x(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL));
    $pwd = x($_POST["pwd"]);
    $id = makeID($name);
    $pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
    $sqr = mysqli_query($dbc, "SELECT `useremail` FROM `user`");
    $date = date("Y-m-d H:i:s");
    if (!mysqli_num_rows($sqr) == 0) {
        $emails = mysqli_fetch_assoc($sqr);
        if ($email === $emails["useremail"]) {
            $res = "exist";
            echo json_encode($res);
            header('location: ../signup.php');
        } else {
            $_SESSION["userid"] = $id;
            $_SESSION["username"] = $name;
            $_SESSION["useremail"] = $email;
            $sql = "INSERT INTO `user`(`userid`, `username`, `useremail`, `password`, `userimg`, `userdate`) VALUES ('$id','$name','$email','$pwd','Images/user.jpeg','$date')";
            $qry = mysqli_query($dbc, $sql);
            if ($qry) {
                $folder = mkdir("../Accounts/" . $email, 0777, true);
                if ($folder) {
                    header("location: ../ux.php");
                    echo "<script> alert('Account created Successfully!'); Location='upload.php'</script>";
                } else {
                    echo "<script> alert('Account created Successfully!'); Location='upload.php'</script>";
                }
            } else {
                echo "Unable to create account. Error: " . mysqli_error($dbc);
            }
        }
    } else {
        $_SESSION['userid'] = $id;
        $_SESSION['username'] = $name;
        $_SESSION["useremail"] = $email;
        echo $id;
        $insql = "INSERT INTO `user`(`userid`, `username`, `useremail`, `password`, `userimg`, `userdate`) VALUES ('$id','$name','$email','$pwd','Images/user.jpeg','$date')";
        $inqry = mysqli_query($dbc, $insql);
        if ($inqry) {
            $folder = mkdir("../Accounts/" . $email, 0777, true);
            header("location: ../ux.php");
            exit();
        } else {
            echo "Unable to create account. Error: " . mysqli_error($dbc);
        }
    }
}




// Login
if (isset($_POST['login'])) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    } else {
        // If the session is already started, redirect the user or display an error message
        header('Location: ../login.php');
        exit();
    }
    $email = x($_POST['email']);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = x($_POST['pwd']);
    $email = mysqli_real_escape_string($dbc, $email); //Email Verification
    $sql = "SELECT `password`, `userid`, `username`,`useremail` FROM `user` WHERE useremail='$email'";
    $qry = mysqli_query($dbc, $sql);

    if (mysqli_num_rows($qry) === 1) {
        $row = mysqli_fetch_assoc($qry);
        $hashedpassword = $row['password'];

        if (password_verify($password, $hashedpassword)) {

            $_SESSION['userid'] = $row['userid'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['useremail'] = $row['useremail'];

            header('Location: ../ux.php');
            exit();
        } else {
            echo '<p style="font-size:35px;text-align:center;">Incorrect password!</p>';
        }
    } else {
        echo '<p style="font-size:35px;text-align:center;">Account does not exist! Please sign up <a href="../signup.php">here!</a></p>';
    }
}

// Logout
if (isset($_POST["logout"])) {
    session_start();
    // Clear all session variables
    session_unset();
    session_destroy();
    header("location:../index.php");
}
// alert('cid: ' + cid + ' Reply: ' + replyContent);

// Reply process
if (isset($_POST['content'])) {
    session_start();
    if (isset($_SESSION['userid'])) {
        $commentid = $_POST['cid'];
        $reply = $_POST['content'];
        // $reply = mysqli_real_escape_string($dbc, $reply);
        // $reply = str_replace("'", "\'", $reply);
        $userid = $_SESSION['userid'];
        $productid = $_POST['productid'];
        $id = makeID($reply);
        $date = date("Y-m-d H-i-s");
        $res = 'succeed';
        echo json_encode($res);
        $sql = mysqli_query($dbc, "INSERT INTO `reply`(`replyid`, `content`, `commentid`, `userid`, `replydate`) VALUES ('$id','$reply','$commentid','$userid','$date')");
        // header("location: ../product-card.php?id=$productid");
    } else {
        $res = 'sorry';
        echo json_encode($res);
    }
}

// Comment process
if (isset($_POST['commentcontent'])) {
    session_start();
    if (isset($_SESSION['userid'])) {
        $content = $_POST['commentcontent'];
        $userid = $_SESSION['userid'];
        $productid = $_POST['cid'];
        $commentid = makeID($content);
        $date = date("Y-m-d H-i-s");
        $res = 'succeed';
        echo json_encode($res);
        $sql = mysqli_query($dbc, "INSERT INTO `comment`(`commentid`, `content`, `productid`, `userid`, `commentdate`) VALUES ('$commentid','$content','$productid','$userid','$date')");
        // header("location: ../product-card.php?id=$productid");
    } else {
        $res = 'sorry';
        echo json_encode($res);
    }
}
// upload-product


mysqli_close($dbc);
?>