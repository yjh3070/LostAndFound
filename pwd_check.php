<?php
    include ("connect.php"); // DB접속

    $pwd = $_POST['pwd'];
    $pwd_check = $_POST['pwd_check'];
    $id = $_SESSION['id'];

    if($pwd != $pwd_check){
        echo "<script>window.alert('비밀번호가 다릅니다');";
        echo "location.href='pwd.php';</script>";
    }
    else if(strlen($pwd) < 8){
        echo "<script>window.alert('비밀번호는 8자 이상으로 설정해주세요');";
        echo "location.href='pwd.php';</script>";
    }
    else{
        // $encrypted_password = password_hash($pwd, PASSWORD_DEFAULT);
        $query = "update student set pwd = '$pwd' where id = $id";
        $result = mysqli_query($con, $query);
        echo "<script>window.alert('비밀번호가 변경되었습니다.');";
        echo "location.href='main.php';</script>";
    }
?>