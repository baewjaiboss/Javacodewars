<?php
require_once 'global.php' ;
require_once 'connect.php' ;

putenv("PATH=C:\Program Files\Java\jdk-13.0.1\bin");
/**คอมไฟล์โจทย์แบบฝึกหัด */
$question_name = (isset($_POST['question_name'])) ? $_POST['question_name'] : '';
$question_guide = (isset($_POST['question_guide'])) ? $_POST['question_guide'] : '';
$testcase_testcase = (isset($_POST['testcase_testcase'])) ? $_POST['testcase_testcase'] : '';
$teacher_user = (isset($_POST['teacher_user'])) ? $_POST['teacher_user'] : '';

$filename_guide = "$question_name.java";
$filename_testcase = "$question_name"."Test.java";
$filename_testcase2 = "$question_name"."Test";
$filename_error = "error.txt";


if( !(file_exists("complieAndRun")) ) { 
    mkdir("complieAndRun"); 
}

    $path = "complieAndRun/$teacher_user/";
    mkdir($path);

    $question_guide_decode = rawurldecode($question_guide);
        $file_guide=fopen($path.$filename_guide,"w+");
        fwrite($file_guide,$question_guide_decode);
        fclose($file_guide);

  

        $testcase_testcase_decode = json_decode($testcase_testcase,true);
        //var_dump($testcase_testcase_decode);
        foreach($testcase_testcase_decode as $key => $testcase ) {
            $file_testcase=fopen($path.$filename_testcase,"a+");
            fwrite($file_testcase,$testcase["testcase_testcase"]."\n");
            //fwrite($file_testcase,"\n");
        }
            fclose($file_testcase);


    
        $path_junit = "C:/Junit4/";
        $path_ver = "junit-4.13.jar";
    $command_javac = "cd complieAndRun && cd $teacher_user && javac $filename_guide 2> $filename_error && javac -cp $path_junit$path_ver;. $filename_testcase 2> $filename_error ";
    //$command_javac = "cd complieAndRun && cd $teacher_user && javac -cp C:\Junit4\junit-4.13.jar;. $filename_testcase 2> $filename_error";
    exec($command_javac);
    $error=file_get_contents($path.$filename_error);

    $objScan = scandir($path);
    foreach ($objScan as $value) {
        if ($value != "." && $value != "..") {  /* เช็คว่าผลลัพท์ต้องไม่ใช่ . และ ..*/
            unlink($path.$value);
        }
    }
    rmdir($path);


    $error_complie = array("error_complie" => $error);
    $results_array[] =  $error_complie ;

    if($error == "") {
		response_message(200,"Success");
	}else{
        response_message(200,"Unsuccess",$results_array);
        /*echo "Unsusess"."<hr>" ;
        echo "<pre>$error</pre>";*/
    }

 ?>
