<?php

DRAFT!!!
/*
 * This file follows the business logic according to which the last campaign
 * that was associated with the user in the previous two years should be retained for tracking purposes. 
 * This supports utm_nooverride=1 in case you would not like a campaign to override. 
 */

require("class.gaparse.php");
$aux = new GA_Parse($_COOKIE); // Object of the parsed existing GA cookies, using the required class.gaparse.php
$expire = time()+3600*1000*24*365* 2; // set the expiration period of the new cookie. In this case, two years


/*
 * Checks whether there is a campaign cookie that was set before. 
 * It uses the same campaign name value only if there is a new utm_campaign that has utm_nooverride = 0
 * If there is cookie set, it stores it in the variable.
 */
if (isset($_COOKIE["campaign_cookie"]) && (isset($_GET["utm_campaign"]))
	{
		if (isset($_GET['utm_nooverride']) && ($_GET['utm_nooverride'] = 1) )
			$campaign_variable = $_COOKIE['campaign_cookie']; // see HTML below how to use this variable
		elseif (isset($_GET['utm_nooverride']) && ($_GET['utm_nooverride'] = 0)
			{
			$campaign_variable = $_GET['utm_campaign']; 
			$_COOKIE['campaign_cookie'] = $_GET['utm_campaign']; 
			}
	}

/* 
 * If no cookie is set, it checks whether there is a campaign
 * name in the existing __UTMZ cookie and then puts it in the new 
 * cookie and in the variable. If you never used GA before, you can remove this part. 
 */

elseif ((isset($_COOKIE["__utmz"]) && ($this->campaign_name != "")) {	
	$campaign_name = $this->campaign_name; 
	setcookie('campaign_cookie', $campaign_name, $expire);
	Header('Location: ' . $_SERVER['PHP_SELF']);
}


/* 
 * If there is no cookie, create one from the URL query parameters that you use
 */ 
elseif (isset($_GET['utm_campaign'])) {
	$campaign_name = htmlspecialchars($_GET['utm_campaign']);
	setcookie('campaign_cookie', $campaign_name, $expire);
	Header('Location: ' . $_SERVER['PHP_SELF']);	
}

?>
