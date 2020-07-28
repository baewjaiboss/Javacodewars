<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;

  /**ลบโจทย์แบบฝึกหัด */
  $question_id = (isset($_POST['question_id'])) ? $_POST['question_id'] : '';

  $question_id_array = explode(",", $question_id);
  for($i = 0 ; $i<count($question_id_array) ; $i++){

    $sql2 = "DELETE FROM testcase  WHERE question_id = '$question_id_array[$i]'  ";
    $result2 = mysqli_query($dbcon, $sql2) or die(mysqli_error($dbcon));
    if(!($result2)){
        response_message(500,"Unsuccess");
        return;
    }
    $sql3 = "SELECT* FROM tag INNER JOIN taglist ON tag.tag_id = taglist.tag_id WHERE question_id = '$question_id_array[$i]'  ";
    $result3 = mysqli_query($dbcon, $sql3) or die(mysqli_error($dbcon));
    if(empty($result3)){
        response_message(404,"No data found tag ");
        return;
    }
        while($row = mysqli_fetch_assoc($result3)){
            $tag_id = $row['tag_id'] ;
            $sql4 = "DELETE FROM taglist  WHERE tag_id = '$tag_id' ";
            $result4 = mysqli_query($dbcon, $sql4) or die(mysqli_error($dbcon));
            if(!($result4)){
                response_message(500,"Unsuccess");
                return;
            }
        } 

    $sql5 = "DELETE FROM tag  WHERE question_id = '$question_id_array[$i]' ";
    $result5 = mysqli_query($dbcon, $sql5) or die(mysqli_error($dbcon));
    if(!($result5)){
        response_message(500,"Unsuccess");
        return;
    }

    $sql = "DELETE FROM question  WHERE question_id = '$question_id_array[$i]'";
    $result = mysqli_query($dbcon, $sql) or die(mysqli_error($dbcon));
    if(!($result)){
        response_message(500,"Unsuccess");
        return;
    }

    $sql6 = "DELETE FROM coursequestion  WHERE question_id = '$question_id_array[$i]'";
    $result6 = mysqli_query($dbcon, $sql6) or die(mysqli_error($dbcon));
    if(!($result6)){
        response_message(500,"Unsuccess");
        return;
    }

    $sql7 = "SELECT answer_id FROM answer WHERE  question_id = '$question_id_array[$i]' " ;
    $result7 = mysqli_query($dbcon,$sql7) or die(mysqli_error($dbcon));

    if($result7 -> num_rows > 0) {

      while ($row7 = mysqli_fetch_assoc($result7)) {
        $answer_id = $row7['answer_id'] ;  
        $sql8 = "DELETE FROM submitsession  WHERE  answer_id = '$answer_id'";
        $result8 = mysqli_query($dbcon, $sql8) or die(mysqli_error($dbcon));
        if(!($result8)){
            response_message(500,"Unsuccess");
            return;
        }
        
      }
    }

    $sql9 = "DELETE FROM answer  WHERE  question_id = '$question_id_array[$i]'";
    $result9 = mysqli_query($dbcon, $sql9) or die(mysqli_error($dbcon));
    if(!($result9)){
        response_message(500,"Unsuccess");
        return;
    }

}

mysqli_free_result($result3);
mysqli_close($dbcon);
response_message(200,"Success");
