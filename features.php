<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	
	function wp_tell_a_freind_head() {
		include_once dirname( __FILE__ ) . "/includes/templates/wp-sms-tell-friend-head.php";
	}
	
	function wp_tell_a_freind($content) {
		if(is_single()) {
			global $sms;
			include_once dirname( __FILE__ ) . "/includes/templates/wp-sms-tell-friend.php";
			
			if($_POST['send_post']) {
				$mobile = $_POST['get_fmobile'];
				if($_POST['get_name'] && $_POST['get_fname'] && $_POST['get_fmobile']) {
					if( (strlen($mobile) >= 11) && (preg_match("([a-zA-Z])", $mobile) == 0) ) {
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
	
	function wps_mobilefield_to_newuser($user){
		include_once dirname( __FILE__ ) . "/includes/templates/wp-sms-user-field.php";
	}
	
	function wps_mobilefield_to_ptofile($fields) {
		$fields['mobile'] = __('Mobile', 'wp-sms');
		return $fields;
	}
	
	function wps_register_form() {
		$mobile = ( isset( $_POST['mobile'] ) ) ? $_POST['mobile']: '';
		include_once dirname( __FILE__ ) . "/includes/templates/wp-sms-user-field-register.php";
	}
	
	function wps_registration_errors($errors, $sanitized_user_login, $user_email) {
		if ( empty( $_POST['mobile'] ) )
		$errors->add( 'first_name_error', __('<strong>ERROR</strong>: You must include a mobile number.', 'wp-sms') );
		return $errors;
	}
	
	function wps_save_register($user_id) {
		if ( isset( $_POST['mobile'] ) ) {
			update_user_meta($user_id, 'mobile', $_POST['mobile']);
		}
	}
	
	if(get_option('wps_add_mobile_field')) {
		add_action('user_new_form', 'wps_mobilefield_to_newuser');
		add_filter('user_contactmethods', 'wps_mobilefield_to_ptofile');
		add_action('register_form','wps_register_form');
		add_filter('registration_errors', 'wps_registration_errors', 10, 3);
		add_action('user_register', 'wps_save_register');
	}