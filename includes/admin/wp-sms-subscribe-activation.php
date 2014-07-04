<?php
	include_once("../../../../../wp-load.php");

	$mobile	= trim($_REQUEST['mobile']);
	$activation = trim($_REQUEST['activation']);
	
	if($activation) {
	
		$check_mobile = $wpdb->get_row("SELECT * FROM {$table_prefix}sms_subscribes WHERE `mobile` = '{$mobile}'");
		
		if($activation == $check_mobile->activate_key) {
		
			$result = $wpdb->query("UPDATE {$table_prefix}sms_subscribes SET `status` = '1' WHERE mobile = '{$mobile}'");
			
			if( $result ) {
				do_action('wp_sms_subscribe', $check_mobile->name, $mobile);
				echo 'success-1';
				exit(0);
			}
		} else {
			_e('Security Code is wrong', 'wp-sms');
		}
	} else {
		_e('Please complete all fields', 'wp-sms');
	}
?>