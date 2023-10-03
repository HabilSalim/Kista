    <!DOCTYPE html>

    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.css">
        <title>Login Final</title>
    </head>
<style>
    input{
        padding: 8px !important;
        font-size:17px;
    }
</style>
    <body style="min-height: 100vh;display: grid;place-items: center;">
        <form action="apps/process.php" method="POST" enctype="multipart/form-data"
            style="width: 500px !important;" class="p-5 shadow rounded-3 mx-auto" id="form">
            <h3 class="text-center text-muted mb-4">Login</h3>
            <input type="email" name="email" placeholder="Email" id="email" class="form-control shadow-none mb-4"
                required>
            <input type="password" name="pwd" placeholder="Password" class="form-control shadow-none mb-3" required>
            <div class="text-center"><input type="submit" name="login" class="btn btn-primary w-50 mt-3 mb-4" value="Login"
                    id="submit">
            </div>
            <p>Don't have an account? <a href="signup.php">Create one!</a></p>
        </form>
      
</body>

</html>