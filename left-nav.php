<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

if (!securePage($_SERVER['PHP_SELF'])){die();}

//Links for logged in user
if(isUserLoggedIn()) {
	echo "
	<ul class='nav navbar-nav'>
	<li><a href='index.php'>Home</a></li>
	<li><a href='user_settings.php'>Account</a></li>
	<li><a href='logout.php'>Esci</a></li>
	</ul>";
	
	//Links for permission level 2 (default admin)
	if ($loggedInUser->checkPermission(array(2))){
	echo "
	<ul class='nav navbar-nav'>
	
	</ul>";
	}
} 
//Links for users not logged in
else {
	echo "
	<ul class='nav navbar-nav'>
	<li><a href='index.php'>Home</a></li>
	<li><a href='login.php'>Login</a></li>
	<li><a href='register.php'>Registrati</a></li>
	<li><a href='forgot-password.php'>Password dimenticata?</a></li>";
	
	echo "</ul>";
}

?>
