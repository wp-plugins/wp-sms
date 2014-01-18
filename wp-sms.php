<?php
/*
Plugin Name: Wordpress SMS
Plugin URI: http://iran98.org/category/wordpress/plugins/wp-sms/
Description: Send a SMS via WordPress, Subscribe for sms newsletter and send an SMS to the subscriber newsletter.
Version: 2.2.3
Author: Mostafa Soufi
Author URI: http://mostafa-soufi.ir/
Text Domain: wp-sms
License: GPL2
*/

	define('WP_SMS_VERSION', '2.2.3');

	include_once dirname( __FILE__ ) . '/install.php';
	include_once dirname( __FILE__ ) . '/upgrade.php';
	
	register_activation_hook(__FILE__, 'wp_sms_install');
	
	load_plugin_textdomain('wp-sms', false, dirname( plugin_basename( __FILE__ ) ) . '/includes/languages');
	__('Send a SMS via WordPress, Subscribe for sms newsletter and send an SMS to the subscriber newsletter.', 'wp-sms');

	global $wp_sms_db_version, $wpdb;
	
	$date = date('Y-m-d H:i:s' ,current_time('timestamp',0));

	function wp_sms_page() {

		if (function_exists('add_options_page')) {

			add_menu_page(__('Wordpress SMS', 'wp-sms'), __('Wordpress SMS', 'wp-sms'), 'manage_options', __FILE__, 'wp_send_sms_page', plugin_dir_url( __FILE__ ).'/images/sms.png');
			add_submenu_page(__FILE__, __('Send SMS', 'wp-sms'), __('Send SMS', 'wp-sms'), 'manage_options', __FILE__, 'wp_send_sms_page');
			add_submenu_page(__FILE__, __('Posted SMS', 'wp-sms'), __('Posted', 'wp-sms'), 'manage_options', 'wp-sms/posted', 'wp_posted_sms_page');
			add_submenu_page(__FILE__, __('Members Newsletter', 'wp-sms'), __('Newsletter subscribers', 'wp-sms'), 'manage_options', 'wp-sms/subscribe', 'wp_subscribes_page');
			add_submenu_page(__FILE__, __('Setting', 'wp-sms'), __('Setting', 'wp-sms'), 'manage_options', 'wp-sms/setting', 'wp_sms_setting_page');
			add_submenu_page(__FILE__, __('About', 'wp-sms'), __('About', 'wp-sms'), 'manage_options', 'wp-sms/about', 'wp_about_setting_page');
		}

	}
	add_action('admin_menu', 'wp_sms_page');
	
	if(get_option('wp_webservice')) {

		$webservice = get_option('wp_webservice');
		include_once dirname( __FILE__ ) . "/includes/classes/webservice/{$webservice}.class.php";

		$obj = new $webservice;
		
		$obj->user = get_option('wp_username');
		$obj->pass = get_option('wp_password');
		$obj->from = get_option('wp_number');

		if($obj->unitrial == true) {
			$obj->unit = __('Rial', 'wp-sms');
		} else {
			$obj->unit = __('SMS', 'wp-sms');
		}
	}
	
	if( !get_option('wp_sms_mcc') )
		update_option('wp_sms_mcc', '09');
	
	function wp_subscribes() {
	
		global $wpdb, $table_prefix;
		
		$get_group_result = $wpdb->get_results("SELECT * FROM `{$table_prefix}sms_subscribes_group`");
		
		include_once dirname( __FILE__ ) . "/includes/newsletter/form.php";
	}
	add_shortcode('subscribe', 'wp_subscribes');
	
	function wpsms_loader(){
	
		wp_enqueue_style('wpsms-css', plugin_dir_url(__FILE__) . 'css/style.css', true, '1.1');
		
		if( get_option('wp_call_jquery') )
			wp_enqueue_script('jquery');
	}
	add_action('wp_enqueue_scripts', 'wpsms_loader');

	function wp_sms_menu() {
	
		global $wp_admin_bar;
		$get_last_credit = get_option('wp_last_credit');
		
		if(is_super_admin() || is_admin_bar_showing()) {
		
			if($get_last_credit) {
			
				global $obj;
				
				$wp_admin_bar->add_menu(array
					(
						'id'		=>	'wp-credit-sms',
						'title'		=>	 sprintf(__('Your Credit: %s %s', 'wp-sms'), number_format($get_last_credit), $obj->unit),
						'href'		=>	get_bloginfo('url').'/wp-admin/admin.php?page=wp-sms/setting'
					));
			}
			$wp_admin_bar->add_menu(array
				(
					'id'		=>	'wp-send-sms',
					'parent'	=>	'new-content',
					'title'		=>	__('SMS', 'wp-sms'),
					'href'		=>	get_bloginfo('url').'/wp-admin/admin.php?page=wp-sms/wp-sms.php'
				));
		} else {
			return false;
		}
	}
	add_action('admin_bar_menu', 'wp_sms_menu');

	function wp_sms_rightnow_discussion() {
	
		global $obj;
		echo "<tr><td class='b'><a href='".get_bloginfo('url')."/wp-admin/admin.php?page=wp-sms/wp-sms.php'>".number_format(get_option('wp_last_credit'))."</a></td><td><a href='".get_bloginfo('url')."/admin.php?page=wp-sms/wp-sms.php'>".__('Credit', 'wp-sms')." (".$obj->unit.")</a></td></tr>";
	}
	add_action('right_now_discussion_table_end', 'wp_sms_rightnow_discussion');

	function wp_sms_rightnow_content() {
	
		global $wpdb, $table_prefix;
		$users = $wpdb->get_var("SELECT COUNT(*) FROM {$table_prefix}sms_subscribes");
		echo "<tr><td class='b'><a href='".get_bloginfo('url')."/wp-admin/admin.php?page=wp-sms/subscribe'>".$users."</a></td><td><a href='".get_bloginfo('url')."/wp-admin/admin.php?page=wp-sms/subscribe'>".__('Newsletter Subscriber', 'wp-sms')."</a></td></tr>";
	}
	add_action('right_now_content_table_end', 'wp_sms_rightnow_content');

	function wp_sms_enable() {
	
		$get_bloginfo_url = get_admin_url() . "admin.php?page=wp-sms/setting";
		echo '<div class="error"><p>'.sprintf(__('Please check the <a href="%s">SMS credit</a> the settings', 'wp-sms'), $get_bloginfo_url).'</p></div>';

	}

	if(!get_option('wp_username') || !get_option('wp_password'))
		add_action('admin_notices', 'wp_sms_enable');
	
	function wp_sms_widget() {
	
		wp_register_sidebar_widget('wp_sms', __('Subscribe to SMS', 'wp-sms'), 'wp_subscribe_show_widget', array('description'	=>	__('Subscribe to SMS', 'wp-sms')));
		wp_register_widget_control('wp_sms', __('Subscribe to SMS', 'wp-sms'), 'wp_subscribe_control_widget');

	}
	add_action('plugins_loaded', 'wp_sms_widget');
	
	function wp_subscribe_show_widget($args) {
	
		extract($args);
			echo $before_title . get_option('wp_sms_widget_name') . $after_title;
			wp_subscribes();
	}

	function wp_subscribe_control_widget() {
	
		if($_POST['wp_sms_submit_widget']) {
			update_option('wp_sms_widget_name', $_POST['wp_sms_widget_name']);
		}
		
		include_once("widget.php");
	}

	function wp_subscribe_meta_box() {
		add_meta_box('subscribe-meta-box', __('Subscribe SMS', 'wp-sms'), 'wp_subscribe_post', 'post', 'normal', 'high');
	}

	if(get_option('wp_subscribes_send'))
		add_action('add_meta_boxes', 'wp_subscribe_meta_box');
	
	function wp_subscribe_post($post) {
	
		$values = get_post_custom($post->ID);
		$selected = isset( $values['subscribe_post'] ) ? esc_attr( $values['subscribe_post'][0] ) : '';
		wp_nonce_field('subscribe_box_nonce', 'meta_box_nonce');
		
		include_once dirname( __FILE__ ) . "/includes/settings/meta-box.php";
	}

	function wp_subscribe_post_save($post_id) {
	
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
		if(!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'subscribe_box_nonce')) return;
		if(!current_user_can('edit_post')) return;

		if( isset( $_POST['subscribe_post'] ) )
		update_post_meta($post_id, 'subscribe_post', esc_attr($_POST['subscribe_post']));

	}
	add_action('save_post', 'wp_subscribe_post_save');

	function wp_subscribe_send($post_ID) {
	
		if(get_post_meta($post_ID, "subscribe_post", true) == 'yes') {
		
			global $wpdb, $table_prefix, $obj, $date;
			
			$obj->to = $wpdb->get_col("SELECT mobile FROM {$table_prefix}sms_subscribes");
			$obj->msg = get_the_title($post_ID);

			if( $obj->send_sms() ) {
			
				$to = implode($wpdb->get_col("SELECT mobile FROM {$table_prefix}sms_subscribes"), ",");
				
				$wpdb->query("INSERT INTO {$table_prefix}sms_send (date, sender, message, recipient) VALUES ('{$date}', '{$obj->from}', '{$obj->msg}', '{$to}')");
			}
			
			return $post_ID;
		}
	}
	add_action('publish_post', 'wp_subscribe_send');

	function wp_tell_a_freind_head() {
		include_once dirname( __FILE__ ) . "/tell-a-freind.php";
	}
		
	function wp_tell_a_freind($content) {
	
		if(is_single()) {
		
			global $obj;
			echo '<span id="send_friend">'.__('Suggested by SMS', 'wp-sms').'</span>';
			echo '
			<form action="" method="post" id="tell_friend_form">
				<table width="100%">
					<tr>
						<td><label for="get_name">'.__('Your name', 'wp-sms').':</label></td>
						<td><label for="get_fname">'.__('Your friend name', 'wp-sms').':</label></td>
						<td><label for="get_fmobile">'.__('Your friend mobile', 'wp-sms').':</label></td>
						<td></td>
					</tr>

					<tr>
						<td><input type="text" name="get_name" id="get_name"/></td>
						<td><input type="text" name="get_fname" id="get_fname"/></td>
						<td><input type="text" name="get_fmobile" id="get_fmobile" value="09"/></td>
						<td><input type="submit" name="send_post" value="'.__('Send', 'wp-sms').'"/></td>
					</tr>
				</table>
			</form>';

			if($_POST['send_post']) {
				$mobile = $_POST['get_fmobile'];
				if($_POST['get_name'] && $_POST['get_fname'] && $_POST['get_fmobile']) {
					if( (strlen($mobile) >= 11) && (substr($mobile, 0, 2) == get_option('wp_sms_mcc')) && (preg_match("([a-zA-Z])", $mobile) == 0) ) {
						$obj->to = array($_POST['get_fmobile']);
						$obj->msg = sprintf(__('Hi %s, the %s post suggested to you by %s. url: %s', 'wp-sms'), $_POST['get_fname'], get_the_title(), $_POST['get_name'], wp_get_shortlink());
						
						if( $obj->send_sms() ) {
						
							global $wpdb, $table_prefix, $obj, $date;
						
							$to = implode($wpdb->get_col("SELECT mobile FROM {$table_prefix}sms_subscribes"), ",");
							
							$wpdb->query("INSERT INTO {$table_prefix}sms_send (date, sender, message, recipient) VALUES ('{$date}', '{$obj->from}', '{$obj->msg}', '{$to}')");
							
							_e('SMS was sent with success', 'wp-sms');
						}
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
	
	if( get_option('wps_add_wpcf7') ) {
		add_action('wpcf7_admin_after_form', 'wps_setup_wpcf7_form'); 
		add_action('wpcf7_after_save', 'wps_save_wpcf7_form');
		add_action('wpcf7_before_send_mail', 'wps_send_wpcf7_sms');
	}
	
	function wps_setup_wpcf7_form($form) {
		
		$options = get_option('wpcf7_sms_' . $form->id);
		
		include_once dirname( __FILE__ ) . "/includes/settings/wpcf7-form-options.php";
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
	
	function wpsms_pointer($hook_suffix) {
	
		/*$admin_bar = get_user_setting('wpsms_p1', 0);
		
		if ( ! $admin_bar && apply_filters('show_wp_pointer_admin_bar', TRUE) ) {
			$enqueue = TRUE;
			add_action('admin_print_footer_scripts', 'wpsms_group_pointer');
		}*/
		
		wp_enqueue_style('wp-pointer');
		wp_enqueue_script('wp-pointer');
		wp_enqueue_script('utils');
	}
	add_action('admin_enqueue_scripts', 'wpsms_pointer');
	
	function wp_send_sms_page() {
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}
		
		global $wpdb, $table_prefix;
		
		wp_enqueue_style('wpsms-css', plugin_dir_url(__FILE__) . 'css/style.css', true, '1.1');
		$get_group_result = $wpdb->get_results("SELECT * FROM `{$table_prefix}sms_subscribes_group`");
		
		include_once dirname( __FILE__ ) . "/includes/settings/send-sms.php";
	}
	
	function wp_posted_sms_page() {
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}
		
		global $wpdb, $table_prefix;
		
		wp_enqueue_style('pagination-css', plugin_dir_url(__FILE__) . 'css/pagination.css', true, '1.0');
		include_once dirname( __FILE__ ) . '/includes/classes/pagination.class.php';
		
		if($_POST['doaction']) {
		
			$get_IDs = implode(",", $_POST['column_ID']);
			$check_ID = $wpdb->query("SELECT * FROM {$table_prefix}sms_send WHERE ID='".$get_IDs."'");

			switch($_POST['action']) {
				case 'trash':
					if($check_ID) {
						$wpdb->query("DELETE FROM {$table_prefix}sms_send WHERE ID IN (".$get_IDs.")");
						echo "<div class='updated'><p>" . __('With success was removed', 'wp-sms') . "</div></p>";
					} else {
						echo "<div class='error'><p>" . __('Not Found', 'wp-sms') . "</div></p>";
					}
				break;
			}
		}
		
		$total = $wpdb->query("SELECT * FROM `{$table_prefix}sms_send`");
		
		include_once dirname( __FILE__ ) . "/includes/settings/posted.php";
	}
	
	function wp_subscribes_page() {
	
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}
		
		global $wpdb, $table_prefix, $date;
		
		wp_enqueue_style('pagination-css', plugin_dir_url(__FILE__) . 'css/pagination.css', true, '1.0');
		include_once dirname( __FILE__ ) . '/includes/classes/pagination.class.php';
		
		if($_POST['doaction']) {
		
			$get_IDs = implode(",", $_POST['column_ID']);
			$check_ID = $wpdb->query("SELECT * FROM {$table_prefix}sms_subscribes WHERE ID='".$get_IDs."'");

			switch($_POST['action']) {
				case 'trash':
					if($check_ID) {
						$wpdb->query("DELETE FROM {$table_prefix}sms_subscribes WHERE ID IN (".$get_IDs.")");
						echo "<div class='updated'><p>" . __('With success was removed', 'wp-sms') . "</div></p>";
					} else {
						echo "<div class='error'><p>" . __('Not Found', 'wp-sms') . "</div></p>";
					}
				break;
				
				case 'active':
					if($check_ID) {
						$wpdb->query("UPDATE {$table_prefix}sms_subscribes SET `status` = '1' WHERE ID IN (".$get_IDs.")");
						echo "<div class='updated'><p>" . __('User actived.', 'wp-sms') . "</div></p>";
					} else {
						echo "<div class='error'><p>" . __('Not Found', 'wp-sms') . "</div></p>";
					}
				break;
				
				case 'deactive':
					if($check_ID) {
						$wpdb->query("UPDATE {$table_prefix}sms_subscribes SET `status` = '0' WHERE ID IN (".$get_IDs.")");
						echo "<div class='updated'><p>" . __('User deactived.', 'wp-sms') . "</div></p>";
					} else {
						echo "<div class='error'><p>" . __('Not Found', 'wp-sms') . "</div></p>";
					}
				break;
			}
		}
		
		$name	= trim($_POST['wp_subscribe_name']);
		$mobile	= trim($_POST['wp_subscribe_mobile']);
		$group	= trim($_POST['wpsms_group_name']);
		
		if(isset($_POST['wp_add_subscribe'])) {
		
			if($name && $mobile && $group) {
			
				if( (strlen($mobile) >= 11) && (substr($mobile, 0, 2) == '09') && (preg_match("([a-zA-Z])", $mobile) == 0) ) {
				
					$check_mobile = $wpdb->query("SELECT * FROM {$table_prefix}sms_subscribes WHERE mobile='{$mobile}'");
					
					if(!$check_mobile) {
						$check = $wpdb->query("INSERT INTO {$table_prefix}sms_subscribes (date, name, mobile, status, group_ID) VALUES ('{$date}', '{$name}', '{$mobile}', '1', '{$group}')");
						
						if($check) {
							echo "<div class='updated'><p>" . sprintf(__('User <strong>%s</strong> was added successfully.', 'wp-sms'), $name) . "</div></p>";
						}
					} else {
						echo "<div class='error'><p>" . __('Phone number is repeated', 'wp-sms') . "</div></p>";
					}
				} else {
					echo "<div class='error'><p>" . __('Please enter a valid mobile number', 'wp-sms') . "</div></p>";
				}
			} else {
				echo "<div class='error'><p>" . __('Please complete all fields', 'wp-sms') . "</div></p>";
			}
			
		}
		
		if(isset($_POST['wpsms_add_group'])) {
		
			if($group) {
			
				$check_group = $wpdb->query("SELECT * FROM {$table_prefix}sms_subscribes_group WHERE name='{$group}'");
				
				if(!$check_group) {
					$check = $wpdb->query("INSERT INTO {$table_prefix}sms_subscribes_group (name) VALUES ('{$group}')");
					
					if($check) {
						echo "<div class='updated'><p>" . sprintf(__('Group <strong>%s</strong> was added successfully.', 'wp-sms'), $group) . "</div></p>";
					}
				} else {
					echo "<div class='error'><p>" . __('Group name is repeated', 'wp-sms') . "</div></p>";
				}
			} else {
				echo "<div class='error'><p>" . __('Please complete field', 'wp-sms') . "</div></p>";
			}
		}
		
		if(isset($_POST['wpsms_delete_group'])) {
		
			if($group) {
			
				$check_group = $wpdb->query("SELECT * FROM {$table_prefix}sms_subscribes_group WHERE `ID` = '{$group}'");
				
				if($check_group) {
					$group_name = $wpdb->get_row("SELECT * FROM {$table_prefix}sms_subscribes_group WHERE `ID` = '{$group}'");
					$check = $wpdb->query("DELETE FROM {$table_prefix}sms_subscribes_group WHERE `ID` = '{$group}'");
					
					if($check) {
						echo "<div class='updated'><p>" . sprintf(__('Group <strong>%s</strong> was successfully removed.', 'wp-sms'), $group_name->name) . "</div></p>";
					}
				}
			} else {
				echo "<div class='error'><p>" . __('Nothing found!', 'wp-sms') . "</div></p>";
			}
			
		}
		
		if(isset($_POST['wp_edit_subscribe'])) {
		
			if($name && $mobile && $group) {
				if( (strlen($mobile) >= 11) && (substr($mobile, 0, 2) == get_option('wp_sms_mcc')) && (preg_match("([a-zA-Z])", $mobile) == 0) ) {
				
					$check = $wpdb->query("UPDATE {$table_prefix}sms_subscribes SET `name` = '{$name}', `mobile` = '{$mobile}', `status` = '".$_POST['wp_subscribe_status']."', `group_ID` = '{$group}' WHERE `ID` = '".$_GET['ID']."'");
					
					if($check) {
						echo "<div class='updated'><p>" . sprintf(__('User <strong>%s</strong> was update successfully.', 'wp-sms'), $name) . "</div></p>";
					}
					
				} else {
					echo "<div class='error'><p>" . __('Please enter a valid mobile number', 'wp-sms') . "</div></p>";
				}
			} else {
				echo "<div class='error'><p>" . __('Please complete all fields', 'wp-sms') . "</div></p>";
			}
			
		}
		
		$total = $wpdb->query("SELECT * FROM `{$table_prefix}sms_subscribes`");
		$get_group_result = $wpdb->get_results("SELECT * FROM `{$table_prefix}sms_subscribes_group`");
		
		if(!$get_group_result) {
			add_action('admin_print_footer_scripts', 'wpsms_group_pointer');
		}
		
		include_once dirname( __FILE__ ) . "/includes/settings/subscribes.php";
	}
	
	function wp_sms_setting_page() {
	
		global $obj;
		
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
			
			settings_fields('wp_sms_options');
		}
		
		wp_enqueue_style('css', plugin_dir_url(__FILE__) . 'css/style.css', true, '1.0');
		
		$sms_page['about'] = get_bloginfo('url') . "/wp-admin/admin.php?page=wp-sms/about";
		
		include_once dirname( __FILE__ ) . "/includes/settings/setting.php";
	}
	
	function wp_about_setting_page() {
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}
		
		include_once dirname( __FILE__ ) . "/includes/settings/about.php";
	}
?>