<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;
  /* สร้างรายวิชา*/ 
  $course_code = (isset($_POST['course_code'])) ? $_POST['course_code'] : '';
  $course_name = (isset($_POST['course_name'])) ? $_POST['course_name'] : '';
  $course_year = (isset($_POST['course_year'])) ? $_POST['course_year'] : '';
  $teacher_user = (isset($_POST['teacher_user'])) ? $_POST['teacher_user'] : '';
  $course_status = "Open" ;

  $query = "INSERT INTO course(course_code,course_name,course_year,teacher_user,course_status) VALUES ('$course_code','$course_name','$course_year','$teacher_user','$course_status')" ;
  $result2 = mysqli_query($dbcon,$query) or die(mysqli_error($dbcon)); ;
  if($result2){
    response_message(200,"Success");
  }else{
    response_message(500,"Unsuccess");
  }
  
 ?>
