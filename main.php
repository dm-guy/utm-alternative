<!-- how to use $campaign_variable in your forms -->

<?php 
require_once (choose_your_approach.php)
?>
<!DOCTYPE html>
<html>

	<body>		
		<form>
			<input type="hidden" id="lead_source" name="lead_source" value="<?php echo $campaign_variable; ?>" />
		</form>
	</body>
</html>
