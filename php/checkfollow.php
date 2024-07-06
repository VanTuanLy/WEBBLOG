<?php
session_start();
require './connect.php';

$response = array(
    'followed' => false
);

$username = $_SESSION['username'];
$writer = $_SESSION['writer'];

$sql = "SELECT * FROM FOLLOW WHERE FOLLOWER = ? AND BE_FOLLOWED = ?";
$params = array($username, $writer);
$stmt = sqlsrv_query($conn, $sql, $params);


if (sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $response['followed'] = true;
}

echo json_encode($response);
?>