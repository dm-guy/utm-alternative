<?php
/* check whether there is a campaign cookie set */
if (isset($_COOKIE["campaign_cookie"]))
	{
		$campaign_variable = $_COOKIE['campaign_cookie']; 
	}

/* If there is no cookie, create one */ 
elseif (isset($_GET['utm_campaign'])) {
	$campaign_name = htmlspecialchars($_GET['utm_campaign'], ENT_QUOTES);
	$expire = time()+60*60*24*30*24; //two years
	setcookie('campaign_cookie', $campaign_name, $expire);
	$campaign_variable = $_COOKIE['campaign_cookie'];
	Header('Location: '.$_SERVER['PHP_SELF']);
}
 
?>


<!DOCTYPE html>
<html>

	<body>		
		<form>
			<!-- how to use $campaign_variable in your forms -->
			<input type="hidden" id="lead_source" name="lead_source" value="<?php echo $campaign_name; ?>" />
		</form>
	</body>
</html>
