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
	document.getElementById("final_callsign").value = document.getElementById("callsign").value;
	document.getElementById("final_meshhostname").value = document.getElementById("meshhostname").value;
	document.getElementById("final_meshpassword").value = document.getElementById("meshpassword").value;
	document.getElementById("final_nodechannel").value = document.getElementById("nodechannel").value;
    if (document.getElementById("meshLan").checked) {
        document.getElementById("final_meshEthernetType").value = "LAN";
    } else if (document.getElementById("meshWan").checked) {
        document.getElementById("final_meshEthernetType").value = "WAN";
    } else {
        document.getElementById("final_meshEthernetType").value = "unknown";
    }
	document.getElementById("final_routerhostname").value = document.getElementById("routerhostname").value;
	document.getElementById("final_ssid").value = document.getElementById("ssid").value;
	document.getElementById("final_password").value = document.getElementById("password").value;
    if (document.getElementById("routerLan").checked) {
        document.getElementById("final_routerEthernetType").value = "LAN";
    } else if (document.getElementById("routerWan").checked) {
        document.getElementById("final_routerEthernetType").value = "WAN";
    } else {
        document.getElementById("final_routerEthernetType").value = "unknown";
    }
	document.getElementById("final_accesspointssid").value = document.getElementById("accesspointssid").value;
	document.getElementById("final_accesspointpassword").value = document.getElementById("accesspointpassword").value;
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


