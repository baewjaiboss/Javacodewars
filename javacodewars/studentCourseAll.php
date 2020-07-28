<?php  
require_once 'connect.php' ;
require_once 'global.php' ;
/**แสดงรายวิชาทั้งหมดของนักศึกษาที่ยังเปิดอยู่ */
$student_id = (isset($_POST['student_id'])) ? $_POST['student_id'] : '';
$course_status = "Open" ;

$results_array = array() ;

 $sql = " SELECT * FROM course INNER JOIN coursestudent ON course.course_id = coursestudent.course_id WHERE course_status = '$course_status' AND  student_id = '$student_id'  ";
 $result = mysqli_query($dbcon,$sql) or die(mysqli_error($dbcon));
 while ($row = mysqli_fetch_assoc($result)) {
    $results_array[] = $row ;
 }
 mysqli_free_result($result);
mysqli_close($dbcon);
response_message(200,"Success",$results_array);
