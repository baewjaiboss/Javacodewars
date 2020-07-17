<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;
/**เข้าสู่ระบบ */
  $username = mysqli_real_escape_string($dbcon,($_POST['username']));;
  $password = mysqli_real_escape_string($dbcon,($_POST['password'])); ;
  $email = mysqli_real_escape_string($dbcon,($_POST['username']));
  $results_array = array();

  $salt = 'javacodewars' ;
  $hash_pass = hash_hmac('sha256',$password,$salt);
 
  $sql1 = "SELECT teacher_user , teacher_email , teacher_picture FROM teacher WHERE teacher_user=? AND teacher_pass=?";
  $stmt = mysqli_prepare($dbcon,$sql1);
  mysqli_stmt_bind_param($stmt,"ss",$username,$hash_pass);
  mysqli_execute($stmt);
  $result1 = mysqli_stmt_get_result($stmt);
  if($result1 -> num_rows == 1){
      $row = $result1->fetch_assoc() ;
      $results_array[] = $row;
      mysqli_free_result($result1);
       response_message(200,"Success Teacher Username",$results_array);
       return;
   }

  $sql2 = "SELECT student_id ,student_name,student_email,student_picture FROM student WHERE student_id=? AND student_pass=?";
  $stmt2 = mysqli_prepare($dbcon,$sql2);
  mysqli_stmt_bind_param($stmt2,"ss",$username,$hash_pass);
  mysqli_execute($stmt2);
  $result2 = mysqli_stmt_get_result($stmt2);
  if($result2 -> num_rows == 1){
      $row = $result2->fetch_assoc();
      $results_array[] = $row;
      mysqli_free_result($result1);
      mysqli_free_result($result2);
       response_message(200,"Success Student Username",$results_array);
       return;
   }

  $sql3 = "SELECT teacher_user , teacher_email , teacher_picture FROM teacher WHERE teacher_email='$email' AND teacher_pass='$hash_pass'";
  $result3 = mysqli_query($dbcon, $sql3) or die(mysqli_error());
  if($result3 -> num_rows == 1){
      $row = $result3->fetch_assoc();
      $results_array[] = $row;
      mysqli_free_result($result1);
      mysqli_free_result($result2);
      mysqli_free_result($result3);
       response_message(200,"Success Teacher Email",$results_array);
       return;
   }


  $sql4 = "SELECT student_id ,student_name,student_email,student_picture FROM student WHERE student_email ='$email' AND student_pass='$hash_pass'";
  $result4 = mysqli_query($dbcon, $sql4) or die(mysqli_error());
  if($result4 -> num_rows == 1){
      $row = $result4->fetch_assoc();
      $results_array[] = $row;
      mysqli_free_result($result1);
      mysqli_free_result($result2);
      mysqli_free_result($result3);
      mysqli_free_result($result4);
       response_message(200,"Success Student Email",$results_array);
       return;
   }
   
  mysqli_free_result($result1);
  mysqli_free_result($result2);
  mysqli_free_result($result3);
  mysqli_free_result($result4);
  mysqli_close($dbcon);
  response_message(500,"Unsuccess ,Username and Password Invalid 5555555---T^T");

 ?>
