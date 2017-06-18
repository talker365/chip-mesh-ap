function populateForm(microtype) {

    document.getElementById("final_microtype").value = microtype;

	switch (microtype) {
		case "microrouter":
		    if (document.getElementById("routerhostname").value.length > 0) {
		        document.getElementById("final_routerhostname").value = document.getElementById("routerhostname").value;
		    } else {
		        document.getElementById("final_routerhostname").value = "micromesh-01"; 
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

			break;


		case "micromesh":

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
    
		    if (document.getElementById("nodessid").value.length > 0) {
			    document.getElementById("final_nodessid").value = document.getElementById("nodessid").value;
		    }
    
		    if (document.getElementById("nodechannel").value.length > 0) {
				var data = document.getElementById("nodechannel").value;
				var nodeData = data.split(" ");
			    document.getElementById("final_nodechannel").value = nodeData[0];
		    }

		    if (document.getElementById("meshLan") != null) {
			    if (document.getElementById("meshLan").checked) {
			        document.getElementById("final_meshEthernetType").value = "LAN";
			    } else if (document.getElementById("meshWan").checked) {
			        document.getElementById("final_meshEthernetType").value = "WAN";
			    } else {
			        document.getElementById("final_meshEthernetType").value = "unknown";
			    }
			} else {
			    document.getElementById("final_meshEthernetType").value = "none";
			}
    
			break;

	}
    
}

function populateDefaults() {
    document.getElementById("callsign").value = "";
    document.getElementById("meshhostname").value = "nocall-micromesh-01";
    document.getElementById("meshpassword").value = "micromesh";
    document.getElementById("routerhostname").value = "microrouter01";
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
}

