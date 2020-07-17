<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;

  /**ดูคะแนนรายบุคคล */
  $answer_id = (isset($_POST['answer_id'])) ? $_POST['answer_id'] : '';
  
  $sql = "SELECT submitsession_id ,submitsession_code,submitsession_time , submitsession_copy_paste , submitsession_point ,submitsession_status FROM answer INNER JOIN submitsession ON answer.answer_id = submitsession.answer_id  WHERE answer.answer_id = '$answer_id' ";
  $result = mysqli_query($dbcon, $sql) or die(mysqli_error($dbcon));
  $results_array = array();
  
    while ($row = mysqli_fetch_assoc($result)) {
        $results_array[] = $row;
        
    }
    if(empty($results_array)) {
        response_message(404,"No data found");
        return;
    }
    mysqli_free_result($result);
    mysqli_close($dbcon);
    response_message(200,"Success",$results_array);

 ?>
