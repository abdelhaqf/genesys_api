<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "genesys";
$table = 'users';

$id = '';

$con = mysqli_connect($host, $user, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$operation = $_POST["operation"];
if ($operation == 'insert') {
    $new_user = array(
        "username" => $_POST['username'],
        "password" => md5($_POST['password']),
        "email" => $_POST['email'],
        "first_name" => $_POST['first_name'],
        "last_name" => $_POST['last_name'],
        "company_name" => $_POST['company_name'],
        "phone_number" => $_POST['phone_number'],
    );

    $sql = sprintf(
        "INSERT INTO %s (%s) values (%s)",
        $table,
        implode(", ", array_keys($new_user)),
        "'" . implode("','", $new_user) . "'"
    );
    echo $sql;
    $result = mysqli_query($con, $sql);

    if (!$result) {
        http_response_code(404);
        die(mysqli_error($con));
    }
    echo json_encode($result);
    http_response_code(200);
    $con->close();
}

if ($operation == 'gets') {
    $sql = "SELECT * FROM $table";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        http_response_code(404);
        die(mysqli_error($con));
    }
    echo '[';
    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        echo ($i > 0 ? ',' : '') . json_encode(mysqli_fetch_object($result));
    }
    echo ']';

    http_response_code(200);
    $con->close();

}
if ($operation == 'get') {
    $id = $_POST['user_id'];
    $sql = "SELECT * FROM $table where user_id = $id";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        http_response_code(404);
        die(mysqli_error($con));
    }
    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        echo ($i > 0 ? ',' : '') . json_encode(mysqli_fetch_object($result));
    }

    http_response_code(200);
    $con->close();

}
if ($operation == 'login') {
    $username = $_POST['username'];
    // $password = md5($_POST['password']);
    $password = $_POST['password'];
    $sql = "SELECT * FROM $table where username = '$username' and password = '$password'";
    $result = mysqli_query($con, $sql);
    if (!$result || mysqli_num_rows($result) == 0) {
        http_response_code(404);
        die(mysqli_error($con));
    }
    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        echo ($i > 0 ? ',' : '') . json_encode(mysqli_fetch_object($result));
    }

    http_response_code(200);
    $con->close();

}

if ($operation == 'update') {
    $new_user = array(
        "username" => $_POST['username'],
        "img" => $_POST['img'],
        "password" => $_POST['password'],
        "email" => $_POST['email'],
        "first_name" => $_POST['first_name'],
        "last_name" => $_POST['last_name'],
        "company_name" => $_POST['company_name'],
        "phone_number" => $_POST['phone_number'],
    );
    $id = $_POST['user_id'];
    $help = "";
    for ($idx = 0; $idx < count($new_user); $idx++) {
        $help .= array_keys($new_user)[$idx] . "='" . $new_user[array_keys($new_user)[$idx]] . "'";
        if ($idx < (count($new_user) - 1)) {
            $help .= ",";
        }
    }

    $sql = sprintf(
        "UPDATE $table SET %s WHERE user_id=$id",
        $help
    );
    echo $sql;
    $result = mysqli_query($con, $sql);

    if (!$result) {
        http_response_code(404);
        die(mysqli_error($con));
    }
    echo json_encode($result);
    http_response_code(200);
    $con->close();

}
if ($operation == 'delete') {
    $id = $_POST['user_id'];
    $sql = "delete  FROM $table where user_id = $id";
    $result = mysqli_query($con, $sql);
    if (!$result || !mysqli_affected_rows($con)) {
        http_response_code(404);
        die(mysqli_error($con));
    }

    http_response_code(200);
    $con->close();

}
