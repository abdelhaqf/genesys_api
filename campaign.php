<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "genesys";
$table = 'campaigns';
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
    $sql = "SELECT * FROM $table order by created_at desc";
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
    $id = $_POST['campaign_id'];
    $help = 'campaign_id';
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
    $id = $_POST['user_id'];
    $help = 'user_id';
    $sql = "SELECT * FROM $table where $help = '$id' order by created_at desc";
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
    $id = $_POST['campaign_id'];
    $help = 'campaign_id';

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
if ($operation == 'finish') {
    $data = array(
        "result" => 'finished',
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

if ($operation == 'pay') {
    $data = array(
        "is_paid" => 1,
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
if ($operation == 'review') {
    $data = array(
        "is_reviewed" => 1,
        "result" => "rated"
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


if ($operation == 'delete') {
    $id = $_POST['campaign_id'];
    $help = 'campaign_id';

    $sql = "delete  FROM $table where $help = '$id'";
    $result = mysqli_query($con, $sql);
    if (!$result || !mysqli_affected_rows($con)) {
        http_response_code(404);
        die(mysqli_error($con));
    }

    http_response_code(200);
    $con->close();

}

if ($operation == 'getTotalSMM') {
    $val = 'social media marketing';
    $column = 'service_type';
    $sql = "SELECT count(*) as total FROM $table where $column = '$val'";
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

if ($operation == 'getTotalPPC') {
    $val = 'pay per click ads';
    $column = 'service_type';
    $sql = "SELECT count(*) as total FROM $table where $column = '$val'";
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



if ($operation == 'getTotalIncome') {
    // $sql = "SELECT * FROM $table order by created_at desc";
    $sql = "SELECT monthName(created_at) as month,year(created_at) as year,sum(final_cost) as sum FROM `campaigns` WHERE is_paid=1 group by year(created_at), month(created_at)";
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
if ($operation == 'getTotalPaidCampaign') {
    $sql = "SELECT count(*) FROM `campaigns` WHERE `is_paid`=1";
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
if ($operation == 'getCountPaidCampaign') {
    $sql = "SELECT count(*) as count FROM `campaigns` WHERE `is_paid`=1";
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
if ($operation == 'getCuontFinishedCampaign') {
    $sql = "SELECT count(*) as count from campaigns where result='finished' or result='rated'";
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




