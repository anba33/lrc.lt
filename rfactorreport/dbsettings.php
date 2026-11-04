<?php
/**
 * Contains settings needed to connect to the mysqldatabase
 */
 $mysql_host = 'localhost'; //change this to the hostname where your mysql is running
 $mysql_user = $_REQUEST['login'];
 $mysql_password = $_REQUEST['pass']; //the password for this login
 
 $mysql_dbname = 'rfactorreport'; //only change this if you gave your db another name
?>
