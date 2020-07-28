<?php
require_once 'connect.php' ;
require_once 'global.php' ;
//ส่งแบบฝึกหัด
putenv("PATH=C:\Program Files\Java\jdk-13.0.1\bin");

$course_id = (isset($_POST['course_id'])) ? $_POST['course_id'] : '';
$student_id = (isset($_POST['student_id'])) ? $_POST['student_id'] : '';
$question_name = (isset($_POST['question_name'])) ? $_POST['question_name'] : '';
$question_guide = (isset($_POST['question_guide'])) ? $_POST['question_guide'] : '';
$question_point = (isset($_POST['question_point'])) ? $_POST['question_point'] : '';
$question_id = (isset($_POST['question_id'])) ? $_POST['question_id'] : '';

$submitsession_time = (isset($_POST['submitsession_time'])) ? $_POST['submitsession_time'] : '';
$submitsession_copy_paste = (isset($_POST['submitsession_copy_paste'])) ? $_POST['submitsession_copy_paste'] : '';
$submitsession_status = "Submit";

$answer_id = "" ;
$answer_status = "";

$question_guide_decode = rawurldecode($question_guide);
$question_guide_str = mysqli_real_escape_string($dbcon,$question_guide_decode);

$filename_guide = $question_name.".java";
$filename_testcase = $question_name."Test.java";
$filename_error = "error.txt";
$filename_testcase2 = $question_name."Test";


if( !(file_exists("complieAndRun")) ) { 
    mkdir("complieAndRun"); 
}

    $path = "complieAndRun/$student_id/";
    mkdir($path);

        $file_guide=fopen($path.$filename_guide,"w+");
        fwrite($file_guide,$question_guide_decode);
        fclose($file_guide);

    $sql = "SELECT testcase_testcase FROM testcase WHERE question_id = '$question_id' ";
    $result = mysqli_query($dbcon,$sql) or die(mysqli_error($dbcon));
    while ($row = mysqli_fetch_assoc($result)) {
        $file_testcase=fopen($path.$filename_testcase,"a+");
        fwrite($file_testcase,$row['testcase_testcase']."\n");
    }
        fclose($file_testcase);

       

    $pathJunit = "C:/Junit4/";
    $junit = "junit-4.13.jar" ;
    $hamcrestCore = "hamcrest-core-1.3.jar";
    $junitRunner = "org.junit.runner.JUnitCore" ;

    $command_javac = "cd complieAndRun && cd $student_id && javac $filename_guide 2> $filename_error && javac -cp $pathJunit$junit;. $filename_testcase 2> $filename_error ";
    exec($command_javac,$output);
    $error=file_get_contents($path.$filename_error);

    if($error == "") {
        $command_run = "cd complieAndRun && cd $student_id && java -cp $pathJunit$junit;$pathJunit$hamcrestCore;. $junitRunner $filename_testcase2 ";
        exec($command_run,$output);

        /*unlink($path.$filename_guide);
        unlink($path.$filename_testcase);
        unlink($path.$filename_error);
        if(file_exists($path."$question_name.class")) {
            unlink($path."$question_name.class");
        }
        if(file_exists($path."$question_name"."Test.class")){
            unlink($path."$question_name"."Test.class");
        }
        rmdir($path);*/

        $objScan = scandir($path);
        foreach ($objScan as $value) {
            if ($value != "." && $value != "..") {  /* เช็คว่าผลลัพท์ต้องไม่ใช่ . และ ..*/
                unlink($path.$value);
            }
        }
        rmdir($path);

        $OK = $output[count($output)-2];
        $ok = "OK" ;
        $check_ok = strpos($OK, $ok);
        
        $FAILURES = $output[count($output)-3];
        $failures = "FAILURES";
        $check_failures = strpos($FAILURES, $failures);

        if ($check_ok === 0) { 
            $answer_status = "Pass" ;
        } elseif ($check_failures === 0) {
            $answer_status = "Fail" ;
            $str_error = explode(",",$output[count($output)-2]);
            preg_match("/[[:digit:]]+\.?[[:digit:]]*/", $str_error[0] , $test_all ) ;
            preg_match("/[[:digit:]]+\.?[[:digit:]]*/", $str_error[1] , $test_failures ) ;
            $question_point_result = ($question_point*($test_all[0]-$test_failures[0]))/$test_all[0] ;
            $question_point = number_format($question_point_result, 2);
        }

	}else{
        /*unlink($path.$filename_guide);
        unlink($path.$filename_testcase);
        unlink($path.$filename_error);
        if(file_exists($path."$question_name.class")) {
            unlink($path."$question_name.class");
        }

        if(file_exists($path."$question_name"."Test.class")){
            unlink($path."$question_name"."Test.class");
        }
        rmdir($path);*/

        $objScan = scandir($path);
        foreach ($objScan as $value) {
            if ($value != "." && $value != "..") {  /* เช็คว่าผลลัพท์ต้องไม่ใช่ . และ ..*/
                unlink($path.$value);
            }
        }
        rmdir($path);

        $question_point = 0 ;
        $answer_status = "Error" ; 
    }

    $point = array( "question_point" => $question_point);
    $results_array[] =  $point ;

    $query4 = " SELECT answer_id  FROM answer WHERE course_id = '$course_id' AND student_id = '$student_id' AND question_id = '$question_id'  " ;
    $result4 = mysqli_query($dbcon,$query4) or die(mysqli_error($dbcon));
    $count4 = mysqli_num_rows($result4);
    
    if($count4 == 0) {
        $query = " INSERT INTO answer(course_id,student_id,question_id,answer_status) VALUES ('$course_id','$student_id','$question_id','$answer_status')" ;
        $result = mysqli_query($dbcon,$query) or die(mysqli_error($dbcon));
            if(!($result)) {
                response_message(500,"Unsuccess");
                return;
            }else {
                $query2 = " SELECT answer_id   FROM answer WHERE course_id = '$course_id' AND student_id = '$student_id' AND question_id = '$question_id'  " ;
                $result2 = mysqli_query($dbcon,$query2) or die(mysqli_error($dbcon));
                $count2 = mysqli_num_rows($result2);
                    if($count2 == 1 ) {
                        $row2 = mysqli_fetch_assoc($result2);
                        $answer_id = $row2['answer_id'];
                        $query3 = " INSERT INTO submitsession(submitsession_code,submitsession_time,submitsession_copy_paste,submitsession_point,submitsession_status,answer_id) VALUES ('$question_guide_str','$submitsession_time','$submitsession_copy_paste','$question_point','$submitsession_status','$answer_id')" ;
                        $result3 = mysqli_query($dbcon,$query3) or die(mysqli_error($dbcon));
                            if(!($result3)) {
                                response_message(500,"Unsuccess");
                                return;
                            }
                    }
            }
            
            mysqli_free_result($result2);
            mysqli_free_result($result4);
            mysqli_close($dbcon);
            response_message(200,"Success",$results_array);
    }else{
        $row4 = mysqli_fetch_assoc($result4);
        $answer_id = $row4['answer_id'];
        $query3 = " INSERT INTO submitsession(submitsession_code,submitsession_time,submitsession_copy_paste,submitsession_point,submitsession_status,answer_id) VALUES ('$question_guide_str','$submitsession_time','$submitsession_copy_paste','$question_point','$submitsession_status','$answer_id')" ;
        $result3 = mysqli_query($dbcon,$query3) or die(mysqli_error($dbcon));
            if(!($result3)) {
                response_message(500,"Unsuccess");
                return;
            }
            $query = " UPDATE answer SET answer_status = '$answer_status' WHERE answer_id = '$answer_id' " ;
            $result = mysqli_query($dbcon,$query) or die(mysqli_error($dbcon));
                if(!($result)){
                    response_message(500,"Unsuccess");
                    return;
                }

        mysqli_close($dbcon);
        response_message(200,"Success",$results_array);
    }
