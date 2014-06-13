<div class="wrap">
	<h2 class="nav-tab-wrapper">
		<a href="?page=wp-sms/setting" class="nav-tab<?php if($_GET['tab'] == '') { echo " nav-tab-active";} ?>"><?php _e('General', 'wp-sms'); ?></a>
		<a href="?page=wp-sms/setting&tab=web-service" class="nav-tab<?php if($_GET['tab'] == 'web-service') { echo " nav-tab-active"; } ?>"><?php _e('Web Service', 'wp-sms'); ?></a>
		<a href="?page=wp-sms/setting&tab=newsletter" class="nav-tab<?php if($_GET['tab'] == 'newsletter') { echo " nav-tab-active"; } ?>"><?php _e('Newsletter', 'wp-sms'); ?></a>
		<a href="?page=wp-sms/setting&tab=features" class="nav-tab<?php if($_GET['tab'] == 'features') { echo " nav-tab-active"; } ?>"><?php _e('Features', 'wp-sms'); ?></a>
		<a href="?page=wp-sms/setting&tab=notification" class="nav-tab<?php if($_GET['tab'] == 'notification') { echo " nav-tab-active"; } ?>"><?php _e('Notification', 'wp-sms'); ?></a>
	</h2>
	
	<table class="form-table">
		<form method="post" action="options.php" name="form">
			<?php wp_nonce_field('update-options');?>
			<tr>
				<th><?php _e('Suggested post by SMS?', 'wp-sms'); ?></th>
				<td>
					<input type="checkbox" name="wp_suggestion_status" id="wp_suggestion_status" <?php echo get_option('wp_suggestion_status') ==true? 'checked="checked"':'';?>/>
					<label for="wp_suggestion_status"><?php _e('Active', 'wp-sms'); ?></label>
				</td>
			</tr>
			
			<tr>
				<th><?php _e('Add Mobile field to profile page?', 'wp-sms'); ?></th>
				<td>
					<input type="checkbox" name="wps_add_mobile_field" id="wps_add_mobile_field" <?php echo get_option('wps_add_mobile_field') ==true? 'checked="checked"':'';?>/>
					<label for="wps_add_mobile_field"><?php _e('Active', 'wp-sms'); ?></label>
				</td>
			</tr>
			
			<tr>
				<td>
					<p class="submit">
						<input type="hidden" name="action" value="update" />
						<input type="hidden" name="page_options" value="wp_suggestion_status,wps_add_mobile_field" />
						<input type="submit" class="button-primary" name="Submit" value="<?php _e('Update', 'wp-sms'); ?>" />
					</p>
				</td>
			</tr>
		</form>	
	</table>
</div>