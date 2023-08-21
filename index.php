<?php
require_once("config/config.php");
if (isset($_SESSION['username'])) {

    header("Location: dashboard.php");
    exit;
  } else {
    header("Location: login.php");
    exit;
  }

?>