<?php
	function wp_sms_add_meta_links($links, $file) {
		if( $file == 'wp-sms/wp-sms.php' ) {
			$links[] = '<b><a href="http://wp-sms-plugin.com/purchases" target="_blank" title="'. __('Upgrade to pro version', 'wp-sms') .'">'. __('Upgrade to pro version', 'wp-sms') .'</a></b>';
			$links[] = '<b><a href="'.admin_url('admin.php?page=wp-sms/addons').'" title="'. __('Addons', 'wp-sms') .'">'. __('Addons', 'wp-sms') .'</a></b>';
		}
		
		return $links;
	}
	add_filter('plugin_row_meta', 'wp_sms_add_meta_links', 10, 2);