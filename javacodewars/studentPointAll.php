<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;

  /**ดูคะแนนของนักศึกษาทั้งหมดในรายวิชา */
  $course_id = (isset($_POST['course_id'])) ? $_POST['course_id'] : '';

  $sql = "SELECT coursestudent.student_id, student.student_id FROM coursestudent INNER JOIN student ON coursestudent.student_id = student.student_id WHERE course_id = '$course_id' ";

  $result = mysqli_query($dbcon, $sql) or die(mysqli_error($dbcon));
  $results_array = array();
  $num=mysqli_num_rows($result);
  if($num < 1){
      response_message(404,"No data found question");
      return;
    }

    while ($row = mysqli_fetch_assoc($result)) {

        $student_id = $row['student_id'];
        $student_id_array = array();

            $sql2 = "SELECT  coursequestion.question_id , question.question_id , question_name FROM coursequestion INNER JOIN question ON coursequestion.question_id = question.question_id WHERE course_id = '$course_id' ";
            $result2 = mysqli_query($dbcon, $sql2) or die(mysqli_error($dbcon));
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $question_id = $row2['question_id'];
                $submitsession_status = "Submit" ;

                    $sql3 = " SELECT answer.answer_id,submitsession_point FROM answer INNER JOIN submitsession ON answer.answer_id = submitsession.answer_id WHERE course_id = '$course_id' AND student_id = '$student_id' AND question_id = '$question_id' AND submitsession_status = '$submitsession_status' ORDER BY submitsession_id DESC LIMIT 1  ";
                    
                    $result3 = mysqli_query($dbcon, $sql3) or die(mysqli_error($dbcon));
                    $row3 = mysqli_fetch_assoc($result3);
                    if($result3 -> num_rows < 1 ){
                        $answer_id = "NULL";
                        $submitsession_point = "NULL";
                    }else{
                        $answer_id = $row3['answer_id'];
                        $submitsession_point = $row3['submitsession_point'];
                    }

                    $point_all_course = array(
                        "question_id" => $question_id,
                        "answer_id" => $answer_id,
                        "submitsession_point" => $submitsession_point);
                    $student_id_array[] =  $point_all_course ;
            }

        $students_id_array = array(
            "student_id" => $student_id,
            "point_all_course" => $student_id_array   
        );

        $results_array[] = $students_id_array;
    }

    if(empty($student_id_array)) {
        response_message(404,"No data found");
        return;
    }
    mysqli_free_result($result);
    mysqli_free_result($result2);
    mysqli_free_result($result3);
    mysqli_close($dbcon);
    response_message(200,"Success",$results_array);

 
 ?>
