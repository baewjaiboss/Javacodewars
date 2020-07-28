<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;
  /**แสดงรายละเอียดข้อมูลนักศึกษา */
  $student_id = (isset($_POST['student_id'])) ? $_POST['student_id'] : '';


  $sql = "SELECT student_name,student_email,student_picture FROM student WHERE student_id = '$student_id' LIMIT 1 ";
  $result = mysqli_query($dbcon, $sql) or die(mysqli_error($dbcon));
  $results_array = array();

    if(empty($result)){
        response_message(404,"No data found");
        return;
    }

    while ($row = $result->fetch_assoc()) {
    $results_array[] = $row;
    }

    if(empty($results_array)) {
        response_message(404,"No data found");
        return;
    }

    mysqli_free_result($result);
    mysqli_close($dbcon);
    response_message(200,"Success",$results_array);
