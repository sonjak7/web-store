<?php
  include_once 'header.php'
?>

<section class="main-container">
  <div class="main-wrapper">
  <h2>Sign Up</h2>
    <form class="signup-form" action="includes/signup-inc.php" method="POST">
      <input type="text" name="firstname" placeholder="* First Name">
      <input type="text" name="lastname" placeholder="* Last Name">
      <input type="text" name="email_ID" placeholder="* Email ID">
      <input type="password" name="password" placeholder="* Password">
      <button type="submit" name="submit">Sign Up</button>
    </form>
    <?php
      if(isset($_SESSION['err1'])){
        echo $_SESSION['err1'];
      }
      else if(isset($_SESSION['err2'])){
        echo $_SESSION['err2'];
      }
      else if(isset($_SESSION['err3'])){
        echo $_SESSION['err3'];
      }
      else if(isset($_SESSION['err4'])){
        echo $_SESSION['err4'];
      }
      else if(isset($_SESSION['err5'])){
        echo $_SESSION['err5'];
      }
      else if(isset($_SESSION['err6'])){
        echo " ";
      }
    ?>
  </div>
</section>

<?php
    unset($_SESSION["err1"]);
    unset($_SESSION["err2"]);
    unset($_SESSION["err3"]);
    unset($_SESSION["err4"]);
    unset($_SESSION["err5"]);
    unset($_SESSION["err6"]);
?>

<?php
  include_once 'footer.php'
?>
