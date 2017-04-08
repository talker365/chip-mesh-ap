<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<link rel="stylesheet" href="jquery.mobile-1.4.5.min.css">
<script src="jquery-1.11.3.min.js"></script>
<script src="jquery.mobile-1.4.5.min.js"></script>
<script src="status.js"></script>
<?php
	$theme = "b";
  session_start();
?>
<style>
	.greenCollHeader {
    	background-color: #7FAF1B !important;
    	text-shadow: #aaa 0 1px 0 !important;
	}
</style>
</head>
<body>


  <?php
    if (file_exists('/var/www/flags/.admin')) {
      $pwdFromFile = trim(shell_exec("cat /var/www/flags/.admin"));
    } else {
      $pwdFromFile = "micromesh";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // collect value of input field
        $adminPwd = $_POST['adminPwd'];
        $_SESSION["authenticated"] = "false";
        if (!empty($adminPwd)) {
          if ($adminPwd == $pwdFromFile) {
            $_SESSION["authenticated"] = "true";
            echo "logged in!";
          } else {
            $_SESSION["authenticated"] = "false";
            echo "sorry, try again";
          }
        }
    } else {
      $_SESSION["authenticated"] = "false";
    }
  ?>


  <br /><br />
  <a data-ajax="false" href="status.php#page_admin">click here to return to status page</a>
  <br /><br />


  <?php #print_r($_SESSION); ?>
</body>
</html>