<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "genesys";
$table = 'testimonials';
$id = '';

$con = mysqli_connect($host, $user, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$operation = $_POST["operation"];
if ($operation == 'insert') {
    $data = array(
        "campaign_id" => $_POST['campaign_id'],
        "user_id" => $_POST['user_id'],
        "img" => $_POST['img'],
        "name" => $_POST['name'],
        "company" => $_POST['company'],
        "rating" => $_POST['rating'],
        "comment" => $_POST['comment'],
    );

    $sql = sprintf(
        "INSERT INTO %s (%s) values (%s)",
        $table,
        implode(", ", array_keys($data)),
        "'" . implode("','", $data) . "'"
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
if ($operation == 'getsaccepted') {
    $sql = "SELECT * FROM $table where result='accepted'";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        http_response_code(404);
        die(mysqli_error($con));
    }
    echo '[';
    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        echo ($i > 0 ? ',' : '') . json_encode(mysqli_fetch_object($result), JSON_NUMERIC_CHECK);
    }
    echo ']';

    http_response_code(200);
    $con->close();

}

if ($operation == 'get') {
    $id = $_POST['testimonial_id'];
    $help = 'testimonial_id';
    $sql = "SELECT * FROM $table where $help = '$id'";
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
if ($operation == 'getMine') {
    $id = $_POST['campaign_id'];
    $help = 'campaign_id';
    $sql = "SELECT * FROM $table where $help = '$id'";
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

if ($operation == 'update') {
    $data = array(
        "user_id" => $_POST['user_id'],
        "target_audience" => $_POST['target_audience'],
        "gender" => $_POST['gender'],
        "job" => $_POST['job'],
        "company_name" => $_POST['company_name'],
        "custom_status" => $_POST['custom_status'],
        "service_type" => $_POST['service_type'],
        "social_medias" => $_POST['social_medias'],
        "target_like" => $_POST['target_like'],
        "target_view" => $_POST['target_view'],
        "target_click" => $_POST['target_click'],
        "time_period" => $_POST['time_period'],
        "final_cost" => $_POST['final_cost'],
    );
    $id = $_POST['testimonial_id'];
    $help = 'testimonial_id';

    $help2 = "";
    for ($idx = 0; $idx < count($data); $idx++) {
        $help2 .= array_keys($data)[$idx] . "='" . $new_user[array_keys($data)[$idx]] . "'";
        if ($idx < (count($data) - 1)) {
            $help2 .= ",";
        }
    }

    $sql = sprintf(
        "UPDATE $table SET %s WHERE $help='$id'",
        $help2
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
    $id = $_POST['testimonial_id'];
    $help = 'testimonial_id';

    $sql = "delete  FROM $table where $help = '$id'";
    $result = mysqli_query($con, $sql);
    if (!$result || !mysqli_affected_rows($con)) {
        http_response_code(404);
        die(mysqli_error($con));
    }

    http_response_code(200);
    $con->close();

}

if ($operation == 'accept') {
    $data = array(
        "result" => 'accepted',
    );
    $id = $_POST['campaign_id'];
    $help = 'campaign_id';

    $help2 = "";
    for ($idx = 0; $idx < count($data); $idx++) {
        $help2 .= array_keys($data)[$idx] . "='" . $data[array_keys($data)[$idx]] . "'";
        if ($idx < (count($data) - 1)) {
            $help2 .= ",";
        }
    }

    $sql = sprintf(
        "UPDATE $table SET %s WHERE $help='$id'",
        $help2
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

if ($operation == 'decline') {
    $data = array(
        "result" => 'declined',
    );
    $id = $_POST['campaign_id'];
    $help = 'campaign_id';

    $help2 = "";
    for ($idx = 0; $idx < count($data); $idx++) {
        $help2 .= array_keys($data)[$idx] . "='" . $data[array_keys($data)[$idx]] . "'";
        if ($idx < (count($data) - 1)) {
            $help2 .= ",";
        }
    }

    $sql = sprintf(
        "UPDATE $table SET %s WHERE $help='$id'",
        $help2
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
