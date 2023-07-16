<?php
include "init.php";

$ses = new Session();

if($ses->exitSession('USERDETAILS'))
{
    $ses->sessionRemove('USERDETAILS');
}

header('Location:login.php');
die;
?>