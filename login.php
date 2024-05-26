<?php
    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        include "partials/_dbconnection.php";
        $exist_or_not = "SELECT * FROM User WHERE email = '$email'";
        $result = mysqli_query($conn, $exist_or_not);
        if (mysqli_num_rows($result) > 0 && $email) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($pass, $row['pass'])) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                header("location: home.php");
                exit;
            } else {
                $error_msg = "Invalid Password";
            }
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php include "partials/_header.php"?>
    <div class="container mt-5">
        <div class="container">
            <form method="post">
                <h1 class="text-center">Login Here</h1>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <p class="text-center">Don't have an account? <a href="signup.php">Sign Up</a></p>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
        // Initialization for ES Users
        import { Input, Ripple, initMDB } from "mdb-ui-kit";

        initMDB({ Input, Ripple });
    </script>
</body>
</html>