<?php
                include ("connect.php"); // DB접속
                
                $subject = $_POST['subject'];  
                $type = $_POST['type'];                     
                $place = $_POST['place']; 
                $locker = $_POST['locker'];  
                $content = $_POST['content'];  
                $pwd = $_POST['pwd'];      
                $date = date('Y-m-d H:i:s');            
 
                $URL = './found.php?page=1';                   //return URL
 
                $sql = "select * from found order by id desc limit 1";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_object($result);
                $id = $row->id;
                $id = $id + 1;
                $stu_id = $_SESSION['id'];

                $query = "insert into found (id, subject, content, date, type_id, student_id, locker_id, place) values('$id', '$subject','$content', '$date', '$type', '$stu_id', '$locker', '$place')";

                $query3 = "set foreign_key_checks = 0";
                mysqli_query($con, $query3);

                $query2 = "update locker set archived = 1, found_id = $id, pwd = '$pwd' where id = $locker";

                if(isset($_FILES['upfile']) && $_FILES['upfile']['name'] != "") {
                        $file = $_FILES['upfile'];
                        $upload_directory = 'uploads';
                        $ext_str = "jpg,gif,png";
                        $allowed_extensions = explode(',', $ext_str);
                        $name = $_FILES['upfile']['name'];
                        $target_path = dirname(__FILE__).'\\'.$upload_directory;
                        echo $target_path;

                        $max_file_size = 5242880;
                        $ext = substr($file['name'], strrpos($file['name'], '.') + 1);

                        // 확장자 체크
                        if(!in_array($ext, $allowed_extensions)) {
                                echo "업로드할 수 없는 확장자 입니다.";
                        }

                        // 파일 크기 체크
                        if($file['size'] >= $max_file_size) {
                                echo "5MB 까지만 업로드 가능합니다.";
                        }

                        $path = md5(microtime()) . '.' . $ext;
                        chmod($target_path, 0777);
                        if(move_uploaded_file($file['tmp_name'], $target_path.'\\'.$name)) {
                                $sql = "select * from imges order by id desc limit 1";
                                $result = mysqli_query($con, $sql);
                                $row = mysqli_fetch_object($result);
                                $file_id = $row->id;
                                $file_id = $file_id + 1;
                                $name_orig = $file['name'];
                                $name_save = $path;
                                $query6 = "INSERT INTO imges (id, name_orig, name_save, reg_time, found_id) VALUES ($file_id, '$name_orig', '$name_save', now(), $id)";
                                
                                mysqli_query($con, $query6);
                                
                        } 
                }

                mysqli_query($con, $query2);

                $query5 = "set foreign_key_checks = 1";
                mysqli_query($con, $query5);
 
                $result = mysqli_query($con, $query);
                
                if($result){
?>                  <script>
                        alert("<?php echo "글이 등록되었습니다."?>");
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
