<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">습득했어요!</h5>
                    <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" id="content-form" method="post" action="write_Action.php">
                        <div class="line">
                            <input type="text" placeholder="글 제목" class="modal-input-title" name=subject></div>
                        <div class="type-place line">
                            <select name="type" id="" class="modal-input-type">
                                <?php
                                        include ("connect.php"); // DB접속
                                        $query = "select * from type";
                                        $result = mysqli_query($con, $query);
                                        while($row = mysqli_fetch_array($result)){
                                                echo "<option value = ".$row[0].">".$row[1]."</option>";
                                        }
                                ?>
                            </select>
                            <input type="text" placeholder="습득 장소" class="modal-input-place" name=place>

                        </div>

                        <div class="ham-password line">
                            <div class="ham">
                                <select name="locker" id="" class="modal-input-ham">
                                    <?php
                                            include ("connect.php"); // DB접속
                                            $query = "select * from locker";
                                            $result = mysqli_query($con, $query);
                                            while($row = mysqli_fetch_array($result)){
                                                    if($row[1] != 1){
                                                            echo "<option value = ".$row[0].">".$row[0]."</option>";
                                                    }
                                            }
                                    ?>
                                </select> 번 함에 보관중</div>
                            <input type="text" placeholder="보관함 비밀번호" class=" modal-input-password" numberOnly maxlength="4" name="pwd">
                        </div>
                        <textarea placeholder="내용을 입력해 주세요." name="content" id="" cols="30" rows="10" class="modal-input-contents line"></textarea>
                        <div class="filebox bs3-primary preview-image">
                            <label for="input_file">파일 첨부</label>
                            <input class="upload-name" value="파일선택" disabled="disabled" style="width: 200px;">
                            <input type="file" id="input_file" class="upload-hidden" name="upfile">
                        </div>
                   
<!--                   비밀보노 네자리 숫자-->
                    <script>
                        $("input:text[numberOnly]").on("keyup", function() {
                            $(this).val($(this).val().replace(/[^0-9]/g, ""));
                        });
                    </script>

                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-upload-contents" value="등록">
                </div>
                <input type="hidden" name="lost_or_found" value="found">
                </form>
            </div>
        </div>
    </div>