<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	
	// Wordpress new version
	if(get_option('wp_notification_new_wp_version')) {
	
		$update = get_site_transient('update_core');
		$update = $update->updates;
		
		if($update[1]->current > $wp_version) {
		
			if(get_option('wp_last_send_notification') == false) {
			
				$obj->to = array(get_option('wp_admin_mobile'));
				$obj->msg = sprintf(__('WordPress %s is available! Please update now', 'wp-sms'), $update[1]->current);
				
				if( $obj->send_sms() ) {
				
					global $wpdb, $table_prefix, $obj, $date;
				
					$to = implode($wpdb->get_col("SELECT mobile FROM {$table_prefix}sms_subscribes"), ",");
					
					$wpdb->query("INSERT INTO {$table_prefix}sms_send (date, sender, message, recipient) VALUES ('{$date}', '{$obj->from}', '{$obj->msg}', '{$to}')");
				}
				
				update_option('wp_last_send_notification', true);
				
			}
		} else {
			update_option('wp_last_send_notification', false);
		}
	}
	
	// Register new user
	function wps_notification_new_user($user_id) {
	
		global $obj, $date;
		
		$obj->to = array(get_option('wp_admin_mobile'));
		
		$string = get_option('wpsms_nrnu_tt');
		
		$user_info = get_userdata($user_id);
		
		$template_vars = array(
			'user_login'	=> $user_info->user_login,
			'user_email'	=> $user_info->user_email,
			'date_register'	=> $date,
		);
		
		$final_message = preg_replace('/%(.*?)%/ime', "\$template_vars['$1']", $string);
		
		$obj->msg = $final_message;
		
		$obj->send_sms();
	}
	
	if(get_option('wpsms_nrnu_stats'))
		add_action('user_register', 'wps_notification_new_user', 10, 1);
	
	// New Comment
	function wps_notification_new_comment($comment_id, $comment_object){
	
		global $obj;
		
		$obj->to = array(get_option('wp_admin_mobile'));
		
		$string = get_option('wpsms_gnc_tt');
		
		$template_vars = array(
			'comment_author'		=> $comment_object->comment_author,
			'comment_author_email'	=> $comment_object->comment_author_email,
			'comment_author_url'	=> $comment_object->comment_author_url,
			'comment_author_IP'		=> $comment_object->comment_author_IP,
			'comment_date'			=> $comment_object->comment_date,
			'comment_content'		=> $comment_object->comment_content
		);
		
		$final_message = preg_replace('/%(.*?)%/ime', "\$template_vars['$1']", $string);
		
		$obj->msg = $final_message;
		
		$obj->send_sms();
	}
	
	if(get_option('wpsms_gnc_stats'))
		add_action('wp_insert_comment', 'wps_notification_new_comment',99,2);
	
	// User login
	function wps_notification_login($user_login, $user){
	
		global $obj;
		
		$obj->to = array(get_option('wp_admin_mobile'));
		
		$string = get_option('wpsms_ul_tt');
		
		$template_vars = array(
			'user_login'	=> $user->user_login,
			'display_name'	=> $user->display_name
		);
		
		$final_message = preg_replace('/%(.*?)%/ime', "\$template_vars['$1']", $string);
		
		$obj->msg = $final_message;
		
		$obj->send_sms();
	}
	
	if(get_option('wpsms_ul_stats'))
		add_action('wp_login', 'wps_notification_login',99,2);
	
	// Contact Form 7
	if( get_option('wps_add_wpcf7') ) {
		add_action('wpcf7_admin_after_form', 'wps_setup_wpcf7_form'); 
		add_action('wpcf7_after_save', 'wps_save_wpcf7_form');
		add_action('wpcf7_before_send_mail', 'wps_send_wpcf7_sms');
	}
	
	function wps_setup_wpcf7_form($form) {
		
		$options = get_option('wpcf7_sms_' . $form->id);
		
		include_once dirname( __FILE__ ) . "/../templates/wp-sms-wpcf7-form.php";
	}
	
	function wps_save_wpcf7_form($form) {
		update_option('wpcf7_sms_' . $form->id, $_POST['wpcf7-sms']);
	}
	
	function wps_send_wpcf7_sms($form) {
		
		global $obj;
		
		$options = get_option('wpcf7_sms_' . $form->id);
		
		if( $options['message'] && $options['phone'] ) {
		
			// Replace merged Contact Form 7 fields
			if( defined( 'WPCF7_VERSION' ) && WPCF7_VERSION < 3.1 ) {
				$regex = '/\[\s*([a-zA-Z_][0-9a-zA-Z:._-]*)\s*\]/';
			} else {
				$regex = '/(\[?)\[\s*([a-zA-Z_][0-9a-zA-Z:._-]*)\s*\](\]?)/';
			}
			
			$callback = array( &$form, 'mail_callback' );
			
			$message = preg_replace_callback( $regex, $callback, $options['message'] );
			
			// Send SMS
			$obj->to = array( $options['phone'] );
			$obj->msg = $message;
			
			if( $obj->send_sms() ) {
			
				global $wpdb, $table_prefix, $date;
				
				$to = implode($wpdb->get_col("SELECT mobile FROM {$table_prefix}sms_subscribes"), ",");
				
				$wpdb->query("INSERT INTO {$table_prefix}sms_send (date, sender, message, recipient) VALUES ('{$date}', '{$obj->from}', '{$obj->msg}', '{$to}')");
			}
		}
	}