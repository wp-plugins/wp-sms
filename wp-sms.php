<?php
/*
Plugin Name: WP SMS
Plugin URI: http://www.webstudio.ir/
Description: Send SMS from wordpress
Version: 1.2
Author: Mostafa Soufi
Author URI: http://www.webstudio.ir/sms-services/extensions/
License: GPL2
*/

	load_plugin_textdomain('wp-sms', 'wp-content/plugins/wp-sms/langs');
	add_action('admin_menu', 'wp_sms_page');
	add_action('admin_bar_menu', 'wp_sms_menu');
	register_activation_hook(__FILE__,'wp_sms_install');
	add_action('plugins_loaded', 'wp_sms_widget');

	global $wp_sms_db_version, $wpdb;
	$wp_sms_db_version = "1.0";

	function wp_sms_page()
	{
		if (function_exists('add_options_page'))
		{
			add_menu_page(__('SMS Setting', 'wp-sms'), __('SMS Setting', 'wp-sms'), 'manage_options', 'wp-sms', 'wp_sms_setting_page', plugin_dir_url( __FILE__ ).'/images/sms.png');
			add_submenu_page('wp-sms', __('Send SMS', 'wp-sms'), __('Send SMS', 'wp-sms'), 'manage_options', 'wp-sms/send', 'wp_send_sms_setting_page');
			add_submenu_page('wp-sms', __('Members Newsletter', 'wp-sms'), __('Members Newsletter', 'wp-sms'), 'manage_options', 'wp-sms/subscribe', 'wp_subscribes_setting_page');
		}
	}

	if(get_option('wp_webservice'))
	{
		$webservice = get_option('wp_webservice');
		include_once("inc/$webservice.class.php");
		$obj = new $webservice;
		$obj->user = get_option('wp_username');
		$obj->pass = get_option('wp_password');
		$obj->from = get_option('wp_number');
	}

	function wp_subscribes()
	{
		include_once("inc/form.php");
	}
	add_shortcode('subscribe', 'wp_subscribes');

	function wp_sms_menu()
	{
		global $wp_admin_bar;
		$get_last_credit = get_option('wp_last_credit');

		if(is_super_admin() || is_admin_bar_showing())
		{
			if($get_last_credit)
			{
				global $obj;
				$wp_admin_bar->add_menu(array
					(
						'id'		=>	'wp-credit-sms',
						'title'		=>	'<img src="'.plugin_dir_url(__FILE__).'images/money_coin.png" align="bottom"/> ' . number_format($get_last_credit) . ' ' . $obj->unit,
						'href'		=>	get_bloginfo('url').'/wp-admin/admin.php?page=wp-sms'
					));
			}
			$wp_admin_bar->add_menu(array
				(
					'id'		=>	'wp-send-sms',
					'parent'	=>	'new-content',
					'title'		=>	__('SMS', 'wp-sms'),
					'href'		=>	get_bloginfo('url').'/wp-admin/admin.php?page=wp-sms/send'
				));
		} else {
			return false;
		}
	}

	function wp_sms_rightnow_discussion()
	{
		global $obj;
		echo "<tr><td class='b'><a href='".get_bloginfo('url')."/wp-admin/admin.php?page=wp-sms'>".number_format(get_option('wp_last_credit'))."</a></td><td><a href='".get_bloginfo('url')."/wp-admin/admin.php?page=wp-sms'>".$obj->unit."</a></td></tr>";
	}
	add_action('right_now_discussion_table_end', 'wp_sms_rightnow_discussion');

	function wp_sms_rightnow_content()
	{
		global $wpdb, $table_prefix;
		$users = $wpdb->get_var("SELECT COUNT(*) FROM {$table_prefix}subscribes");
		echo "<tr><td class='b'><a href='".get_bloginfo('url')."/wp-admin/admin.php?page=wp-sms/subscribe'>".$users."</a></td><td><a href='".get_bloginfo('url')."/wp-admin/admin.php?page=wp-sms/subscribe'>".__('Common', 'wp-sms')."</a></td></tr>";
	}
	add_action('right_now_content_table_end', 'wp_sms_rightnow_content');

	function wp_sms_enable()
	{
		$get_bloginfo_url = get_admin_url() . "admin.php?page=wp-sms";
		echo '<div class="error"><p><img src="'.plugin_dir_url(__FILE__).'/images/exclamation.png" alt="Bottom" align="top"/> '.sprintf(__('Please check the <a href="%s">SMS credit</a> the settings', 'wp-sms'), $get_bloginfo_url).'</p></div>';
	}

	if(!get_option('wp_username') || !get_option('wp_password'))
	{
		add_action('admin_notices', 'wp_sms_enable');
	}

	function wp_sms_install()
	{
		global $wp_sms_db_version, $table_prefix;
		$subscribes_table	= $table_prefix . "subscribes";

		$create_subscribes_table = ("CREATE TABLE ".$subscribes_table."(
			ID int(10) NOT NULL auto_increment,
			date DATETIME,
			name VARCHAR(20),
			mobile VARCHAR(20) NOT NULL,
			PRIMARY KEY(ID)) CHARSET=utf8
		");

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		dbDelta($create_subscribes_table);
		add_option('wp_sms_db_version', 'wp_sms_db_version');

		update_option('wp_webservice', '');
	}

	function wp_sms_widget()
	{
		wp_register_sidebar_widget('wp_sms', __('Subscribe to SMS', 'wp-sms'), 'wp_subscribe_show_widget', array('description'	=>	__('Subscribe to SMS', 'wp-sms')));
		wp_register_widget_control('wp_sms', __('Subscribe to SMS', 'wp-sms'), 'wp_subscribe_control_widget');
	}

	function wp_subscribe_show_widget($args)
	{
		extract($args);
			echo $before_title . get_option('wp_sms_widget_name') . $after_title;
			include("inc/form.php");
	}

	function wp_subscribe_meta_box()
	{
		add_meta_box('subscribe-meta-box', __('Subscribe', 'wp-sms'), 'wp_subscribe_post', 'post', 'normal', 'high');
	}

	if(get_option('wp_subscribes_send'))
	{
		add_action('add_meta_boxes', 'wp_subscribe_meta_box');
	}

	function wp_subscribe_post($post)
	{
		$values = get_post_custom($post->ID);
		$selected = isset( $values['subscribe_post'] ) ? esc_attr( $values['subscribe_post'][0] ) : '';
		wp_nonce_field('subscribe_box_nonce', 'meta_box_nonce');
		?>
		<p>
			<label for="subscribe_post"><?php _e('Send this post to subscribers?', 'wp-sms'); ?></label>
			<select name="subscribe_post" id="subscribe_post">
				<option value="yes" <?php selected($selected, 'yes'); ?>><?php _e('Yes'); ?></option>
				<option value="no" <?php selected($selected, 'no'); ?>><?php _e('No'); ?></option>
			</select>
		</p>
		<?php	
	}

	function wp_subscribe_post_save($post_id)
	{
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
		if(!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'subscribe_box_nonce')) return;
		if(!current_user_can('edit_post')) return;

		$allowed = array
		( 
			'a' => array
			(
				'href' => array()
			)
		);

		if( isset( $_POST['subscribe_post'] ) )
		update_post_meta($post_id, 'subscribe_post', esc_attr($_POST['subscribe_post']));
	}
	add_action('save_post', 'wp_subscribe_post_save');

	function wp_subscribe_send($post_ID)
	{
		if( !strstr($_POST['_wp_http_referer'], "action=edit"))
		{
			if(get_post_meta($post_ID, "subscribe_post", true) == 'yes')
			{
				global $wpdb, $table_prefix, $obj;
				$obj->to = $wpdb->get_col("SELECT mobile FROM {$table_prefix}subscribes");
				$obj->msg = get_the_title($post_ID);

				$obj->send_sms();
				return $post_ID;
			}
		}
	}
	add_action('publish_post', 'wp_subscribe_send');

	function wp_subscribe_control_widget()
	{
		if($_POST['wp_sms_submit_widget'])
		{
			update_option('wp_sms_widget_name', $_POST['wp_sms_widget_name']);
		} ?>

		<p>
			<?php _e('Name', 'wp-sms'); ?>:<br />
			<input id="wp_sms_widget_name" name="wp_sms_widget_name" type="text" value="<?php echo get_option('wp_sms_widget_name'); ?>" />
		</p>

		<input type="hidden" id="wp_sms_submit_widget" name="wp_sms_submit_widget" value="1" />
<?php }

	function wp_sms_setting_page()
	{
		if (!current_user_can('manage_options'))
		{
			wp_die(__('You do not have sufficient permissions to access this page.'));

			settings_fields('wp_sms_options');
			function register_mysettings()
			{
				register_setting('wp_sms_options', 'wp_username');
				register_setting('wp_sms_options', 'wp_password');
				register_setting('wp_sms_options', 'wp_subscribes_status');
				register_setting('wp_sms_options', 'wp_subscribes_send');
			}
		}
	?>
	<div class="wrap">
	<h2><?php _e('SMS Setting', 'wp-sms'); ?></h2>
	<table class="form-table">
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options');?>
		<tr><th><h3><?php _e('Credit SMS Setting', 'wp-sms'); ?></h4></th></tr>
		<tr>
			<td><?php _e('Web Service', 'wp-sms'); ?>:</td>
			<td>
				<select name="wp_webservice">
					<option value=""><?php _e('Select your Web Service', 'wp-sms'); ?></option>
					<option value="" disabled="disabled"><?php _e('The main server', 'wp-sms'); ?></option>
					<option value="webstudio" <?php selected(get_option('wp_webservice'), 'webstudio'); ?>>&nbsp;&nbsp;- <?php _e('Webstudio (sms.webstudio.ir)', 'wp-sms'); ?></option>
					<option value="" disabled="disabled"><?php _e('Other servers', 'wp-sms'); ?></option>
					<option value="panizsms" <?php selected(get_option('wp_webservice'), 'panizsms'); ?>>&nbsp;&nbsp;- <?php _e('Paniz SMS (panizsms.ir)', 'wp-sms'); ?></option>
					<option value="orangesms" <?php selected(get_option('wp_webservice'), 'orangesms'); ?>>&nbsp;&nbsp;- <?php _e('Orange SMS (orangesms.net)', 'wp-sms'); ?></option>
				</select>

				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="page_options" value="wp_webservice" />
				<input type="submit" class="button" name="Submit" value="<?php _e('Select', 'wp-sms'); ?>" />
			</td>
		</tr>

		<?php if(get_option('wp_webservice')) { ?>
		<tr>
			<td><?php _e('Username', 'wp-sms'); ?>:</td>
			<td>
				<input type="text" style="direction: ltr; width: 200px;" name="wp_username" value="<?php echo get_option('wp_username'); ?>"/>
				<span style="font-size: 10px"><?php _e('Your username in', 'wp-sms'); ?>: <?php echo get_option('wp_webservice'); ?></span>
			</td>
		</tr>

		<tr>
			<td><?php _e('Password', 'wp-sms'); ?>:</td>
			<td>
				<input type="password" style="direction: ltr; width: 200px;" name="wp_password" value="<?php echo get_option('wp_password'); ?>"/>
				<span style="font-size: 10px"><?php _e('Your password in', 'wp-sms'); ?>: <?php echo get_option('wp_webservice'); ?></span>
			</td>
		</tr>

		<tr>
			<td><?php _e('Number', 'wp-sms'); ?>:</td>
			<td>
				<input type="text" style="direction: ltr; width: 200px;" name="wp_number" value="<?php echo get_option('wp_number'); ?>"/>
				<span style="font-size: 10px"><?php _e('Your SMS sender number in', 'wp-sms'); ?>: <?php echo get_option('wp_webservice'); ?></span>
			</td>
		</tr>

		<tr>
			<td><?php _e('Credit', 'wp-sms'); ?>:</td>
			<td>
			<?php global $obj; echo $obj->get_credit() . " " . $obj->unit; ?>
			</td>
		</tr>

		<tr>
			<td><?php _e('Status', 'wp-sms'); ?>:</td>
			<td>
				<?php if($obj->get_credit()) { ?>
					<img src="<?php echo plugin_dir_url(__FILE__); ?>images/green.png" alt="Active" align="absmiddle"/><span style="font-weight: bold;"><?php _e('Active', 'wp-sms'); ?></span>
				<?php } else { ?>
					<img src="<?php echo plugin_dir_url(__FILE__); ?>images/grey.png" alt="Deactive" align="absmiddle"/><span style="font-weight: bold;"><?php _e('Deactive', 'wp-sms'); ?></span>
				<?php } ?>
			</td>
		</tr>
		<?php } ?>

		<tr><th><h3><?php _e('Newsletter', 'wp-sms'); ?></h4></th></tr>
		<tr>
			<td><?php _e('Register?', 'wp-sms'); ?></td>
			<td>
				<input type="checkbox" name="wp_subscribes_status" id="wp_subscribes_status" <?php echo get_option('wp_subscribes_status') ==true? 'checked="checked"':'';?>/>
				<label for="wp_subscribes_status"><?php _e('Active', 'wp-sms'); ?></label>
			</td>
		</tr>

		<tr>
			<td><?php _e('Posts sent to subscribers?', 'wp-sms'); ?></td>
			<td>
				<input type="checkbox" name="wp_subscribes_send" id="wp_subscribes_send" <?php echo get_option('wp_subscribes_send') ==true? 'checked="checked"':'';?>/>
				<label for="wp_subscribes_send"><?php _e('Active', 'wp-sms'); ?></label>
			</td>
		</tr>

		<tr>
			<td>
				<p class="submit">
				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="page_options" value="wp_webservice,wp_username,wp_password,wp_number,wp_unit_money,wp_subscribes_status,wp_subscribes_send" />
				<input type="submit" class="button-primary" name="Submit" value="<?php _e('Update', 'wp-sms'); ?>" />
				</p>
			</td>
		</tr>
	</form>	
	</table>
	</div>
	<?php }
	function wp_send_sms_setting_page()
	{
		if (!current_user_can('manage_options'))
		{
			wp_die(__('You do not have sufficient permissions to access this page.'));

			settings_fields('wp_sms_options');
			function register_mysettings()
			{
				register_setting('wp_sms_options', 'wp_username');
			}
		}
	?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo plugin_dir_url(__FILE__); ?>js/functions.js" type="text/javascript"></script>
	<script type="text/javascript">
		var boxId2 = 'wp_get_message';
		var counter = 'wp_counter';
		var part = 'wp_part';
		var max = 'wp_max';
		function charLeft2()
		{
			checkSMSLength(boxId2, counter, part, max);
		}

		$(document).ready(function(){
			$("select#select_sender").change(function(){
				var get_method = "";
				$("select#select_sender option:selected").each(
					function(){
						get_method += $(this).attr('id');
					}
				);
				if(get_method == 'wp_tellephone'){
					$("#wp_get_numbers").fadeIn();
					$("#wp_get_number").focus();
				} else {
					$("#wp_get_numbers").fadeOut();
				}
			});

			charLeft2();
			$("#" + boxId2).bind('keyup', function()
			{
				charLeft2();
			});
			$("#" + boxId2).bind('keydown', function()
			{
				charLeft2();
			});
			$("#" + boxId2).bind('paste', function(e)
			{
				charLeft2();
			});
		});
	</script>

	<style>
	#wp_get_number:focus{border:1px solid #FF0000;}
	.number{font-weight: bold;}
	</style>
	<div class="wrap">
		<h2><?php _e('Send SMS', 'wp-sms'); ?></h2>
		<?php
		global $obj, $wpdb, $table_prefix;
		if(get_option('wp_webservice'))
		{
			update_option('wp_last_credit', $obj->get_credit());
			if($obj->get_credit())
			{
				?>
				<form method="post" action="">
				<table class="form-table">
					<tr>
						<td colspan="2">
						<?php
							if(isset($_POST['send_sms']))
							{
								if($_POST['wp_get_message'])
								{
									if($_POST['wp_send_to'] == "wp_subscribe_user")
									{
										$obj->to = $wpdb->get_col("SELECT mobile FROM {$table_prefix}subscribes");
									}
									else if($_POST['wp_send_to'] == "wp_tellephone")
									{
										$obj->to = explode(",", $_POST['wp_get_number']);
									}

									$obj->msg = $_POST['wp_get_message'];

									if($_POST['wp_flash'] == "true")
									{
										$obj->isflash = true;
									}
									elseif($_POST['wp_flash'] == "false")
									{
										$obj->isflash = false;
									}

									if($obj->send_sms())
									{
										echo "<div class='updated'><p>" . __('SMS was sent with success', 'wp-sms') . "</p></div>";
									}
								}
								else
								{
									echo "<div class='error'><p>" . __('Please enter a message', 'wp-sms') . "</p></div>";
								}
							}
						?>
						</td>
					</tr>
					<?php wp_nonce_field('update-options');?>
					<tr>
						<th><h3><?php _e('Send SMS', 'wp-sms'); ?></h4></th>
					</tr>
					<tr>
						<td><?php _e('Send from', 'wp-sms'); ?>:</td>
						<td><?php echo $obj->from; ?></td>
					</tr>
					<tr>
						<td><?php _e('Send to', 'wp-sms'); ?>:</td>
						<td>
							<select name="wp_send_to" id="select_sender">
								<?php global $wpdb, $table_prefix; ?>
								<option value="wp_subscribe_user" id="wp_subscribe_user"><?php _e('Subscribe users', 'wp-sms'); ?> (<?php echo $wpdb->query("SELECT * FROM {$table_prefix}subscribes"); ?> <?php _e('Peaple', 'wp-sms'); ?>)</option>
								<option value="wp_tellephone" id="wp_tellephone"><?php _e('Numbers', 'wp-sms'); ?></option>
							</select>

							<span id="wp_get_numbers" style="display:none;">
								<input type="text" style="direction:ltr;" id="wp_get_number" name="wp_get_number" value="09"/>
								<span style="font-size: 10px"><?php _e('For example', 'wp-sms'); ?>: 09180000000,09180000001</span>
							</span>
						</td>
					</tr>
					
					<tr>
						<td><?php _e('SMS', 'wp-sms'); ?>:</td>
						<td>
							<textarea name="wp_get_message" id="wp_get_message" style="width:350px; height: 200px; direction:ltr;"></textarea><br />
							<?php _e('The remaining words', 'wp-sms'); ?>: <span id="wp_counter" class="number"></span>/<span id="wp_max" class="number"></span><br />
							<span id="wp_part" class="number"></span> <?php _e('SMS', 'wp-sms'); ?><br />
							<p class="number">
								<?php echo __('Your credit', 'wp-sms') . ': ' . number_format($obj->get_credit()) . ' ' . $obj->unit; ?>
							</p>
						</td>
					</tr>
					<?php if($obj->flash == "enable") { ?>
					<tr>
						<td><?php _e('Send a Flash', 'wp-sms'); ?>:</td>
						<td>
							<input type="radio" id="flash_yes" name="wp_flash" value="true"/>
							<label for="flash_yes"><?php _e('Yes', 'wp-sms'); ?></label>

							<input type="radio" id="flash_no" name="wp_flash" value="false" CHECKED/>
							<label for="flash_no"><?php _e('No', 'wp-sms'); ?></label>

							<br />
							<span style="font-size: 10px"><?php _e('Flash is possible to send messages without being asked, opens', 'wp-sms'); ?></span>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<td>
							<p class="submit">
							<input type="submit" class="button-primary" name="send_sms" value="<?php _e('Send SMS', 'wp-sms'); ?>" />
							</p>
						</td>
					</tr>
				</form>
				</table>
				<?php
			}
			else
			{
				?>
				<div class="error">
					<?php $get_bloginfo_url = get_admin_url() . "admin.php?page=wp-sms"; ?>
					<p><?php echo sprintf(__('Please check the <a href="%s">SMS credit</a> the settings', 'wp-sms'), $get_bloginfo_url); ?></p>
				</div>
				<?php
			}
		}
		else
		{
			?>
			<div class="error">
				<?php $get_bloginfo_url = get_admin_url() . "admin.php?page=wp-sms"; ?>
				<p><?php echo sprintf(__('Please check the <a href="%s">SMS credit</a> the settings', 'wp-sms'), $get_bloginfo_url); ?></p>
			</div>
			<?php
		}
		?>
	</div>
	<?php }
	function wp_subscribes_setting_page()
	{
		if (!current_user_can('manage_options'))
		{
			wp_die(__('You do not have sufficient permissions to access this page.'));

			settings_fields('wp_sms_options');
			function register_mysettings()
			{
				register_setting('wp_sms_options', 'wp_username');
			}
		}
	?>
	<div class="wrap">
		<h2><?php _e('Subscribes list', 'wp-sms'); ?></h2>
		<?php
			$name = trim($_POST['wp_subscribe_name']);
			$mobile = trim($_POST['wp_subscribe_mobile']);
			$date = date('Y-m-d H:i:s' ,current_time('timestamp',0));

			if($_POST['wp_add_subscribe'])
			{
				if($name && $mobile)
				{
					if( (strlen($mobile) >= 11) && (substr($mobile, 0, 2) == '09') && (preg_match("([a-zA-Z])", $mobile) == 0) )
					{
						global $wpdb, $table_prefix;
						$check_mobile = $wpdb->query("SELECT * FROM {$table_prefix}subscribes WHERE mobile='".$mobile."'");

						if(!$check_mobile)
						{
							$check = $wpdb->query("INSERT INTO {$table_prefix}subscribes (date, name, mobile) VALUES ('".$date."', '".$name."', '".$mobile."')");

							if($check)
							{
								echo "<div class='updated'><p>" . __('Number with success was added', 'wp-sms') . "</div></p>";
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

			if($_POST['doaction'])
				{
					$get_IDs = implode(",", $_POST['column_ID']);

					if($_POST['action'] == "trash")
					{
						global $wpdb, $table_prefix;
						$check_ID = $wpdb->query("SELECT * FROM {$table_prefix}subscribes WHERE ID='".$get_IDs."'");
						if($check_ID)
						{
							$test = "DELETE FROM {$table_prefix}subscribes WHERE ID IN (".$get_IDs.")";
							$wpdb->query($test);
							echo "<div class='updated'><p>" . __('With success was removed', 'wp-sms') . "</div></p>";
						} else {
							echo "<div class='error'><p>" . __('Not Found', 'wp-sms') . "</div></p>";
						}
					}
				}
		?>
		<form action="" method="post">
			<table class="widefat fixed" cellspacing="0">
				<thead>
					<tr>
						<th id="cb" scope="col" class="manage-column column-cb check-column"><input type="checkbox" name="checkAll" value=""/></th>
						<th scope="col" class="manage-column column-name" width="10%"><?php _e('ID', 'wp-sms'); ?></th>
						<th scope="col" class="manage-column column-name" width="30%"><?php _e('Register date', 'wp-sms'); ?></th>
						<th scope="col" class="manage-column column-name" width="30%"><?php _e('Name', 'wp-sms'); ?></th>
						<th scope="col" class="manage-column column-name" width="30%"><?php _e('Mobile', 'wp-sms'); ?></th>
					</tr>
				</thead>
			

				<tbody>
					<?php
					global $wpdb, $table_prefix;
					$get_result = $wpdb->get_results("SELECT * FROM {$table_prefix}subscribes");

					if(count($get_result ) > 0)
					{
						foreach($get_result as $gets)
						{
							$i++;
					?>
					<tr class="<?php echo $i % 2 == 0 ? 'alternate':'author-self'; ?>" valign="middle" id="link-2">
						<th class="check-column" scope="row"><input type="checkbox" name="column_ID[]" value="<?php echo $gets->ID ; ?>" /></th>
						<td class="column-name"><?php echo $gets->ID; ?></td>
						<td class="column-name"><?php echo $gets->date; ?></td>
						<td class="column-name"><?php echo $gets->name; ?></td>
						<td class="column-name"><?php echo $gets->mobile; ?></td>
					</tr>
					<?php
						}
					} else { ?>
						<tr>
							<td colspan="5"><?php _e('Not Found!', 'wp-sms'); ?></td>
						</tr>
					<?php } ?>
				</tbody>

				<tfoot>
					<tr>
						<th id="cb" scope="col" class="manage-column column-cb check-column"><input type="checkbox" name="checkAll" value=""/></th>
						<th scope="col" class="manage-column column-name" width="5%"><?php _e('ID', 'wp-sms'); ?></th>
						<th scope="col" class="manage-column column-name" width="20%"><?php _e('Register date', 'wp-sms'); ?></th>
						<th scope="col" class="manage-column column-name" width="20%"><?php _e('Name', 'wp-sms'); ?></th>
						<th scope="col" class="manage-column column-name" width="20%"><?php _e('Mobile', 'wp-sms'); ?></th>
					</tr>
				</tfoot>
			</table>

			<div class="tablenav">
				<div class="alignleft actions">
					<select name="action">
						<option selected="selected"><?php _e('Bulk Actions', 'wp-sms'); ?></option>
						<option value="trash"><?php _e('Remove', 'wp-sms'); ?></option>
					</select>
					<input value="<?php _e('Apply', 'wp-sms'); ?>" name="doaction" id="doaction" class="button-secondary action" type="submit"/>
				</div>
				<br class="clear">
			</div>
		</form>

		<form action="" method="post">
			<table>
				<tr>
					<td><span class="label_td"><?php _e('Name', 'wp-sms'); ?>:</span><input type="text" name="wp_subscribe_name"/></td>
					<td><span class="label_td"><?php _e('Mobile', 'wp-sms'); ?>:</span><input type="text" name="wp_subscribe_mobile" class="ltr_td"/></td>
					<td><input type="submit" class="button-primary" name="wp_add_subscribe" value="<?php _e('Add', 'wp-sms'); ?>" /></td>
				</tr>
			</table>
		</form>
	</div>
	<?php } ?>