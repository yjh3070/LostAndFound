<?php

    include ('connect.php');

    $id = $_POST['id'];

    $query3 = "set foreign_key_checks = 0";
        mysqli_query($con, $query3);

    $select_query = "select id, lost_id from lost_comment";
    $select_result = mysqli_query($con, $select_query);
    while($select_row = mysqli_fetch_array($select_result)){
        if($select_row['lost_id'] == $id){
            $reply_id = $select_row['id'];
            $delete_re_reply_query = "delete from lost_comment where id = $reply_id";
            mysqli_query($con, $delete_re_reply_query);
        }
    };

    $nCnt = $id;
    $query1 = "select id from lost order by id desc limit 1";
    $result1 = mysqli_query($con, $query1);
    $row1 = mysqli_fetch_array($result1);
    $nTot = $row1['id'];

    $delete_query = "delete from lost where id = $id";
    mysqli_query($con, $delete_query);
    $imges_delete = "delete from imges where lost_id=$id";
    mysqli_query($con, $imges_delete);
    
    if($row1['id'] != 1){
        $query2 = "set SQL_SAFE_UPDATE = 0";
        mysqli_query($con, $query2);

        while($nCnt != $nTot){
            $query4 = "update lost set id='$nCnt' where id='$nCnt'+1";
            mysqli_query($con, $query4);
            $comment_update = "update lost_comment set lost_id=$nCnt where lost_id=$nCnt+1";
            mysqli_query($con, $comment_update);
            $comment_update = "update imges set lost_id=$nCnt where lost_id=$nCnt+1";
            mysqli_query($con, $comment_update);
            $nCnt++;
        }

        $query = "set foreign_key_checks = 1";
        mysqli_query($con, $query);
    }
    echo "<script>location.href='lost.php?page=1';</script>";
?>