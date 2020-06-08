<?php
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "1234";
    $db_name = "lost_and_found";

    $con = new mysqli($db_host, $db_user, $db_password, $db_name);  // 데이터베이스 접속
    if ($con->connect_errno){
        die('Connection Error: '.$con->connect_error);  // 오류가 있으면 오류 메세지 출력
    }
    mysqli_query($con, "SET session character_set_client = 'UTF8'");
    mysqli_query($con, "SET session character_set_connection = 'UTF8'");
    mysqli_query($con, "SET session character_set_results = 'UTF8'");
    mysqli_query($con, "SET session character_set_server = 'UTF8'");

?>