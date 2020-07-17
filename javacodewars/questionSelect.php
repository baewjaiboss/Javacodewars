<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;
  /** -- แสดงรายละเอียดโจทย์แบบฝึกหัดที่เลือก --  */
  $question_id = (isset($_POST['question_id'])) ? $_POST['question_id'] : '';

  $sql = " SELECT * FROM question WHERE question_id = '$question_id' " ;
  $result = mysqli_query($dbcon,$sql) or die(mysqli_error());
  $results_array = array();

  if(empty($result)){
    response_message(404,"No data found question");
    return;
  }

  while ($row = mysqli_fetch_assoc($result)) {
       //echo $row['question_id']."<br>".$row['question_name']."<br>".$row['question_point']."<br>".$row['question_proposition']."<br>".$row['question_guide']."<br>" ;
       $results_array[] = $row ;     
  }

  if(empty($results_array)) {
    response_message(404,"No data found question");
    return;
  }

    mysqli_free_result($result);
    mysqli_close($dbcon);
    response_message(200,"Success",$results_array);

 ?>
