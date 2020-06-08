<?php
include ("connect.php"); // DB접속

$id = $_POST['id']; // 아이디
$pw = $_POST['pw']; // 패스워드
$query = "select * from student where id='$id' LIMIT 1";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
// $hash_password = $row['pwd'];

// if($row['id'] == $row['pwd']){
   if($id==$row['id'] && $pw==$row['pwd']){ // id와 pw가 맞다면 login
      $_SESSION['id']=$row['id'];
      $_SESSION['name']=$row['name'];
      echo "<script>location.href='login.php';</script>";
   }else{ // id 또는 pw가 다르다면 login 폼으로
      echo "<script>window.alert('아이디 또는 비밀번호가 틀렸습니다.');</script>"; // 잘못된 아이디 또는 비빌번호 입니다
      echo "<script>location.href='login.php';</script>";
    }
// }
// else{
//    if($id==$row['id'] && password_verify($pw, $hash_password)){ // id와 pw가 맞다면 login
//       $_SESSION['id']=$row['id'];
//       $_SESSION['name']=$row['name'];
//       echo "<script>location.href='login.php';</script>";
//    }else{ // id 또는 pw가 다르다면 login 폼으로
//       echo "<script>window.alert('아이디 또는 비밀번호가 틀렸습니다.');</script>"; // 잘못된 아이디 또는 비빌번호 입니다
//       echo "<script>location.href='login.php';</script>";
//    }
// }
?>