<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;
  /**แก้ไขคำถาม */
  $question_id = (isset($_POST['question_id'])) ? $_POST['question_id'] : '';
  
  $question_name = (isset($_POST['question_name'])) ? $_POST['question_name'] : '';
  $question_point = (isset($_POST['question_point'])) ? $_POST['question_point'] : '';
  $question_proposition = (isset($_POST['question_proposition'])) ? $_POST['question_proposition'] : '';
  $question_guide = (isset($_POST['question_guide'])) ? $_POST['question_guide'] : '';
  $testcase_testcase = (isset($_POST['testcase_testcase'])) ? $_POST['testcase_testcase'] : '';
  $question_example = (isset($_POST['question_example'])) ? $_POST['question_example'] : '';
  $teacher_user = (isset($_POST['teacher_user'])) ? $_POST['teacher_user'] : '';


  $question_guide_decode = rawurldecode($question_guide);
  $testcase_testcase_decode_rawurl = rawurldecode($testcase_testcase);
  $question_example_decode = rawurldecode($question_example);

  $question_proposition_str =  mysqli_real_escape_string($dbcon,$question_proposition);
  $question_guide_str = mysqli_real_escape_string($dbcon,$question_guide_decode);
  $question_example_str = mysqli_real_escape_string($dbcon,$question_example_decode);
  
  $tag_tag_array = array();
  $tag_id_array = array();
  $testcase_testcase_array  = array();
  $testcase_id_array = array();

  
 /** check question_name ไปซ้ำกับ question_name ข้ออื่น  */
  $sql0 = " SELECT question_name FROM question WHERE teacher_user = '$teacher_user'  AND NOT question_id = '$question_id' " ;
  $result0 = mysqli_query($dbcon,$sql0) or die(mysqli_error($dbcon));
  while($row0 = mysqli_fetch_assoc($result0)){
    $question_name_check = $row0['question_name'];  
    if( $question_name_check === $question_name){
        response_message(200,"Unsuccess question name already exists");
        return;
    }
  }

  /**แก้ไขคำถาม */
  $query = " UPDATE question SET question_name = '$question_name', question_point = '$question_point', question_proposition = '$question_proposition_str', question_guide = '$question_guide_str' , question_example = '$question_example_str'  WHERE question_id = '$question_id' " ;
  $result = mysqli_query($dbcon,$query) or die(mysqli_error($dbcon));
  if(!($result)){
    response_message(500,"Unsuccess");
    return;
  }

         $query2 = "SELECT testcase_id FROM testcase WHERE question_id = '$question_id' ";
         $result2 = mysqli_query($dbcon,$query2) or die(mysqli_error($dbcon));
                while($row = mysqli_fetch_assoc($result2)){
                    $testcase_id_array[] = $row['testcase_id'];  
                }   
             

        $testcase_testcase_decode = json_decode($testcase_testcase_decode_rawurl,true);
         $count_testcase = count($testcase_id_array);
         for($i=0;$i<$count_testcase;$i++){
             //$testcase = $testcase_testcase_array[$i] ;
             $testcase = mysqli_real_escape_string($dbcon,$testcase_testcase_decode[$i]["testcase_testcase"]);
             //$testcase = $testcase_testcase_array[$i];
             $testcase_id = $testcase_id_array[$i] ;
            // echo "$testcase_id "."------>"."$testcase"."<br>";
             $query5 = " UPDATE testcase SET testcase_testcase = '$testcase' WHERE testcase_id = '$testcase_id' " ;
             $result5 = mysqli_query($dbcon,$query5) or die(mysqli_error($dbcon));
             if(!($result5)){
                response_message(500,"Unsuccess");
                return;
              }
 
         }
       
        mysqli_free_result($result0);
        mysqli_free_result($result2);
        //mysqli_free_result($result3);
        mysqli_close($dbcon);
        response_message(200,"Success");
