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

    <title>Lost And Found</title>
    
  </head>
  <body>
    <img onclick="location.href='main.php'" src="images/main_lost_n_found.png" class="lost_n_found">

    <form name="login_form" action="pwd_check.php" method="POST">
      <input type="password" name="pwd" class="form-control" placeholder="비밀번호"><br>
      <input type="password" class="form-control" id="inputPassword2" placeholder="비밀번호 확인" name="pwd_check">
      <button type="submit" class="btn btn-sm animated-button thar-three">비밀번호 재설정</button>
    </form>

    <img src="images/GSM.png" class="fixed-bottom">


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  </body>
</html>