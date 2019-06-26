<?php
if (move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES['file']['name'])) {
    echo "done";
    http_response_code(200);
    exit;
} else {
    http_response_code(404);
    echo "failed";
}
