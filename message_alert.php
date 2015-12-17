<?php 
session_start(); // for next page load message alerts

//--------------------------------------------------------------------
	// MESSAGE ALERT
//--------------------------------------------------------------------
// EXAMPLES:
//message_alert(0, "User is updated."); // GREEN - Status good message
//message_alert(1, "An error has occurred. Please fix."); // RED - Error message
//message_alert(2, "Warning, robots.txt allows search engines to view this page."); // YELLOW - Status warning message
$message_alert_arr = array();
function message_alert($type, $message, $killtime = null) {
	global $message_alert_arr;
	if (isset($killtime)) {
		array_push($message_alert_arr, array("type" => $type, "message" => addslashes($message), "killtime" => $killtime));
	} else {
		array_push($message_alert_arr, array("type" => $type, "message" => addslashes($message)));
	}
}
//--------------------------------------------------------------------
	// MESSAGE ALERT - for next page load (php session)
//--------------------------------------------------------------------
//	  EXAMPLE
//	  array_push($_SESSION['message_alert'], array("type"=>2,"message"=>"Invalid Email or Password"));
if (!isset($_SESSION['message_alert'])) {
	$_SESSION['message_alert'] = array();
}
if (isset($_SESSION['message_alert']) && !empty($_SESSION['message_alert'])) {
	foreach ($_SESSION['message_alert'] as $arr) {
		if (isset($arr["killtime"])) {
			message_alert($arr["type"], $arr["message"], $arr["killtime"]);
		} else {
			message_alert($arr["type"], $arr["message"]);
		}
	}
	$_SESSION['message_alert'] = array();
}
