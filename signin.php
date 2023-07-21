<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization');
header('Content-Type: application/json');
include('connection.php');

$username = $_POST['username'];
$password = $_POST['password'];

$query = $mysqli->prepare('select id,username,password,first_name,last_name
from users 
where username=?');
$query->bind_param('s', $username);
$query->execute();
$query->store_result();
$num_rows = $query->num_rows();

$query->bind_result($id, $username, $hashed_password, $first_name, $last_name);
$query->fetch();

if ($num_rows == 0) {
    $response['status'] = " user not found ";
} else {
    if (password_verify($password, $hashed_password)) {
        $response['status'] = 'success!';
        $response['id'] = $id;
        $response['fname'] = $first_name;
        $response['username'] = $username;
    } else {
        $response['status'] = "wrong password";
    }
}
echo json_encode($response);