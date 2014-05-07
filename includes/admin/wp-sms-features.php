<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	
	function wp_tell_a_freind_head() {
		include_once dirname( __FILE__ ) . "/../templates/wp-sms-tell-friend-head.php";
	}
	
	function wp_tell_a_freind($content) {
	
		if(is_single()) {
		
			global $sms;
			
			include_once dirname( __FILE__ ) . "/../templates/wp-sms-tell-friend.php";
			
			if($_POST['send_post']) {
				$mobile = $_POST['get_fmobile'];
				if($_POST['get_name'] && $_POST['get_fname'] && $_POST['get_fmobile']) {
					if( (strlen($mobile) >= 11) && (substr($mobile, 0, 2) == get_option('wp_sms_mcc')) && (preg_match("([a-zA-Z])", $mobile) == 0) ) {
						$sms->to = array($_POST['get_fmobile']);
						$sms->msg = sprintf(__('Hi %s, the %s post suggested to you by %s. url: %s', 'wp-sms'), $_POST['get_fname'], get_the_title(), $_POST['get_name'], wp_get_shortlink());
						
						if( $sms->SendSMS() )
							_e('SMS was sent with success', 'wp-sms');
							
					} else {
						_e('Please enter a valid mobile number', 'wp-sms');
					}
				} else {
					_e('Please complete all fields', 'wp-sms');
				}
			}
		}
		return $content;
		
	}
	
	if(get_option('wp_suggestion_status')) {
		add_action('wp_head', 'wp_tell_a_freind_head');
		add_action('the_content', 'wp_tell_a_freind');
	}