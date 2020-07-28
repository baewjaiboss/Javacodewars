<?php
require_once 'connect.php';
require_once 'global.php';
/**ลบนักศึกษา */
$course_id = (isset($_POST['course_id'])) ? $_POST['course_id'] : '';
$student_id = (isset($_POST['student_id'])) ? $_POST['student_id'] : '';
$answer_id = "";

$student_id_array = explode(",", $student_id);

for ($i = 0; $i < count($student_id_array); $i++) {

  $sql = "DELETE FROM coursestudent  WHERE student_id = '$student_id_array[$i]' AND course_id = '$course_id'";
  $result = mysqli_query($dbcon, $sql) or die(mysqli_error($dbcon));
  if (!($result)) {
    response_message(500, "Unsuccess");
    return;
  }

  $sql2 = "SELECT answer_id FROM answer WHERE student_id = '$student_id_array[$i]' AND course_id = '$course_id' ";
  $result2 = mysqli_query($dbcon, $sql2) or die(mysqli_error($dbcon));

  if ($result2->num_rows > 0) {

    while ($row2 = mysqli_fetch_assoc($result2)) {

      $answer_id = $row2['answer_id'];
      $sql3 = "DELETE FROM submitsession  WHERE  answer_id = '$answer_id'";
      $result3 = mysqli_query($dbcon, $sql3) or die(mysqli_error($dbcon));
      if (!($result3)) {
        response_message(500, "Unsuccess");
        return;
      }
    }
  }

  $sql4 = "DELETE FROM answer  WHERE  student_id = '$student_id_array[$i]' AND course_id = '$course_id'";
  $result4 = mysqli_query($dbcon, $sql4) or die(mysqli_error($dbcon));
  if (!($result4)) {
    response_message(500, "Unsuccess");
    return;
  }
}

response_message(200, "Success");
