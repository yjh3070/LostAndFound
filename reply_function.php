<?php
    function input($id, $id_id, $lostfound_id, $parent_secret, $lost_and_found){
      echo  '<div class="collapse" id="collapseExample'.$id_id.'">
                <form method="post" action="'.$lost_and_found.'">
                    <div class="form-group re-reply-input">';
                        if(!$parent_secret){
                            echo '<label style="line-height: 27px; margin-bottom: 0px;">
                                <div style="display: inline" class="custom-control custom-checkbox">
                                    <input style="margin-right: 0px;" type="checkbox" class="custom-control-input" id="customCheckreply'.$id_id.'" name="secret">
                                    <label style="font-size: 12px;" class="custom-control-label" for="customCheckreply'.$id_id.'">비밀댓글 남기기<img src="images/lock%20(1).png" width="19px" style="margin-bottom: 10px"></label>
                                </div>
                            </label>';
                        }
                        else{
                            echo '<input type="hidden" name="secret" value=1>';
                        }
                        echo '<div class="reply-input row">
                                <input type="hidden" value="'.$lostfound_id.'" name="lostfound_id">
                                <input type="hidden" value="'.$id.'" name="id">
                            <div class="col-10">
                                <textarea class="form-control reply-space" placeholder="댓글을 남겨주세요." name="content"></textarea></div>
                            <div class="col">
                                <input type="submit" class="col btn btn-reply" value="댓글 등록"></div>
                                <input type="hidden" name="parent" value="'.$id.'">
                        </div>
                    </div>
                </form>
            </div></li>';
    }

    function reply($secret, $name, $id, $stu_id, $content){
        echo '<li class="list-group-item odd"><div class="user-set"><div class="user"><img src="images/';
        if($secret)
            echo 'lock%20(1).png';
        else
            echo 'reply.png';
        echo '" width="25px" style="margin-right: 5px;">'.$name.'</div><div class="set"><span class="re-re" data-toggle="collapse" href="#collapseExample'.$id.'" role="button" aria-expanded="false" aria-controls="collapseExample">답글</span>';

        if($_SESSION['id'] == $stu_id)
        {
            echo " | ";
            echo '<span class="reply-delete" onclick="replyDelete('.$id.', 1)">삭제</span>';
        }
            

        echo '</div></div><div class="reply-contents">'.$content.'</div>';
    }

    function re_reply($secret, $name, $stu_id, $content, $id){
        echo '<li class="list-group-item even re-reply row"><div class="col-1"><img src="images/%EA%B7%B8%EB%A3%B9%2020.png" width="25px" class="re-re-img"></div><div class="re-re-contents col"><div class="user-set"><div class="user"><img src="images/';
        if($secret)
            echo 'lock%20(1).png';
        else
            echo 'reply2.png';
        echo '" width="25px" style="margin-right: 5px;">'.$name.'</div><div class="set">';
        
        if($_SESSION['id'] == $stu_id)
            echo'<span class="reply-delete" onclick="replyDelete('.$id.', 0)">삭제</span>';
        
        echo '</div></div><div class="reply-contents">'.$content.'</div>';
    }
?>