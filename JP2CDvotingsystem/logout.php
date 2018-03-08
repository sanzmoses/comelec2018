<?php 
session_start();
require 'loggedin_admin.php';
session_destroy();
header("location: admin-login.php");



?>
