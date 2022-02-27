<?php 

// keep database credentials in a separate file
// 1-> easy to exclude this file from source code managers 
// 2-> unique credentials for both development and production servers 
// 3-> unique credentials if work with multiple developers

define("DB_SERVER", "localhost");  // for IP address for us will be 'localhost'
define("DB_USER", "webuser");   // our user that allowed to connect to the database
define("DB_PASS", "secretpassword"); // our password
define("DB_NAME", "chain_gang"); // our database name



?>
