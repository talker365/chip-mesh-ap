var myVar;

function refreshADC() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("spanADC").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", "xml.php?t=" + Math.random(), true);
  xhttp.send();
  //alert("sent")
}

function startADC() {
	myVar = setInterval(refreshADC, 1000);
}

function stopADC() {
	clearTimeout(myVar);
}