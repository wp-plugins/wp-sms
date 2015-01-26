<div class="wrap">
	<?php include( dirname( __FILE__ ) . '/tabs.php' ); ?>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<td align="center" scope="row"><img src="<?php echo plugins_url('wp-sms/assets/images/logo-250.png'); ?>"></td>
			</tr>
			
			<tr valign="top">
				<td scope="row" align="center"><h2><?php echo sprintf(__('WP SMS V%s', 'wp-sms'), WP_SMS_VERSION); ?></h2></td>
			</tr>
			
			<tr valign="top">
				<td align="center" scope="row"><?php _e('Send a SMS via WordPress, Subscribe for sms newsletter and send an SMS to the subscriber newsletter.', 'wp-sms'); ?></td>
			</tr>
			
			<tr valign="top">
				<td align="center" scope="row"><hr></td>
			</tr>
			
			<tr valign="top">
				<td colspan="2" scope="row"><h2><?php _e('Support', 'wp-sms'); ?></h2></td>
			</tr>
			
			<tr valign="top">
				<td colspan="2" scope="row">
					<ul>
						<li><?php _e('do you have problem with plugin?', 'wp-sms'); ?></li>
						<li><?php _e('are you a translator?', 'wp-sms'); ?></li>
						<li><?php _e('You want add your web service to this plugin?', 'wp-sms'); ?></li>
					</ul>
					<p><?php echo sprintf(__('Please contact with email %s', 'wp-sms'), '<code>mst404@gmail.com</code>'); ?></p>
				</td>
			</tr>
			
			<tr valign="top">
				<td colspan="2" scope="row"><h2><?php _e('Pro version', 'wp-sms'); ?></h2></td>
			</tr>
			
			<tr valign="top">
				<td scope="row"><?php echo sprintf(__('If you need a more feature of WP SMS, you can purchase %s.', 'wp-sms'), '<a href="http://codecanyon.net/item/wp-sms-pro/9380372" target="_blank">'.__('Pro version', 'wp-sms').'</a>'); ?></td>
			</tr>
		</tbody>
</table>
</div>