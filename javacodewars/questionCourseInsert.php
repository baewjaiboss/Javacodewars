<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;
  /*เพิ่มคำถามลงในรายวิชา*/
  $course_id = (isset($_POST['course_id'])) ? $_POST['course_id'] : '';
  $question_id = (isset($_POST['question_id'])) ? $_POST['question_id'] : '';
  
  $question_id_array = explode(",", $question_id);
  for($i = 0 ; $i<count($question_id_array) ; $i++){
    $query = "INSERT INTO coursequestion(course_id,question_id) VALUES ('$course_id','$question_id_array[$i]')" ;
    $result = mysqli_query($dbcon,$query) or die(mysqli_error($dbcon));
    if(!($result)){
      response_message(500,"Unsuccess");
    }

  }
  response_message(200,"Success");

 ?>
