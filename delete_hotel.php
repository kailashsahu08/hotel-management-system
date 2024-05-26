<?php 

include "partials/_dbconnection.php";
if (isset($_GET['id'])) {
    $hotel_id = intval($_GET['id']);
    $sql = "DELETE FROM Hotel WHERE id = '$hotel_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: hotels.php");
        exit();
    } else {
        echo "Error: ". $sql. "<br>". mysqli_error($conn);
    }
}

mysqli_close($conn);
?>