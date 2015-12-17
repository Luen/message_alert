<?php
require 'message_alert.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<title>Message Alert</title>
<meta name="description" content="A jquery plugin for drupal styled message alerts">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="message_alert.css">
<style type="text/css">
a, code {
	display: block;
}
a {
	cursor: pointer;
}
</style>
<!--[if lt IE 9]>
<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel="shortcut icon" href="">
</head>
<body>
<a href="javascript:message_alert(0,'Good to go');">inline js</a>
<a id="onclick">Onclick</a>
<a id="nextpageload">On next page load (reloads the page)</a>
<a id="killtime">expires after 1 second</a>
<a id="nokilltime">does not expire until dismissed</a>

php example:
<code>
	&lt;?php message_alert(1, "php"); ?>
</code>



Removing message dynamicly
<code>
	$('.message_alert:contains(Your session has expired)').remove(); // Removes the session expired message if it is shown
</code>

In php for next page load:
<code>
	&lt;?php array_push($_SESSION['message_alert'], array("type"=>0,"message"=>"this is the next page load")); // Send message to next page load ?>
</code>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="message_alert.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	message_alert(1, "On page load: RED");
	message_alert(0, "On page load: GREEN");
	message_alert(2, "On page load: YELLOW");

	$("#onclick").click(function() {
		message_alert(1, "onclick");
	});

	$("#nextpageload").click(function() {
		$.post("ajax.php?action=message_alert", {type: "1", message: "Next page load"});
	});
});
</script>
<div id="message_alerts"></div>
<?php
// Message Alerts
if (!empty($message_alert_arr)) { 
	echo "<script type=\"text/javascript\">\n";
	foreach($message_alert_arr as $key=>$value) {
		$type = $value["type"];
		$message = $value["message"];
		$killtime = null;
		if (isset($value["killtime"])) {
			$killtime = $value["killtime"];
			$killtime = ", ".$killtime;
		}
		echo "	message_alert(".$type.", \"".$message."\"".$killtime.");\n";
	}
	$message_alert_arr = array();
	echo "</script>\n";
} 
?>
</body>
</html>