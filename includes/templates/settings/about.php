<div class="wrap">
	<h2><?php _e('About Plugin', 'wp-sms'); ?></h2>
	<p><?php echo sprintf(__('Version plugin: %s', 'wp-sms'), WP_SMS_VERSION); ?></p>
	<p><?php echo sprintf(__('The first free WordPress Iranian plugin that works on Web service messages.', 'wp-sms'), 'http://www.webstudio.ir'); ?></p>
	<p><?php echo sprintf(__('This plugin created by %s from %s gorup', 'wp-sms'), '<a href="http://profiles.wordpress.org/mostafa.s1990/">Mostafa Soufi</a>', '<a href="http://forum.wp-parsi.com">WP Parsi</a>'); ?>
	<h3><?php _e('do you have problem with plugin?', 'wp-sms'); ?></h3>
	<p><?php echo sprintf(__('if you have you can tell your problem in <a href="%s">forum</a>.', 'wp-sms'), 'http://forum.wp-parsi.com/'); ?></p>

	<h3><?php _e('are you a translator?', 'wp-sms'); ?></h3>
	<p><?php echo sprintf(__('please send your translation to %s.', 'wp-sms'), '<code>mst404@gmail.com</code>'); ?></p>

	<h3><?php _e('you want to know about how to add your web service to this plugin?', 'wp-sms'); ?></h3>
	<p><?php echo sprintf(__('to adding your web service please contact with %s.', 'wp-sms'), '<code>mst404@gmail.com</code>'); ?></p>
	
	<h3><?php _e('Donate in plugin.', 'wp-sms'); ?></h3>
	<p>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="Z959U3RPCC9WG">
			<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>
		
		<hr />
		
		<p><a href="http://iran98.org/donate/" target="_blank"><img src="<?php echo plugins_url('wp-statistics/images/donate/donate.png'); ?>" id="donate" alt="<?php _e('Donate', 'wp_statistics'); ?>"/><br /><img src="<?php echo plugins_url('wp-sms/images/donate/tdCflg.png'); ?>" id="donate" alt="<?php _e('Donate', 'wp_statistics'); ?>"/></a></p>
	</p>
</div>