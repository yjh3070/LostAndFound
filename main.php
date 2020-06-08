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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css?after">
    <link rel="stylesheet" href="stylesheets/main.css?after">
    <link rel="stylesheet" href="stylesheets/btn.css?after">
    <link rel="shortcut icon" href="logo/L_F.ico">

    <title>Lost And Found</title>
  </head>
  <body>
    <img src="images/main_lost_n_found.png" class="lost_n_found">

    <div class="btndiv">
      <div class="btndiv"> <button class="btn btn-sm animated-button thar-three" onclick="location.href='lost.php?page=1'">잃어버렸나요?</button> </div>
      <div class="btndiv bottom"> <button class="btn btn-sm animated-button thar-three" onclick="location.href='found.php?page=1'">주인을 찾아요!</button> </div>
    </div>
    <img src="images/GSM.png" class="gsm fixed-bottom">

    <div class="alertdiv fixed-bottom">
      <div class="alert alert-info bootoast alert-dismissable" style="opacity: 1;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <span class="glyphicon glyphicon-info-sign"></span>
        <span class="bootoast-alert-container">
          <span class="bootoast-alert-content">비밀번호를 변경하려면 이름을 클릭하세요</span>
        </span>
      </div>
    </div>

    <?php
        echo '<div class="fixed-bottom">';
        echo "안녕하세요 <a href='pwd.php'>";
        echo $_SESSION['name']."</a> 회원님!";
        echo "<a href='logout.php'><button class='btn btn-sm animated-button thar-three'>Log out</button></a>";
        echo "</div>";
    ?>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  </body>
</html>

<?php
    }
?>