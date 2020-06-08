<?php
$my_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
if($my_id != null){
   session_destroy();
}
echo "<script>location.href='index.php';</script>";
?>