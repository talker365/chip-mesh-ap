<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<link rel="stylesheet" href="jquery.mobile-1.4.5.min.css">
<script src="jquery-1.11.3.min.js"></script>
<script src="jquery.mobile-1.4.5.min.js"></script>
<script src="adc.js"></script>
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

<div data-role="page" id="page_status" data-theme="<?php echo $theme; ?>">
  <div data-role="header">
    <a href="index.php" data-ajax="false" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <h1>
      <?php
        echo shell_exec("hostname");
        switch (1) {
          case (file_exists('/var/www/flags/.micromesh')):
            ?> - Micro Mesh <?php
            break;
          case (file_exists('/var/www/flags/.microrouter')):
            ?> - Micro Router <?php
            break;
          default:
            #echo 'no default tab set, please pick a tab (temp message)';
            echo 'unknown setup detected';
        }
      ?>
    </h1>
  </div>

  <div data-role="main" class="ui-content">
	<h1><?php echo shell_exec("hostname"); ?></h1>

	<span id="spanADC">Data will show up here!</span>

	<a class="ui-btn" onclick="refreshADC();" data-inline="true">Refresh</a>
	<a class="ui-btn" onclick="startADC();" data-inline="true">Start</a>
	<a class="ui-btn" onclick="stopADC();" data-inline="true">Stop</a>

   <div id="divDebug" style="display:none;">
        <?php echo $_SERVER["SERVER_NAME"]; ?> Status <br />
        PHP_SELF: <?php echo $_SERVER["PHP_SELF"]; ?> <br />
        SERVER_NAME: <?php echo $_SERVER["SERVER_NAME"]; ?> <br />
        HTTP_HOST: <?php echo $_SERVER["HTTP_HOST"]; ?> <br />
        HTTP_REFERER: <?php echo $_SERVER["HTTP_REFERER"]; ?> <br />
        HTTP_USER_AGENT: <?php echo $_SERVER["HTTP_USER_AGENT"]; ?> <br />
        SCRIPT_NAME: <?php echo $_SERVER["SCRIPT_NAME"]; ?> <br />
    </div>


  </div>

  <div data-role="footer">
    <h1>Valley Digital Network (VDN)</h1>
  </div>
</div> 


</body>
</html>
