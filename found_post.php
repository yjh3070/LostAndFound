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
                    $cont_result = mysqli_query($con, "select * from found");
                    $data = mysqli_num_rows($cont_result);
                    $last_query = "select * from found order by id desc limit 1";
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
                        $query = "select * from found where id = $last_id";
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

                    $id = $row[0];

                    $stu_id = $row[5];
                    $query2 = "select name from student where id = $stu_id;";
                    $result2 = mysqli_query($con, $query2);
                    $row2 = mysqli_fetch_array($result2);

                    if($row[6] != null){
                        $locker_id = $row[6];
                        $query3 = "select archived, pwd from locker where id = $locker_id;";
                        $result3 = mysqli_query($con, $query3);
                        $row3 = mysqli_fetch_array($result3);
                        $archived = $row3['archived'];
                    }
                    else
                        $archived = 0;

                    $type_id = $row[4];
                    $query4 = "select name from type where id = $type_id;";
                    $result4 = mysqli_query($con, $query4);
                    $row4 = mysqli_fetch_array($result4);

                    $img_query = "select name_orig from imges where found_id = $id;";
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
                            echo $row[0];
                        ?>
                        </td>
                        <td scope="col" class="" style="width: 50%;"><?php
                            echo $row[1];
                        ?></td>
                        <td scope="col" class="writer" style="width: 12%"><?php
                            echo $row2[0];
                        ?></td>
                        <td scope="col" class="condition" style="width: 14%"><?php
                            if($archived == 1)
                                echo "O";
                            else
                                echo "X";
                        ?></td>
                        <td scope="col" class="date"><?php
                            echo $row[3];
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
                                        <?php if($archived == 1){ ?>
                                            <button class="content-change-btn btn" onclick="change(<?php echo $id; ?>);">찾아감</button>
                                        <?php } ?>
                                       <?php
                                        if($_SESSION['id'] == $stu_id){
                                            echo '<button class="content-delete-btn btn" onclick="postDelete('.$id.')"><img src="images/delete.png" width="20px"></button>';
                                        }
                                    ?>
                                    </div>
<!--                                    프롬프트 js-->
                                    <script>
                                        function change(id){
                                            const inputNum = prompt('보관함의 비밀번호를 입력해주세요.', '번호 입력');

                                            const path = "find.php";
                                            const form = document.createElement("form");
                                            form.setAttribute("method", "post");
                                            form.setAttribute("action", path);

                                            const hiddenField = document.createElement("input");
                                            hiddenField.setAttribute("type", "hidden");
                                            hiddenField.setAttribute("name", "id");
                                            hiddenField.setAttribute("value", id);

                                            form.appendChild(hiddenField);

                                            const hiddenField2 = document.createElement("input");
                                            hiddenField2.setAttribute("type", "hidden");
                                            hiddenField2.setAttribute("name", "pwd");
                                            hiddenField2.setAttribute("value", inputNum);

                                            form.appendChild(hiddenField2);

                                            document.body.appendChild(form);
                                            form.submit();
                                        }
                                    </script>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="row">습득장소</div>
                                            <div class="row">분류</div>
                                            <div class="row">보관</div>
                                            <div class="row">습득자</div>
                                            <?php if($stu_id == $_SESSION['id'] && $archived == 1){?>
                                            <div class="row">보관함 비밀번호</div>
                                            <?php } ?>
                                        </div>
                                        <div class="col">
                                            <div class="row"><?php
                                                echo $row[7];
                                            ?></div>
                                            <div class="row"><?php
                                                echo $row4[0];
                                            ?></div>
                                            <div class="row"><?php
                                                if($archived == 1){
                                                    echo $locker_id.'번 함에 보관중';
                                                }
                                                else{
                                                    echo '찾아감';
                                                }
                                            ?></div>
                                            <div class="row"><?php
                                                echo $row2[0];
                                            ?></div>
                                            <?php if($stu_id == $_SESSION['id'] && $archived == 1){?>
                                                <div class="row"><?php
                                                    echo $row3['pwd'];
                                                ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="add" style="white-space: pre-line;"><?php
                                echo $row[2];
                            ?></div>
                        </div>
                        <div class="form-group reply"><span style="margin-right: 15px; font-size: 15px; font-weight: bold">앗, 내꺼인가?</span>
                            <form method="POST" action="found_reply_write.php" style="display: inline;">
                                <input type="hidden" value="<?php echo $id?>" name="found_id">
                                <label style="line-height: 27px; margin-bottom: 0px;">
                                    <div class="custom-control custom-checkbox">
                                        <input style="margin-right: 0px;" type="checkbox" class="custom-control-input" id="customCheck<?php echo '1'.$id?>" name="secret">
                                        <label style="font-size: 12px;" class="custom-control-label" for="customCheck<?php echo '1'.$id?>">비밀댓글 남기기<img src="images/lock%20(1).png" width="19px" style="margin-bottom: 10px"></label>
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
                            include ('found_reply.php');
                        ?>
                    </div>
                </div>
            </div>
            <?php
                    $last_id = $last_id - 1;
                    //$data = $data + 1;
                };
                unset( $_SESSION['search_query'] );
            ?>