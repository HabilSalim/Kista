<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery.js"></script>
</head>

<body style="min-height: 100vh;display: grid;place-items: center;">
    <form action="apps/process.php" method="POST" enctype="multipart/form-data" style="width: 500px !important;"
        class="p-5 shadow rounded-3 mx-auto" id="form">
        <h3 class="text-center text-muted mb-4">Signup</h3>
        <input type="text" name="name" placeholder="Name" id="name" class="form-control shadow-none mb-4" required>
        <input type="email" name="email" placeholder="Email" id="email" class="form-control shadow-none mb-4" required>
        <input type="password" name="pwd" id="pwd" placeholder="Password" minlength="8"
            class="form-control shadow-none mb-3">
        <input type="password" name="cpwd" id="cpwd" placeholder="Confirm Password"
            class="form-control shadow-none mb-3" required>
        <p class="" id="vpwd"></p>
        <div class="text-center"><input type="submit" id="signup" name="signup"
                class="btn btn-primary w-50 mt-3 mb-4 disabled" value="Signup" id="submit">
        </div>
        <p>Already have an account? <a href="login.php">Login!</a></p>
    </form>
    <script>
        $(document).ready(function () {
            $("#cpwd").on("input", function () {
                if ($("#cpwd").val() === $("#pwd").val()) {
                    $("#vpwd").text('Identical Password!').removeClass("text-danger").addClass("text-success");
                    $("#signup").removeClass("disabled");
                } else {
                    $("#vpwd").text('Unidentical Password!').addClass("text-danger").removeClass("text-success");
                    $("#signup").addClass("disabled");
                }
            })

                fetch('apps/process.php')
                    .then(response => response.text())
                    .then(res => {
                        // Handle the received response data
                        console.log(res.message);
                        // alert(res.code);
                    })
                    .catch(error => {
                        // Handle any errors that occurred during the request
                        console.error(error);
                    });
            });


    </script>
</body>

</html>