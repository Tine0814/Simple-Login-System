<?php
session_start();

// remove all session
session_unset();

//destroy
session_destroy();

if(!isset($_SESSION['user'])) header('location: index.php');

?>