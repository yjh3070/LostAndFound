<?php
                function get_stu_id($stu_id){
                    include ("connect.php"); // DB접속
                    $get_stu_id_query = "select name from student where id = $stu_id;";
                    $get_stu_id_result = mysqli_query($con, $get_stu_id_query);
                    $get_stu_id_row = mysqli_fetch_array($get_stu_id_result);
                    return $get_stu_id_row;
                }

                include ('connect.php');

                $page = $_GET['page'] * 10;

                $data = 0;

                if(isset($_SESSION['search_query'])){
                    $cont_result = mysqli_query($con, $_SESSION['search_query']);
                    $data = mysqli_num_rows($cont_result);
                    $last_query = $_SESSION['search_query']." order by id desc limit 1";
                    $last_result = mysqli_query($con, $last_query);
                    if(mysqli_fetch_array($last_result)){
                        $last_result = mysqli_query($con, $last_query);
                        $last_row = mysqli_fetch_array($last_result);
                    }
                    else{
                        return;
                    }
                    
                    $fix_last_id = $last_row['id'];
                    $last_id = $last_row['id'];
                    if($page != 1)
                        $last_id = $last_id - ($page / 10-1) * 10;
                    $last = $last_id-$page;
                    if($last <= 0){
                        $last = 0;
                    }
                }
                else{
                    $cont_result = mysqli_query($con, "select * from lost");
                    $data = mysqli_num_rows($cont_result);
                    $last_query = "select * from lost order by id desc limit 1";
                    $last_result = mysqli_query($con, $last_query);
                    $last_row = mysqli_fetch_array($last_result);
                    $fix_last_id = $last_row['id'];
                    $last_id = $last_row['id'];
                    if($page != 1)
                        $last_id = $last_id - ($page / 10-1) * 10;
                    $last = $last_id-$page;
                    if($last <= 0){
                        $last = 0;
                    }
                }
                while($last_id > $last){
                    if(isset($_SESSION['search_query'])){
                        $query = $_SESSION['search_query']." and id = $last_id";
                    }
                    else{
                        $query = "select * from lost where id = $last_id";
                    }
                    $result = mysqli_query($con, $query);
                    if(mysqli_fetch_array($result)){
                        $result = mysqli_query($con, $query);
                        $row = mysqli_fetch_array($result); 
                    }
                    else{
                        $last_id = $last_id - 1;
                        continue;
                    }

                    $id = $row['id'];

                    $stu_id = $row['student_id'];
                    $query2 = "select name from student where id = $stu_id;";
                    $result2 = mysqli_query($con, $query2);
                    $row2 = mysqli_fetch_array($result2);

                    $type_id = $row['type_id'];
                    $query4 = "select name from type where id = $type_id;";
                    $result4 = mysqli_query($con, $query4);
                    $row4 = mysqli_fetch_array($result4);

                    $img_query = "select name_orig from imges where lost_id = $id;";
                    $img_result = mysqli_query($con, $img_query);
                    $img_row = mysqli_fetch_array($img_result);
            ?>
            <div id="heading<?php echo $id?>">
                <table <?php
                    if($row['id'] == $fix_last_id){
                        echo "id=one";
                    }
                ?> class="arcodion-list table list-group-item-action" data-toggle="collapse" data-target="#collapse<?php echo $id?>" aria-expanded="false" aria-controls="collapse<?php echo $id?>">
                    <tr>
                        <td scope="col" class="serial-num" style="width: 10%">
                        <?php
                            echo $row['id'];
                        ?>
                        </td>
                        <td scope="col" class="" style="width: 60%;"><?php
                            echo $row['subject'];
                        ?></td>
                        <td scope="col" class="writer" style="width: 12%"><?php
                            echo $row2['name'];
                        ?></td>
                        <td scope="col" class="date"><?php
                            echo $row['date'];
                        ?></td>
                    </tr>
                </table>
            </div>

            <div id="collapse<?php echo $id?>" class="collapse" aria-labelledby="heading<?php echo $id?>" data-parent="#accordionExample">
                <div class="hiddenRow">
                    <div class="container">
                        <div class="article">
                            <div class="row">
                                <?php 
                                    $img_name = $img_row['name_orig'];
                                    if($img_name == "")
                                        $img_name = 'no-pic.png';
                                ?>
                                <div class="col-5"><img class="img-thumbnail img-fluid" src="uploads/<?php echo $img_name ?>" alt=""></div>
                                <div class="col classification">
                                    <div class="content-change-delete">
                                        <?php
                                            if($_SESSION['id'] == $stu_id)
                                            echo '<div class="content-delete">
                                                <button class="content-delete-btn btn" onclick="postDelete('.$id.')"><img src="images/delete.png" width="20px"></button>
                                            </div>';
                                        ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="row">분실장소</div>
                                            <div class="row">분류</div>
                                            <div class="row">분실자</div>
                                        </div>
                                        <div class="col">
                                            <div class="row"><?php
                                                if($row['place'] == null)
                                                    echo "모름";
                                                echo $row['place'];
                                            ?></div>
                                            <div class="row"><?php
                                                echo $row4['name'];
                                            ?></div>
                                            <div class="row"><?php
                                                echo $row2['name'];
                                            ?></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="add" style="white-space: pre-line;"><?php
                                echo $row[2];
                            ?></div>
                        </div>
                        <div class="form-group reply"><span style="margin-right: 15px; font-size: 15px; font-weight: bold">앗, 내꺼인가?</span>
                            <form method="POST" action="lost_reply_write.php" style="display: inline;">
                                <input type="hidden" value="<?php echo $id?>" name="lost_id">
                                <label style="line-height: 27px; margin-bottom: 0px;">
                                    <div class="custom-control custom-checkbox">
                                        <input style="margin-right: 0px;" type="checkbox" class="custom-control-input" id="customCheck<?php echo $id?>" name="secret">
                                        <label style="font-size: 12px;" class="custom-control-label" for="customCheck<?php echo $id?>">비밀댓글 남기기<img src="images/lock%20(1).png" width="19px" style="margin-bottom: 10px"></label>
                                    </div>
                                </label>
                                <div class="reply-input row">
                                    <div class="col-10">
                                        <textarea class="form-control reply-space" placeholder="댓글을 남겨주세요." name="reply"></textarea></div>
                                    <div class="col">
                                        <input type="submit" class="col btn btn-reply" value="댓글 등록"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="reply-list">
                        <?php
                            include ('lost_reply.php');
                        ?>
                    </div>
                </div>
            </div>
            <?php
                $last_id = $last_id - 1;
                //$data = $data + 1;
                };
                unset($_SESSION['search_query']);
            ?>