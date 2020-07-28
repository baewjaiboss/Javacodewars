<?php
  require 'connect.php' ;
  require 'global.php' ;
    /**แก้ไขอีเมล */
  $user = (isset($_POST['user'])) ? $_POST['user'] : '';
  $email = (isset($_POST['email'])) ? $_POST['email'] : '';
 
    
    $query = "SELECT * FROM student WHERE student_id = '$user' LIMIT 1 ";
    $result1 = mysqli_query($dbcon, $query) or die(mysqli_error($dbcon));
    if($result1 -> num_rows == 1) {

        $email_check2 = "SELECT teacher_email FROM teacher WHERE teacher_email = '$email' LIMIT 1 ";
        $result2 = mysqli_query($dbcon, $email_check2) or die(mysqli_error($dbcon));
            if($result2 -> num_rows == 1) {
                mysqli_free_result($result1);
                mysqli_free_result($result2);
                response_message(200,"Unsuccess. Email already exists");
                return;
            }

        $email_check3 = "SELECT student_email FROM student WHERE student_email = '$email' LIMIT 1";
        $result3 = mysqli_query($dbcon, $email_check3) or die(mysqli_error($dbcon));
            
            if($result3 -> num_rows == 1) {
                mysqli_free_result($result1);
                mysqli_free_result($result2);
                mysqli_free_result($result3);
                response_message(200,"Unsuccess. Email already exists");
                return;
            }else {
                $sql = "UPDATE student SET student_email = '$email'  WHERE student_id = '$user' ";
                $result = mysqli_query($dbcon,$sql) or die(mysqli_error($dbcon));
                if(!($result)) {
                    mysqli_free_result($result1);
                    mysqli_free_result($result2);
                    mysqli_free_result($result3);
                    response_message(500,"Unsuccess");
                    return;
                }else {
                    mysqli_free_result($result1);
                    mysqli_free_result($result2);
                    mysqli_free_result($result3);
                    response_message(200,"Success, Change student email");
                    return;
                }
            }
    }else {
        $query = "SELECT * FROM teacher WHERE teacher_user = '$user' LIMIT 1 ";
        $result1 = mysqli_query($dbcon, $query) or die(mysqli_error($dbcon));

        $email_check2 = "SELECT teacher_email FROM teacher WHERE teacher_email = '$email' LIMIT 1 ";
        $result2 = mysqli_query($dbcon, $email_check2) or die(mysqli_error($dbcon));
            if($result2 -> num_rows == 1) {
                mysqli_free_result($result1);
                mysqli_free_result($result2);
                response_message(200,"Unsuccess. Email already exists");
                return;
            }

        $email_check3 = "SELECT student_email FROM student WHERE student_email = '$email' LIMIT 1";
        $result3 = mysqli_query($dbcon, $email_check3) or die(mysqli_error($dbcon));
            
            if($result3 -> num_rows == 1) {
                mysqli_free_result($result1);
                mysqli_free_result($result2);
                mysqli_free_result($result3);
                response_message(200,"Unsuccess. Email already exists");
                return;
            }else {
                $sql = "UPDATE teacher SET teacher_email = '$email'  WHERE teacher_user = '$user' ";
                $result = mysqli_query($dbcon,$sql) or die(mysqli_error($dbcon));
                if(!($result)) {
                    mysqli_free_result($result1);
                    mysqli_free_result($result2);
                    mysqli_free_result($result3);
                    response_message(500,"Unsuccess");
                    return;
                }else {
                    mysqli_free_result($result1);
                    mysqli_free_result($result2);
                    mysqli_free_result($result3);
                    response_message(200,"Success , Change teacher email");
                    return;
                }
            }

    }
