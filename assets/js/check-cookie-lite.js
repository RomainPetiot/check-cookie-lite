/*
 *
*/

if(document.getElementById('ccl-accept-cookie')){
	document.getElementById('ccl-accept-cookie').addEventListener('click', function(e) {
		var expire = new Date();
		expire.setTime(expire.getTime()+(365*24*60*60*1000));
		document.cookie = "check-cookie-lite=accept;path=/;expires=" + expire.toGMTString();
		document.getElementById('check-cookie-lite-container').style.display = 'none';
	});

	//si cookie existe et message cookie -> cache le message
	// possible en cas de cache varnish (ou autre)
	if (document.cookie.indexOf('check-cookie-lite') > -1 ) {
		document.getElementById('ccl-accept-cookie').style.display = "none";
	}

	console.log(document.referrer + " - "+ document.URL);
}
