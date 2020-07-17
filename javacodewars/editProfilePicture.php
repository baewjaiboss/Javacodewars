<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;
/**แก้ไขรูปภาพ */
  $user = (isset($_POST['user'])) ? $_POST['user'] : '';
  $picture = (isset($_FILES['picture']['name'])) ? $_FILES['picture']['name'] : '';

  
  
  if( !(file_exists("imagesProfile")) ) { 
    mkdir("imagesProfile"); 
    }

  $query = "SELECT * FROM student WHERE student_id = '$user' ";
  $result1 = mysqli_query($dbcon, $query) or die(mysqli_error($dbcon));
  if($result1 -> num_rows == 1){
    $row =mysqli_fetch_assoc($result1) ;
    if($row['student_picture'] === ""){

        //if (is_uploaded_file($_FILES['picture']['tmp_name'])) {
        if($_FILES['picture']) {

            $error = $_FILES["picture"]["error"];
            if($error > 0){
                response_message(500,"Error uploading the file!");
            }
  
                $surnameFile = pathinfo($_FILES['picture']['name'],PATHINFO_EXTENSION); // jpg
                $number = mt_rand() ;                   //  10477032
                $date = date("Ymd_His");                //  20200402_082048
                $newImgName = $number.$date.".".$surnameFile ;    //  1047703220200402_082048.jpg
                $path = "imagesProfile/" ;
                $upload_path = $path.$newImgName ;  //      imagesProfile/1047703220200402_082048.jpg
                //$server_url = 'http://127.0.0.1:8000';
                if (move_uploaded_file($_FILES['picture']['tmp_name'], /*$_SERVER['DOCUMENT_ROOT']."/".*/$upload_path)) {
                   $picture = $newImgName ;
                   $sql = "UPDATE student SET student_picture = '$picture' WHERE student_id = '$user' ";
                   $result4 = mysqli_query($dbcon,$sql) or die(mysqli_error());
                    if(!($result4)){
                        response_message(500,"Unsuccess");
                        return;
                    }
                    mysqli_free_result($result1);
                    mysqli_close($dbcon);
                    response_message(200,"Success ,Add student image");
                } else {
                    response_message(500,"Unsuccess uploade");
                }
            } else {
                response_message(500,"No file was sent!");
                //response_message(500,"Unsuccess uploade file");
            }
      }else{
          $imgFile = $row['student_picture'] ;
          $path = "imagesProfile/" ;
          unlink($path.$imgFile);
          //if (is_uploaded_file($_FILES['picture']['tmp_name'])) {
            if($_FILES['picture']) {
  
                  $surnameFile = pathinfo($_FILES['picture']['name'],PATHINFO_EXTENSION);
                  $number = mt_rand() ;
                  $date = date("Ymd_His");
                  $newImgName = $number.$date.".".$surnameFile ;
                  $upload_path = $path.$newImgName ;
  
                  if (move_uploaded_file($_FILES['picture']['tmp_name'], $upload_path)) {
                     $picture = $newImgName ;
                     $sql = "UPDATE student SET student_picture = '$picture' WHERE student_id = '$user' ";
                     $result4 = mysqli_query($dbcon,$sql) or die(mysqli_error());
                      if(!($result4)){
                          response_message(500,"Unsuccess");
                          return;
                      }
                      mysqli_free_result($result1);
                      mysqli_close($dbcon);
                      response_message(200,"Success ,Change student image");
                  } else {
                      response_message(500,"Unsuccess uploade");
                  }
              } else {
                response_message(500,"No file was sent!");
                //response_message(500,"Unsuccess uploade file");
              }
      }

  }
  else{

    $query = "SELECT * FROM teacher WHERE teacher_user = '$user' ";
    
    $result1 = mysqli_query($dbcon, $query) or die(mysqli_error($dbcon));
    $row =mysqli_fetch_assoc($result1) ;
     if($row['teacher_picture'] === ""){
        //if (is_uploaded_file($_FILES['picture']['tmp_name'])) {
        if($_FILES['picture']) {
  
                $surnameFile = pathinfo($_FILES['picture']['name'],PATHINFO_EXTENSION); // jpg
                $number = mt_rand() ;                   //  10477032
                $date = date("Ymd_His");                //  20200402_082048
                $newImgName = $number.$date.".".$surnameFile ;    //  1047703220200402_082048.jpg
                $path = "imagesProfile/" ;
                $upload_path = $path.$newImgName ;  //      imagesProfile/1047703220200402_082048.jpg
  
                if (move_uploaded_file($_FILES['picture']['tmp_name'], $upload_path)) {
                   $picture = $newImgName ;
                   $sql = "UPDATE teacher SET teacher_picture = '$picture' WHERE teacher_user = '$user' ";
                   $result4 = mysqli_query($dbcon,$sql) or die(mysqli_error());
                    if(!($result4)){
                        response_message(500,"Unsuccess");
                        return;
                    }
                    mysqli_free_result($result1);
                    mysqli_close($dbcon);
                    response_message(200,"Success ,Add teacher image");
                } else {
                    response_message(500,"Unsuccess uploade");
                }
            } else {
                response_message(500,"No file was sent!");
                //response_message(500,"Unsuccess uploade file");
            }
      }else{
          $imgFile = $row['teacher_picture'] ;
          
          $path = "imagesProfile/" ;
          unlink($path.$imgFile);
          //if (is_uploaded_file($_FILES['picture']['tmp_name'])) {
            if($_FILES['picture']) {
  
                  $surnameFile = pathinfo($_FILES['picture']['name'],PATHINFO_EXTENSION);
                  $number = mt_rand() ;
                  $date = date("Ymd_His");
                  $newImgName = $number.$date.".".$surnameFile ;
                  $upload_path = $path.$newImgName ;
  
                  if (move_uploaded_file($_FILES['picture']['tmp_name'], $upload_path)) {
                     $picture = $newImgName ;
                     $sql = "UPDATE teacher SET teacher_picture = '$picture' WHERE teacher_user = '$user' ";
                     $result4 = mysqli_query($dbcon,$sql) or die(mysqli_error());
                      if(!($result4)){
                          response_message(500,"Unsuccess");
                          return;
                      }
                      mysqli_free_result($result1);
                      mysqli_close($dbcon);
                      response_message(200,"Success ,Change teacher image");
                  } else {
                      response_message(500,"Unsuccess uploade");
                  }
              } else {
                response_message(500,"No file was sent!");
                //response_message(500,"Unsuccess uploade file");
              }
      }

  }

    
 ?>