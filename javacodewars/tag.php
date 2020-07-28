<?php
  require_once 'connect.php' ;
  require_once 'global.php' ;

    /**แสดง tag ทั้งหมดในระบบ */

  $sql = " SELECT DISTINCT tag_tag FROM taglist " ;
  $result = mysqli_query($dbcon,$sql) or die(mysqli_error($dbcon));

  if(empty($result)){
    response_message(404,"No data found taglist");
    return;
  }

  $results_array = array();
  while ($row = mysqli_fetch_assoc($result)) {
       $results_array[] = $row ;
  }

  if(empty($results_array)) {
    response_message(404,"No data found taglist");
    return;
  }

  mysqli_free_result($result);
  mysqli_close($dbcon);
  response_message(200,"Success",$results_array);
