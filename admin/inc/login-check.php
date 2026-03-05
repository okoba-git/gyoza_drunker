<?php
session_start();
if (!isset($_SESSION['id'])) {
  header('location:' . $path . '/login.php');
  exit();
}
