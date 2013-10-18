<?php
	function wp_sms_upgrade() {
	
		global $wpdb, $table_prefix;
		
		// Add sms prefix to subscribe table.
		$wpdb->query("RENAME TABLE `{$table_prefix}subscribes` TO `{$table_prefix}sms_subscribes`");
		
		// Create Subscrip group table.
		if( $wpdb->query("SELECT * FROM {$table_prefix}sms_group_subscribes") <= 0 ) {
		
			$create_sms_subscribes_group = ("CREATE TABLE IF NOT EXISTS {$table_prefix}sms_subscribes_group(
				ID int(10) NOT NULL auto_increment,
				name VARCHAR(20),
				PRIMARY KEY(ID)) CHARSET=utf8
			");
			
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($create_sms_subscribes_group);
		}
		
		// Add group_ID column in 2.0 version plugin.
		$wpdb->query("ALTER TABLE `{$table_prefix}sms_subscribes` ADD (group_ID tinyint(1))");
		
		update_option('wp_statistics_db_version', WP_STATISTICS_VERSION);
		
		do_action('wp_sms_install');
	}
	add_action('admin_init', 'wp_sms_upgrade');
?>