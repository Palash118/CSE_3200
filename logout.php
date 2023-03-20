<?php

session_start();
$_SESSION = array();
//$google_client->revokeToken();
session_destroy();
header("location: login.php");

?>
