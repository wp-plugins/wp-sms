<span id="send_friend"><?php _e('Suggested by SMS', 'wp-sms'); ?></span>
<form action="" method="post" id="tell_friend_form">
	<table width="100%">
		<tr>
			<td><label for="get_name"><?php _e('Your name', 'wp-sms'); ?>:</label></td>
			<td><label for="get_fname"><?php _e('Your friend name', 'wp-sms'); ?>:</label></td>
			<td><label for="get_fmobile"><?php _e('Your friend mobile', 'wp-sms'); ?>:</label></td>
			<td></td>
		</tr>
		
		<tr>
			<td><input type="text" name="get_name" id="get_name"/></td>
			<td><input type="text" name="get_fname" id="get_fname"/></td>
			<td><input type="text" name="get_fmobile" id="get_fmobile" value="<?php echo get_option('wp_sms_mcc'); ?>"/></td>
			<td><input type="submit" name="send_post" value="<?php _e('Send', 'wp-sms'); ?>"/></td>
		</tr>
	</table>
</form>