<?php
	include_once("../../../../../wp-load.php");
	
	$name	= trim($_REQUEST['name']);
	$mobile	= trim($_REQUEST['mobile']);
	$group	= trim($_REQUEST['group']);
	$type	= $_REQUEST['type'];
	
	if($name && $mobile) {
		if(preg_match(WP_SMS_MOBILE_REGEX, $mobile)) {
		
			global $wpdb, $table_prefix, $sms, $date;
			
			$check_mobile = $wpdb->query($wpdb->prepare("SELECT * FROM `{$table_prefix}sms_subscribes` WHERE `mobile` = '%s'", $mobile));
			
			if(!$check_mobile || $type != 'subscribe') {
			
				if($type == 'subscribe') {
				
					$get_current_date = date('Y-m-d H:i:s' ,current_time('timestamp',0));

					if(get_option('wp_subscribes_activation')) {
					
						$key = rand(1000, 9999);
						
						$check = $wpdb->insert("{$table_prefix}sms_subscribes",
							array(
								'date'			=>	$get_current_date,
								'name'			=>	$name,
								'mobile'		=>	$mobile,
								'status'		=>	'0',
								'activate_key'	=>	$key,
								'group_ID'		=>	$group
							)
						);
						
						$sms->to = array($mobile);
						$sms->msg = __('Your activation code', 'wp-sms') . ': ' . $key;
						
						$sms->SendSMS();

						if($check)
							echo 'success-3';
						
					} else {
						
						$check = $wpdb->insert("{$table_prefix}sms_subscribes",
							array(
								'date'			=>	$get_current_date,
								'name'			=>	$name,
								'mobile'		=>	$mobile,
								'status'		=>	'1',
								'group_ID'		=>	$group
							)
						);
						
						if($check) {
							do_action('wp_sms_subscribe', $name, $mobile);
							echo 'success-1';
							exit(0);
						}
					}
					
				} else if($type == 'unsubscribe') {
					if($check_mobile) {
					
						$check = $wpdb->delete("{$table_prefix}sms_subscribes", array('mobile' => $mobile) );
						
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