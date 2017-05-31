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

<div data-role="page" id="page_status" data-theme="<?php echo $theme; ?>">
  <div data-role="header">
    <a href="index.php" data-ajax="false" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
	<a href="#page_status_info" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-icon-left">Help</a>
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
        <li><a href="#page_projects" data-transition="slide">Projects</a></li>
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
        		          ?><h4> Mesh Node </h4><?php
		                  break;
		                case (file_exists('/var/www/flags/.microrouter')):
                      switch (1) {
                        case (file_exists('/var/www/flags/.eth')):
                          ?><h2> Micro Router (Access Point) </h2><?php
                          break;
                        case (file_exists('/var/www/flags/.wlan')):
                          ?><h2> Micro Router (WiFi Bridge) </h2><?php
                          break;
                      }
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
    <a href="index.php" data-ajax="false" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="#page_nodes_info" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-icon-left">Help</a>
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
    <div data-role="navbar">
      <ul>
        <li><a href="#page_status" data-transition="reverse">Status</a></li>
        <li><a href="#page_nodes" class="ui-btn-active">Nodes</a></li>
        <li><a href="#page_olsr" data-transition="slide">OLSR</a></li>
        <li><a href="#page_projects" data-transition="slide">Projects</a></li>
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
    <a href="index.php" data-ajax="false" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="#page_olsr_info" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-icon-left">Help</a>
    <h1><?php echo shell_exec("hostname"); ?> - Micro Mesh</h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#page_status" data-transition="reverse">Status</a></li>
        <li><a href="#page_nodes" data-transition="reverse">Nodes</a></li>
        <li><a href="#page_olsr" class="ui-btn-active">OLSR</a></li>
        <li><a href="#page_projects" data-transition="slide">Projects</a></li>
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
    <a href="index.php" data-ajax="false" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="#page_clients_info" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-icon-left">Help</a>
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
    <div data-role="navbar">
      <ul>
        <li><a href="#page_status" data-transition="reverse">Status</a></li>
        <li><a href="#page_clients" class="ui-btn-active">Clients</a></li>
        <li><a href="#page_projects" data-transition="slide">Projects</a></li>
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
    <a href="index.php" data-ajax="false" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="#page_admin_info" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-icon-left">Help</a>
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
        <li><a href="#page_projects" data-transition="slide">Projects</a></li>
        <li><a href="#page_admin" class="ui-btn-active">Admin</a></li>
      </ul>
    </div>
  </div>

  <div data-role="main" class="ui-content">

  <!-- Admin Login Form -->
  <?php if ($_SESSION["authenticated"] == "true") { ?>
    <div style="display: none;">
  <?php } else { ?>
    <div>
  <?php } ?>
      <form method="post" action="authenticate.php">
        <div class="ui-field-contain">
          <label for="adminPwd">Admin Password:</label>
          <input type="password" name="adminPwd" id="adminPwd">       
        </div>
        <input type="submit" data-inline="true" value="Submit">
      </form>
    </div>
  
  <!-- Admin Page -->
  <?php if ($_SESSION["authenticated"] == "true") { ?>
    <div>
  <?php } else { ?>
    <div style="display: none;">
  <?php } ?>
    	<h2>Admin Options</h2>
        <a href="authenticate.php" data-ajax="false" data-transition="slide">Log off</a>
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
 
     <?php
        switch (1) {
            case (file_exists('/var/www/flags/.micromesh')) :
                ?>
				<!-- Mesh Settings -->
          <div class="ui-field-contain">
            <label for="callsign">Callsign:</label>
            <input type="text" name="callsign" id="callsign" value="<?php echo trim(shell_exec("cat /var/www/flags/.callsign")) ?>" onkeyup="updateNodeName();" placeholder="Please enter your callsign">
            <label for="meshhostname">Node name:</label>
            <input type="text" name="meshhostname" id="meshhostname" value="<?php echo shell_exec("hostname"); ?>" placeholder="Please select a unique hostname (e.g. callsign-micromesh-01)">
            <label for="meshpassword">Admin Password:</label>
            <input type="password" name="meshpassword" id="meshpassword" value="<?php echo trim(shell_exec("cat /var/www/flags/.admin")) ?>" placeholder="This is the password used to access this micro mesh node's mangement features">
            <label for="nodessid">SSID:</label>
            <input type="text" name="nodessid" id="nodessid" value="<?php echo trim(shell_exec("echo $(iwconfig wlan1 | grep ESSID | cut -d '\"' -f2)")); ?>" placeholder="SSID used by the mesh node (e.g. AREDN-VDN-20-v3)">
            <label for="nodechannel">Select Channel</label>
            <select name="nodechannel" id="nodechannel">
                <?php echo shell_exec("/var/www/html/./wifiscan CH 2>&1"); ?>
            </select>
          </div>
        <?php
            $eth0present = shell_exec("/var/www/html/./mmconfig check ethernet");
            #echo "<p> DEBUG: mmconfig=$eth0present </p>";

            if (trim($eth0present) == "TRUE") {
        ?>
          <h2> Ethernet Connection </h2>
            <fieldset data-role="controlgroup">
                <legend>A wired connection was identified, please select how to use it:</legend>
                <label for="meshLan"> LAN - Wired connection is treated like another connection to the Access Point</label>
                <input type="radio" name="meshEthernetType" id="meshLan" value="meshLan" <?php if (file_exists('/var/www/flags/.lan')) { echo "checked";} ?> >
                <label for="meshWan"> WAN - Wired connection is treated as the connection to the internet (or your home network)</label>
                <input type="radio" name="meshEthernetType" id="meshWan" value="meshWan" <?php if (file_exists('/var/www/flags/.wan')) { echo "checked";} ?> >
            </fieldset>

        <?php
            }
        ?>



                <?php
                break;
            case (file_exists('/var/www/flags/.microrouter')) :
                ?>

        <!-- Router Settings -->
            <h2> Access Point </h2>

                <fieldset data-role="controlgroup">
                  <legend>Choose routing mode:</legend>
                  <label for="routerEth">Acts as WiFi Hotspot</label>
                  <input type="radio" name="routerEthernetType" id="routerEth" value="routerEth" onclick="document.getElementById('div1').style.display='block';document.getElementById('div2').style.display='none';" <?php if (file_exists('/var/www/flags/.eth')) { echo "checked";} ?> >
                    <label for="routerWlan">Connects to a WiFi Hotspot</label>
                    <input type="radio" name="routerEthernetType" id="routerWlan" value="routerWlan" onclick="document.getElementById('div2').style.display='block';document.getElementById('div1').style.display='none';" <?php if (file_exists('/var/www/flags/.wlan')) { echo "checked";} ?> >
                </fieldset>
                <?php
                    $eth0present = shell_exec("/var/www/html/./mmconfig check ethernet");
                    #echo "<p> DEBUG: mmconfig=$eth0present </p>";
            
                    if (trim($eth0present) == "FALSE") {
                ?>
                <h2 style="color: red;"> Ethernet Connection Error!</h2>
                      <p> No wired connection found!  You must have a wired connection for the micro router to function properly. </p>
                <?php
                    }
                ?>
                <div id="div1" <?php if (file_exists('/var/www/flags/.wlan')) { echo "style=\"display: none;\""; } ?> >
                  <h2> Access Point </h2>
                    <div class="ui-field-contain">
                        <label for="accesspointssid">SSID:</label>
                        <input type="text" name="accesspointssid" id="accesspointssid" value="<?php echo shell_exec("cat /etc/hostapd.conf|grep ssid|cut -d'=' -f2"); ?>" placeholder="SSID used by the access point">
                        <label for="accesspointpassword">Password:</label>
                        <input type="text" name="accesspointpassword" id="accesspointpassword" value="<?php echo shell_exec("cat /etc/hostapd.conf|grep wpa_passphrase|cut -d'=' -f2"); ?>" placeholder="This is the password used to access the access point">
                        <label for="accesspointchannel">Select Channel</label>
                        <select name="accesspointchannel" id="accesspointchannel">
                            <?php echo shell_exec("sudo /var/www/html/./wifiscan CH 2>&1"); ?>
                        </select>
                    </div>

                </div>
                <div id="div2" <?php if (file_exists('/var/www/flags/.eth')) { echo "style=\"display: none;\""; } ?> >
                      <h2> WiFi Connection </h2>
                  <span id=spanWiFiConnection>
                        <?php echo shell_exec("sudo /var/www/html/./wifiscan AP HTML 2>&1");  ?>  
                  </span>
                  <a class="ui-btn" onclick="refreshWiFiConnection();" data-inline="true">Refresh</a>
                      <!--<br /><br />-->
                      <div class="ui-field-contain">
                          <label for="ssid">SSID:</label>
                          <input type="text" name="ssid" id="ssid" placeholder="Select SSID above or type your own..." data-clear-btn="true" value="<?php echo shell_exec("cat /var/www/flags/.wifiSSID") ?>">
                          <label for="password">Password:</label>
                          <input type="password" name="password" id="password" placeholder="Enter WiFi Password..." data-clear-btn="true" value="<?php echo shell_exec("cat /var/www/flags/.wifiPASS") ?>">
                      </div>
                </div>




                <?php
                break;
        }
    ?>



    <a href="#submitChangesPopup" data-rel="popup" data-transition="slideup" 
     <?php
        switch (1) {
            case (file_exists('/var/www/flags/.micromesh')) :
                ?>
                  onclick="populateForm('micromesh');" 
                <?php
                break;
            case (file_exists('/var/www/flags/.microrouter')) :
                ?>
                  onclick="populateForm('microrouter');" 
                <?php
                break;
        }
    ?>
    data-inline="true" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Save Changes</a>

    <a href="#resetPopup" data-rel="popup" data-transition="slideup" data-inline="true" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Reset Device</a>

    <a data-transition="slideup" data-inline="true" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Reboot</a>


    <div data-role="popup" id="resetPopup" class="ui-content">
        <p>Are you sure you wish to reset this device?</p>
        <li><a href="/setup.php" data-ajax="false" data-transition="slide">Reset Device!</a></li>
    </div>

    <div data-role="popup" id="submitChangesPopup" class="ui-content">
        <p>Here are the new values you are updating: </p>

	    <form method="post" action="deploy.php">
    			<div style="display:none;">
            		<label for="deploy_mode">Deploy Mode:</label>
                	<input type="text" readonly="readonly" required name="deploy_mode" id="deploy_mode" placeholder="Deploy Mode" value="admin">
    			</div>
    			<div>
            <div style="display: none;" class="ui-field-contain" data-type="horizontal">
                <label for="final_microtype">Installation Type:</label>
                <input type="text" readonly="readonly" required name="final_microtype" id="final_microtype" placeholder="Installation Type" 
                <?php
                  switch (1) {
                      case (file_exists('/var/www/flags/.micromesh')) :
                          ?>
                            value="micromesh" 
                          <?php
                          break;
                      case (file_exists('/var/www/flags/.microrouter')) :
                          ?>
                            value="microrouter" 
                          <?php
                          break;
                  }
                ?>
                >
            </div>
            <div <?php if (file_exists('/var/www/flags/.microrouter')) {echo " style=\"display:none;\" ";} ?> >
              <div id="f_callsign" class="ui-field-contain" data-type="horizontal">
                  <label for="final_callsign">Callsign:</label>
                  <input type="text" readonly="readonly" required name="final_callsign" id="final_callsign" placeholder="Your callsign">
              </div>
              <div id="f_nodename" class="ui-field-contain" data-type="horizontal">
                  <label for="final_meshhostname">Node:</label>
                  <input type="text" readonly="readonly" required name="final_meshhostname" id="final_meshhostname" placeholder="Node name">
              </div>
              <div id="f_nodessid" class="ui-field-contain" data-type="horizontal">
                  <label for="final_nodessid">Node SSID:</label>
                  <input type="text" readonly="readonly" required name="final_nodessid" id="final_nodessid" placeholder="">
              </div>
              <div class="ui-field-contain" data-type="horizontal">
                  <label for="final_meshpassword">Admin Password:</label>
                  <input type="text" readonly="readonly" required name="final_meshpassword" id="final_meshpassword" placeholder="Node password">
              </div>
              <div id="f_nodechannel" class="ui-field-contain" data-type="horizontal">
                  <label for="final_nodechannel">Node Channel:</label>
                  <input type="text" readonly="readonly" required name="final_nodechannel" id="final_nodechannel" placeholder="Node channel">
              </div>
              <div id="f_nodeethernet" class="ui-field-contain" data-type="horizontal">
                  <label for="final_meshEthernetType">Ethernet:</label>
                  <input type="text" readonly="readonly" required name="final_meshEthernetType" id="final_meshEthernetType" placeholder="Ethernet use">
              </div>
            </div>
            <div <?php if (file_exists('/var/www/flags/.micromesh')) {echo " style=\"display:none;\" ";} ?> >
              <div id="f_routername" class="ui-field-contain" data-type="horizontal">
                  <label for="final_routerhostname">Router Name:</label>
                  <input type="text" readonly="readonly" required name="final_routerhostname" id="final_routerhostname" placeholder="Router hostname">
              </div>
              <div id="f_routerethernet" class="ui-field-contain" data-type="horizontal">
                  <label for="final_routerEthernetType">Gateway Device:</label>
                  <input type="text" readonly="readonly" required name="final_routerEthernetType" id="final_routerEthernetType" placeholder="">
              </div>
              <div id="div2" <?php if (file_exists('/var/www/flags/.eth')) {echo " style=\"display:none;\" ";} ?> >
                <div id="f_wifissid" class="ui-field-contain" data-type="horizontal">
                    <label for="final_ssid">WiFi SSID:</label>
                    <input type="text" readonly="readonly" required name="final_ssid" id="final_ssid" placeholder="">
                </div>
                <div id="f_wifipassword" class="ui-field-contain" data-type="horizontal">
                    <label for="final_password">WiFi Password:</label>
                    <input type="text" readonly="readonly" required name="final_password" id="final_password" placeholder="">
                </div>
              </div>
              <div id="div1" <?php if (file_exists('/var/www/flags/.wlan')) {echo " style=\"display:none;\" ";} ?> >
                <div id="f_apssid" class="ui-field-contain" data-type="horizontal">
                    <label for="final_accesspointssid">AccessPoint SSID:</label>
                    <input type="text" readonly="readonly" required name="final_accesspointssid" id="final_accesspointssid" placeholder="">
                </div>
                <div id="f_appassword" class="ui-field-contain" data-type="horizontal">
                    <label for="final_accesspointpassword">AccessPoint Password:</label>
                    <input type="text" readonly="readonly" required name="final_accesspointpassword" id="final_accesspointpassword" placeholder="">
                </div>
                <div id="f_apchannel" class="ui-field-contain" data-type="horizontal">
                    <label for="final_accesspointchannel">AccessPoint Channel:</label>
                    <input type="text" readonly="readonly" required name="final_accesspointchannel" id="final_accesspointchannel" placeholder="">
                </div>
              </div>
            </div>
          </div>
        	<input type="submit" data-inline="true" value="Update" data-ajax="false">
     	</form>

      </div>

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
