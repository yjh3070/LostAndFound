<?php
    include ('connect.php');

    $id = $_POST['id'];
    $reply = $_POST['reply'];

    if($reply) {
        $select_query = "select id, parent from lost_comment";
        $select_result = mysqli_query($con, $select_query);
        while($select_row = mysqli_fetch_array($select_result)){
            if($select_row['parent'] == $id){
                $re_reply_id = $select_row['id'];
                $delete_re_reply_query = "delete from lost_comment where id = $re_reply_id";
                $delete_result = mysqli_query($con, $delete_re_reply_query);
            }
        }
    }

    $delete_query = "delete from lost_comment where id = $id";
    mysqli_query($con, $delete_query);

    echo "<script>location.href='lost.php?page=1';</script>";
?>