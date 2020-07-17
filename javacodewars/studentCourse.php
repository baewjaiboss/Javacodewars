<?php  
require_once 'connect.php' ;
require_once 'global.php' ;
/**แสดงรายชื่อนักศึกษาในรายวิชา */
$course_id = (isset($_POST['course_id'])) ? $_POST['course_id'] : '';
$results_array = array() ;

 $sql = " SELECT student.student_id,student_name,student_email FROM student INNER JOIN coursestudent ON student.student_id = coursestudent.student_id WHERE course_id = '$course_id ' ";
 $result = mysqli_query($dbcon,$sql) or die(mysqli_error($dbcon));
 while ($row = mysqli_fetch_assoc($result)) {
    $results_array[] = $row ;
 }
mysqli_free_result($result);
mysqli_close($dbcon);
response_message(200,"Success",$results_array);

?>  
