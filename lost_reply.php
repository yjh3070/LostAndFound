<ul class="list-group list-group-flush">
<?php
    include_once ('reply_function.php');
    $query5 = "select id, stu_id, content, parent, depth, seq, secret from lost_comment where lost_id=$id";
    $result5 = mysqli_query($con, $query5);
    $lost_qeury = "select student_id from lost where id=$id";
    $lost_result = mysqli_query($con, $lost_qeury);
    $lost_row = mysqli_fetch_array($lost_result);
    while($row5 = mysqli_fetch_array($result5)){
        $result6 = mysqli_query($con, $query5);
        $parent = $row5['id'];
        if($row5['secret'] && $lost_row['student_id'] != $_SESSION['id']){
            if($row5['depth'] == 1){
                if($row5['stu_id'] != $_SESSION['id']){
?>
                    <li class='list-group-item odd'>
                        <img class='reply-secret' src='images/lock%20(1).png' width='25px' style='margin-right: 5px;'>비밀 댓글은 글 작성자만 보입니다.
                    </li>
<?php
                }
                else{
                    $row7 = get_stu_id($row5['stu_id']);
                    reply($row5['secret'], $row7['name'], $row5['id'], $row5['stu_id'], $row5['content']);
                    input($row5['id'], $row5['id'], $id, $row5['secret'], "lost_re_reply_write.php");
                }
                while($row6 = mysqli_fetch_array($result6)){
                    if($row6['parent'] == $parent && $row6['stu_id'] != $_SESSION['id']){
?>
                        <li class="list-group-item even re-reply row">
                            <div class="col-1"><img src="images/%EA%B7%B8%EB%A3%B9%2020.png" width="25px" class="re-re-img"></div>
                            <div class="re-re-contents col">
                                <img class="reply-secret" src="images/lock%20(1).png" width="25px" style="margin-right: 5px;">비밀 댓글은 글 작성자만 보입니다.
                            </div>
                        </li>
<?php
                    }
                    else if($row6['parent'] != null && $row6['parent'] == $parent){
                        $row7 = get_stu_id($row6['stu_id']);
                        re_reply($row6['secret'], $row7['name'], $row6['stu_id'], $row6['content'], $row6['id']);
                        input($row5['id'], 're-reply'.$row5['id'], $id, $row5['secret'], "lost_re_reply_write.php");
                    }
                }
            }
        }
        else{
            if($row5[4] == 1){
                $row7 = get_stu_id($row5['stu_id']);
                reply($row5['secret'], $row7['name'], $row5['id'], $row5['stu_id'], $row5['content']);

                input($row5['id'], $row5[0], $id, $row5['secret'], "lost_re_reply_write.php");

                while($row6 = mysqli_fetch_array($result6)){
                    if($row6['secret'] && $row6['parent'] == $parent && $row6['stu_id'] != $_SESSION['id']){
?>
                        <li class="list-group-item even re-reply row">
                            <div class="col-1"><img src="images/%EA%B7%B8%EB%A3%B9%2020.png" width="25px" class="re-re-img"></div>
                            <div class="re-re-contents col">
                                <img class="reply-secret" src="images/lock%20(1).png" width="25px" style="margin-right: 5px;">비밀 댓글은 글 작성자만 보입니다.
                            </div>
                        </li>
<?php
                    }
                    else if($row6['parent'] != null && $row6['parent'] == $parent){
                        $row7 = get_stu_id($row6['stu_id']);
                        re_reply($row6['secret'], $row7['name'], $row6['stu_id'], $row6['content'], $row6['id']);
                        input($row5['id'], 're-reply'.$row5['id'], $id, $row5['secret'], "lost_re_reply.write.php");
                    }
                }
            }
        }
    }
?>
</ul>