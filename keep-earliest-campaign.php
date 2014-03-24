<?php

/*
 * This file follows the business logic according to which the first 
 * campaign that was associated with the user in the previous two years should be retained for tracking purposes. 
 */

require("class.gaparse.php");
$aux = new GA_Parse($_COOKIE); // Object of the parsed existing GA cookies, using the required class.gaparse.php
$expire = time()+3600*1000*24*365* 2; // set the expiration period of the new cookie. In this case, two years


/*
 * Checks whether there is a campaign cookie that was set before 
 * If there is cookie set, it stores it in the variable.
 */
if (isset($_COOKIE["campaign_cookie"]))
	{
		$campaign_variable = $_COOKIE['campaign_cookie']; // see HTML below how to use this variable
	}
	
/* 
 * If no cookie is set, it checks whether there is a campaign
 * name in the existing __UTMZ cookie and then puts it in the new 
 * cookie and in the variable. If you never used GA before, you can remove this part. 
 */

elseif ((isset($_COOKIE["__utmz"]) && ($this->campaign_name != "")) {	
	$campaign_name = $this->campaign_name; 
	setcookie('campaign_cookie', $campaign_name, $expire); //currently the campaign timespan resets for two years. 
	Header('Location: ' . $_SERVER['PHP_SELF']);
}

	
/* 
 * If there is no cookie, create one from the URL query parameters that you use
 */ 
elseif (isset($_GET['utm_campaign'])) {
	$campaign_name = htmlspecialchars($_GET['utm_campaign']);
	$expire = time()+60*60*24*30*24; //two years
	Header('Location: ' . $_SERVER['PHP_SELF']);	
}

?>

