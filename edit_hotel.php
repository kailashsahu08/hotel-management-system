<?php 
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location: login.php");
        exit();
    }

?>
<?php
    include "partials/_dbconnection.php";
    $hotel_id = 0;
    $success_msg = null;
    $error_msg = null;
    $hotel_name = null;
    $hotel_address = null;
    $hotel_description = null;
    if (isset($_GET['id'])) {
        $hotel_id = intval($_GET['id']);
        $sql = "SELECT * FROM Hotel WHERE id = '$hotel_id'";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) > 0 ){
            $row = mysqli_fetch_assoc($res);
            $hotel_name = $row['name'];
            $hotel_address = $row['address'];
            $hotel_description = $row['description'];
        }
        else{
            $error_msg = "Hotel not found";
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect and sanitize the POST data
        $hotelName = $_POST['hotelName'];
        $hotelAddress = $_POST['hotelAddress'];
        $hotelDescription = $_POST['hotelDescription'];
        $owner_id = $_SESSION['id'];
        $sql = "UPDATE Hotel SET name = '$hotelName', address = '$hotelAddress', description = '$hotelDescription', owner_id = '$owner_id' WHERE id = '$hotel_id'";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            $success_msg = "Hotel Update successful";
            header("location: hotels.php");
            exit();
        } else {
            $error_msg =  "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        // Close the database connection . 
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register hotel</title>
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
    <div class="container mt-5">
        <div class="container">
            <form method="post">
                <h1 class="text-center">Update Hotel</h1>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Hotel Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="hotelName" value="<?php echo $hotel_name; $hotel_name=null;?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Hotel Address</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="hotelAddress" value="<?php echo $hotel_address?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Hotel Description</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="hotelDescription" value="<?php echo $hotel_description?>">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>