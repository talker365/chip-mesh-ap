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
    <a href="#page_status" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left ui-btn-active">Home</a>
	<!--<a href="#page_home_info" class="ui-disabled ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-icon-left">Help</a>-->
	<a href="#page_home_info" class="ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-icon-left">Help</a>
    <h1><?php echo shell_exec("hostname"); ?> - Micro Mesh</h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#page_status" data-transition="slide">Status</a></li>
        <li><a href="#page_nodes">Nodes</a></li>
        <!--<li><a href="#page_olsr" class="ui-disabled" data-transition="slide">OLSR</a></li>-->
        <li><a href="#page_olsr" data-transition="slide">OLSR</a></li>
        <li><a href="/setup.php" data-ajax="false" data-transition="slide">Setup</a></li>
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
								echo "($mains)";
							?>
						  </h1>
						  <p>
							Level: <?php echo shell_exec("sudo /etc/vdn/bin/battery level");?> %<br />
							Voltage: <?php echo shell_exec("sudo /etc/vdn/bin/battery volts");?> mV<br />
							Battery Temp: <?php echo shell_exec("sudo /etc/vdn/bin/battery tempf");?> F<br />
							Current: <?php echo shell_exec("sudo /etc/vdn/bin/battery current");?>mA<br />
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
        <li><a href="#page_olsr">OLSR</a></li>
        <li><a href="/setup.php" data-ajax="false" data-transition="slide">Setup</a></li>
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



<div data-role="page" id="page_olsr" data-theme="<?php echo $theme; ?>">
  <div data-role="header">
    <a href="#page_status" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="#page_olsr_info" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-icon-left">Help</a>
    <h1><?php echo shell_exec("hostname"); ?> - Micro Mesh</h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#page_status" data-transition="reverse">Status</a></li>
        <li><a href="#page_nodes">Nodes</a></li>
		<li><a href="#page_olsr" class="ui-btn-active">OLSR</a></li>
        <li><a href="/setup.php" data-ajax="false" data-transition="slide">Setup</a></li>
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




</body>
</html>
