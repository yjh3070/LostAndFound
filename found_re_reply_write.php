<?php
    include ('connect.php');

    if(isset($_POST['secret'])){
        $secret = $_POST['secret'];
        $secret_whether = 1;
    }
    else
        $secret_whether = 0;
    $content = $_POST['content'];
    $found_id = $_POST['lostfound_id'];
    $parent = $_POST['id'];

    $URL = './found.php?page=1';

    $sql = "select * from found_comment order by id desc limit 1";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_object($result);
    $id = $row->id;
    $id = $id + 1;

    $sql = "select seq from found_comment order by parent=$id desc limit 1";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_object($result);
    $seq = $row->seq;
    $seq = $seq + 1;

    $stu_id = $_SESSION['id'];

    $query = "insert into found_comment (id, found_id, stu_id, parent, content, depth, seq, secret) values($id, $found_id, $stu_id, $parent, '$content', 2, $seq, $secret_whether);";
    $result = mysqli_query($con, $query);
    if($result){
?>      <script>
            alert("<?php echo "댓글이 등록되었습니다."?>");
            location.replace("<?php echo $URL?>");
        </script>
<?php
    }
    else{
            echo "FAIL";
            echo mysqli_error($con);
    }

    mysqli_close($con);
?>