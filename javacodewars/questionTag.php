<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;

    /**แสดง tag ของโจทย์แบบฝึกหัด */
    $question_id = (isset($_POST['question_id'])) ? $_POST['question_id'] : '';

    $sql = " SELECT * FROM taglist INNER JOIN tag ON taglist.tag_id = tag.tag_id WHERE question_id = '$question_id' " ;
    $result = mysqli_query($dbcon, $sql) or die(mysqli_error());

    if(empty($result)){
        response_message(404,"No data found tag");
        return;
    }
      
    while ($row = mysqli_fetch_assoc($result)) {
        $results_array[] = $row ;
    }

    if(empty($results_array)) {
        response_message(404,"No data found tag");
        return;
    }
    
    mysqli_free_result($result);
    mysqli_close($dbcon);
    response_message(200,"Success",$results_array);

 ?>
