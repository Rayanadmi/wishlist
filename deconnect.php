<?php

session_start();

unset($_SESSION['id']);
unset($_SESSION['logged']);

session_destroy();
  header("Location: connect.php");


?>