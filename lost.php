<?php
    $my_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
    if($my_id==null) {
        echo "<script>location.href='index.php';</script>";
    }
    else{
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!--    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->

    <!--    제이쿼리-->

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css?after" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css?after">

    <link rel="stylesheet" href="stylesheets/reset.css?after">
    <link rel="stylesheet" href="stylesheets/lost.css?after">
    <link rel="shortcut icon" href="logo/L_F.ico">

    <title>lost</title>

    <script type="text/javascript"> 
        const replyDelete = function(id, reply){
            alert("댓글을 삭제합니다.");

            const path = "lost_reply_delete.php";
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
            hiddenField2.setAttribute("name", "reply");
            hiddenField2.setAttribute("value", reply);

            form.appendChild(hiddenField2);

            document.body.appendChild(form);
            form.submit();
        };

        const postDelete = function(id){
            alert("게시물을 삭제합니다.");

            const path = "post_delete.php";
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
            hiddenField2.setAttribute("name", "lost_or_found");
            hiddenField2.setAttribute("value", "lost");

            form.appendChild(hiddenField2);

            document.body.appendChild(form);
            form.submit();
        };
    </script>
</head>

<body>
    <header id="head"><img class="heading" src="images/Lost & Found.png" alt="Lost & Found" onclick="location.href='main.php'">
    </header>
    <nav class="menu">
        <ul>
            <li class="lost"><a href="lost.php?page=1">잃어버렸나요?</a></li>
            <li class="found"><a href="found.php?page=1">주인을 찾아요!</a></li>
        </ul>
    </nav>

    <!--    내비 추가-->
    <nav id="scrolled" class="fixed-top">
        <img src="images/Lost%20&%20Found.png" width="270px" alt="" onclick="location.href='main.php'">
        <ul class="menu">
            <li class="lost"><a href="lost.php?page=1">잃어버렸나요?</a></li>
            <li class="found"><a href="found.php?page=1">주인을 찾아요!</a></li>
        </ul>
    </nav>

    <section class="board">
        <div class="upload">
            <span>물건을 잃어버렸을 때</span>
            <button type="button" class="btn btn-upload" data-toggle="modal" data-target="#exampleModalCenter">분실했어요!</button>
        </div>
        <form class="search-form" action="search.php" method="post">
            <input type="hidden" name="lost_or_found" value="lost">
            <div class="row row-cols-2">
                <div class="col title-search">
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">글 제목</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="subject">
                        </div>
                    </div>
                </div>
                <div class="col date-search">
                    <div class="form-group row">
                        <label for="input" class="col-sm-3 col-form-label date-label">날짜</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="datefilter"/>
                            <script type="text/javascript" src="javascripts/datepicker.js">
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col type-search">
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">분류</label>
                        <div class="col-sm-9">
                            <select class="custom-select" name="type">
                                <option selected></option>
                                <?php
                                    include ("connect.php"); // DB접속
                                    $query = "select * from type";
                                    $result = mysqli_query($con, $query);
                                    while($row = mysqli_fetch_array($result)){
                                            echo "<option value = ".$row[0].">".$row[1]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col place-search">
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label place-label">장소</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="" name="place">
                        </div>
                    </div>
                </div>
            </div>
            <div class="search">
                <button type="submit" class="btn btn-search">검색하기</button>
            </div>
        </form>

        <div class="accordion" id="accordionExample">
            <table class="table list">
                <thead>
                    <tr>
                        <td scope="col" style="width: 10%">번호</td>
                        <td scope="col" style="width: 60%;">글 제목</td>
                        <td scope="col" style="width: 12%">작성자</td>
                        <td scope="col">날짜</td>
                    </tr>
                </thead>
            </table>

           <!-- 게시물 -->
           <?php
                include('lost_post.php');
           ?>
        </div>
           <div class="upload">
            <button type="button" class="btn btn-upload" data-toggle="modal" data-target="#exampleModalCenter">분실했어요!</button>
            </div>

        <nav aria-label="...">
            <ul class="pagination">
                <?php
                    $page = $_GET['page'];
                    $list = 10;
                    $block = 3;
                    $pageNum = ceil($data/$list); // 총 페이지
                    $blockNum = ceil($pageNum/$block); // 총 블록
                    $nowBlock = ceil($page/$block);

                    $s_page = ($nowBlock * $block) - ($block - 1);

                    if ($s_page <= 1) {
                        $s_page = 1;
                    }
                    $e_page = $nowBlock*$block;
                    if ($pageNum <= $e_page) {
                        $e_page = $pageNum;
                    }

                    ?>
                    <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item <?php if($page == 1) echo 'disabled'?>">
                                <a class="page-link prev" href="lost.php?page=<?=$page-1?>" <?php if($page == 1) echo 'tabindex="-1" aria-disabled="true"'?>>&laquo;</a>
                            </li>
                            <?php
                            for ($p=$s_page; $p<=$e_page; $p++) {
                                if($p == $page){
                            ?>
                                <li class="page-item active">
                                    <a class="page-link" href="lost.php?page=<?=$p?>"><?=$p?></a>
                                </li>
                            <?php
                                } else {
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="lost.php?page=<?=$p?>"><?=$p?></a>
                            </li>
                            <?php
                                }
                            }
                            ?>
                            <li class="page-item <?php if($page == $e_page) echo 'disabled'?>">
                                <a class="page-link next" href="lost.php?page=<?=$page+1?>" <?php if($page == $e_page) echo 'tabindex="-1" aria-disabled="true"'?>>&raquo;</a>
                            </li>
                        </ul>
                    </nav>


                <?php
                    $s_point = ($page-1) * $list;


                    $real_data = mysqli_query($con,"SELECT * FROM list ORDER BY no DESC LIMIT $s_point,$list");
                ?>
            </ul>
        </nav>


        <script src="javascripts/accordian.js"></script>



    </section>


    <!-- Modal -->
    <?php
        include ('lost_modal.php');

        mysqli_close($con);
    ?>

    <script src="javascripts/form-reset.js"></script>
    <script src="javascripts/nav-scroll.js"></script>
    <script src="javascripts/image-upload.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body></html>
<?php
    }
    unset($_SESSION['search_query']);
?>