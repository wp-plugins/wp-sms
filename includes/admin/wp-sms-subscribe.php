<?php
	include_once("../../../../../wp-load.php");
	
	$name	= trim($_REQUEST['name']);
	$mobile	= trim($_REQUEST['mobile']);
	$group	= trim($_REQUEST['group']);
	$type	= $_REQUEST['type'];
	
	if($name && $mobile) {
		if( (strlen($mobile) >= 11) && (substr($mobile, 0, 2) == get_option('wp_sms_mcc')) && (preg_match("([a-zA-Z])", $mobile) == 0) ) {
		
			global $wpdb, $table_prefix, $sms, $date;
			
			$check_mobile = $wpdb->query("SELECT * FROM {$table_prefix}sms_subscribes WHERE mobile='{$mobile}'");
			
			if(!$check_mobile || $type != 'subscribe') {
			
				if($type == 'subscribe') {
				
					$get_current_date = date('Y-m-d H:i:s' ,current_time('timestamp',0));

					if(get_option('wp_subscribes_activation')) {
					
						$key = rand(1000, 9999);
						$check = $wpdb->query("INSERT INTO {$table_prefix}sms_subscribes (date, name, mobile, status, activate_key, group_ID) VALUES ('".$get_current_date."', '{$name}', '{$mobile}', '0', '{$key}', '{$group}')");

						$sms->to = array($mobile);
						$sms->msg = __('Your activation code', 'wp-sms') . ': ' . $key;
						
						$sms->SendSMS();

						if($check)
							echo 'success-3';
						
					} else {
					
						$check = $wpdb->query("INSERT INTO {$table_prefix}sms_subscribes (date, name, mobile, status, group_ID) VALUES ('{$get_current_date}', '{$name}', '{$mobile}', '1', '{$group}')");
						
						if($check) {
							do_action('wp_sms_subscribe', $name, $mobile);
							echo 'success-1';
							exit(0);
						}
					}
				} else if($type == 'unsubscribe') {
					if($check_mobile) {
					
						$check = $wpdb->query("DELETE FROM {$table_prefix}sms_subscribes WHERE mobile='{$mobile}'");
						if($check)
							echo 'success-2';
							
					} else {
						_e('Nothing found!', 'wp-sms');
					}
				}
			} else {
				_e('Phone number is repeated', 'wp-sms');
			}
		} else {
			_e('Please enter a valid mobile number', 'wp-sms');
		}
	} else {
		_e('Please complete all fields', 'wp-sms');
	}
?>