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
	*/

	if (document.getElementById("micromesh").checked) {
		document.getElementById("final_microtype").value = "micromesh";
	} else if (document.getElementById("microrouter").checked) {
        document.getElementById("final_microtype").value = "microrouter";
    } else {
        document.getElementById("final_microtype").value = "unknown";
	}

    if (document.getElementById("final_callsign").length > 0) {
        document.getElementById("final_callsign").value = document.getElementById("callsign").value;
    } else {
        document.getElementById("final_callsign").value = "nocall";
    }
 
    if (document.getElementById("final_meshhostname").length > 0) {
		document.getElementById("final_meshhostname").value = document.getElementById("meshhostname").value;
    } else {
        document.getElementById("final_meshhostname").value = "nocall-micromesh-01";
    }

    if (document.getElementById("final_meshpassword").length > 0) {
		document.getElementById("final_meshpassword").value = document.getElementById("meshpassword").value;
    } else {
        document.getElementById("final_meshpassword").value = "micromesh"; 
    }
    
    document.getElementById("final_nodechannel").value = document.getElementById("nodechannel").value;

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
    
    if (document.getElementById("final_routerhostname").length > 0) {
     	document.getElementById("final_routerhostname").value = document.getElementById("routerhostname").value;
    } else {
        document.getElementById("final_routerhostname").value = "micromesh-01"; 
    }
    
    if (document.getElementById("final_ssid").length > 0) {
     	document.getElementById("final_ssid").value = document.getElementById("ssid").value;
    } else {
        document.getElementById("final_ssid").value = "none"; 
    }
    
    if (document.getElementById("final_password").length > 0) {
     	document.getElementById("final_password").value = document.getElementById("password").value;
    } else {
        document.getElementById("final_password").value = "none"; 
    }
    
    if (document.getElementById("routerLan") != null) {
    	if (document.getElementById("routerLan").checked) {
	        document.getElementById("final_routerEthernetType").value = "LAN";
	    } else if (document.getElementById("routerWan").checked) {
	        document.getElementById("final_routerEthernetType").value = "WAN";
	    } else {
	        document.getElementById("final_routerEthernetType").value = "unknown";
	    }
	} else {
	    document.getElementById("final_routerEthernetType").value = "none";
	}
 
    if (document.getElementById("final_accesspointssid").length > 0) {
     	document.getElementById("final_accesspointssid").value = document.getElementById("accesspointssid").value;
    } else {
        document.getElementById("final_accesspointssid").value = "vdn-micro-AP"; 
    }
    
    if (document.getElementById("final_accesspointpassword").length > 0) {
     	document.getElementById("final_accesspointpassword").value = document.getElementById("accesspointpassword").value;
    } else {
        document.getElementById("final_accesspointpassword").value = "micromesh"; 
    }
    
    document.getElementById("final_accesspointchannel").value = document.getElementById("accesspointchannel").value;
    
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

function loadDeploy() {
	populateForm();

}


