<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	
	// Wordpress new version
	if(get_option('wp_notification_new_wp_version')) {
		$update = get_site_transient('update_core');
		$update = $update->updates;
		if($update[1]->current > $wp_version) {
			if(get_option('wp_last_send_notification') == false) {
				$webservice = get_option('wp_webservice');
				include_once dirname( __FILE__ ) . "/includes/classes/wp-sms.class.php";
				include_once dirname( __FILE__ ) . "/includes/classes/webservice/{$webservice}.class.php";
				$sms = new $webservice;
				$sms->to = array(get_option('wp_admin_mobile'));
				$sms->msg = sprintf(__('WordPress %s is available! Please update now', 'wp-sms'), $update[1]->current);
				$sms->SendSMS();
				update_option('wp_last_send_notification', true);
			}
		} else {
			update_option('wp_last_send_notification', false);
		}
	}
	
	// Register new user
	function wps_notification_new_user($username_id) {
		global $sms, $date;
		$sms->to = array(get_option('wp_admin_mobile'));
		$string = get_option('wpsms_nrnu_tt');
		$username_info = get_userdata($username_id);
		$template_vars = array(
			'user_login'	=> $username_info->user_login,
			'user_email'	=> $username_info->user_email,
			'date_register'	=> $date,
		);
		$final_message = preg_replace('/%(.*?)%/ime', "\$template_vars['$1']", $string);
		$sms->msg = $final_message;
		$sms->SendSMS();
	}
	
	if(get_option('wpsms_nrnu_stats'))
		add_action('user_register', 'wps_notification_new_user', 10, 1);
	
	// New Comment
	function wps_notification_new_comment($comment_id, $comment_smsect){
		global $sms;
		$sms->to = array(get_option('wp_admin_mobile'));
		$string = get_option('wpsms_gnc_tt');
		$template_vars = array(
			'comment_author'		=> $comment_smsect->comment_author,
			'comment_author_email'	=> $comment_smsect->comment_author_email,
			'comment_author_url'	=> $comment_smsect->comment_author_url,
			'comment_author_IP'		=> $comment_smsect->comment_author_IP,
			'comment_date'			=> $comment_smsect->comment_date,
			'comment_content'		=> $comment_smsect->comment_content
		);
		$final_message = preg_replace('/%(.*?)%/ime', "\$template_vars['$1']", $string);
		$sms->msg = $final_message;
		$sms->SendSMS();
	}
	
	if(get_option('wpsms_gnc_stats'))
		add_action('wp_insert_comment', 'wps_notification_new_comment',99,2);
	
	// User login
	function wps_notification_login($username_login, $username){
		global $sms;
		$sms->to = array(get_option('wp_admin_mobile'));
		$string = get_option('wpsms_ul_tt');
		$template_vars = array(
			'username_login'	=> $username->username_login,
			'display_name'	=> $username->display_name
		);
		$final_message = preg_replace('/%(.*?)%/ime', "\$template_vars['$1']", $string);
		$sms->msg = $final_message;
		$sms->SendSMS();
	}
	
	if(get_option('wpsms_ul_stats'))
		add_action('wp_login', 'wps_notification_login', 99, 2);
	
	// Contact Form 7 Hooks
	if( get_option('wps_add_wpcf7') ) {
		add_action('wpcf7_admin_after_form', 'wps_setup_wpcf7_form'); 
		add_action('wpcf7_after_save', 'wps_save_wpcf7_form');
		add_action('wpcf7_before_send_mail', 'wps_send_wpcf7_sms');
	}
	
	function wps_setup_wpcf7_form($form) {
		$options = get_option('wpcf7_sms_' . $form->id);
		include_once dirname( __FILE__ ) . "/includes/templates/wp-sms-wpcf7-form.php";
	}
	
	function wps_save_wpcf7_form($form) {
		update_option('wpcf7_sms_' . $form->id, $_POST['wpcf7-sms']);
	}
	
	function wps_send_wpcf7_sms($form) {
		global $sms;
		$options = get_option('wpcf7_sms_' . $form->id);
		if( $options['message'] && $options['phone'] ) {
			// Replace merged Contact Form 7 fields
			/*if( defined( 'WPCF7_VERSION' ) && WPCF7_VERSION < 3.1 ) {
				$regex = '/\[\s*([a-zA-Z_][0-9a-zA-Z:._-]*)\s*\]/';
			} else {
				$regex = '/(\[?)\[\s*([a-zA-Z_][0-9a-zA-Z:._-]*)\s*\](\]?)/';
			}
			$callback = array( &$form, 'mail_callback' );
			$message = preg_replace_callback( $regex, $form, $options['message'] );*/
			$sms->to = array( $options['phone'] );
			$sms->msg = $options['message'];
			$sms->SendSMS();
		}
	}
	
	// Woocommerce Hooks
	function wps_woocommerce_new_order($order_id){
		global $sms;
		$sms->to = array(get_option('wp_admin_mobile'));
		$string = get_option('wpsms_wc_no_tt');
		$template_vars = array(
			'order_id'	=> $order_id,
		);
		$final_message = preg_replace('/%(.*?)%/ime', "\$template_vars['$1']", $string);
		$sms->msg = $final_message;
		$sms->SendSMS();
	}
	
	if(get_option('wpsms_wc_no_stats'))
		add_action('woocommerce_new_order', 'wps_woocommerce_new_order');
	
	// Easy Digital Downloads Hooks
	function wps_edd_new_order() {
		global $sms;
		$sms->to = array(get_option('wp_admin_mobile'));
		$sms->msg = get_option('wpsms_edd_no_tt');
		$sms->SendSMS();
	}
	
	if(get_option('wpsms_edd_no_stats'))
		add_action('edd_complete_purchase', 'wps_edd_new_order');