function populateForm() {
	/*
	Setup:
	  - micromesh       - microtype
	  - microrouter

	Configure:
	  - callsign
	  - meshhostname
	  - meshpassword
	  - nodechannel
	  - * meshLan       - meshEthernetType
	  - * meshWan
	  - routerhostname
	  - ssid
	  - password
	  - * routerLan     - routerEthernetType
	  - * routerWan
	  - accesspointssid
	  - accesspointpassword
	  - accesspointchannel
	  - nodessid
	*/

	if (document.getElementById("micromesh").checked) {
		document.getElementById("final_microtype").value = "micromesh";
	} else if (document.getElementById("microrouter").checked) {
        document.getElementById("final_microtype").value = "microrouter";
    } else {
        document.getElementById("final_microtype").value = "unknown";
	}

    if (document.getElementById("callsign").value.length > 0) {
        document.getElementById("final_callsign").value = document.getElementById("callsign").value;
    } else {
        document.getElementById("final_callsign").value = "nocall";
    }
 
    if (document.getElementById("meshhostname").value.length > 0) {
		document.getElementById("final_meshhostname").value = document.getElementById("meshhostname").value;
    } else {
        document.getElementById("final_meshhostname").value = "nocall-micromesh-01";
    }

    if (document.getElementById("meshpassword").value.length > 0) {
		document.getElementById("final_meshpassword").value = document.getElementById("meshpassword").value;
    } else {
        document.getElementById("final_meshpassword").value = "micromesh"; 
    }
    
	var data = document.getElementById("nodessid").value;
	var nodeData = data.split("|||");
    document.getElementById("final_nodessid").value = nodeData[0];
    document.getElementById("final_nodechannel").value = nodeData[1];

    if (document.getElementById("meshLan") != null) {
	    if (document.getElementById("meshLan").checked) {
	        document.getElementById("final_meshEthernetType").value = "LAN";
	    } else if (document.getElementById("meshWan").checked) {
	        document.getElementById("final_meshEthernetType").value = "WAN";
	    } else {
            /*ADD POPUP WARNING*/
	        document.getElementById("final_meshEthernetType").value = "WAN";
	    }
	} else {
	    document.getElementById("final_meshEthernetType").value = "WAN";
	}
    
    if (document.getElementById("routerhostname").value.length > 0) {
     	document.getElementById("final_routerhostname").value = document.getElementById("routerhostname").value;
    } else {
        document.getElementById("final_routerhostname").value = "micromesh-01"; 
    }
    
    if (document.getElementById("ssid").value.length > 0) {
     	document.getElementById("final_ssid").value = document.getElementById("ssid").value;
    } else {
        document.getElementById("final_ssid").value = "none"; 
    }
    
    if (document.getElementById("password").value.length > 0) {
     	document.getElementById("final_password").value = document.getElementById("password").value;
    } else {
        document.getElementById("final_password").value = "none"; 
    }
    
    if (document.getElementById("routerEth") != null) {
    	if (document.getElementById("routerEth").checked) {
	        document.getElementById("final_routerEthernetType").value = "ETH";
	    } else if (document.getElementById("routerWlan").checked) {
	        document.getElementById("final_routerEthernetType").value = "WLAN";
	    } else {
	        document.getElementById("final_routerEthernetType").value = "unknown";
	    }
	} else {
	    document.getElementById("final_routerEthernetType").value = "none";
	}
 
    if (document.getElementById("accesspointssid").value.length > 0) {
     	document.getElementById("final_accesspointssid").value = document.getElementById("accesspointssid").value;
    } else {
        document.getElementById("final_accesspointssid").value = "vdn-micro-AP"; 
    }
    
    if (document.getElementById("accesspointpassword").value.length > 0) {
     	document.getElementById("final_accesspointpassword").value = document.getElementById("accesspointpassword").value;
    } else {
        document.getElementById("final_accesspointpassword").value = "micromesh"; 
    }
    
    /*document.getElementById("final_accesspointchannel").value = document.getElementById("accesspointchannel").value;*/
    document.getElementById("final_accesspointchannel").value = document.getElementById("accesspointchannel").selectedIndex + 1;

    
}

function populateDefaults() {
    document.getElementById("callsign").value = "";
    document.getElementById("meshhostname").value = "nocall-micromesh-01";
    document.getElementById("meshpassword").value = "micromesh";
    document.getElementById("routerhostname").value = "nocall-microrouter-01";
    document.getElementById("ssid").value = "";
    document.getElementById("password").value = "";
    document.getElementById("accesspointssid").value = "vdn-micro-AP";
    document.getElementById("accesspointpassword").value = "micromesh";
}

function loadConfigure() {
	if (document.getElementById("micromesh").checked) {
		document.getElementById("divConfigureMesh").style.display = "inline";
		document.getElementById("divConfigureRouter").style.display = "none";
	} else if (document.getElementById("microrouter").checked) {
		document.getElementById("divConfigureMesh").style.display = "none";
		document.getElementById("divConfigureRouter").style.display = "inline";
	}
}

function updateNodeName() {
	document.getElementById("meshhostname").value = document.getElementById("callsign").value + "-micromesh-01";
}

function loadDeploy() {
	populateForm();
	setSummaryDisplay();
}

function setSummaryDisplay() {
    document.getElementById("f_routername").style.display = "block";
    document.getElementById("f_wifissid").style.display = "block";
    document.getElementById("f_wifipassword").style.display = "block";
    document.getElementById("f_routerethernet").style.display = "block";
    document.getElementById("f_apssid").style.display = "block";
    document.getElementById("f_appassword").style.display = "block";
    document.getElementById("f_apchannel").style.display = "block";
    document.getElementById("f_callsign").style.display = "block";
    document.getElementById("f_nodename").style.display = "block";
    document.getElementById("f_nodessid").style.display = "block";
    document.getElementById("f_nodechannel").style.display = "block";
    document.getElementById("f_nodeethernet").style.display = "block";

	if (document.getElementById("final_microtype").value == "micromesh") {
		document.getElementById("f_routername").style.display = "none";
		document.getElementById("f_wifissid").style.display = "none";
		document.getElementById("f_wifipassword").style.display = "none";
		document.getElementById("f_routerethernet").style.display = "none";
		document.getElementById("f_apssid").style.display = "none";
		document.getElementById("f_appassword").style.display = "none";
		document.getElementById("f_apchannel").style.display = "none";
    } else if (document.getElementById("final_microtype").value == "microrouter"){
		document.getElementById("f_callsign").style.display = "none";
		document.getElementById("f_nodename").style.display = "none";
		document.getElementById("f_nodessid").style.display = "none";
		document.getElementById("f_nodechannel").style.display = "none";
		document.getElementById("f_nodeethernet").style.display = "none";
	}
}

function refreshWiFiConnection() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("spanWiFiConnection").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", "ap_list.php", true);
  xhttp.send();
}



