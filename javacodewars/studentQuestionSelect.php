<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;

  //แสดงรายละเอียดโจทย์  // ถ้า seve ไว้ ไปเอาที่ save มาแสดง
  $student_id = (isset($_POST['student_id'])) ? $_POST['student_id'] : '';
  $course_id = (isset($_POST['course_id'])) ? $_POST['course_id'] : '';
  $question_id = (isset($_POST['question_id'])) ? $_POST['question_id'] : '';
  $submitsession_status = "Save";
  
  $query4 = " SELECT submitsession_id,submitsession_code,submitsession_time,submitsession_copy_paste FROM answer INNER JOIN submitsession ON answer.answer_id = submitsession.answer_id  WHERE course_id = '$course_id' AND student_id = '$student_id' AND question_id = '$question_id' AND submitsession_status = '$submitsession_status' ORDER BY submitsession_id DESC LIMIT 1 " ;
  $result4 = mysqli_query($dbcon,$query4) or die(mysqli_error($dbcon));
  $count4 = mysqli_num_rows($result4);

  if($count4 == 1){

    $sql = " SELECT question_id,question_name,question_point,question_proposition FROM question WHERE question_id = '$question_id' " ;
    $result = mysqli_query($dbcon,$sql) or die(mysqli_error());
    if(empty($result)){
      response_message(404,"No data found");
      return;
    }
    $results_array = array();
    while ($row = mysqli_fetch_assoc($result)) {

      $question_id = $row['question_id'];
      $question_name = $row['question_name'];
      $question_point = $row['question_point'];
      $question_proposition = $row['question_proposition'];

        //echo $row['question_id']."<br>".$row['question_name']."<br>".$row['question_point']."<br>".$row['question_proposition']."<br>" ;
       
              
      }
      while ($row4 = mysqli_fetch_assoc($result4)) {
        $submitsession_code = $row4['submitsession_code'];
        $submitsession_time = $row4['submitsession_time'];
        $submitsession_copy_paste = $row4['submitsession_copy_paste'];
        //echo $row4['submitsession_id'].">>>>>>>".nl2br($row4['submitsession_code'])."<br>" ;
      }

      $results_array_row = array(
        "question_id" => $question_id,
        "question_name" => $question_name,
        "question_point" => $question_point,
        "question_proposition" => $question_proposition,
        "question_guide" => $submitsession_code,
        "submitsession_time" => $submitsession_time,
        "submitsession_copy_paste" => $submitsession_copy_paste);
      $results_array[] = $results_array_row ;


      if(empty($results_array)) {
        response_message(404,"No data found");
        return;
      }
      mysqli_free_result($result);
      mysqli_close($dbcon);
      response_message(200,"Success",$results_array);

  } else{

    $sql = " SELECT * FROM question WHERE question_id = '$question_id' " ;
    $result = mysqli_query($dbcon,$sql) or die(mysqli_error());
    if(empty($result)){
      response_message(404,"No data found");
      return;
    }
    $results_array = array();
    while ($row = mysqli_fetch_assoc($result)) {
        //echo $row['question_id']."<br>".$row['question_name']."<br>".$row['question_point']."<br>".$row['question_proposition']."<br>".nl2br($row['question_guide'])."<br>" ;
        $results_array[] = $row ;
    }
      
    if(empty($results_array)) {
        response_message(404,"No data found");
        return;
    }

      mysqli_free_result($result);
      mysqli_close($dbcon);
      response_message(200,"Success",$results_array);

  }
 ?>
