<?php 
// 세션
$my_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
if($my_id==null) { // 로그인 하지 않았다면
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css?after">
    <link rel="stylesheet" href="stylesheets/login.css?after">
    <link rel="stylesheet" href="stylesheets/btn.css?after">
    <link rel="shortcut icon" href="logo/L_F.ico">

    <title>Lost And Found</title>
    
  </head>
  <body>
    <img src="images/main_lost_n_found.png" class="lost_n_found">

    <form name="login_form" action="login_check.php" method="POST">
      <input type="text" name="id" class="form-control" placeholder="학번"><br>
      <input type="password" class="form-control" id="inputPassword2" placeholder="비밀번호" name="pw">
      <button type="submit" class="btn btn-sm animated-button thar-three">Log in</button>
    </form>

    <img src="images/GSM.png" class="fixed-bottom">


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  </body>
</html>

<?php
}else{ 
   echo "<script>location.href='main.php';</script>";
}
?>