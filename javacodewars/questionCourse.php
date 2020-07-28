<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;
  /**แสดงคำถามของอาจารย์ ในรายวิชาที่เลือก */
  $course_id = (isset($_POST['course_id'])) ? $_POST['course_id'] : '';
  $teacher_user = (isset($_POST['teacher_user'])) ? $_POST['teacher_user'] : '';

  $sql = "SELECT * FROM question INNER JOIN coursequestion ON question.question_id = coursequestion.question_id  WHERE course_id = '$course_id' AND teacher_user = '$teacher_user' ";
  $result = mysqli_query($dbcon, $sql) or die(mysqli_error($dbcon)); /*ค้นหาคำถามในรายวิชา*/ 

  if($result -> num_rows < 1){
    response_message(404,"No data found question in course");
    return;
  }
        
  while ($row = mysqli_fetch_assoc($result)) {

    $question_id = $row['question_id'];
    $question_name = $row['question_name'];
    $question_point = $row['question_point'];
    $question_proposition = $row['question_proposition'];  
    $question_guide = $row['question_guide']; 
    $question_example = $row['question_example']; 
    $teacher_user = $row['teacher_user']; 
    
    $array_tags = array();


    $sql2 = " SELECT * FROM taglist INNER JOIN tag ON taglist.tag_id = tag.tag_id WHERE question_id = '$question_id' " ;
        $result2 = mysqli_query($dbcon, $sql2) or die(mysqli_error($dbcon));
        while ($row2 = mysqli_fetch_assoc($result2)) {
          //echo $row3['tag_id']." " ;
          $tag_id = $row2['tag_id'];
          $tag_tag = $row2['tag_tag'];

          $tag_array["tag"] = array(
            "tag_id" => $tag_id,
            "tag_tag" => $tag_tag);

          $array_tags[] =  $tag_array["tag"] ;
        }

        $question_array = array(
          "question_id" => $question_id,
          "question_name" => $question_name,
          "question_point" => $question_point,
          "question_proposition" => $question_proposition,
          "question_guide" => $question_guide,
          "question_example" => $question_example,
          "teacher_user" => $teacher_user,
          "question_tags" => $array_tags);

      $results_array[] = $question_array;
      //echo $row2['question_name']."<br>";
  }
        
  if(empty($results_array)) {
    response_message(404,"No data found question in course");
    return;
  }

    mysqli_free_result($result);
    mysqli_close($dbcon);
    response_message(200,"Success",$results_array);
