<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;
    /**แก้ไขรหัสผ่าน */
  $user = (isset($_POST['user'])) ? $_POST['user'] : '';
  $password_old = (isset($_POST['password_old'])) ? $_POST['password_old'] : '';
  $password_new = (isset($_POST['password_new'])) ? $_POST['password_new'] : '';
  
  $salt = 'javacodewars' ;

    $query = "SELECT * FROM student WHERE student_id = '$user' ";
    $result1 = mysqli_query($dbcon, $query) or die(mysqli_error());
    if($result1 -> num_rows == 1) {
        $row = mysqli_fetch_assoc($result1) ;
        $chack_pass = (isset($row['student_pass'])) ? $row['student_pass'] : ''; 
        $hash_pass_old = hash_hmac('sha256',$password_old,$salt);
        //echo $chack_pass."<br>".$hash_pass_old ."<hr>";
        $check = strcmp($chack_pass,$hash_pass_old);
        if($check == 0) {
            $hash_pass_new = hash_hmac('sha256',$password_new,$salt);
            $sql = "UPDATE student SET  student_pass = '$hash_pass_new'  WHERE student_id = '$user' ";
            $result = mysqli_query($dbcon,$sql) or die(mysqli_error());
                if(!($result)) {
                    mysqli_free_result($result1);
                    mysqli_close($dbcon);
                    response_message(500,"Unsuccess");
                }else {
                    mysqli_free_result($result1);
                    mysqli_close($dbcon);
                    response_message(200,"Success,Change student password");
                }

        }else {
            mysqli_free_result($result1);
            mysqli_close($dbcon);
            response_message(500,"Unsuccess, Student password invalid");
        }

    }else {

        $query = "SELECT * FROM teacher WHERE teacher_user = '$user' ";
        $result1 = mysqli_query($dbcon, $query) or die(mysqli_error());
        $row = mysqli_fetch_assoc($result1) ;
        $chack_pass =  (isset($row['teacher_pass'])) ? $row['teacher_pass'] : '';
        $hash_pass_old = hash_hmac('sha256',$password_old,$salt);
        //echo $chack_pass."<br>".$hash_pass_old ."<hr>";
        $check = strcmp($chack_pass,$hash_pass_old);
        if($check == 0) {
            $hash_pass_new = hash_hmac('sha256',$password_new,$salt);
            $sql = "UPDATE teacher SET  teacher_pass = '$hash_pass_new'  WHERE teacher_user = '$user' ";
            $result = mysqli_query($dbcon,$sql) or die(mysqli_error());
                if(!($result)) {
                    mysqli_free_result($result1);
                    mysqli_close($dbcon);
                    response_message(500,"Unsuccess");
                }else {
                    mysqli_free_result($result1);
                    mysqli_close($dbcon);
                    response_message(200,"Success,Change teacher password");
                }

        }else {
            mysqli_free_result($result1);
            mysqli_close($dbcon);
            response_message(500,"Unsuccess, Teacher password invalid");
        }

    }

 ?>