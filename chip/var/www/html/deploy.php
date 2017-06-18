<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<link rel="stylesheet" href="jquery.mobile-1.4.5.min.css">
	<script src="jquery-1.11.3.min.js"></script>
	<script src="jquery.mobile-1.4.5.min.js"></script>
	<script>
		setTimeout(function(){"window.location='/index.php'";},5000);
	</script>
	<?php
    	$theme = "b";
	?>
</head>
<body>
	<div data-role="page" id="page_status" data-theme="<?php echo $theme; ?>">
		<div data-role="header">
			<a href="index.php" data-ajax="false" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left ui-btn-active">Home</a>
			<a href="#page_home_info" class="ui-disabled ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-icon-left">Help</a>
			<!--<a href="#page_home_info" class="ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-icon-left">Help</a>-->
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
			<?php
				switch ($_POST["deploy_mode"]) {
				    case "install": ?>
			            <div data-role="collapsible" data-theme="e" data-content-theme="c">
			                <h1>Installation Parameters</h1>
			                <p> 
			                    Installation Type: <?php echo $_POST["final_microtype"]; ?> <br />
			                    Callsign: <?php echo $_POST["final_callsign"]; ?> <br />
			                    Node Name: <?php echo $_POST["final_meshhostname"]; ?> <br />
        			            Node Password: <?php echo $_POST["final_meshpassword"]; ?> <br />
			                    Node Channel: <?php echo $_POST["final_nodechannel"]; ?> <br />
			                    Node SSID: <?php echo $_POST["final_nodessid"]; ?> <br />
			                    Mesh Ethernet Type: <?php echo $_POST["final_meshEthernetType"]; ?> <br />
			                    Router Hostname: <?php echo $_POST["final_routerhostname"]; ?> <br />
			                    SSID: <?php echo $_POST["final_ssid"]; ?> <br />
			                    Password: <?php echo $_POST["final_password"]; ?><br />
			                    Router Ethernet Type: <?php echo $_POST["final_routerEthernetType"]; ?> <br />
			                    AP SSID: <?php echo $_POST["final_accesspointssid"]; ?> <br />
			                    AP Password: <?php echo $_POST["final_accesspointpassword"]; ?> <br />
			                    AP Channel: <?php echo $_POST["final_accesspointchannel"]; ?> <br />
			                    <div data-role="collapsible" data-collapsed="false" data-theme="e" data-content-theme="c">
			                        <h1>Installation Commmand</h1>
			                        <p>
			                            <?php
			                                $command = "sudo /var/www/html/./mmconfig ";
			                                $command .= $_POST["final_microtype"] . " ";
			                                $command .= $_POST["final_callsign"] . " ";
			                                $command .= $_POST["final_meshhostname"] . " ";
			                                $command .= $_POST["final_meshpassword"] . " ";
			                                $command .= $_POST["final_nodechannel"] . " ";
			                                $command .= $_POST["final_meshEthernetType"] . " ";
            			                    $command .= $_POST["final_routerhostname"] . " ";
                        			        $command .= $_POST["final_ssid"] . " ";
			                                $command .= $_POST["final_password"] . " ";
            			                    $command .= $_POST["final_routerEthernetType"] . " ";
                        			        $command .= $_POST["final_accesspointssid"] . " ";
			                                $command .= $_POST["final_accesspointpassword"] . " ";
            			                    $command .= $_POST["final_accesspointchannel"] . " ";
                        			        $command .= $_POST["final_nodessid"] . " ";
			                                echo $command;
            				                ?>
			                        </p>
			                    </div>
			                </p>
			            </div>
			            <div data-role="collapsible" data-collapsed="false" data-theme="e" data-content-theme="c">
			                <h1>Installation Results</h1>
			                <p>
			                    <?php
			                        echo shell_exec("$command");
			                    ?>
			                </p>
			            </div>



				        <?php break;
				    case "admin":
					    $command = "";

					    /* --- Setting Old Values - Micro Mesh --- */
						if (file_exists('/var/www/flags/.micromesh')) {
					    	$old_callsign = trim(shell_exec("cat /var/www/flags/.callsign"));
					    	$old_meshhostname = trim(shell_exec("hostname"));
					    	$old_meshpassword = trim(shell_exec("cat /var/www/flags/.admin"));
					    	$old_nodechannel = trim(shell_exec("cat /proc/net/rtl8723bs/wlan1/rf_info | awk '/cur_ch/ { print $1}' | cut -d '=' -f2 | cut -d ',' -f1"));
					    	$old_nodessid = trim(shell_exec("echo $(iwconfig wlan1 | grep ESSID | cut -d '\"' -f2)"));
					    	if (file_exists('/var/www/flags/.lan')) { 
					    		$old_meshEthernetType = "LAN";
					    	} else {
					    		$old_meshEthernetType = "WAN";
					    	}
						}				    

					    /* --- Setting Old Values - Micro Router --- */
						if (file_exists('/var/www/flags/.microrouter')) {
							$old_routerhostname = trim(shell_exec("hostname"));
							$old_ssid = trim(shell_exec("cat /var/www/flags/.wifiSSID"));
							$old_password = trim(shell_exec("cat /var/www/flags/.wifiPASS"));
							if (file_exists('/var/www/flags/.eth')) {
								$old_routerEthernetType = "ETH";
							} else {
								$old_routerEthernetType = "WLAN";
							}
							$old_accesspointssid = trim(shell_exec("cat /var/www/flags/.apSSID"));
							$old_accesspointpassword = trim(shell_exec("cat /var/www/flags/.apPASS"));
							$old_accesspointchannel = trim(shell_exec("cat /var/www/flags/.apChannel"));
						}
				    ?>
			            <div data-role="collapsible" data-theme="e" data-content-theme="c">
			                <h1>Admin Updates</h1>
			                <p> 			            
			                    Installation Type: <?php echo $_POST["final_microtype"]; ?> <br />
			                    <?php switch ($_POST["final_microtype"]) {
			                    	case "micromesh": ?>
					                    Callsign:
					                    	<?php
					                    		echo $_POST["final_callsign"];
					                    		if ($old_callsign != $_POST["final_callsign"]) {
					                    			echo " (new) ";
					                    			$command .= "sudo /var/www/html/./mmconfig update callsign " . $_POST["final_callsign"] . "; ";
					                    		}
				                    		?>
				                    		<br />
					                    Node Name:
					                    	<?php
					                    		echo $_POST["final_meshhostname"];
					                    		if ($old_meshhostname != $_POST["final_meshhostname"]) {
					                    			echo " (new) ";
					                    			$command .= "sudo /var/www/html/./mmconfig update meshName " . $_POST["final_meshhostname"] . "; ";
					                    		}
				                    		?>
				                    		<br />
		        			            Node Password:
		        			            	<?php
		        			            		echo $_POST["final_meshpassword"];
					                    		if ($old_meshpassword != $_POST["final_meshpassword"]) {
					                    			echo " (new) ";
					                    			$command .= "sudo /var/www/html/./mmconfig update adminPASS " . $_POST["final_meshpassword"] . "; ";
					                    		}
		    			            		?>
		    			            		<br />
					                    Node Channel:
					                    	<?php
					                    		echo $_POST["final_nodechannel"];
					                    		if ($old_nodechannel != $_POST["final_nodechannel"]) {
					                    			echo " (new) ";
					                    			$command .= "sudo /var/www/html/./mmconfig update meshChannel " . $_POST["final_nodechannel"] . "; ";
					                    		}
				                    		?>
				                    		<br />
					                    Node SSID:
					                    	<?php
					                    		echo $_POST["final_nodessid"];
					                    		if ($old_nodessid != $_POST["final_nodessid"]) {
					                    			echo " (new) ";
					                    			$command .= "sudo /var/www/html/./mmconfig update meshSSID " . $_POST["final_nodessid"] . "; ";
					                    		}
				                    		?>
				                    		<br />
					                    Mesh Ethernet Type:
					                    	<?php
					                    		echo $_POST["final_meshEthernetType"];
					                    		if ($old_meshEthernetType != $_POST["final_meshEthernetType"]) {
					                    			echo " (new) ";
					                    			$command .= "sudo /var/www/html/./mmconfig update meshEthernetType " . $_POST["final_meshEthernetType"] . "; ";
					                    		}
				                    		?>
				                    		<br />
		                    	<?php
		                    			break;
		                    		
		                    		case "microrouter": 
			                    ?>
					                    Router Ethernet Type:
					                    	<?php
					                    		$command .= "sudo /var/www/html/./mmconfig update routerEthernetType ";
					                    		echo $_POST["final_routerEthernetType"];
					                    		if ($old_routerEthernetType != $_POST["final_routerEthernetType"]) {
					                    			echo " (new) ";
					                    			$command .= $_POST["final_routerEthernetType"] . " ";
					                    		} else {
					                    			$command .= $old_routerEthernetType . " ";
					                    		}
				                    		?>
				                    		<br />
					                    Hostname:
					                    	<?php
					                    		echo $_POST["final_routerhostname"];
					                    		if ($old_routerhostname != $_POST["final_routerhostname"]) {
					                    			echo " (new) ";
					                    			$command .= $_POST["final_routerhostname"] . " ";
					                    		} else {
					                    			$command .= $old_routerhostname . " ";
					                    		}
				                    		?>
				                    		<br />
				                    	<?php if ($_POST["final_routerEthernetType"] == "ETH") { ?>
						                    Access Point SSID:
						                    	<?php
						                    		echo $_POST["final_accesspointssid"];
						                    		if ($old_accesspointssid != $_POST["final_accesspointssid"]) {
						                    			echo " (new) ";
						                    			$command .= $_POST["final_accesspointssid"] . " ";
					                    		} else {
					                    			$command .= $old_accesspointssid . " ";
						                    		}
					                    		?>
					                    		<br />
						                    Access Point Password:
						                    	<?php
						                    		echo $_POST["final_accesspointpassword"];
						                    		if ($old_accesspointpassword != $_POST["final_accesspointpassword"]) {
						                    			echo " (new) ";
						                    			$command .= $_POST["final_accesspointpassword"] . " ";
						                    		} else {
						                    			$command .= $old_accesspointpassword . " ";
						                    		}
					                    		?>
					                    		<br />
						                    Access Point Channel:
						                    	<?php
						                    		echo $_POST["final_accesspointchannel"];
						                    		if ($old_accesspointchannel != $_POST["final_accesspointchannel"]) {
						                    			echo " (new) ";
						                    			$command .= $_POST["final_accesspointchannel"] . " ";
						                    		} else {
						                    			$command .= $old_accesspointchannel . " ";
						                    		}
					                    		?>
					                    		<br />
				                    	<?php } ?>

				                    	<?php if ($_POST["final_routerEthernetType"] == "WLAN") { ?>
						                    WiFi SSID:
						                    	<?php
						                    		echo $_POST["final_ssid"];
						                    		if ($old_ssid != $_POST["final_ssid"]) {
						                    			echo " (new) ";
						                    			$command .= $_POST["final_ssid"] . " ";
						                    		} else {
						                    			$command .= $old_ssid . " ";
						                    		}
					                    		?>
					                    		<br />
						                    WiFi Password:
						                    	<?php
						                    		echo $_POST["final_password"];
						                    		if ($old_password != $_POST["final_password"]) {
						                    			echo " (new) ";
						                    			$command .= $_POST["final_password"] . " ";
						                    		} else {
						                    			$command .= $old_password . " ";
						                    		}
					                    		?>
					                    		<br />
				                    	<?php } ?>

								<?php
										break;
									} 
								?>

			                    <div data-role="collapsible" data-collapsed="false" data-theme="e" data-content-theme="c">
			                        <h1>Update Commmands</h1>
			                        <p>
			                            <?php echo $command; ?>
			                        </p>
			                    </div>
			                </p>
			            </div>
			            <div data-role="collapsible" data-collapsed="false" data-theme="e" data-content-theme="c">
			                <h1>Installation Results</h1>
			                <p>
			                    <?php
			                        echo shell_exec("$command");
			                    ?>
			                </p>
			            </div>

				        <?php break;	
			    	default: ?>
						<h1>Unknown Navigation</h1>

				<?php }
			?>

        </div>
		<div data-role="footer">
			<h1>Valley Digital Network (VDN)</h1>
		</div>
	</div>


</body>
</html>
