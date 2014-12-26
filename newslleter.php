<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	
	function wp_sms_subscribe_meta_box() {
		add_meta_box('subscribe-meta-box', __('Subscribe SMS', 'wp-sms'), 'wp_sms_subscribe_post', 'post', 'normal', 'high');
	}

	if(get_option('wp_subscribes_send'))
		add_action('add_meta_boxes', 'wp_sms_subscribe_meta_box');
	
	function wp_sms_subscribe_post($post) {
	
		$values = get_post_custom($post->ID);
		$selected = isset( $values['subscribe_post'] ) ? esc_attr( $values['subscribe_post'][0] ) : '';
		wp_nonce_field('subscribe_box_nonce', 'meta_box_nonce');
		
		include_once dirname( __FILE__ ) . "/includes/templates/wp-meta-box.php";
	}

	function wp_sms_subscribe_post_save($post_id) {
	
		if(!current_user_can('edit_post')) return;

		if( isset( $_POST['subscribe_post'] ) )
			update_post_meta($post_id, 'subscribe_post', esc_attr($_POST['subscribe_post']));
			
	}
	add_action('save_post', 'wp_sms_subscribe_post_save');

	function wp_sms_subscribe_send($post_ID) {
	
		if($_REQUEST['subscribe_post'] == 'yes') {
		
			global $wpdb, $table_prefix, $sms;
			
			$sms->to = $wpdb->get_col("SELECT mobile FROM {$table_prefix}sms_subscribes");
			
			$string = get_option('wp_sms_text_template');
			
			$template_vars = array(
				'title_post'		=> get_the_title($post_ID),
				'url_post'			=> wp_get_shortlink($post_ID),
				'date_post'			=> get_post_time(get_option('date_format'), true, $post_ID)
			);
			
			$final_message = preg_replace('/%(.*?)%/ime', "\$template_vars['$1']", $string);
			
			if( get_option('wp_sms_text_template') ) {
				$sms->msg = $final_message;
			} else {
				$sms->msg = get_the_title($post_ID);
			}
			
			$sms->SendSMS();
			
			return $post_ID;
		}
	}
	if(get_option('wp_subscribes_send'))
		add_action('publish_post', 'wp_sms_subscribe_send');
	
	function wp_sms_register_new_subscribe($name, $mobile) {
	
		global $sms;
		
		$string = get_option('wp_subscribes_text_send');
		
		$template_vars = array(
			'subscribe_name'	=> $name,
			'subscribe_mobile'	=> $mobile
		);
		
		$final_message = preg_replace('/%(.*?)%/ime', "\$template_vars['$1']", $string);
		
		$sms->to = array($mobile);
		$sms->msg = $final_message;
		
		$sms->SendSMS();
	}
	if(get_option('wp_subscribes_send_sms'))
		add_action('wp_sms_subscribe', 'wp_sms_register_new_subscribe', 10, 2);