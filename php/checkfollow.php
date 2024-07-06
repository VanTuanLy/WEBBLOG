<?php
session_start();
$serverName = "LAPTOP-MUS82LPQ";
$connectionOptions = array("Database" => "QLLOGIN");
$conn = sqlsrv_connect($serverName, $connectionOptions);

$response = array(
    'followed' => false
);

$username = $_SESSION['username'];
$writer = $_SESSION['writer'];

if($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

$sql = "SELECT * FROM FOLLOW WHERE FOLLOWER = ? AND BE_FOLLOWED = ?";
$params = array($username, $writer);
$stmt = sqlsrv_query($conn, $sql, $params);


if (sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $response['followed'] = true;
}

echo json_encode($response);
?>