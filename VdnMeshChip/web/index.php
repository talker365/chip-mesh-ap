<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<link rel="stylesheet" href="jquery.mobile-1.4.5.min.css">
<script src="jquery-1.11.3.min.js"></script>
<script src="jquery.mobile-1.4.5.min.js"></script>
<script>
	function populateForm() {
		document.getElementById("hiddenSSID").value = document.getElementById("ssid").value;
		document.getElementById("hiddenPassword").value = document.getElementById("password").value;
		document.getElementById("visibleSSID").innerHTML = document.getElementById("ssid").value;
	}
</script>

</head>
<body>

<div data-role="page" id="page_home" data-theme="b">
  <div data-role="header">
    <a href="#page_home" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
	<a href="#optionsPanel" class="ui-btn ui-corner-all ui-shadow ui-icon-grid ui-btn-icon-left">Options</a>
    <h1>Micro Mesh Installer</h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#page_setup" data-transition="slide">Choose Setup</a></li>
        <li><a href="#page_configure" data-transition="slide">Configure</a></li>
        <li><a href="#page_deploy" data-transition="slide">Deploy</a></li>
      </ul>
    </div>
  </div>

  <div data-role="main" class="ui-content">
	<div data-role="panel" id="optionsPanel">
	  <h2>Options</h2>
	  <p>Some text..</p>
	</div>
    <p>Welcome to the Micro Mesh installer.</p>
	<p> The following steps will help you setup and configure your chip. </p>
	<a href="#page_setup" class="ui-btn">Begin</a>
  </div>

  <div data-role="footer">
    <h1>Valley Digital Network (VDN)</h1>
  </div>
</div> 


<div data-role="page" id="page_setup" data-theme="b">
  <div data-role="header">
    <a href="#page_home" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="#optionsPanel" class="ui-btn ui-corner-all ui-shadow ui-icon-grid ui-btn-icon-left">Options</a>
    <h1>Micro Mesh Installer</h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#page_setup">Choose Setup</a></li>
        <li><a href="#page_configure" data-transition="slide">Configure</a></li>
        <li><a href="#page_deploy" data-transition="slide">Deploy</a></li>
      </ul>
    </div>
  </div>

  <div data-role="main" class="ui-content">
    <div data-role="panel" id="optionsPanel">
      <h2>Options</h2>
      <p>Some text..</p>
    </div>
	<h1>Choose Setup...</h1>
    <p>Select the desired chip mode</p>

	<p>
	Sorry, you have no choice yet, this is the only option.
	
	<ul>
		<li>
			Wireless Client and Access Point
		    <ul>
       			<li> eth0 - not used </li> 
		        <li> wlan0 - home wifi </li> 
		        <li> wlan1 - access point </li> 
		    </ul> 

		</li>
	</ul>	

	<a href="#page_configure" class="ui-btn">Continue</a>
  </div>

  <div data-role="footer">
    <h1>Valley Digital Network (VDN)</h1>
  </div>
</div> 



<div data-role="page" id="page_configure" data-theme="b">
  <div data-role="header">
    <a href="#page_home" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="#optionsPanel" class="ui-btn ui-corner-all ui-shadow ui-icon-grid ui-btn-icon-left">Options</a>
    <h1>Micro Mesh Installer</h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#page_setup" data-transition="slide" data-direction="reverse">Choose Setup</a></li>
        <li><a href="#page_configure">Configure</a></li>
        <li><a href="#page_deploy" data-transition="slide">Deploy</a></li>
      </ul>
    </div>
  </div>

  <div data-role="main" class="ui-content">
    <div data-role="panel" id="optionsPanel">
      <h2>Options</h2>
      <p>Some text..</p>
    </div>
	<h1>Configure...</h1>
    <p>Configure all settings for the pending installation...</p>

	<?php echo shell_exec("/var/www/html/./wifiscan"); 	?>

	<br /><br />
	<div class="ui-field-contain">
		<label for="ssid">SSID:</label>
		<input type="text" name="ssid" id="ssid" placeholder="Select SSID above or type your own..." data-clear-btn="true">
		<label for="password">Password:</label>
		<input type="password" name="password" id="password" placeholder="Enter WiFi Password..." data-clear-btn="true">
	</div>
	<!--
	<a href="#page_deploy" class="ui-btn" data-transition="slide">Continue</a>
	-->
	<a href="#page_deploy" class="ui-btn" data-transition="slide" onclick="populateForm();">Continue</a>

  </div>

  <div data-role="footer">
    <h1>Valley Digital Network (VDN)</h1>
  </div>
</div> 





<div data-role="page" id="page_deploy" data-theme="b">
  <div data-role="header">
    <a href="#page_home" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">Home</a>
    <a href="#optionsPanel" class="ui-btn ui-corner-all ui-shadow ui-icon-grid ui-btn-icon-left">Options</a>
    <h1>Micro Mesh Installer</h1>
    <div data-role="navbar">
      <ul>
        <li><a href="#page_setup" data-transition="slide" data-direction="reverse">Choose Setup</a></li>
        <li><a href="#page_configure" data-transition="slide" data-direction="reverse">Configure</a></li>
        <li><a href="#page_deploy">Deploy</a></li>
      </ul>
    </div>
  </div>

  <div data-role="main" class="ui-content">
    <div data-role="panel" id="optionsPanel">
      <h2>Options</h2>
      <p>Some text..</p>
    </div>
	<h1>Deploy...</h1>
    <p>Review and finalize deployment to chip</p>
    <form method="post" action="deploy.php">
		<input type="hidden" name="hiddenSSID" id="hiddenSSID" value="">
		<p> SSID: <span id="visibleSSID"></span> </p>
		<input type="hidden" name="hiddenPassword" id="hiddenPassword" value="">
		<input type="hidden" name="hiddenInstallType" id="hiddenInstallType" value="">
    	<input type="submit" data-inline="true" value="Continue" onclick="populateForm();">
    </form>
  </div>

  <div data-role="footer">
    <h1>Valley Digital Network (VDN)</h1>
  </div>

</div> 

</body>
</html>


