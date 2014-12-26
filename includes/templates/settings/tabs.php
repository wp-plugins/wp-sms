<h2 class="nav-tab-wrapper">
	<a href="?page=wp-sms/setting" class="nav-tab<?php if(isset($_GET['tab']) == '') { echo " nav-tab-active";} ?>"><?php _e('General', 'wp-sms'); ?></a>
	<a href="?page=wp-sms/setting&tab=web-service" class="nav-tab<?php if($_GET['tab'] == 'web-service') { echo " nav-tab-active"; } ?>"><?php _e('Web Service', 'wp-sms'); ?></a>
	<a href="?page=wp-sms/setting&tab=newsletter" class="nav-tab<?php if($_GET['tab'] == 'newsletter') { echo " nav-tab-active"; } ?>"><?php _e('Newsletter', 'wp-sms'); ?></a>
	<a href="?page=wp-sms/setting&tab=features" class="nav-tab<?php if($_GET['tab'] == 'features') { echo " nav-tab-active"; } ?>"><?php _e('Features', 'wp-sms'); ?></a>
	<a href="?page=wp-sms/setting&tab=notification" class="nav-tab<?php if($_GET['tab'] == 'notification') { echo " nav-tab-active"; } ?>"><?php _e('Notification', 'wp-sms'); ?></a>
	<a href="?page=wp-sms/setting&tab=about" class="nav-tab<?php if($_GET['tab'] == 'about') { echo " nav-tab-active"; } ?>"><?php _e('About', 'wp-sms'); ?></a>
</h2>