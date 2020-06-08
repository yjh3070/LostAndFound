<?php
    include ('connect.php');

    $found_id = $_POST['id'];
    $pwd = $_POST['pwd'];

    $locker_pwd_result = mysqli_query($con, "select pwd from locker where found_id = $found_id");
    $locker_pwd = mysqli_fetch_array($locker_pwd_result);


    if($locker_pwd['pwd'] == $pwd){
        mysqli_query($con, "update locker set found_id = null, archived = 0, pwd = '0000' where found_id=$found_id");
        mysqli_query($con, "update locker set locker_id = null where id=$found_id");
    }
    else{
        echo '<script>alert("비밀번호가 틀렸습니다.")</script>';
    }

    mysqli_close($con);

    echo "<script>location.href='found.php?page=1'</script>";
?>