<?php 
include "init.php";
$userdetails=User::action()->is_logged_in();
if(empty($userdetails)){
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