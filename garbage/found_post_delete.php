<?php

    include ('connect.php');

    $id = $_POST['id'];

    $query3 = "set foreign_key_checks = 0";
    mysqli_query($con, $query3);

    $select_query = "select id, found_id from found_comment";
    $select_result = mysqli_query($con, $select_query);
    while($select_row = mysqli_fetch_array($select_result)){
        if($select_row['found_id'] == $id){
            $reply_id = $select_row['id'];
            $delete_re_reply_query = "delete from found_comment where id = $reply_id";
            mysqli_query($con, $delete_re_reply_query);
        }
    };

    $imges_delete = "delete from imges where found_id=$id";
    mysqli_query($con, $imges_delete);

    $nCnt = $id;
    $query1 = "select id from found order by id desc limit 1";
    $result1 = mysqli_query($con, $query1);
    $row1 = mysqli_fetch_array($result1);
    $nTot = $row1['id'];

    $delete_query = "delete from found where id = $id";
    mysqli_query($con, $delete_query);

    $locker_update = "update locker set found_id = null, archived = 0, pwd = 0000 where found_id=$id";
    mysqli_query($con, $locker_update);

    $query2 = "set SQL_SAFE_UPDATE = 0";
    mysqli_query($con, $query2);

    while($nCnt != $nTot){
        $query4 = "update found set id='$nCnt' where id='$nCnt'+1";
        mysqli_query($con, $query4);
        $comment_update = "update found_comment set found_id=$nCnt where found_id=$nCnt+1";
        mysqli_query($con, $comment_update);
        $imges_update = "update imges set found_id=$nCnt where found_id=$nCnt+1";
        mysqli_query($con, $comment_update);
        $nCnt++;
    }



    $query = "set foreign_key_checks = 1";
    mysqli_query($con, $query);

    echo "<script>location.href='found.php?page=1';</script>";
?>