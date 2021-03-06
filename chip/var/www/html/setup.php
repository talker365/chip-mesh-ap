<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<link rel="stylesheet" href="jquery.mobile-1.4.5.min.css">
<script src="jquery-1.11.3.min.js"></script>
<script src="jquery.mobile-1.4.5.min.js"></script>
<script src="setup.js"></script>
<?php
	$theme = "b";
?>
</head>
<body onload="populateDefaults();">

<div data-role="page" id="page_home" data-theme="<?php echo $theme; ?>">
  <div data-role="header">
    <a href="index.php" data-ajax="false" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left ui-btn-active">Home</a>
	<a href="#page_home_info" class="ui-disabled ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-icon-left">Help</a>
    <h1>Micro Mesh Installer</h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#page_setup" data-transition="slide">Choose Setup</a></li>
        <li><a href="#page_configure" class="ui-disabled" data-transition="slide">Configure</a></li>
        <li><a href="#page_deploy" class="ui-disabled" data-transition="slide">Deploy</a></li>
      </ul>
    </div>
  </div>

  <div data-role="main" class="ui-content">
	<p>
		<h2> Welcome to the Micro Mesh installer! </h2>
	</p>
	<div style="text-align: center;"/>
		<img src="images/wifi.png" style="background: #bbbbbb;"/>
	</div>
	<p>
		The following steps will allow you to complete the conversion of a $9 C.H.I.P. 
		microcomputer into a fully functional mesh node and WiFi access point to allow direct connection to 
		the mesh from your personal wireless devices (phones, tablets, laptops, etc...). 
	</p>

	<a href="#page_setup" class="ui-btn">Begin</a>
  </div>

  <div data-role="footer">
    <h1>Valley Digital Network (VDN)</h1>
  </div>
</div> 


<div data-role="page" id="page_setup" data-theme="<?php echo $theme; ?>">
  <div data-role="header">
    <a href="index.php" data-ajax="false" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="#page_setup_info" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-icon-left">Help</a>
    <h1>Micro Mesh Installer</h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#page_setup" class="ui-btn-active">Choose Setup</a></li>
        <li><a href="#page_configure" data-transition="slide" onclick="loadConfigure();">Configure</a></li>
        <li><a href="#page_deploy" class="ui-disabled" data-transition="slide">Deploy</a></li>
      </ul>
    </div>
  </div>

  <div data-role="main" class="ui-content">
    <fieldset data-role="controlgroup">
        <legend> 
			Installation Type:
		</legend>
        <label for="micromesh">
            Micro Mesh Node
            <ul>
                <li> Create a mesh node that also provides a wifi access point</li>
            </ul>
        </label>
        <input type="radio" name="microtype" id="micromesh" value="micromesh" checked="checked">
        <label for="microrouter">
            Micro Mesh Router
            <ul>
                <li> Create a wifi access point that connects to your existing mesh node</li>
            </ul>
        </label>
        <input type="radio" name="microtype" id="microrouter" value="microrouter">
   </fieldset>


	<a href="#page_configure" class="ui-btn" onclick="loadConfigure();">Continue</a>
  </div>

  <div data-role="footer">
    <h1>Valley Digital Network (VDN)</h1>
  </div>
  <div data-role="popup" id="page_setup_info">
	<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
	<br />
	<p> There are two types of installations that can be selected. </p>
	<p>
		The <b>Micro Mesh Node</b> installation will create a mesh node using one of the two wifi radios
		available on the chip. This node will be able to communicate with other mesh nodes in range over
		that wifi radio.  The remaining wifi radio on the chip will be used as an Access Point, which 
		allows direct connection to the mesh from personal devices such as: smart phones, tablets, laptops,
		etc.  If an ethernet connection is also available on the chip, it can be used to provide WAN or LAN
		access.
	</p>
	<p>
		The <b>Micro Mesh Router</b> installation does not create a mesh node.  Instead, this choice will
		only create an Access Point on the chip using one of the wifi radios.  Additionally, the chip will
		need to have an ethernet connection to a LAN port on an existing mesh node.  All traffic from the
		Access Point is routed to the ethernet connected mesh node.  This allows direct connection to the
		mesh from personal devices such as: smart phones, tablets, laptops, etc. using the chip as a 
		router.
	</p>
  </div>
</div> 



<div data-role="page" id="page_configure" data-theme="<?php echo $theme; ?>">
  <div data-role="header">
    <a href="index.php" data-ajax="false" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="#page_configure_info" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-icon-left">Help</a>
    <h1>Micro Mesh Installer</h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#page_setup" data-transition="slide" data-direction="reverse">Choose Setup</a></li>
        <li><a href="#page_configure" class="ui-btn-active" onclick="loadConfigure();">Configure</a></li>
        <li><a href="#page_deploy" data-transition="slide" onclick="loadDeploy();">Deploy</a></li>
      </ul>
    </div>
  </div>

  <div data-role="main" class="ui-content">
	<div id="divConfigureMesh">
		<h2> Mesh Node Configuration </h2>
		<div class="ui-field-contain">
			<label for="callsign">Callsign:</label>
	    	<input type="text" name="callsign" id="callsign" onkeyup="updateNodeName();" placeholder="Please enter your callsign">
			<label for="meshhostname">Node name:</label>
	    	<input type="text" name="meshhostname" id="meshhostname" placeholder="Please select a unique hostname (e.g. callsign-micromesh-01)">
	        <label for="meshpassword">Admin Password:</label>
	        <input type="text" name="meshpassword" id="meshpassword" placeholder="This is the password used to access this micro mesh node's mangement features">
			<label for="nodessid">Select Mesh SSID</label>
			<select name="nodessid" id="nodessid">
				<?php echo shell_exec("/var/www/html/./wifiscan SSID 2>&1"); ?>
			</select>
		</div>
			<fieldset data-role="controlgroup">
	        	<legend>Choose how to use your ethernet connection:</legend>
	        	<label for="meshLan">LAN - Gives Mesh address to connected device</label>
	        	<input type="radio" name="meshEthernetType" id="meshLan" value="meshLan" checked>
	            <label for="meshWan">WAN - Uses connected device as the internet</label>
	            <input type="radio" name="meshEthernetType" id="meshWan" value="meshWan">
	        </fieldset>


 	</div>

    <div id="divConfigureRouter" style="display:none;">
		<h2> Router Configuration </h2>
    	<div class="ui-field-contain">
	    	<label id="label_routerhostname" for="routerhostname"> Router name:</label>
	    	<input type="text" name="routerhostname" id="routerhostname">
	    	<span style="font-size: smaller;"> <i>Please make sure the router name is unique (e.g. yourcall-microrouter-01, yourcall-microrouter-02, etc...)</i> </span>
    	</div>
    	<div class="ui-field-contain">
	    	<label for="adminpassword">Admin Password:</label>
	    	<input type="text" name=adminpassword" id="adminpassword" placeholder="This is the password used to access this micro router's mangement features">
    	</div>

        <fieldset data-role="controlgroup">
        	<legend>Choose routing mode:</legend>
        	<label for="routerEth">Acts as WiFi Hotspot</label>
        	<input type="radio" name="routerEthernetType" id="routerEth" value="routerEth" onclick="document.getElementById('div1').style.display='block';document.getElementById('div2').style.display='none';" checked>
            <label for="routerWlan">Connects to a WiFi Hotspot</label>
            <input type="radio" name="routerEthernetType" id="routerWlan" value="routerWlan" onclick="document.getElementById('div2').style.display='block';document.getElementById('div1').style.display='none';">
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
		<div id="div1">
			<h2> Access Point </h2>
    	    <div class="ui-field-contain">
        	    <label for="accesspointssid">SSID:</label>
            	<input type="text" name="accesspointssid" id="accesspointssid" placeholder="SSID used by the access point">
	            <label for="accesspointpassword">Password:</label>
    	        <input type="text" name="accesspointpassword" id="accesspointpassword" placeholder="This is the password used to access the access point">
        	    <label for="accesspointchannel">Select Channel</label>
            	<select name="accesspointchannel" id="accesspointchannel">
					<?php echo shell_exec("/var/www/html/./wifiscan CH 2>&1"); ?>
	            </select>
    	    </div>
		</div>
		<div id="div2" style="display: none;">
	        <h2> WiFi Connection </h2>
			<span id=spanWiFiConnection>
	        	<?php echo shell_exec("/var/www/html/./wifiscan AP HTML 2>&1");  ?>  
			</span>
			<a class="ui-btn" onclick="refreshWiFiConnection();" data-inline="true">Refresh</a>
    	    <!--<br /><br />-->
    	    <div class="ui-field-contain">
        	    <label for="ssid">SSID:</label>
            	<input type="text" name="ssid" id="ssid" placeholder="Select SSID above or type your own..." data-clear-btn="true">
	            <label for="password">Password:</label>
    	        <input type="password" name="password" id="password" placeholder="Enter WiFi Password..." data-clear-btn="true">
        	</div>
		</div>

	</div>


	<a href="#page_deploy" class="ui-btn" data-transition="slide" onclick="loadDeploy();">Continue</a>
  </div>

  <div data-role="footer">
    <h1>Valley Digital Network (VDN)</h1>
  </div>
  <div data-role="popup" id="page_configure_info">
    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
    <br />
	<p>
		Depending on the type of installation you selected, some of the sections below may not apply.
	</p>
	<h3> Device Name </h3>
	<p>
		Please
	</p>
	<h3> Ethernet Connection </h3>
	<p>
		Please
	</p>
	<h3> WiFi Connection </h3>
	<p>
		Please
	</p>
  </div>
</div> 





<div data-role="page" id="page_deploy" data-theme="<?php echo $theme; ?>">
  <div data-role="header">
    <a href="index.php" data-ajax="false" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="#page_deploy_help" class="ui-disabled ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-icon-left">Help</a>
    <h1>Micro Mesh Installer</h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#page_setup" data-transition="slide" data-direction="reverse">Choose Setup</a></li>
        <li><a href="#page_configure" data-transition="slide" data-direction="reverse" onclick="loadConfigure();">Configure</a></li>
        <li><a href="#page_deploy" class="ui-btn-active">Deploy</a></li>
      </ul>
    </div>
  </div>

  <div data-role="main" class="ui-content">
    <p>Review and finalize deployment to chip</p>
    <form method="post" action="deploy.php">
		<div class="ui-field-contain" data-type="vertical">
	    		<input type="submit" data-inline="true" value="Install">
				<div class="ui-field-contain" data-type="horizontal" style="display: none;">
			        <label for="deploy_mode">Installation Type:</label>
			        <input type="text" readonly="readonly" required name="deploy_mode" id="deploy_mode" placeholder="Deploy Mode" value="install">
				</div>
				<div class="ui-field-contain" data-type="horizontal">
			        <label for="final_microtype">Installation Type:</label>
			        <input type="text" readonly="readonly" required name="final_microtype" id="final_microtype" placeholder="Installation Type">
				</div>
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
				<div id="f_routername" class="ui-field-contain" data-type="horizontal">
			        <label for="final_routerhostname">Router Name:</label>
			        <input type="text" readonly="readonly" required name="final_routerhostname" id="final_routerhostname" placeholder="Router hostname">
				</div>
				<div id="f_wifissid" class="ui-field-contain" data-type="horizontal">
			        <label for="final_ssid">WiFi SSID:</label>
			        <input type="text" readonly="readonly" required name="final_ssid" id="final_ssid" placeholder="">
				</div>
				<div id="f_wifipassword" class="ui-field-contain" data-type="horizontal">
			        <label for="final_password">WiFi Password:</label>
			        <input type="password" readonly="readonly" required name="final_password" id="final_password" placeholder="">
				</div>
				<div id="f_routerethernet" class="ui-field-contain" data-type="horizontal">
			        <label for="final_routerEthernetType">Ethernet:</label>
			        <input type="text" readonly="readonly" required name="final_routerEthernetType" id="final_routerEthernetType" placeholder="">
				</div>
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
	    		<input type="submit" data-inline="true" value="Install">
			</div>
		</div>
    </form>
  </div>

  <div data-role="footer">
    <h1>Valley Digital Network (VDN)</h1>
  </div>

</div> 

</body>
</html>
