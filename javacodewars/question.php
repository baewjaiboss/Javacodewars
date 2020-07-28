<?php
require_once 'connect.php' ;
require_once 'global.php' ;
/**สร้างโจทย์แบบฝึกหัด */
$question_name = (isset($_POST['question_name'])) ? $_POST['question_name'] : '';
$question_point = (isset($_POST['question_point'])) ? $_POST['question_point'] : '';
$question_proposition = (isset($_POST['question_proposition'])) ? $_POST['question_proposition'] : '';
$question_guide = (isset($_POST['question_guide'])) ? $_POST['question_guide'] : '';
$tag_tag = (isset($_POST['tag_tag'])) ? $_POST['tag_tag'] : '';
$testcase_testcase = (isset($_POST['testcase_testcase'])) ? $_POST['testcase_testcase'] : '';
$question_example = (isset($_POST['question_example'])) ? $_POST['question_example'] : '';
$teacher_user = (isset($_POST['teacher_user'])) ? $_POST['teacher_user'] : '';


$question_guide_decode = rawurldecode($question_guide);
$testcase_testcase_decode_rawurl = rawurldecode($testcase_testcase);
$question_example_decode = rawurldecode($question_example);

$question_proposition_str =  mysqli_real_escape_string($dbcon,$question_proposition);
$question_guide_str = mysqli_real_escape_string($dbcon,$question_guide_decode);
$question_example_str = mysqli_real_escape_string($dbcon,$question_example_decode);

$question_id = "" ;
$tag_id = "" ;
$testcase_id = "";

        /** check question_name ไม่ซ้ำ */
        $query7 = " SELECT question_name FROM question  WHERE teacher_user = '$teacher_user' AND question_name = '$question_name' LIMIT 1 ";
        $result7 = mysqli_query($dbcon,$query7) or die(mysqli_error($dbcon)); /*เลือก id question */
        if($result7 -> num_rows == 1) {
          response_message(200,"Unsuccess question name already exists ");
          return ;
        }


        /* เพิ่ม question*/
      $query1 = " INSERT INTO question(question_name,question_proposition,question_point,question_guide,question_example,teacher_user) 
      VALUES ('$question_name','$question_proposition_str','$question_point','$question_guide_str','$question_example_str','$teacher_user') " ;
      $result1 = mysqli_query($dbcon,$query1) or die(mysqli_error($dbcon));
      if(!($result1)){
        response_message(500,"Unsuccess");
      }

            $query4 = " SELECT question_id FROM question  WHERE teacher_user = '$teacher_user' AND question_name = '$question_name' LIMIT 1 ";
            $result4 = mysqli_query($dbcon,$query4) or die(mysqli_error($dbcon)); /*เลือก id question */
            if($result4){
                while($row = mysqli_fetch_array($result4)){
                  $question_id = $row['question_id'];
                //  echo $row['question_id'];
                }
            }else{
              response_message(404,"No data found id question");
            }

      $testcase_testcase_decode = json_decode($testcase_testcase_decode_rawurl ,true);
       foreach($testcase_testcase_decode as $key => $testcase ) {
          $testcase_str =  mysqli_real_escape_string($dbcon,$testcase["testcase_testcase"]) ;
          $query2 = " INSERT INTO testcase(testcase_testcase,question_id) VALUES ('$testcase_str','$question_id')" ;
          $result2 = mysqli_query($dbcon,$query2) or die(mysqli_error($dbcon)); /**เพิ่ม testcase */
          if(!($result2)){
                response_message(500,"Unsuccess");
            }
        }
 
          $tag_tag_array = explode(",", $tag_tag);
          for($i = 0 ; $i<count($tag_tag_array) ; $i++){
            $tag_low = strtolower ( $tag_tag_array[$i] );
            $query3 = " INSERT INTO taglist(tag_tag) VALUES ('$tag_low')" ;
            $result3 = mysqli_query($dbcon,$query3) or die(mysqli_error($dbcon)); /**เพิ่ม taglist */
            if(!($result3)){
              response_message(500,"Unsuccess");
            }

                  $query6 = " SELECT tag_id FROM taglist  WHERE tag_tag = '$tag_low' ORDER BY tag_id DESC LIMIT 1";
                  $result6 = mysqli_query($dbcon,$query6) or die(mysqli_error($dbcon)); /** เลือก id taglist  */
                  if($result6){
                    $row2 = mysqli_fetch_array($result6);
                    $tag_id = $row2['tag_id'];
                        //echo $row2['tag_id']."<br>";
                  }else{
                    response_message(404,"No data found id tag ");
                  }

          $query5 = " INSERT INTO tag(tag_id,question_id) VALUES ('$tag_id','$question_id')" ;
          $result5 = mysqli_query($dbcon,$query5) or die(mysqli_error($dbcon)); /** เชื่อม tag_id question_id */
          if(!($result5)){
            response_message(500,"Unsuccess");
          }
          
        }
    
       mysqli_free_result($result4);
        mysqli_free_result($result6);
        mysqli_free_result($result7);
        mysqli_close($dbcon); 
        response_message(200,"Success");
