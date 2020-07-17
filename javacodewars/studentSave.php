<?php
require_once 'connect.php' ;
require_once 'global.php' ;
/**บันทึกแบบฝึกหัด */
$course_id = (isset($_POST['course_id'])) ? $_POST['course_id'] : '';
$student_id = (isset($_POST['student_id'])) ? $_POST['student_id'] : '';
$question_guide = (isset($_POST['question_guide'])) ? $_POST['question_guide'] : '';
$question_id = (isset($_POST['question_id'])) ? $_POST['question_id'] : '';

$submitsession_time = (isset($_POST['submitsession_time'])) ? $_POST['submitsession_time'] : '';
$submitsession_copy_paste = (isset($_POST['submitsession_copy_paste'])) ? $_POST['submitsession_copy_paste'] : '';
$submitsession_status = "Save";

$question_guide_decode = rawurldecode($question_guide);
$question_guide_str = mysqli_real_escape_string($dbcon,$question_guide_decode);

$answer_id = "" ;

    $query4 = " SELECT answer_id  FROM answer WHERE course_id = '$course_id' AND student_id = '$student_id' AND question_id = '$question_id'  " ;
    $result4 = mysqli_query($dbcon,$query4) or die(mysqli_error());
    $count4 = mysqli_num_rows($result4);
    
    if($count4 == 0) {
        $query = " INSERT INTO answer(course_id,student_id,question_id) VALUES ('$course_id','$student_id','$question_id')" ;
        $result = mysqli_query($dbcon,$query) or die(mysqli_error());
            if(!($result)) {
                response_message(500,"Unsuccess");
                return;
            }else {
                $query2 = " SELECT answer_id FROM answer WHERE course_id = '$course_id' AND student_id = '$student_id' AND question_id = '$question_id'  " ;
                $result2 = mysqli_query($dbcon,$query2) or die(mysqli_error());
                $count2 = mysqli_num_rows($result2);
                    if($count2 == 1 ) {
                        $row2 = mysqli_fetch_assoc($result2);
                        $answer_id = $row2['answer_id'];
                        $query3 = " INSERT INTO submitsession(submitsession_code,submitsession_time,submitsession_copy_paste,submitsession_status,answer_id) VALUES ('$question_guide_str','$submitsession_time','$submitsession_copy_paste','$submitsession_status','$answer_id')" ;
                        $result3 = mysqli_query($dbcon,$query3) or die(mysqli_error());
                            if(!($result3)) {
                                response_message(500,"Unsuccess");
                                return;
                            }
                    }
            }
            mysqli_free_result($result2);
            mysqli_free_result($result4);
            mysqli_close($dbcon);
            response_message(200,"Success");
    }else{
        $row4 = mysqli_fetch_assoc($result4);
        $answer_id = $row4['answer_id'];
        $query3 = " INSERT INTO submitsession(submitsession_code,submitsession_time,submitsession_copy_paste,submitsession_status,answer_id) VALUES ('$question_guide_str','$submitsession_time','$submitsession_copy_paste','$submitsession_status','$answer_id')" ;
        $result3 = mysqli_query($dbcon,$query3) or die(mysqli_error());
            if(!($result3)) {
                response_message(500,"Unsuccess");
                return;
            }
        mysqli_free_result($result4);
        mysqli_close($dbcon);
        response_message(200,"Success");
    }
 ?>
