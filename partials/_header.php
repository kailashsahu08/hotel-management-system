<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Hotel Management</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="hotels.php">Hotels</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register_hotel.php">Register Hotel</a>
          </li>
          <?php 
            if(isset($_SESSION['loggedin'])){
                echo '<li class="nav-item">
                <a class="nav-link" href="logout.php">logout</a>
              </li>';
            }
          ?>
        </ul>
        <div class="d-flex">
            <?php 
                if(!isset($_SESSION['loggedin'])){
                    echo '<a href="login.php" class="btn btn-outline-light mx-2" type="submit">Log In</a>
                    <a href="signup.php" class="btn btn-outline-light" type="submit">Sign Up</a>';
                }
                else {
                    echo '<a href="login.php" class="btn btn-outline-light mx-2" type="submit">';
                    ?>
                    <?php echo $_SESSION['username'];?>
                    
                <?php echo '</a>'; } ?>
          
        </div>
      </div>
    </div>
  </nav>