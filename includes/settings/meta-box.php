<p>
	<label for="subscribe_post"><?php _e('Send this post to subscribers?', 'wp-sms'); ?></label>
	<select name="subscribe_post" id="subscribe_post">
		<option value="yes" <?php selected($selected, 'yes'); ?>><?php _e('Yes'); ?></option>
		<option value="no" <?php selected($selected, 'no'); ?>><?php _e('No'); ?></option>
	</select>
</p>