<?php
include('header.php');
head('Pictotime','');
?>
<script>
	window.fbAsyncInit = function() {
		FB.init({
			appId      : '801856749915043',
			cookie     : true,  // enable cookies to allow the server to access 
					// the session
			xfbml      : true,  // parse social plugins on this page
			version    : 'v2.8' // use graph api version 2.5
		});
				
		FB.getLoginStatus(function(response) {
			if(response.status=='connected'){
				console.log(response);
				FB.logout(function(response) {
					location.href="login.php";
				});
			}
		});
	}
</script>
<?php
foot();
?>
