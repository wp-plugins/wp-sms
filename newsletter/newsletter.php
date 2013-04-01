<?php
	include_once("../../../../wp-load.php");

	$name	= trim($_REQUEST['name']);
	$mobile	= trim($_REQUEST['mobile']);
	$type	= $_REQUEST['type'];

	if($name && $mobile) {
		if( (strlen($mobile) >= 11) && (substr($mobile, 0, 2) == '09') && (preg_match("([a-zA-Z])", $mobile) == 0) ) {
			global $wpdb, $table_prefix, $obj;

			$check_mobile = $wpdb->query("SELECT * FROM {$table_prefix}subscribes WHERE mobile='".$mobile."'");
			if(!$check_mobile || $type != 'subscribe') {
				if($type == 'subscribe') {
					$get_current_date = date('Y-m-d H:i:s' ,current_time('timestamp',0));

					if(get_option('wp_subscribes_activation')) {
						$key = rand(1000, 9999);
						$check = $wpdb->query("INSERT INTO {$table_prefix}subscribes (date, name, mobile, status, activate_key) VALUES ('".$get_current_date."', '".$name."', '".$mobile."', '0', '".$key."')");

						$obj->to = array($mobile);
						$obj->msg = __('Your activation code', 'wp-sms') . ': ' . $key;
						$obj->send_sms();

						if($check)
						{
							echo '<span id="result-activation">' . __('You will join the newsletter, Activation code sent to your number.', 'wp-sms') . '</span>';
						}
							echo '<br />' . __('Please enter the activation code:', 'wp-sms');
							echo '<input type="text" id="get_activation" name="get_activation"/><button id="activation">فعال سازی</button>';
					} else {
						$check = $wpdb->query("INSERT INTO {$table_prefix}subscribes (date, name, mobile, status) VALUES ('".$get_current_date."', '".$name."', '".$mobile."', '1')");

						if($check)
						{
							echo '<span id="result-register">' . __('You will join the newsletter', 'wp-sms') . '</span>';
						}
					}
				} else if($type == 'unsubscribe') {
					if($check_mobile) {
						$check = $wpdb->query("DELETE FROM {$table_prefix}subscribes WHERE mobile='".$mobile."'");
						if($check) {
							echo '<span id="result-register">' . __('Your subscription was canceled.', 'wp-sms') . '</span>';
						}
					} else {
						echo '<span id="result-register">' . __('Nothing found!', 'wp-sms') . '</span>';
					}
				}
			} else {
				echo '<span id="result-register">' . __('Phone number is repeated', 'wp-sms') . '</span>';
			}
		} else {
			echo '<span id="result-register">' . __('Please enter a valid mobile number', 'wp-sms') . '</span>';
		}
	} else {
		echo '<span id="result-register">' . __('Please complete all fields', 'wp-sms') . '</span>';
	}
?>