<?php
/* check whether there is a campaign cookie that was set before */
if (isset($_COOKIE["campaign_cookie"]))
	{
		$campaign_variable = $_COOKIE['campaign_cookie']; // see HTML below how to use this variable
	}

/* If there is no cookie, create one */ 
elseif (isset($_GET['utm_campaign'])) {
	$campaign_name = htmlspecialchars($_GET['utm_campaign']);
	$expire = time()+60*60*24*30*24; //two years
	setcookie('campaign_cookie', $campaign_name, $expire);
	Header('Location: ' . $_SERVER['PHP_SELF']);
	$campaign_variable = $_COOKIE['campaign_cookie'];
	
}
 

?>


<!DOCTYPE html>
<html>

	<body>		
		<form>
			<!-- how to use $campaign_variable in your forms -->
			<input type="hidden" id="lead_source" name="lead_source" value="<?php echo $campaign_variable; ?>" />
		</form>
	</body>
</html>
