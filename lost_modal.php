<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">잃어버렸나요?</h5>
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
                                                echo "<option value = ".$row['id'].">".$row['name']."</option>";
                                        }
                                ?>
                            </select>
                            <input type="text" placeholder="분실 장소" class="modal-input-place" name=place>

                        </div>
                        <textarea placeholder="내용을 입력해 주세요." name="content" id="" cols="30" rows="10" class="modal-input-contents line"></textarea>
                        <div class="filebox bs3-primary preview-image">
                            <label for="input_file">파일 첨부</label>
                            <input class="upload-name" value="파일선택" disabled="disabled" style="width: 200px;">
                            <input type="file" id="input_file" class="upload-hidden" name="upfile">
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-upload-contents" value="등록">
                </div>
                <input type="hidden" name="lost_or_found" value="lost">
                </form>
            </div>
        </div>
    </div>