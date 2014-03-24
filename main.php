
<?php 
require_once (your-file.php)
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
