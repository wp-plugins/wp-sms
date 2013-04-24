<?php
	include_once("../../../../wp-load.php");

	$mobile	= trim($_REQUEST['mobile']);
	$activation = trim($_REQUEST['activation']);

	if($activation)
	{
		global $wpdb, $table_prefix;
		$check_mobile = $wpdb->get_row("SELECT * FROM {$table_prefix}subscribes WHERE `mobile` = '".$mobile."'");

		if($activation == $check_mobile->activate_key)
		{
			$query = "UPDATE {$table_prefix}subscribes SET `status` = '1' WHERE mobile = '".$mobile."'";
			if($wpdb->query($query))
			{
				_e('Your membership in the complete newsletter', 'wp-sms');
			}
		} else {
			_e('Security Code is wrong', 'wp-sms');
		}
	} else {
		_e('Please complete all fields', 'wp-sms');
	}
?>