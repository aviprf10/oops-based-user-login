 <header>
    <a href="index.php">Home</a> . 
    <a href="shop.php">Shop</a> 
    <?php
    if(!empty($userdetails))
    { 
    ?>
      <div style="float:right;">  Welcome:: <?php echo $userdetails->name; ?>-    <a href="logout.php">Logout</a></div>
    <?php 
    }
    else {
    ?>
    <div style="float:right;">  <a href="login.php">login</a></div>
    <?php }
    ?>
  </header>