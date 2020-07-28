<?php
require_once 'connect.php';
require_once 'global.php';
/**สถานะของรายวิชา ( Hide / Open / Delete ) */
$course_id = (isset($_POST['course_id'])) ? $_POST['course_id'] : '';
$course_status = (isset($_POST['course_status'])) ? $_POST['course_status'] : ''; // Hide Open Delete

if ($course_status === "Hide") {

  $sql = "UPDATE course SET course_status = '$course_status' WHERE course_id = '$course_id' ";
  $result2 = mysqli_query($dbcon, $sql) or die(mysqli_error($dbcon));;
  if ($result2) {
    response_message(200, "Success");
  } else {
    response_message(500, "Unsuccess");
  }
} elseif ($course_status === "Delete") {

  $sql = "DELETE FROM coursestudent WHERE course_id = '$course_id' ";
  $result = mysqli_query($dbcon, $sql) or die(mysqli_error($dbcon));;
  if (!($result)) {
    response_message(500, "Unsuccess");
    return;
  }

  $sql2 = "DELETE FROM coursequestion WHERE course_id = '$course_id' ";
  $result2 = mysqli_query($dbcon, $sql2) or die(mysqli_error($dbcon));;
  if (!($result2)) {
    response_message(500, "Unsuccess");
    return;
  }

  $sql3 = "SELECT answer_id FROM answer WHERE  course_id = '$course_id' ";
  $result3 = mysqli_query($dbcon, $sql3) or die(mysqli_error($dbcon));

  if ($result3->num_rows > 0) {

    while ($row3 = mysqli_fetch_assoc($result3)) {

      $answer_id = $row3['answer_id'];
      $sql4 = "DELETE FROM submitsession  WHERE  answer_id = '$answer_id'";
      $result4 = mysqli_query($dbcon, $sql4) or die(mysqli_error($dbcon));
      if (!($result4)) {
        response_message(500, "Unsuccess");
        return;
      }
    }
  }

  $sql6 = "DELETE FROM answer  WHERE  course_id = '$course_id'";
  $result6 = mysqli_query($dbcon, $sql6) or die(mysqli_error($dbcon));
  if (!($result6)) {
    response_message(500, "Unsuccess");
    return;
  }


  $sql5 = "DELETE FROM course  WHERE course_id = '$course_id' ";
  $result5 = mysqli_query($dbcon, $sql5) or die(mysqli_error($dbcon));;
  if ($result5) {
    response_message(200, "Success");
  } else {
    response_message(500, "Unsuccess");
  }
}
