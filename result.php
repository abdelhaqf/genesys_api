<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "genesys";
$table = 'results';
$id = '';

$con = mysqli_connect($host, $user, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$operation = $_POST["operation"];
if ($operation == 'insert') {
    $data = array(
        // "result_id" => $_POST['result_id'],
        "campaign_id" => $_POST['campaign_id'],
        "current_like" => $_POST['current_like'],
        "current_view" => $_POST['current_view'],
        "current_click" => $_POST['current_click'],
        "remaja" => $_POST['remaja'],
        "dewasa" => $_POST['dewasa'],
        "orang_tua" => $_POST['orang_tua'],
        "pria" => $_POST['pria'],
        "wanita" => $_POST['wanita'],
        "pegawai" => $_POST['pegawai'],
        "karyawan" => $_POST['karyawan'],
        "pengusaha" => $_POST['pengusaha'],
        "facebook" => $_POST['facebook'],
        "twitter" => $_POST['twitter'],
        "instagram" => $_POST['instagram'],
        "created_at" => $_POST['created_at'],
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
if ($operation == 'get') {
    $id = $_POST['result_id'];
    $help = 'result_id';
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
    $id = $_POST['result_id'];
    $help = 'result_id';

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

if ($operation == 'getTotalSocmeds') {
    $id = $_POST['campaign_id'];
    $help = 'campaign_id';
    // $sql = "SELECT * FROM $table where $help = '$id'";
    $sql = "SELECT sum(facebook) as facebook, sum(twitter) as twitter, sum(instagram) as instagram FROM results where $help = '$id'";
    // echo $sql;
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
if ($operation == 'getTotalGenders') {
    $id = $_POST['campaign_id'];
    $help = 'campaign_id';
    $sql = "SELECT sum(pria) as pria, sum(wanita) as wanita FROM results where $help = '$id'";
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
if ($operation == 'getTotalJobs') {
    $id = $_POST['campaign_id'];
    $help = 'campaign_id';
    $sql = "SELECT sum(pegawai) as pegawai, sum(karyawan) as karyawan, sum(pengusaha) as pengusaha FROM results where $help = '$id'";
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
if ($operation == 'getTotalActions') {
    $id = $_POST['campaign_id'];
    $help = 'campaign_id';
    $sql = "SELECT sum(current_view) as view, sum(current_click) as click, sum(`current_like`) as `like` FROM results where $help = '$id'";
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

if ($operation == 'getTotalAllActions') {
    $sql = "SELECT sum(current_view) as view, sum(current_click) as click, sum(`current_like`) as `like` FROM results ";
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

if ($operation == 'getProgressAction') {
    $sql = "SELECT monthName(created_at) as month,year(created_at) as year,sum(current_view) as view,sum(current_click) as click,sum(current_like) as 'like' FROM `results` where 1=1 group by year(created_at), month(created_at)";
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







// if ($operation == 'pay') {
//     $data = array(
//         "result_type" => $_POST['result_type'],
//         "card_number" => $_POST['card_number'],
//         "card_exp" => $_POST['card_exp'],
//         "cvv" => $_POST['cvv'],
//         "account_name" => $_POST['account_name'],
//         "account_number" => $_POST['account_number'],
//         "ammount" => $_POST['ammount'],
//     );
//     $id = $_POST['result_id'];
//     $help = 'result_id';

//     $help2 = "";
//     for ($idx = 0; $idx < count($data); $idx++) {
//         $help2 .= array_keys($data)[$idx] . "='" . $data[array_keys($data)[$idx]] . "'";
//         if ($idx < (count($data) - 1)) {
//             $help2 .= ",";
//         }
//     }

//     $sql = sprintf(
//         "UPDATE $table SET %s WHERE $help='$id'",
//         $help2
//     );
//     echo $sql;
//     $result = mysqli_query($con, $sql);

//     if (!$result) {
//         http_response_code(404);
//         die(mysqli_error($con));
//     }
//     echo json_encode($result);
//     http_response_code(200);
//     $con->close();
// }

if ($operation == 'delete') {
    $id = $_POST['result_id'];
    $help = 'result_id';

    $sql = "delete  FROM $table where $help = '$id'";
    $result = mysqli_query($con, $sql);
    if (!$result || !mysqli_affected_rows($con)) {
        http_response_code(404);
        die(mysqli_error($con));
    }

    http_response_code(200);
    $con->close();

}
