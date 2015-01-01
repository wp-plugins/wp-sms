<?php
	function wp_sms_add_meta_links($links, $file) {
		if( $file == 'wp-sms/wp-sms.php' ) {
			$links[] = '<a href="http://codecanyon.net/item/wp-sms-pro/9380372" target="_blank" title="'. __('Upgrade to pro version', 'wp-sms') .'">'. __('Upgrade to pro version', 'wp-sms') .'</a>';
		}
		
		return $links;
	}
	add_filter('plugin_row_meta', 'wp_sms_add_meta_links', 10, 2);