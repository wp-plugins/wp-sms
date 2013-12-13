<?php
	function wp_sms_install() {

		global $wp_sms_db_version, $table_prefix, $wpdb;
		
		$create_sms_subscribes = ("CREATE TABLE {$table_prefix}sms_subscribes(
			ID int(10) NOT NULL auto_increment,
			date DATETIME,
			name VARCHAR(20),
			mobile VARCHAR(20) NOT NULL,
			status tinyint(1),
			activate_key INT(11),
			group_ID int(5),
			PRIMARY KEY(ID)) CHARSET=utf8
		");
		
		$create_sms_subscribes_group = ("CREATE TABLE {$table_prefix}sms_subscribes_group(
			ID int(10) NOT NULL auto_increment,
			name VARCHAR(20),
			PRIMARY KEY(ID)) CHARSET=utf8
		");
		
		$create_sms_send = ("CREATE TABLE {$table_prefix}sms_send(
			ID int(10) NOT NULL auto_increment,
			date DATETIME,
			sender VARCHAR(20) NOT NULL,
			message TEXT NOT NULL,
			recipient TEXT NOT NULL,
			PRIMARY KEY(ID)) CHARSET=utf8
		");

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($create_sms_subscribes);
		dbDelta($create_sms_subscribes_group);
		dbDelta($create_sms_send);
		
		add_option('wp_sms_db_version', WP_SMS_VERSION);
	}
?>