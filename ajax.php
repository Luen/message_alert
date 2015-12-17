<?php require_once 'message_alert.php';
//--------------------------------------------------------------------
	// MESSAGE ALERT
//--------------------------------------------------------------------
	//example $.post( "ajax.php?action=message_alert", { type: "1", message: message } );
	// needs about 100 miliseconds to post the request.
	// eg. Delay for AJAX POST or use ajax success function
	//	setTimeout(function(){
	//		window.location.href = "?navaction=user";
	//	}, 100);
	if ($_GET["action"] == "message_alert") {
		$type = $_POST['type'];
		$message = $_POST['message'];
		if (isset($_POST["killtime"])) {
			array_push($_SESSION['message_alert'], array("type"=>$type,"message"=>$message,"killtime"=>$_POST["killtime"]));
		} else {
			array_push($_SESSION['message_alert'], array("type"=>$type,"message"=>$message));
		}
	}