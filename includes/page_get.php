<?php
  //unique id
	$id=0;
  	if(isset($_GET['id'])){
    	$id = $_GET['id'];   
    	$count_id = getTableCount("users WHERE UniqueID='" . $id . "'");  
    	if($count_id == 0 ){
      		$id = 0;
          echo '<meta http-equiv="refresh" content="0;url=../src/index.php">';
    	}
  	}

  //other id  
  $privId = 0;
  $userId = "";
  $username = "";
  $firstname = "";
  $lastname = "";
  $uid_link = "";
  $uid_link_2 = ""; //concat with diff get
  if($id <> 0){
    $privId = getTableRow("privilege", "users", "WHERE UniqueID='".$id."'");
    $userId = getTableRow("UserID", "users", "WHERE UniqueID='".$id."'");
    $username = getTableRow("Email", "users", "WHERE UniqueID='".$id."'");
    $firstname = getTableRow("FirstName", "users", "WHERE UniqueID='".$id."'");
    $lastname = getTableRow("LastName", "users", "WHERE UniqueID='".$id."'");
    $uid_link = '?id='.$id;
    $uid_link_2 = '&id='.$id;
    $uid_link_3 = '?uid='.$id;
  }  
  
  //Date Today
  date_default_timezone_set('Asia/Manila');
  $dateToday = date("Y-m-d H:i:s"); 
  $dateNow = date("Y-m-d");
  $yearNow = date("Y");

  $timeNow = date("H:i"); 
  $timeNows = date("H:i:s"); 

  $tom = strtotime("tomorrow");
  $dateTom = date("Y-m-d", $tom);
  
  //User id
    $uid=0;
    if(isset($_GET['uid'])){
      $uid = $_GET['uid'];  
      $count_uid = getTableCount("users WHERE UserID='" . $uid . "'");  
      if($count_uid == 0 ){
          $uid = 0;
          echo '<meta http-equiv="refresh" content="0;url=../src/index.php"' . $uid_link . '>';
      }
    }

?>