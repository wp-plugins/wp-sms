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
		
		include_once dirname( __FILE__ ) . "/../templates/settings/meta-box.php";
	}

	function wp_sms_subscribe_post_save($post_id) {
	
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
		if(!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'subscribe_box_nonce')) return;
		if(!current_user_can('edit_post')) return;

		if( isset( $_POST['subscribe_post'] ) )
		update_post_meta($post_id, 'subscribe_post', esc_attr($_POST['subscribe_post']));

	}
	add_action('save_post', 'wp_sms_subscribe_post_save');

	function wp_sms_subscribe_send($post_ID) {
	
		if(get_post_meta($post_ID, "subscribe_post", true) == 'yes') {
		
			global $wpdb, $table_prefix, $obj, $date;
			
			$obj->to = $wpdb->get_col("SELECT mobile FROM {$table_prefix}sms_subscribes");
			
			$string = get_option('wp_sms_text_template');
			
			$template_vars = array(
				'title_post'		=> get_the_title($post_ID),
				'url_post'			=> wp_get_shortlink($post_ID),
				'date_post'			=> get_post_time(get_option('date_format'), true, $post_ID)
			);
			
			$final_message = preg_replace('/%(.*?)%/ime', "\$template_vars['$1']", $string);
			
			if( get_option('wp_sms_text_template') ) {
				$obj->msg = $final_message;
			} else {
				$obj->msg = get_the_title($post_ID);
			}
			
			if( $obj->send_sms() ) {
			
				$to = implode($wpdb->get_col("SELECT mobile FROM {$table_prefix}sms_subscribes"), ",");
				
				$wpdb->query("INSERT INTO {$table_prefix}sms_send (date, sender, message, recipient) VALUES ('{$date}', '{$obj->from}', '{$obj->msg}', '{$to}')");
			}
			
			return $post_ID;
		}
	}
	add_action('publish_post', 'wp_sms_subscribe_send');