<?php 
include "init.php";
if(!$userdetails=User::action()->is_logged_in()){
    header('Location: login.php');
    die;
}

?>
<html>
<head>
  <title>welcome to Dashboard</title>
</head>

<body>
  <center>Dashboard</center>
  <?php include "header.php" ?>
</body>

</html>