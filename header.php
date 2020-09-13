<?php
 session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<header>
  <nav>
    <div class="main-wrapper">
      <ul>
        <li><a href="index.php">Home</a></li>
        <?php if(isset($_SESSION['email_ID'])) : ?>
          <li><a href="listRestaurant.php">Products</a></li>
          <li><a href="myCart.php">My Cart</a></li>
        <?php endif; ?>

      </ul>
      <div class="nav-login">
        <?php
          /*Show logout button when logged in*/
          if(isset($_SESSION['email_ID'])){
            echo '<form action="includes/logout-inc.php" method="POST">
                  <button type="submit" name="submit">Logout</button>
                  </form>';
          }
          /*Else show login button*/
          else{
            echo '<form action="includes/login-inc.php" method="POST">
                  <input type="text" name="email_ID" placeholder="email_ID">
                  <input type="password" name="password" placeholder="password">
                  <button type="submit" name="submit">Login</button>
                  </form>
                  <a href="signup.php">Sign Up</a>
                  <a href="listusers.php">List Users</a>';

          }
        ?>
      </div>
    </div>
  </nav>
</header>
