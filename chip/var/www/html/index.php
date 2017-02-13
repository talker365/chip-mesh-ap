<?php
	switch (file_exists('/var/www/flags/.installed')) {
		case 1:
			include 'status.php';
			break;
		default:
			#echo 'no default tab set, please pick a tab (temp message)';
			include 'setup.php';
	}
?>

