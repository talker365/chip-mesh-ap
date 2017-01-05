<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<link rel="stylesheet" href="jquery.mobile-1.4.5.min.css">
	<script src="jquery-1.11.3.min.js"></script>
	<script src="jquery.mobile-1.4.5.min.js"></script>
</head>
<body>

	SSID: <?php echo $_POST["hiddenSSID"]; ?> <br />
	<!--Password: <?php echo $_POST["hiddenPassword"]; ?> <br />-->

	<?php
		echo shell_exec("sudo nmcli dev disconnect wlan0");
		echo shell_exec("sudo nmcli device wifi connect '" . $_POST["hiddenSSID"] . "' password '" . $_POST["hiddenPassword"] . "' ifname wlan0 2>&1");
		echo "<br />";

	?>
</body>
</html>
