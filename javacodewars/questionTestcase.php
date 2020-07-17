<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;

    /**แสดง test testcase ของโจทย์บบฝึกหัด */
    $question_id = (isset($_POST['question_id'])) ? $_POST['question_id'] : '';
    
    $sql = "SELECT question.question_id, testcase_id ,  testcase_testcase FROM question INNER JOIN testcase ON question.question_id = testcase.question_id WHERE question.question_id = '$question_id'";
    $result = mysqli_query($dbcon, $sql) or die(mysqli_error());

    if(empty($result)){
        response_message(404,"No data found testcase");
        return;
    }
      
    while ($row = mysqli_fetch_assoc($result)) {
        $results_array[] = $row ;
    }

    if(empty($results_array)) {
        response_message(404,"No data found testcase");
        return;
    }
    
    mysqli_free_result($result);
    mysqli_close($dbcon);
    response_message(200,"Success",$results_array);

 ?>
