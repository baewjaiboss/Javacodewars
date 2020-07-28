<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;
/**แสดงข้อูลรายละเอียด อาจารย์ */
  $teacher_user = (isset($_POST['teacher_user'])) ? $_POST['teacher_user'] : '';


  $sql = "SELECT teacher_email,teacher_picture FROM teacher WHERE teacher_user = '$teacher_user' LIMIT 1 ";
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
