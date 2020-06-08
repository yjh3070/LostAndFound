<?php
    include ('connect.php');

    $id = $_POST['id'];
    $lost_or_found = $_POST['lost_or_found'];

    $query3 = "set foreign_key_checks = 0";
    mysqli_query($con, $query3);

    $select_query = "select id, ".$lost_or_found."_id from ".$lost_or_found."_comment";
    $select_result = mysqli_query($con, $select_query);

    while($select_row = mysqli_fetch_array($select_result)){
        if($select_row[$lost_or_found.'_id'] == $id){
            $reply_id = $select_row['id'];
            $delete_re_reply_query = "delete from ".$lost_or_found."_comment where id = $reply_id";
            mysqli_query($con, $delete_re_reply_query);
        }
    };

    $imges_delete = "delete from imges where ".$lost_or_found."_id=$id";
    mysqli_query($con, $imges_delete);

    $nCnt = $id;
    $query1 = "select id from ".$lost_or_found." order by id desc limit 1";
    $result1 = mysqli_query($con, $query1);
    $row1 = mysqli_fetch_array($result1);
    $nTot = $row1['id'];

    if($lost_or_found == 'found'){
        $locker_update = "update locker set found_id = null, archived = 0, pwd = '0000' where found_id=$id";
        mysqli_query($con, $locker_update);
    }

    $delete_query = "delete from ".$lost_or_found." where id = $id";
    mysqli_query($con, $delete_query);

    $query2 = "set SQL_SAFE_UPDATE = 0";
    mysqli_query($con, $query2);

    while($nCnt != $nTot){
        $query4 = "update ".$lost_or_found." set id='$nCnt' where id='$nCnt'+1";
        mysqli_query($con, $query4);
        $comment_update = "update ".$lost_or_found."_comment set ".$lost_or_found."_id=$nCnt where ".$lost_or_found."_id=$nCnt+1";
        mysqli_query($con, $comment_update);
        $imges_update = "update imges set ".$lost_or_found."_id=$nCnt where ".$lost_or_found."_id=$nCnt+1";
        mysqli_query($con, $imges_update);
        if($lost_or_found == "found")
            mysqli_query($con, "update locker set found_id=$nCnt where found_id=$nCnt+1");
        $nCnt++;
    }

    $query = "set foreign_key_checks = 1";
    mysqli_query($con, $query);

    if($lost_or_found == 'found'){
        echo "<script>location.href='found.php?page=1';</script>";
    }else{
        echo "<script>location.href='lost.php?page=1';</script>";
    }
?>