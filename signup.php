<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization');
header('Content-Type: application/json');
include('connection.php');

$username = $_POST['username'];
$password = $_POST['password'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];

$check_username = $mysqli->prepare('SELECT username FROM users WHERE username=?');
$check_username->bind_param('s', $username);
$check_username->execute();
$check_username->store_result();
$username_exists = $check_username->num_rows();

if ($username_exists == 0) {
    if (strlen($password) >= 8) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $query = $mysqli->prepare('INSERT INTO users(username, password, first_name, last_name) VALUES(?,?,?,?)');
        $query->bind_param('ssss', $username, $hashed_password, $first_name, $last_name);
        $query->execute();

        $response['status'] = "success";
        $response['message'] = "user added";
    } else {
        $response['status'] = "failed";
        $response['message'] = "Password must be at least 8 characters long.";
    }
} else {
    $response['status'] = "failed";
    $response['message'] = "Username already exists.";
}

echo json_encode($response);