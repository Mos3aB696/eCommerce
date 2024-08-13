<?php
$dsn = 'mysql:host=localhost;dbname=eCommerce'; // Data Source Name
$user = 'root'; // User Name
$pass = 'mos3ab_root'; // Password

try {
  $connect = new PDO($dsn, $user, $pass);
  $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
  echo 'Failed To Connect To The Database' . $err->getMessage();
}
