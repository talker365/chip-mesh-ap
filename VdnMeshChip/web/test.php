<html><body style="background: black; color: lightgray;">
<?php 
	$d = opendir("/var/www");
	$f = readdir($d); 
	
	if(is_dir($f)) {
		echo '<b>Works:' . $f . '</b>'; 
	} 
?>
</body></html>
