<?php
//session_start();
/*
Auto load function
*/
spl_autoload_register(function($clasname){

    include 'dbconn/'.$clasname.".class.php";

});

/*
*DB connection Details
*/

define("DBHOST","localhost");
define("DBUSER","root");
define("DBPASS","");
define("DBNAME","oops_db");
?>