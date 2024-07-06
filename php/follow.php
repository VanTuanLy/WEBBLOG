<?php
session_start();
$serverName = "LAPTOP-MUS82LPQ";
$connectionOptions = array("Database" => "QLLOGIN");
$conn = sqlsrv_connect($serverName, $connectionOptions);

$writer = $_SESSION['writer'];
$title = $_SESSION['title'];
$username = $_SESSION['username'];

if($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

$sql = "INSERT INTO FOLLOW (FOLLOWER, BE_FOLLOWED) VALUES (?, ?)";
$params= array($username, $writer);
$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

echo "Success";

?>