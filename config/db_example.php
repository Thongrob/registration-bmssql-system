<!-- Connect to database in PDO type -->

<?php
//Connect to Mysql
  // $servername = "localhost:3307";
  // $username = "root";
  // $password = "";
  // $dbname = "registration-bs-system";

  // try {
  //   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  //   // set the PDO error mode to exception
  //   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //   // echo "Connected successfully";
  // } catch(PDOException $e) {
  //   echo "Connection failed: " . $e->getMessage();
  // }

// Connect to MS SQL Server
  $servername = "<Your severname>";
  $username = "<Your username>";
  $password = "<Your password>";
  $dbname = "<Your db name>";

  try {
    $conn = new PDO("sqlsrv:server=$servername; Database=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
?>