<?php  
require_once 'connect.php' ;
require_once 'global.php' ;
/**เพิ่มนักศึกษา */
$course_id = (isset($_POST['course_id'])) ? $_POST['course_id'] : '';
//$fileStudent = (isset($_FILES['file']['name'])) ? $_FILES['file']['name'] : '';

$student_id = array();
//$student_pass = array();
$student_name = array();
$student_email = array();

$student_id_file = array();
$student_email_file = array();

    //if (is_uploaded_file($_FILES['file']['tmp_name'])) {
    if($_FILES['file']) {

        $error = $_FILES["file"]["error"];
        if($error > 0){
            response_message(500,"Error uploading the file!");
        }

        $filename = explode(".", $_FILES['file']['name']);
        if($filename[1] == 'csv') {

            $handle = fopen($_FILES['file']['tmp_name'], "r");
            $i = 0 ;
            while($data = fgetcsv($handle)) {
                if($i > 0) {
                    $student_id[] = $student_id_file[] = mysqli_real_escape_string($dbcon, $data[0]);  
                    //$student_pass[] = mysqli_real_escape_string($dbcon, $data[1]);
                    $student_name[] =  iconv('TIS-620', 'UTF-8', mysqli_real_escape_string($dbcon, $data[1])); 
                    $student_email[] =  $student_email_file[] = mysqli_real_escape_string($dbcon, $data[2]);
                }
                $i++;
            }
            fclose($handle);
        }
    }else {
        response_message(500,"No file was sent!");
        //response_message(500,"Unsuccess, No uploade file");
    }

    $check_student_id = array();
    $check_student_email = array();
    $check_count = array_count_values($student_id_file);
    foreach ($check_count as $student_id_file => $count_id) {
        if($count_id > 1){
            $check_student_id[] = $student_id_file ;
            //echo $student_id_file ." ------>> ". $count_id."<br>";
        }
    } if(count($check_student_id) > 0){ /** check_student_id ซ้ำใน file  */
        //echo count($check_student_id)."<br>" ;
        response_message(200,"Unsuccess, Student ID is duplicated with in the file.",$check_student_id);
        return ;
    }

    $check_count = array_count_values($student_email_file);
    foreach ($check_count as $student_email_file => $count_email) {
        if($count_email > 1){
            $check_student_email[] = $student_email_file ;
           // echo $student_email_file ." ------>> ". $count_email."<br>";
        }
    } if(count($check_student_email) > 0){ /**check_student_email ซ้ำใน file  */
        //echo count($check_student_email)."<br>" ;
        response_message(200,"Unsuccess, Student email is duplicated with in the file.",$check_student_email);
        return ;
    }

    $result_array2 = array();
    for($i=0 ; $i<count($student_id) ; $i++){
         $sql2 = " SELECT student_id,course_id FROM coursestudent WHERE student_id = '$student_id[$i]' AND course_id = '$course_id'" ;
         $result2 = mysqli_query($dbcon,$sql2) or die(mysqli_error($dbcon));
         $num2=mysqli_num_rows($result2);
         if($num2 > 0){
            $result_array2[] = $student_id[$i];
         } 
     }if(count($result_array2) > 0){ /**check student ซ้ำในรายวิชา */
        response_message(200,"Unsuccess, Student is duplicated with in the Class.",$result_array2);
        return ;
    }

    
    $result_array = array();
    for($i=0 ; $i<count($student_id) ; $i++){
       // echo $student_id[$i] ." ". $student_pass[$i] ." ". $student_name[$i] ." ". $student_email[$i] ."<br>" ;
        $sql = " SELECT student_id FROM student WHERE student_id = '$student_id[$i]' " ;
        $result = mysqli_query($dbcon,$sql) or die(mysqli_error());
        $num=mysqli_num_rows($result);
        if($num < 1){ /**พึ่งลงเรียนครั้งแรก เพิ่มลงใน database */
            //$salt = 'javacodewars' ;
            //$hash_pass = hash_hmac('sha256',$student_pass[$i],$salt);
            $sql1 = " INSERT INTO student(student_id,student_name,student_email) VALUES ('$student_id[$i]','$student_name[$i]','$student_email[$i]')" ;
            $result1 = mysqli_query($dbcon,$sql1) or die(mysqli_error());
                if(!($result1)){
                    response_message(500,"Unsuccess");
                }
        }else{ /**นักศึกษาเคยลงเรียนไปแล้วมากกว่า 1 ครั้ง */
            $result_array[] = $student_id[$i] ;
        }

        $sql2 = " SELECT student_id,course_id FROM coursestudent WHERE student_id = '$student_id[$i]' AND course_id = '$course_id'" ;
        $result2 = mysqli_query($dbcon,$sql2) or die(mysqli_error());
        $num2=mysqli_num_rows($result2);
        if($num2 < 1){ /**เพิ่มนักศึกษาลงในรายวิชา */
            $sql3 = " INSERT INTO coursestudent(student_id,course_id) VALUES ('$student_id[$i]','$course_id')" ;
            $result3 = mysqli_query($dbcon,$sql3) or die(mysqli_error());
                if(!($result3)){
                    response_message(500,"Unsuccess");
                }
        }else{
            response_message(200,"Unsuccess, Student is duplicated with in the Class.",$result_array2);
        }
    }

mysqli_free_result($result);
mysqli_free_result($result2);
mysqli_close($dbcon);
response_message(200,"Success", $result_array);

?>  
