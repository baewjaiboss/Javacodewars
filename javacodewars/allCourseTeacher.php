<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;

  /**แสดงหน้ารายวิชาของอาจารย์ทั้งหมด */
  $teacher_user = (isset($_POST['teacher_user'])) ? $_POST['teacher_user'] : '';
  
  $sql = "SELECT * FROM course WHERE teacher_user = '$teacher_user' ORDER BY course_id DESC ";
  $result = mysqli_query($dbcon, $sql) or die(mysqli_error($dbcon)); /*ค้นหารายวิชาของอาจารย์*/
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
