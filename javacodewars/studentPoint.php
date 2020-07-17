<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;

  /**คะแนนรวมของนักศึกษาคนเดียว */

  $student_id = (isset($_POST['student_id'])) ? $_POST['student_id'] : '';
  $course_id = (isset($_POST['course_id'])) ? $_POST['course_id'] : '';
  $submitsession_point_total = 0.00 ;

        $sql2 = "SELECT coursequestion.question_id , question.question_id FROM coursequestion INNER JOIN question ON coursequestion.question_id = question.question_id WHERE course_id = '$course_id'" ;
        $result2 = mysqli_query($dbcon, $sql2) or die(mysqli_error($dbcon));
        while ($row2 = mysqli_fetch_assoc($result2)) {
            $question_id = $row2['question_id'];
            $submitsession_status = "Submit" ;
            //echo   $question_id."--->" ;

                $sql3 = " SELECT submitsession_point FROM answer INNER JOIN submitsession ON answer.answer_id = submitsession.answer_id WHERE course_id = '$course_id' AND student_id = '$student_id' AND question_id = '$question_id' AND submitsession_status = '$submitsession_status' ORDER BY submitsession_id DESC LIMIT 1  ";
                $result3 = mysqli_query($dbcon, $sql3) or die(mysqli_error($dbcon));
                $row3 = mysqli_fetch_assoc($result3);
                $submitsession_point = (isset( $row3['submitsession_point'])) ?  $row3['submitsession_point'] : 0.00;
    
                $submitsession_point_total = $submitsession_point_total+$submitsession_point ;
                //echo   $submitsession_point."<br>" ;

        }
        $submitsession_point_total = array(
            "course_id" => $course_id,
            "student_id" => $student_id,
            "submitsession_point_total" => number_format($submitsession_point_total, 2));
        $results_array[] =  $submitsession_point_total ;
        //echo $submitsession_point_total ;
        //echo "<hr>" ;
    

    if(empty($results_array)) {
        response_message(404,"No data found");
        return;
    }
    mysqli_free_result($result2);
    mysqli_free_result($result3);
    mysqli_close($dbcon);
    response_message(200,"Success",$results_array);

 
 ?>
