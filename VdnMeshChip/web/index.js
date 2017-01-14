function populateForm() {
	document.getElementById("hiddenSSID").value = document.getElementById("ssid").value;
	document.getElementById("hiddenPassword").value = document.getElementById("password").value;
	document.getElementById("visibleSSID").innerHTML = document.getElementById("ssid").value;
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




