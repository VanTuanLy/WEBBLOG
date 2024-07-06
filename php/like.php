<?php
session_start();
$serverName = "LAPTOP-MUS82LPQ";
$connectionOptions = array("Database" => "QLLOGIN");
$conn = sqlsrv_connect($serverName, $connectionOptions);

$writer = $_SESSION['writer'];
$title = $_SESSION['title'];

if($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

$sql = "UPDATE WRITE_CONTENT SET LIKES = LIKES + 1 WHERE WRITERS = ? AND TITLES = ? ";
$params= array($writer, $title);
$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

echo "Success";

?>