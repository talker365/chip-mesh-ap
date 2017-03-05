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
    <a href="#page_status" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
	<a href="#page_status_info" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-icon-left">Help</a>
    <h1><?php echo shell_exec("hostname"); ?> - Micro Mesh</h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#page_status" class="ui-btn-active">Status</a></li>
		<?php
    		switch (1) {
        		case (file_exists('/var/www/flags/.micromesh')) :
					?>
			        <li><a href="#page_nodes" data-transition="slide">Nodes</a></li>
			        <li><a href="#page_olsr" data-transition="slide">OLSR</a></li>
		            <?php
					break;
        		case (file_exists('/var/www/flags/.microrouter')) :
					?>
			        <li><a href="#page_clients" data-transition="slide">Clients</a></li>
		            <?php
					break;
		    }   
		?>
        <li><a href="#page_admin" data-transition="slide">Admin</a></li>
      </ul>
    </div>
  </div>

  <div data-role="main" class="ui-content">
	<table data-role="table" data-mode="columntoggle:none" class="ui-responsive" id="myTable">
	  <thead style="display:none;">
		<tr>
      	<th>column1</th>
      	<th data-priority="1">column2</th>
		</tr>
	  </thead>
	  <tbody>
		<tr>
		  <td>
			<h1><?php echo shell_exec("hostname"); ?></h1>
		    	<div style="">
		    		<?php
		        	  switch (1) {
		      	        case (file_exists('/var/www/flags/.micromesh')):
        		          ?><h4>Operating Mode: Mesh Node</h4><?php
		                  break;
		                case (file_exists('/var/www/flags/.microrouter')):
		                  ?><h2> Micro Router Status </h2><?php
		                  break;
		                default:
		                  #echo 'no default tab set, please pick a tab (temp message)';
		                  echo 'unknown setup detected';
		        	  }?>
					<h4><?php echo shell_exec("cat /etc/vdn-release");?></h4>
		            <?php echo shell_exec("./status.sh"); ?>
					<?php
						$batteryExists = shell_exec("sudo /etc/vdn/bin/battery check");
						if (trim($batteryExists) == "1") {
					?>
						<div data-role="collapsible" data-theme="e" data-content-theme="c">
						  <h1>
							Battery
							<?php 
								$mains = shell_exec("sudo /etc/vdn/bin/battery mains");
								if (trim($mains) == "1") {
									echo " Detected";
								} else {
									echo " IN USE!";
								}
							?>
						  </h1>
						  <p>
							Level: <?php echo shell_exec("sudo /etc/vdn/bin/battery level");?> %<br />
							Voltage: <?php echo shell_exec("sudo /etc/vdn/bin/battery volts");?> mV<br />
							Current: <?php echo shell_exec("sudo /etc/vdn/bin/battery current");?>mA<br />
							Battery Temp: <?php echo shell_exec("sudo /etc/vdn/bin/battery tempf");?> F<br />
							USB Voltage: <?php echo shell_exec("sudo /etc/vdn/bin/battery usbvolts");?> mV<br />
							USB Current: <?php echo shell_exec("sudo /etc/vdn/bin/battery usbma");?> mA<br />
						  </p>
						</div>
					<?php
						}
					?>
		        </div>
		  </td>
		  <td>
		    <div style="text-align: center;"/>
	        	<img src="images/micromesh_banner.png" style="background: #bbbbbb;"/> <br />
				<?php echo shell_exec("echo \"`date`\""); ?> <br />
				<?php echo shell_exec("echo \"`uptime -p`\""); ?>
    		</div>
		    <div id="divDebug" style="display:none;">
		        <?php echo $_SERVER["SERVER_NAME"]; ?> Status <br />
		        PHP_SELF: <?php echo $_SERVER["PHP_SELF"]; ?> <br />
		        SERVER_NAME: <?php echo $_SERVER["SERVER_NAME"]; ?> <br />
		        HTTP_HOST: <?php echo $_SERVER["HTTP_HOST"]; ?> <br />
		        HTTP_REFERER: <?php echo $_SERVER["HTTP_REFERER"]; ?> <br />
		        HTTP_USER_AGENT: <?php echo $_SERVER["HTTP_USER_AGENT"]; ?> <br />
		        SCRIPT_NAME: <?php echo $_SERVER["SCRIPT_NAME"]; ?> <br />
		    </div>
		  </td>
		</tr>
	  </tbody>
	</table>


  </div>

  <div data-role="footer">
    <h1>Valley Digital Network (VDN)</h1>
  </div>
  <div data-role="popup" id="page_status_info">
    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
    <br />
    <p>
        Status page help
    </p>
  </div>
</div> 



<div data-role="page" id="page_nodes" data-theme="<?php echo $theme; ?>">
  <div data-role="header">
    <a href="#page_status" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="#page_nodes_info" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-icon-left">Help</a>
    <h1><?php echo shell_exec("hostname"); ?> - Micro Mesh</h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#page_status" data-transition="reverse">Status</a></li>
        <li><a href="#page_nodes" class="ui-btn-active">Nodes</a></li>
        <li><a href="#page_olsr" data-transition="slide">OLSR</a></li>
        <li><a href="#page_admin" data-transition="slide">Admin</a></li>
      </ul>
    </div>
  </div>

  <div data-role="main" class="ui-content">
    <?php
        echo shell_exec("/etc/vdn/bin/get_olsr topology html");
    ?>  
  </div>

  <div data-role="footer">
    <h1>Valley Digital Network (VDN)</h1>
  </div>
  <div data-role="popup" id="page_nodes_info">
    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
    <br />
    <p> 
		Nodes page help
    </p>
  </div>
</div>



<div data-role="page" id="page_olsr" data-theme="<?php echo $theme; ?>">
  <div data-role="header">
    <a href="#page_status" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="#page_olsr_info" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-icon-left">Help</a>
    <h1><?php echo shell_exec("hostname"); ?> - Micro Mesh</h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#page_status" data-transition="reverse">Status</a></li>
        <li><a href="#page_nodes" data-transition="reverse">Nodes</a></li>
        <li><a href="#page_olsr" class="ui-btn-active">OLSR</a></li>
        <li><a href="#page_admin" data-transition="slide">Admin</a></li>
      </ul>
    </div>
  </div>

  <div data-role="main" class="ui-content">
	<?php
		echo shell_exec("if [ -f /var/www/tmp/olsr.routes ]; then rm /var/tmp/olsr.routes; fi; wget http://127.0.0.1:1978/routes -q -O /var/www/tmp/olsr.routes;tail -n +31 /var/www/tmp/olsr.routes | head -n -9 -");
	?>
  </div>

  <div data-role="footer">
    <h1>Valley Digital Network (VDN)</h1>
  </div>
  <div data-role="popup" id="page_olsr_info">
	<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
	<br />
	<p>
		OLSR page help
	</p>
  </div>
</div> 

<div data-role="page" id="page_clients" data-theme="<?php echo $theme; ?>">
  <div data-role="header">
    <a href="#page_status" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="#page_clients_info" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-icon-left">Help</a>
    <h1><?php echo shell_exec("hostname"); ?> - Micro Mesh</h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#page_status" data-transition="reverse">Status</a></li>
        <li><a href="#page_clients" class="ui-btn-active">Clients</a></li>
        <li><a href="#page_admin" data-transition="slide">Admin</a></li>
      </ul>
    </div>
  </div>

  <div data-role="main" class="ui-content">
    <?php
        echo shell_exec("/etc/vdn/bin/./client_list html");
    ?>
  </div>
  <div data-role="footer">
    <h1>Valley Digital Network (VDN)</h1>
  </div>
  <div data-role="popup" id="page_clients_info">
    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
    <br />
    <p>
		Clients page help
    </p>
  </div>
</div>

<div data-role="page" id="page_admin" data-theme="<?php echo $theme; ?>">
  <div data-role="header">
    <a href="#page_status" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="#page_admin_info" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-icon-left">Help</a>
    <h1><?php echo shell_exec("hostname"); ?> - Micro Mesh</h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#page_status" data-transition="reverse">Status</a></li>
        <?php
            switch (1) {
                case (file_exists('/var/www/flags/.micromesh')) :
                    ?>  
                    <li><a href="#page_nodes" data-transition="reverse">Nodes</a></li>
                    <li><a href="#page_olsr" data-transition="reverse">OLSR</a></li>
                    <?php
                    break;
                case (file_exists('/var/www/flags/.microrouter')) :
                    ?>  
                    <li><a href="#page_clients" data-transition="reverse">Clients</a></li>
                    <?php
                    break;
            }   
        ?>  
        <li><a href="#page_admin" class="ui-btn-active">Admin</a></li>
      </ul>
    </div>
  </div>

  <div data-role="main" class="ui-content">
	<h2>Admin Options</h2>
    <?php
        switch (1) {
            case (file_exists('/var/www/flags/.micromesh')) :
                ?>
                <!-- -->
                <?php
                break;
            case (file_exists('/var/www/flags/.microrouter')) :
                ?>
                <!-- -->
		        <div class="ui-field-contain">
    				<label id="label_routerhostname" for="routerhostname"> Router Name:</label>
    				<input type="text" name="routerhostname" id="routerhostname" value="<?php echo shell_exec("hostname"); ?>">
    				<span> <i>Please make sure it is unique (e.g. microrouter01, microrouter02, etc...)</i> </span>
				</div>
                <?php
                break;
        }
    ?>
	<div class="ui-field-contain">
    	<label for="adminpassword">Admin Password:</label>
    	<input type="text" name="adminpassword" id="adminpassword" placeholder="Enter new admin password (optional)">
	</div>

    <?php
        switch (1) {
            case (file_exists('/var/www/flags/.micromesh')) :
                ?>
				<!-- -->
                <?php
                break;
            case (file_exists('/var/www/flags/.microrouter')) :
                ?>
				<!-- -->
		        <h2> Access Point </h2>
		    	<fieldset data-role="controlgroup">
		    		<legend>Choose your router mode:</legend>
		        	<label for="hotspot">Acts as WiFi Hotspot</label>
		        	<input type="radio" name="router_mode" id="hotspot" value="hotspot">
		        	<label for="bridge">Connects to a WiFi Hotspot</label>
		        	<input type="radio" name="router_mode" id="bridge" value="bridge">
		    	</fieldset>
		        <div class="ui-field-contain">
		            <label for="accesspointssid">SSID:</label>
		            <input type="text" name="accesspointssid" id="accesspointssid" value="<?php echo shell_exec("cat /etc/hostapd.conf|grep ssid|cut -d'=' -f2"); ?>" placeholder="SSID used by the access point">
		            <label for="accesspointpassword">Password:</label>
		            <input type="text" name="accesspointpassword" id="accesspointpassword" value="<?php echo shell_exec("cat /etc/hostapd.conf|grep wpa_passphrase|cut -d'=' -f2"); ?>" placeholder="This is the password used to access the access point">
		            <label for="accesspointchannel">Select Channel</label>
    		        <select name="accesspointchannel" id="accesspointchannel">
    		            <?php echo shell_exec("/var/www/html/./wifiscan CH 2>&1"); ?>
            		</select>
		        </div>

                <?php
                break;
        }
    ?>



    <a href="#resetPopup" data-rel="popup" data-transition="slideup">Reset this device!</a>
    <div data-role="popup" id="resetPopup" class="ui-content">
        <p>Are you sure you wish to reset this device?</p>
        <li><a href="/setup.php" data-ajax="false" data-transition="slide">Reset this device!</a></li>
    </div>


  </div>
  <div data-role="footer">
    <h1>Valley Digital Network (VDN)</h1>
  </div>
  <div data-role="popup" id="page_admin_info">
    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
    <br />
    <p> 
		Admin page help
    </p>
  </div>
</div>


</body>
</html>
