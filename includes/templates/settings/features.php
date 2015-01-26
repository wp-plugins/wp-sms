<div class="wrap">
	<?php include( dirname( __FILE__ ) . '/tabs.php' ); ?>
	<table class="form-table">
		<form method="post" action="options.php" name="form">
			<?php wp_nonce_field('update-options');?>
			<tr valign="top"><th scope="row" colspan="2"><h3>Wordpress</h3></th></tr>
			<tr>
				<th><?php _e('Suggested post by SMS', 'wp-sms'); ?></th>
				<td>
					<input type="checkbox" name="wp_suggestion_status" id="wp_suggestion_status" <?php echo get_option('wp_suggestion_status') ==true? 'checked="checked"':'';?>/>
					<label for="wp_suggestion_status"><?php _e('Active', 'wp-sms'); ?></label>
				</td>
			</tr>
			
			<tr valign="top"><th scope="row" colspan="2"><h3>WooCommerce</h3></th></tr>
			
			<tr>
				<th><?php _e('Add Mobile number field', 'wp-sms'); ?></th>
				<td>
					<input type="checkbox" name="wps_add_mobile_field" id="wps_add_mobile_field" <?php echo get_option('wps_add_mobile_field') ==true? 'checked="checked"':'';?>/>
					<label for="wps_add_mobile_field"><?php _e('Active', 'wp-sms'); ?></label>
					<p class="description"><?php _e('Add Mobile number to user profile and register form.', 'wp-sms'); ?></p>
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