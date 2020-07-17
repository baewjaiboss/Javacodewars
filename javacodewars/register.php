<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;
  /**สมััครสมาชิก */
  $teacher_user = (isset($_POST['teacher_user'])) ? $_POST['teacher_user'] : '';
  $teacher_email = (isset($_POST['teacher_email'])) ? $_POST['teacher_email'] : '';
  $teacher_pass = (isset($_POST['teacher_pass'])) ? $_POST['teacher_pass'] : '';

  $salt = 'javacodewars' ;
  $hash_pass = hash_hmac('sha256',$teacher_pass,$salt);

  $user_check = "SELECT teacher_user FROM teacher WHERE teacher_user = '$teacher_user'  ";
  $result1 = mysqli_query($dbcon, $user_check) or die(mysqli_error());
  if($result1 -> num_rows == 1){
    mysqli_free_result($result1);
    response_message(500,"Unsuccess. Username already exists");
    return;
  }

  $email_check1 = "SELECT teacher_email FROM teacher WHERE teacher_email = '$teacher_email'  ";
  $result2 = mysqli_query($dbcon, $email_check1) or die(mysqli_error());
  $num2=mysqli_num_rows($result2);
  if($result2 -> num_rows == 1){
    
    mysqli_free_result($result1);
    mysqli_free_result($result2);
    response_message(500,"Unsuccess. Email already exists");
    return;
  }

  $email_check2 = "SELECT student_email FROM student WHERE student_email = '$teacher_email' ";
  $result3 = mysqli_query($dbcon, $email_check2) or die(mysqli_error());
  $num3=mysqli_num_rows($result3);
  if($result3 -> num_rows == 1){
    mysqli_free_result($result1);
    mysqli_free_result($result2);
    mysqli_free_result($result3);
    response_message(500,"Unsuccess. Email already exists");
    return;
  }else{
    
    $query = "INSERT INTO teacher(teacher_user,teacher_email,teacher_pass) VALUES ('$teacher_user','$teacher_email','$hash_pass')" ;
    $result = mysqli_query($dbcon,$query) or die(mysqli_error());
    if(!($result)){
      response_message(500,"Unsuccess Regiser");
    }
    mysqli_free_result($result1);
    mysqli_free_result($result2);
    mysqli_free_result($result3);
    response_message(200,"Success Regiser");
  }
 ?>
