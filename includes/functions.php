<?php

	function timeLimit_1($time_limit, $date_started, $date_completed) {
		$dateToday = date("Y-m-d H:i:s");
		if ($date_started != NULL) {
			$date_started = new DateTime($date_started);
			$date_started = $date_started->modify('+'.$time_limit.' hours');
		}
		$date_today_conv = new DateTime($dateToday);
		

		// 1 - OUT OF TIME - DateStarted + TimeLimit is less than DateToday
		// 2 - IN PROGRESS
		// 3 - NEW - DateStarted is null
		// 4 - COMPLETED - DateCompleted is not null
		if ($date_started == NULL) {
			return 3;
		} else if ($date_completed != NULL) {
			return 4;
		} else if ($date_started < $date_today_conv) {
			return 1;
		} else {
			return 2;
		}
		
	}
	function timeLimit_2($end_date, $end_time, $date_started, $date_completed) {
		$end_date_time = $end_date." ".$end_time;
		$dateToday = date("Y-m-d H:i:s");
		
		$end_date_time_conv = new DateTime($end_date_time);
		$date_today_conv = new DateTime($dateToday);

		// 1 - OUT OF TIME - dateToday >= end date & time
		// 2 - IN PROGRESS
		// 3 - NEW - DateStarted is null
		// 4 - COMPLETED - DateCompleted is not null
		if ($date_started == NULL) {
			return 3;
		} else if ($date_completed != NULL) {
			return 4;
		} else if ($date_today_conv >= $end_date_time_conv) {
			return 1;
		} else {
			return 2;
		}
		
	}
	function strposOffset($search, $string, $offset)
	{
	    /*** explode the string ***/
	    $arr = explode($search, $string);
	    /*** check the search is not out of bounds ***/
	    switch($offset)
	    {
	        case $offset == 0:
				return false;
				break;
	        case $offset > max(array_keys($arr)):
				return false;
				break;
	        default:
	        return strlen(implode($search, array_slice($arr, 0, $offset)));
	    }
	}
	function getUserId($UniqueId){
		$fieldData = '';
		include('../includes/dbconnect.php');
		$sql = "SELECT UserId FROM users WHERE UniqueId = '". $UniqueId ."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$fieldData = $row['UserId'];
			}
		} 
		$conn->close();
		return $fieldData;
	}
	// function getDuplicateEmail($Email){
	// 	$fieldData = '';
	// 	include('../includes/dbconnect.php');
	// 	$sql = "SELECT Email FROM users WHERE Email = '". $Email ."'";
	// 	$result = $conn->query($sql);
	// 	if ($result->num_rows > 0) {
	// 		while($row = $result->fetch_assoc()) {
	// 			$fieldData = $row['Email'];
	// 		}
	// 	} 
	// 	$conn->close();
	// 	return $fieldData;
	// }
	function getUniqueId($UserId){
		$fieldData = '';
		include('../includes/dbconnect.php');
		$sql = "SELECT UniqueId FROM users WHERE UserId = '". $UserId ."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$fieldData = $row['UniqueId'];
			}
		} 
		$conn->close();
		return $fieldData;
	}
	function getUserName($Id, $Type){
		$fieldData = '';
		include('../includes/dbconnect.php');
		$sql = "SELECT UserName FROM users WHERE ". $Type ." = '". $Id ."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$fieldData = $row['UserName'];
			}
		} 
		$conn->close();
		return $fieldData;
	}
	
	function getTableCount($tableName){
		$count = 0;
		include('../includes/dbconnect.php');
		$sql = "SELECT count(*) as count FROM ". $tableName;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$count = $row['count']; //if 0, no data
			}
		} 
		$conn->close();
		return $count;	
	}
	function getTableCountWhere($tableName, $WhereClause){
		$count = 0;
		include('../includes/dbconnect.php');
		$sql = "SELECT count(*) as count FROM ". $tableName . " " .$WhereClause;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$count = $row['count']; //if 0, no data
			}
		} 
		$conn->close();
		return $count;	
	}
	function getAppointmentCount($tableName, $dateSelected){
		$count = 0;
		include('../includes/dbconnect.php');
		$sql = "SELECT count(*) as count FROM ". $tableName . "WHERE DateSelected=".$dateSelected;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$count = $row['count']; //if 0, no data
			}
		} 
		$conn->close();
		return $count;	
	}
	function getHolidayCount($WhereClause){
		$count = 0;
		include('../includes/dbconnect.php');
		$sql = "SELECT count(*) as count FROM holidays". " " . $WhereClause;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$count = $row['count']; //if 0, no data
			}
		}
		$conn->close();
		return $count;
	}
	function getEventCount($tableName, $WhereClause){
		$count = 0;
		include('../includes/dbconnect.php');
		$sql = "SELECT count(*) as count FROM ".$tableName. " " . $WhereClause;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$count = $row['count']; //if 0, no data
			}
		} 
		$conn->close();
		return $count;	
	}
	function getTableRow($field, $tableName, $WhereClause){
		$count = "";
		include('../includes/dbconnect.php');
		$sql = "SELECT " . $field . " FROM ". $tableName . " " . $WhereClause;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$count = $row[$field]; //if 0, no data
			}
		}
		$conn->close();
		return $count;
	}
	function getMax($field, $tableName, $WhereClause){
		$count = "";
		include('../includes/dbconnect.php');
		$sql = "SELECT MAX(".$field.") AS result FROM ".$tableName." ".$WhereClause;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$count = $row['result']; //if 0, no data
			}
		}
		$conn->close();
		return $count;
	}
	function getFirstDayOfTheYear($year){
		// $query_date = $year.'-'. ($month + 1) .'-01';
		$query_date = $year.'-01-01';
      	$date = new DateTime($query_date);
      	//First day of month
      	$date->modify('first day of this month');
      	$sd_in= $date->format('Y-m-d');
      	return $sd_in;
	}
	function getFirstDayOfTheMonth($year, $month){
		// $query_date = $year.'-'. ($month + 1) .'-01';
		$query_date = $year.'-'. ($month) .'-01';
      	$date = new DateTime($query_date);
      	//First day of month
      	$date->modify('first day of this month');
      	$sd_in= $date->format('Y-m-d');
      	return $sd_in;
	}
	function getLastDayOfTheMonth($year, $month){
		$query_date = $year.'-'. ($month) .'-01';
      	$date = new DateTime($query_date);
      	//Last day of month
      	$date->modify('last day of this month');
      	$ed_in= $date->format('Y-m-d');
      	return $ed_in;
	}
	//Logged in
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	function hashSSHA($password) {
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }
    function checkhashSSHA($name, $pass) {
    	$hash = "";
    	$salt = "";
		include('dbconnect.php');
		$sql = "SELECT Salt FROM users WHERE Username = '". $name ."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$salt = $row['Salt'];

			}
		}
		// echo "salt--" . $salt . "--pass" .$pass . "--email" .$email;
		$hash = base64_encode(sha1($pass . $salt, true) . $salt);

		// echo "hash--" . $hash;

		$conn->close();
		return $hash;
    }
    /*Sometimes you will find that your website will not get the correct user IP after adding CDN, then this function will help you*/
	function real_ip(){
	   $ip = $_SERVER['REMOTE_ADDR'];
	    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
	        foreach ($matches[0] AS $xip) {
	            if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
	                $ip = $xip;
	                break;
	            }
	        }
	    } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
	        $ip = $_SERVER['HTTP_CLIENT_IP'];
	    } elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CF_CONNECTING_IP'])) {
	        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
	    } elseif (isset($_SERVER['HTTP_X_REAL_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_X_REAL_IP'])) {
	        $ip = $_SERVER['HTTP_X_REAL_IP'];
	    }
	    return $ip;
	}

	function slotDec($date, $time){
		include('dbconnect.php');
		$sql = "UPDATE slots SET Slots = Slots - 1 WHERE SlotDate = '".$date."' AND Description = '".$time."'";
		$conn->query($sql);
		
	}

	function slotInc($date, $time){
		include('dbconnect.php');
		$sql = "UPDATE slots SET Slots = Slots + 1 WHERE SlotDate = '".$date."' AND Description = '".$time."'";
		$conn->query($sql);
	}

	function emailFull($emailID){
		$count = 0;
		$dateToday = date("Y-m-d");
		include('dbconnect.php');
		$sql = "SELECT Count FROM emailcount WHERE Date = '".$dateToday."' AND EmailID = '".$emailID."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$count = $row['Count'];
			}
			$sqlPrimaryUpdate = "";
			$sqlSecondaryUpdate = "";
			if ($count >= 499) {
				if ($emailID == 1) {
					$sqlPrimaryUpdate = "UPDATE smtp SET Status = 0 WHERE ID = 1";
					$sqlSecondaryUpdate = "UPDATE smtp SET Status = 1 WHERE ID = 2";
				} else if ($emailID == 2) {
					$sqlPrimaryUpdate = "UPDATE smtp SET Status = 1 WHERE ID = 1";
					$sqlSecondaryUpdate = "UPDATE smtp SET Status = 0 WHERE ID = 2";
				}
				$conn->query($sqlPrimaryUpdate);
				$conn->query($sqlSecondaryUpdate);
			}
			
		}
	}

	function emailCount($emailID){
		date_default_timezone_set('Asia/Manila');
		$dateToday = date("Y-m-d");
		$count = 0;
		include('dbconnect.php');
		$sql = "SELECT Count FROM emailcount WHERE Date = '".$dateToday."' AND EmailID = '".$emailID."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$count = $row['Count'];
				$newCount = $count + 1;
			}
			$sqlCount = "UPDATE emailcount SET Count = '".$newCount."' WHERE Date = '".$dateToday."' AND EmailID = '".$emailID."'";
		} else {
			$sqlCount = "INSERT INTO emailcount (Date, Count, EmailID) VALUES ('".$dateToday."', 1, '".$emailID."')";
		}
		$conn->query($sqlCount);
	}

	function saveUniqueUser($ip , $page){
		date_default_timezone_set('Asia/Manila');
		$dateToday = date("Y-m-d");
		$timeToday = date("H:i:s"); 
		$views = 0;

		//count first
		include('dbconnect.php');
		$sql = "SELECT Views, UniqueVisitorsID FROM uniquevisitors WHERE Date = '".$dateToday."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$views = $row['Views'];
				$newViews = $views + 1;
			}
			// UPDATE
			$sqlInfo = "UPDATE uniquevisitors SET Views = '" . $newViews . "' WHERE IP_Address = '". $ip ."' AND Date = '". $dateToday ."' AND Page  = '". $page ."'";
		} else {
			// NEW INSERT
			$sqlInfo = "INSERT INTO uniquevisitors (Date, Time, IP_Address, Views, Page)
			VALUES ('". $dateToday ."','". $timeToday ."', '".  $ip ."', 1 ,'".  $page ."')";
		}

		if ($conn->query($sqlInfo) === TRUE) {
	    } else {
	        // echo "Error: <br>" . $conn->error; //needs to be deleted to not cater error 
	    }
	}

	function saveActionLogs($userid, $actiontype, $description) {
		include('dbconnect.php');
		$dateToday = date("Y-m-d H:i:s");

		$sql = "INSERT INTO actionlogs (UserID, ActionType, Description, ActionDate) VALUES ('".$userid."', '".$actiontype."', '".$description."', '".$dateToday."')";
		mysqli_query($conn, $sql);
	}

	function saveStartProcessTime($appointmentid, $applicationtype) {
		include('dbconnect.php');
		$dateToday = date("Y-m-d H:i:s");

		$sql = "INSERT INTO processtime (AppointmentID, ApplicationType, ProcessStartTime) VALUES ('".$appointmentid."', '".$applicationtype."', '".$dateToday."')";
		mysqli_query($conn, $sql);
	}

	function saveEndProcessTime($appointmentid) {
		include('dbconnect.php');
		$dateToday = date("Y-m-d H:i:s");

		$sql = "UPDATE processtime SET ProcessEndTime = '".$dateToday."' WHERE AppointmentID = '".$appointmentid."'";
		mysqli_query($conn, $sql);
	}

	function saveAppointmentLogs($appointmentid, $clientid, $userid, $logdescription, $status) {
		include('dbconnect.php');
		$dateToday = date("Y-m-d H:i:s");

		$sql = "INSERT INTO appointmentlogs 
			(AppointmentID, ClientID, UserID, LogDescription, LogDateTime, Status, Email) 
			VALUES 
			('".$appointmentid."', '".$clientid."', '".$userid."', '".$logdescription."', '".$dateToday."', '".$status."', '0')";
		mysqli_query($conn, $sql);
	}

	function saveForumLogs($UserId, $Status, $MainMessageId){
		date_default_timezone_set('Asia/Manila');
        $dateToday = date("Y-m-d H:i:s"); 
        
        include('dbconnect.php');
        //edit Status
        $sqlStatus = "UPDATE mainfmessage SET Status = '". $Status ."' WHERE MainMessageId= ". $MainMessageId;
                        
        if ($conn->query($sqlStatus) === TRUE) {
        } else {
            echo "Error: <br>" . $conn->error; 
        }

        //add to forum logs
        $sqlAccept = "INSERT INTO forumlogs (MainMessageId, Status, UserId, Date)
                    VALUES ('". $MainMessageId ."','". $Status ."', '". $UserId ."', '" . $dateToday . "')";
                        
        if ($conn->query($sqlAccept) === TRUE) {
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "Error: <br>" . $conn->error; 
        }
	}
	function get_contents($url, $u = false, $c = null, $o = null) {
	    $headers = @get_headers($url);
  		if ($headers === false) return false; // when server not found
	    $status = substr($headers[0], 9, 3);
	    if ($status == '200') {
	        return file_get_contents($url, $u, $c, $o);
	    }
	    // echo $status;
	    return false;
	}
	function GetVolumeLabel($drive) {
	  // Try to grab the volume name
	  if (preg_match('#Volume Serial Number is (.*)\n#i', shell_exec('dir '.$drive.':'), $m)) {
	    $volname = ' ('.$m[1].')';
	  } else {
	    $volname = '';
	  }
	return $volname;
	}	

	function getMachineName(){
		$machineName = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		return $machineName;
	}

	function emailNotification($email, $fname, $lname, $app_id, $email_type){
		include('dbconnect.php');
		if ($email_type <= 7) {
			$sqlEmailNotif = "INSERT INTO emailnotification 
					  	  	 (EmailAddress, FirstName, LastName, ApplicationID, EmailType, Status)
                      	  	 VALUES 
					  	  	 ('".$email."', '".$fname."', '".$lname."', '".$app_id."', '".$email_type."', '0')";	
		} else {
			$sqlEmailNotif = "INSERT INTO emailnotification 
					  	  	 (EmailAddress, FirstName, LastName, EmailType, Status)
                      	  	 VALUES 
					  	  	 ('".$email."', '".$fname."', '".$lname."', '".$email_type."', '0')";
		}
		$conn->query($sqlEmailNotif);
	}

	function getCourseStatus($status){
		$course_stat_desc = "";
		include('../includes/dbconnect.php');
		$sql = "SELECT Description FROM course_status WHERE CourseStatusID = ".$status;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$course_stat_desc = $row['Description']; //if 0, no data
			}
		}
		$conn->close();
		return $course_stat_desc;
	}

	function hms($seconds) {
		$t = round($seconds);
		return sprintf('%02d:%02d:%02d', $t/3600, floor($t/60)%60, $t%60);
	}

	// Function to generate a unique random number (checks against all previously generated numbers)
	function generateUniqueRandomNumber($min, $max, $generatedData) {
		// Extract the previously generated numbers from the data (across all days)
		$usedNumbers = [];
		foreach ($generatedData as $line) {
			list(, $number) = explode(":", $line);
			$usedNumbers[] = $number;
		}
	
		do {
			$randomNumber = rand($min, $max);
		} while (in_array($randomNumber, $usedNumbers));
	
		return $randomNumber;
	} 
?>