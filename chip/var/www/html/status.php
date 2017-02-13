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
        <!--<li><a href="#page_olsr" class="ui-disabled" data-transition="slide">OLSR</a></li>-->
        <li><a href="#page_olsr" data-transition="slide">OLSR</a></li>
        <li><a href="setup.php" data-transition="slide">Setup</a></li>
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
		    <?php
		        switch (1) {
		      	    case (file_exists('/var/www/flags/.micromesh')):
        		        ?>
		                <div style="">
							<h1><?php echo shell_exec("hostname"); ?></h1>
		                    <h4>Operating Mode: Mesh Node</h4>
							<h4><?php echo shell_exec("cat /etc/vdn-release");?></h4>
		                    <?php echo shell_exec("./status.sh"); ?>
		                </div>

		                <?php
		                break;
		            case (file_exists('/var/www/flags/.microrouter')):
		                ?>
		                <h2> Micro Router Status </h2>

		                <?php
		                break;
		            default:
		                #echo 'no default tab set, please pick a tab (temp message)';
		                echo 'no setup detected';
		        }
		    ?>
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


<div data-role="page" id="page_olsr" data-theme="<?php echo $theme; ?>">
  <div data-role="header">
    <a href="#page_status" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="#page_setup_info" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-icon-info ui-btn-icon-left">Help</a>
    <h1><?php echo shell_exec("hostname"); ?> - Micro Mesh</h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#page_status" data-transition="reverse">Status</a></li>
		<li><a href="#page_olsr" class="ui-btn-active">OLSR</a></li>
		<li><a href="setup.php" data-transition="slide">Setup</a></li>
      </ul>
    </div>
  </div>

  <div data-role="main" class="ui-content">
	<iframe src="http://<?php echo $_SERVER['SERVER_NAME']; ?>:1978" width="100%" height="100%"></iframe>

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




</body>
</html>
