<?php 
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location: login.php");
        exit();
    }

?>
<?php 

    include "partials/_dbconnection.php";
    // SQL QUERY 
    $query = "SELECT * FROM Hotel";
    // FETCHING DATA FROM DATABASE 
    $result = mysqli_query($conn, $query); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php include "partials/_header.php"?>
    <div class="container">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Hotel Id</th>
      <th scope="col">Hotel Name</th>
      <th scope="col">Hotel Adders</th>
      <th scope="col">Hotel Description</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        if (mysqli_num_rows($result) > 0) { 
            // OUTPUT DATA OF EACH ROW 
            while($row = mysqli_fetch_assoc($result)) { 
    ?>
        <tr>
            <th scope="row"><?php echo $row['id']?></th>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['address']?></td>
            <td><?php echo $row['description']?></td>
            <td><a href="edit_hotel.php?id=<?php echo $row['id']?>">Edit</a></td>
            <td><a href="delete_hotel.php?id=<?php echo $row['id']?>">Delete</a></td>
        </tr>
    <?php 
        } 
    } 
    else { 
        echo "No Hotels Found"; 
    } 
    mysqli_close($conn);
    ?>
  </tbody>
</table>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>