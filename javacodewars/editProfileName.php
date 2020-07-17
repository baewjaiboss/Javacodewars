<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;
  /**แก้ไขชื่อ */
  $student_id = (isset($_POST['user'])) ? $_POST['user'] : '';
  $student_name = (isset($_POST['student_name'])) ? $_POST['student_name'] : '';


  $sql = "UPDATE student SET student_name = '$student_name'  WHERE student_id = '$student_id' ";
  $result = mysqli_query($dbcon,$sql) or die(mysqli_error());
    if(!($result)) {
        response_message(500,"Unsuccess");
        return;
    }else {
        response_message(200,"Success, Change student name");
        return;
    }

 ?>