<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;
  /**แสดงรายละเอียดรายวิชา */
  $course_id = (isset($_POST['course_id'])) ? $_POST['course_id'] : '';
  
  $sql = "SELECT * FROM course WHERE course_id = '$course_id' ";
  $result = mysqli_query($dbcon, $sql) or die(mysqli_error($dbcon)); 
  $results_array = array();
  if($result -> num_rows < 1){
      response_message(404,"No data found course your teacher");
      return;
    }

  while ($row = mysqli_fetch_assoc($result)) {
    $results_array[] = $row;
  }
 
    if(empty($results_array)) {
        response_message(404,"No data found course your teacher");
        return;
    }

    mysqli_free_result($result);
    mysqli_close($dbcon);
    response_message(200,"Success",$results_array);
