<?php
  include_once 'header.php';
?>

<section class="main-container">
  <div class="main-heading">
    <h3>Welcome To ProjectX</h3>
    <h5>Sathya Ramanathan | Sanjay Ramanathan<h5>
    <?php if(isset($_SESSION['email_ID'])) : ?>
      <p>HOME PAGE
      To get in contact email us at: test@email.com</p>
      <p>Logged in as: <?php echo $_SESSION['email_ID']; ?></p>
    <?php endif; ?>
  </div>
</section>

<?php
  include_once 'footer.php';
?>
