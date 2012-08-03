<script type="text/javascript">
	function openwin() {
		var url=document.form.wp_webservice.value;
		if(url==1) {
			document.location.href="<?php echo get_bloginfo('url'); ?>/wp-admin/admin.php?page=wp-sms/about";
		}
	}
</script>

<style>
p.register{
	background: #FF6600;
	border-radius: 4px;
	padding: 4px;
	color: #FFFFFF;
	font-size: 11px;
	float: <?php echo is_rtl() == true? "right":"left"; ?>
}
p.register a{
	color: #FFFFFF;
	font-weight: bold;
	text-decoration: none;
}
</style>

<div class="wrap">
	<h2><?php _e('SMS Setting', 'wp-sms'); ?></h2>
	<table class="form-table">
		<form method="post" action="options.php" name="form">
			<?php wp_nonce_field('update-options');?>
			<tr><th colspan="2"><h3><?php _e('General Setting', 'wp-sms'); ?></h4></th></tr>
			<tr>
				<td><?php _e('Your Mobile Number', 'wp-sms'); ?>:</td>
				<td>
					<input type="text" dir="ltr" style="width: 200px;" name="wp_admin_mobile" value="<?php echo get_option('wp_admin_mobile'); ?>"/>
				</td>
			</tr>

			<tr><th colspan="2"><h3><?php _e('Credit SMS Setting', 'wp-sms'); ?></h4></th></tr>
			<tr>
				<td><?php _e('Web Service', 'wp-sms'); ?>:</td>
				<td>
					<select name="wp_webservice" onChange="javascript:openwin()">
						<option value=""><?php _e('Select your Web Service', 'wp-sms'); ?></option>
						<option value="iransmspanel" <?php selected(get_option('wp_webservice'), 'iransmspanel'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Iransmspanel (%s)', 'wp-sms'), 'iransmspanel.ir'); ?>
						</option>
						<option value="smsfa" <?php selected(get_option('wp_webservice'), 'smsfa'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('SMSFa (%s)', 'wp-sms'), 'smsfa.us'); ?>
						</option>
						<option value="hostiran" <?php selected(get_option('wp_webservice'), 'hostiran'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Host Iran (%s)', 'wp-sms'), 'hostiran.net'); ?>
						</option>
						<option value="webstudio" <?php selected(get_option('wp_webservice'), 'webstudio'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Webstudio (%s)', 'wp-sms'), 'sms.webstudio.ir'); ?>
						</option>
						<option value="panizsms" <?php selected(get_option('wp_webservice'), 'panizsms'); ?>>&nbsp;&nbsp;- <?php _e('Paniz SMS (panizsms.ir)', 'wp-sms'); ?></option>
						<option value="" disabled="disabled" style="background:#BBBBBB; color:#FFFFFF;"><?php _e('Your Web Service does not exist?', 'wp-sms'); ?></option>
						<option value="1">&nbsp;&nbsp;- <?php _e('Click for more information', 'wp-sms'); ?></option>
					</select>

					<input type="hidden" name="action" value="update" />
					<input type="hidden" name="page_options" value="wp_webservice" />
					<input type="submit" class="button" name="Submit" value="<?php _e('Select', 'wp-sms'); ?>" />
				</td>
			</tr>

			<?php if(get_option('wp_webservice')) { ?>
			<tr>
				<td><?php _e('Username', 'wp-sms'); ?>:</td>
				<td>
					<input type="text" dir="ltr" style="width: 200px;" name="wp_username" value="<?php echo get_option('wp_username'); ?>"/>
					<span style="font-size: 10px"><?php _e('Your username in', 'wp-sms'); ?>: <?php echo get_option('wp_webservice'); ?></span>
					<?php if(!get_option('wp_username')) { ?>
					<br /><p class="register"><?php echo sprintf(__('If you do not have a username for this service <a href="%s">click here..</a>', 'wp-sms'), $obj->tariff) ?></p>
					<?php } ;?>
				</td>
			</tr>

			<tr>
				<td><?php _e('Password', 'wp-sms'); ?>:</td>
				<td>
					<input type="password" dir="ltr" style="width: 200px;" name="wp_password" value="<?php echo get_option('wp_password'); ?>"/>
					<span style="font-size: 10px"><?php _e('Your password in', 'wp-sms'); ?>: <?php echo get_option('wp_webservice'); ?></span>
					<?php if(!get_option('wp_password')) { ?>
					<br /><p class="register"><?php echo sprintf(__('If you do not have a password for this service <a href="%s">click here..</a>', 'wp-sms'), $obj->tariff) ?></p>
					<?php } ?>
				</td>
			</tr>

			<tr>
				<td><?php _e('Number', 'wp-sms'); ?>:</td>
				<td>
					<input type="text" dir="ltr" style="width: 200px;" name="wp_number" value="<?php echo get_option('wp_number'); ?>"/>
					<span style="font-size: 10px"><?php _e('Your SMS sender number in', 'wp-sms'); ?>: <?php echo get_option('wp_webservice'); ?></span>
				</td>
			</tr>

			<tr>
				<td><?php _e('Credit', 'wp-sms'); ?>:</td>
				<td>
				<?php global $obj; echo $obj->get_credit() . " " . $obj->unit; ?>
				</td>
			</tr>

			<tr>
				<td><?php _e('Status', 'wp-sms'); ?>:</td>
				<td>
					<?php if($obj->get_credit()) { ?>
						<img src="<?php bloginfo('url'); ?>/wp-content/plugins/wp-sms/images/green.png" alt="Active" align="absmiddle"/><span style="font-weight: bold;"><?php _e('Active', 'wp-sms'); ?></span>
					<?php } else { ?>
						<img src="<?php bloginfo('url'); ?>/wp-content/plugins/wp-sms/images/grey.png" alt="Deactive" align="absmiddle"/><span style="font-weight: bold;"><?php _e('Deactive', 'wp-sms'); ?></span>
					<?php } ?>
				</td>
			</tr>
			<?php } ?>

			<tr><th colspan="2"><h3><?php _e('Newsletter', 'wp-sms'); ?></h4></th></tr>
			<tr>
				<td><?php _e('Register?', 'wp-sms'); ?></td>
				<td>
					<input type="checkbox" name="wp_subscribes_status" id="wp_subscribes_status" <?php echo get_option('wp_subscribes_status') ==true? 'checked="checked"':'';?>/>
					<label for="wp_subscribes_status"><?php _e('Active', 'wp-sms'); ?></label>
				</td>
			</tr>

			<tr>
				<td><?php _e('Send activation code via SMS?', 'wp-sms'); ?></td>
				<td>
					<input type="checkbox" name="wp_subscribes_activation" id="wp_subscribes_activation" <?php echo get_option('wp_subscribes_activation') ==true? 'checked="checked"':'';?>/>
					<label for="wp_subscribes_activation"><?php _e('Active', 'wp-sms'); ?></label>
				</td>
			</tr>

			<tr>
				<td><?php _e('Posts sent to subscribers?', 'wp-sms'); ?></td>
				<td>
					<input type="checkbox" name="wp_subscribes_send" id="wp_subscribes_send" <?php echo get_option('wp_subscribes_send') ==true? 'checked="checked"':'';?>/>
					<label for="wp_subscribes_send"><?php _e('Active', 'wp-sms'); ?></label>
				</td>
			</tr>

			<tr>
				<td><?php _e('Calling jQuery in Wordpress?', 'wp-sms'); ?></td>
				<td>
					<input type="checkbox" name="wp_call_jquery" id="wp_call_jquery" <?php echo get_option('wp_call_jquery') ==true? 'checked="checked"':'';?>/>
					<label for="wp_call_jquery"><?php _e('Active', 'wp-sms'); ?></label>
					<span style="font-size: 10px">(<?php _e('Enable this option with JQuery is called in the theme', 'wp-sms'); ?>)</span>
				</td>
			</tr>

			<tr><th colspan="2"><h3><?php _e('Post Suggestion', 'wp-sms'); ?></h4></th></tr>
			<tr>
				<td><?php _e('Suggested post by SMS?', 'wp-sms'); ?></td>
				<td>
					<input type="checkbox" name="wp_suggestion_status" id="wp_suggestion_status" <?php echo get_option('wp_suggestion_status') ==true? 'checked="checked"':'';?>/>
					<label for="wp_suggestion_status"><?php _e('Active', 'wp-sms'); ?></label>
				</td>
			</tr>

			<tr><th colspan="2"><h3><?php _e('Notification Setting', 'wp-sms'); ?></h4></th></tr>
			<tr>
				<td><?php _e('Notification of a new wordPress version by SMS?', 'wp-sms'); ?></td>
				<td>
					<input type="checkbox" name="wp_notification_new_wp_version" id="wp_notification_new_wp_version" <?php echo get_option('wp_notification_new_wp_version') ==true? 'checked="checked"':'';?>/>
					<label for="wp_notification_new_wp_version"><?php _e('Active', 'wp-sms'); ?></label>
					<span style="font-size: 10px">(<?php _e('Enable this option with When a new version of WordPress was ready, will be informed via SMS', 'wp-sms'); ?>)</span>
				</td>
			</tr>

			<tr>
				<td>
					<p class="submit">
					<input type="hidden" name="action" value="update" />
					<input type="hidden" name="page_options" value="wp_admin_mobile,wp_webservice,wp_username,wp_password,wp_number,wp_unit_money,wp_subscribes_status,wp_subscribes_activation,wp_subscribes_send,wp_call_jquery,wp_suggestion_status,wp_notification_new_wp_version" />
					<input type="submit" class="button-primary" name="Submit" value="<?php _e('Update', 'wp-sms'); ?>" />
					</p>
				</td>
			</tr>
		</form>	
	</table>
</div>