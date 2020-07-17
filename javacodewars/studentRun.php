<?php
require_once 'connect.php' ;
require_once 'global.php' ;
//รันแบบฝึกหัด
putenv("PATH=C:\Program Files\Java\jdk-13.0.1\bin");

$student_id = (isset($_POST['student_id'])) ? $_POST['student_id'] : '';
$question_name = (isset($_POST['question_name'])) ? $_POST['question_name'] : '';
$question_guide = (isset($_POST['question_guide'])) ? $_POST['question_guide'] : '';
$question_point = (isset($_POST['question_point'])) ? $_POST['question_point'] : '';
//$testcase_testcase = (isset($_POST['testcase_testcase'])) ? $_POST['testcase_testcase'] : '';
$question_id = (isset($_POST['question_id'])) ? $_POST['question_id'] : '';


/*$sql1 = "SELECT question_name,question_point FROM question WHERE question_id = '$question_id' LIMIT 1";
$result1 = mysqli_query($dbcon,$sql1) or die(mysqli_error());
$row1 = mysqli_fetch_assoc($result1) ;

$question_name = $row1['question_name'];
$question_point = $row1['question_point'];*/
    
$filename_guide = "$question_name.java";
$filename_testcase = "$question_name"."Test.java";
$filename_testcase2 = "$question_name"."Test";
$filename_error = "error.txt";


if( !(file_exists("complieAndRun")) ) { 
    mkdir("complieAndRun"); 
}
    $path = "complieAndRun/$student_id/";
    mkdir($path);

    $question_guide_decode = rawurldecode($question_guide);
        $file_guide=fopen($path.$filename_guide,"w+");
        fwrite($file_guide,$question_guide_decode);
        fclose($file_guide);

    $sql = "SELECT testcase_testcase FROM testcase WHERE question_id = '$question_id' ";
    $result = mysqli_query($dbcon,$sql) or die(mysqli_error());
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
            $question_point = number_format($question_point_result, 2, '.', '');
        }

        $Run_status = array(
            "answer_status" => $answer_status,
            "Run_status" => $output[count($output)-2],
            "question_point" => $question_point);

        $results_array[] =  $Run_status ;
        response_message(200,"Success",$results_array);

	}else{

        $objScan = scandir($path);
        foreach ($objScan as $value) {
            if ($value != "." && $value != "..") {  /* เช็คว่าผลลัพท์ต้องไม่ใช่ . และ ..*/
                unlink($path.$value);
            }
        }
        rmdir($path);
        
        $answer_status = "Error" ;
        $error_complie = array(
            "answer_status" => $answer_status,
            "error_complie" => $error);
        $results_array[] =  $error_complie ;

        response_message(200,"Unsuccess",$results_array);
        /*echo "Unsusess"."<hr>" ;
        echo "<pre>$error</pre>";*/
    }

 ?>
