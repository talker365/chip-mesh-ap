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
			<h1><?php echo shell_exec("hostname"); ?> - Micro Mesh</h1>
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
			                    <span data-role="collapsible">
									<h1>Password</h1>
									<p><?php echo $_POST["final_password"]; ?></p>
								</span>
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
			        </div>

				        <?php break;
				    case "admin": ?>
						<h1>Admin Page Changes</h1>
				        <?php break;	
			    	default: ?>
						<h1>Unknown Navigation</h1>

				<?php }
			?>

		<div data-role="footer">
			<h1>Valley Digital Network (VDN)</h1>
		</div>
	</div>


</body>
</html>
