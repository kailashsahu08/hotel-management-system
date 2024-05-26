
<?php
    $success_msg = null;
    $error_msg = null;
    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect and sanitize the POST data
        $name = $_POST['username'];
        $pass = $_POST['password'];
        $email = $_POST['email'];
        $hashed_password = password_hash($pass, PASSWORD_BCRYPT);
        include "partials/_dbconnection.php";
        $exist_or_not = "SELECT * FROM User WHERE email = '$email' AND username='$name'";
        $result = mysqli_query($conn, $exist_or_not);
        if (mysqli_num_rows($result) > 0 && $email) {
            $error_msg = "Email already exists";
        }
        else{
            $sql = "INSERT INTO User(username,pass,email) VALUES ('$name','$hashed_password','$email')";
            $res = mysqli_query($conn, $sql);
            if ($res) {
                $success_msg = "New record created successfully";
            } else {
                $error_msg =  "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            // Close the database connection . 
            mysqli_close($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php include "partials/_header.php"?>
    <?php if ($error_msg!=null) {?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_msg;?>
        </div>
    <?php }?>
    <?php if ($success_msg!=null) {?>
        <div class="alert alert-success" role="success">
            <?php echo $success_msg;?>
        </div>
    <?php }?>
        <div class="container">
            <form method="post">
                <h1 class="text-center">SignIn Here</h1>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" require>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" require>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" require>
                </div>
                <button type="submit" class="btn btn-primary">Sign Up</button>
                <p class="text-center">Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>