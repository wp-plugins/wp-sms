<?php
	include_once("../../../../wp-load.php");

	$name	= trim($_REQUEST['name']);
	$mobile	= trim($_REQUEST['mobile']);
	$type	= $_REQUEST['type'];

	if($name && $mobile)
	{
		if( (strlen($mobile) >= 11) && (substr($mobile, 0, 2) == '09') && (preg_match("([a-zA-Z])", $mobile) == 0) )
		{
			global $wpdb, $table_prefix;

			$check_mobile = $wpdb->query("SELECT * FROM {$table_prefix}subscribes WHERE mobile='".$mobile."'");
			if(!$check_mobile || $type != 'subscribe')
			{
				if($type == 'subscribe')
				{
					$get_current_date = date('Y-m-d H:i:s' ,current_time('timestamp',0));
					$check = $wpdb->query("INSERT INTO {$table_prefix}subscribes (date, name, mobile) VALUES ('".$get_current_date."', '".$name."', '".$mobile."')");

					if($check)
					{
						_e('You will join the newsletter', 'wp-sms');
					}
				} else if($type == 'unsubscribe') {
					if($check_mobile)
					{
						$check = $wpdb->query("DELETE FROM {$table_prefix}subscribes WHERE mobile='".$mobile."'");
						if($check)
						{
							_e('Your subscription was canceled.', 'wp-sms');
						}
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