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
		float: <?php echo is_rtl() == true? "right":"left"; ?> 
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
			
			<tr>
				<td><?php _e('Your mobile country code', 'wp-sms'); ?>:</td>
				<td>
					<input type="text" dir="ltr" style="width: 200px;" name="wp_sms_mcc" value="<?php echo get_option('wp_sms_mcc'); ?>"/>
					<p class="description"><?php _e('Enter your mobile country code. (For example: Iran 09, Australia 61)', 'wp-sms'); ?></p>
				</td>
			</tr>

			<tr><th colspan="2"><h3><?php _e('Credit SMS Setting', 'wp-sms'); ?></h4></th></tr>
			<tr>
				<td><?php _e('Web Service', 'wp-sms'); ?>:</td>
				<td>
					<select name="wp_webservice" id="wp-webservice" onChange="javascript:openwin()">
						<option value=""><?php _e('Select your Web Service', 'wp-sms'); ?></option>
						
						<!--Seprator-->
						<option value="" disabled="disabled" class="option-seprator"><?php _e('Iran', 'wp-sms'); ?></option>
						<!--Seprator-->
						
						<option value="parandhost" <?php selected(get_option('wp_webservice'), 'parandhost'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'sms.parandhost.com'); ?>
						</option>
						<option value="iransmspanel" <?php selected(get_option('wp_webservice'), 'iransmspanel'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'iransmspanel.ir'); ?>
						</option>
						<option value="hostiran" <?php selected(get_option('wp_webservice'), 'hostiran'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'hostiran.net'); ?>
						</option>
						<option value="smsdehi" <?php selected(get_option('wp_webservice'), 'smsdehi'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'smsdehi.ir'); ?>
						</option>
						<option value="payameavval" <?php selected(get_option('wp_webservice'), 'payameavval'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'payameavval.com'); ?>
						</option>
						<option value="smsclick" <?php selected(get_option('wp_webservice'), 'smsclick'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'smsclick.ir'); ?>
						</option>
						<option value="persiansms" <?php selected(get_option('wp_webservice'), 'persiansms'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'persiansms.com'); ?>
						</option>
						<option value="ariaideh" <?php selected(get_option('wp_webservice'), 'ariaideh'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'sms.ariaideh.com'); ?>
						</option>
						<option value="panizsms" <?php selected(get_option('wp_webservice'), 'panizsms'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'panizsms.ir'); ?>
						</option>
						<option value="sms_s" <?php selected(get_option('wp_webservice'), 'sms_s'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'SMS-S.ir'); ?>
						</option>
						<option value="sadat24" <?php selected(get_option('wp_webservice'), 'sadat24'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'sadat24.ir'); ?>
						</option>
						<option value="smscall" <?php selected(get_option('wp_webservice'), 'smscall'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'smscall.ir'); ?>
						</option>
						<option value="tablighsmsi" <?php selected(get_option('wp_webservice'), 'tablighsmsi'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'tablighsmsi.com'); ?>
						</option>
						<option value="paaz" <?php selected(get_option('wp_webservice'), 'paaz'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'paaz.ir'); ?>
						</option>
						<option value="textsms" <?php selected(get_option('wp_webservice'), 'textsms'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'textsms.ir'); ?>
						</option>
						<option value="jahanpayamak" <?php selected(get_option('wp_webservice'), 'jahanpayamak'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'jahanpayamak.info'); ?>
						</option>
						<option value="opilo" <?php selected(get_option('wp_webservice'), 'opilo'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'opilo.com'); ?>
						</option>
						<option value="barzinsms" <?php selected(get_option('wp_webservice'), 'barzinsms'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'barzinsms.ir'); ?>
						</option>
						<option value="payamaknet" <?php selected(get_option('wp_webservice'), 'payamaknet'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'panel.payamaknet.ir'); ?>
						</option>
						<option value="smsmart" <?php selected(get_option('wp_webservice'), 'smsmart'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'smsmart.info'); ?>
						</option>
						<option value="imencms" <?php selected(get_option('wp_webservice'), 'imencms'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'imencms.com'); ?>
						</option>
						<option value="tcisms" <?php selected(get_option('wp_webservice'), 'tcisms'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'tcisms.com'); ?>
						</option>
						<option value="caffeweb" <?php selected(get_option('wp_webservice'), 'caffeweb'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'caffeweb.com'); ?>
						</option>
						<option value="nasrpayam" <?php selected(get_option('wp_webservice'), 'nasrpayam'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'nasrpayam.ir'); ?>
						</option>
						<option value="smsbartar" <?php selected(get_option('wp_webservice'), 'smsbartar'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'sms-bartar.com'); ?>
						</option>
						<option value="fayasms" <?php selected(get_option('wp_webservice'), 'fayasms'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'fayasms.ir'); ?>
						</option>
						
						<!--Seprator-->
						<option value="" disabled="disabled" class="option-seprator"><?php _e('Australia', 'wp-sms'); ?></option>
						<!--Seprator-->
						
						<option value="smsglobal" <?php selected(get_option('wp_webservice'), 'smsglobal'); ?>>
							&nbsp;&nbsp;-&nbsp;
							<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'smsglobal.com'); ?>
						</option>
						
						<!--Option information-->
						<option value="1" id="option-information"><?php _e('For more information about adding Web Service', 'wp-sms'); ?></option>
						<!--Option information-->
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
					<p class="description"><?php _e('Your username in', 'wp-sms'); ?>: <?php echo get_option('wp_webservice'); ?></p>
					
					<?php if(!get_option('wp_username')) { ?>
						<br /><p class="register"><?php echo sprintf(__('If you do not have a username for this service <a href="%s">click here..</a>', 'wp-sms'), $obj->tariff) ?></p>
					<?php } ;?>
				</td>
			</tr>

			<tr>
				<td><?php _e('Password', 'wp-sms'); ?>:</td>
				<td>
					<input type="password" dir="ltr" style="width: 200px;" name="wp_password" value="<?php echo get_option('wp_password'); ?>"/>
					<p class="description"><?php _e('Your password in', 'wp-sms'); ?>: <?php echo get_option('wp_webservice'); ?></p>
					
					<?php if(!get_option('wp_password')) { ?>
						<br /><p class="register"><?php echo sprintf(__('If you do not have a password for this service <a href="%s">click here..</a>', 'wp-sms'), $obj->tariff) ?></p>
					<?php } ?>
				</td>
			</tr>

			<tr>
				<td><?php _e('Number', 'wp-sms'); ?>:</td>
				<td>
					<input type="text" dir="ltr" style="width: 200px;" name="wp_number" value="<?php echo get_option('wp_number'); ?>"/>
					<p class="description"><?php _e('Your SMS sender number in', 'wp-sms'); ?>: <?php echo get_option('wp_webservice'); ?></p>
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
						<img src="<?php bloginfo('url'); ?>/wp-content/plugins/wp-sms/images/1.png" alt="Active" align="absmiddle"/><span style="font-weight: bold;"><?php _e('Active', 'wp-sms'); ?></span>
					<?php } else { ?>
						<img src="<?php bloginfo('url'); ?>/wp-content/plugins/wp-sms/images/0.png" alt="Deactive" align="absmiddle"/><span style="font-weight: bold;"><?php _e('Deactive', 'wp-sms'); ?></span>
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
					<p class="description">(<?php _e('Enable this option with JQuery is called in the theme', 'wp-sms'); ?>)</p>
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

			<tr><th colspan="2"><h3><?php _e('Notification', 'wp-sms'); ?></h4></th></tr>
			<tr>
				<td><?php _e('Notification SMS of a new wordPress version?', 'wp-sms'); ?></td>
				<td>
					<input type="checkbox" name="wp_notification_new_wp_version" id="wp_notification_new_wp_version" <?php echo get_option('wp_notification_new_wp_version') ==true? 'checked="checked"':'';?>/>
					<label for="wp_notification_new_wp_version"><?php _e('Active', 'wp-sms'); ?></label>
					<p class="description">(<?php _e('Enable this option with When a new version of WordPress was ready, will be informed via SMS', 'wp-sms'); ?>)</p>
				</td>
			</tr>
			
			<tr>
				<td><?php _e('Notification SMS when messages received from Contact Form 7 plugin?', 'wp-sms'); ?></td>
				<td>
					<input type="checkbox" name="wp_notification_wpcf7" id="wp_notification_wpcf7" <?php echo get_option('wp_notification_wpcf7') ==true? 'checked="checked"':'';?>/>
					<label for="wp_notification_wpcf7"><?php _e('Active', 'wp-sms'); ?></label>
					<p class="description">(<?php _e('Enable this option with When a new message received of Contact Form 7 plugin, will be informed via SMS', 'wp-sms'); ?>)</p>
				</td>
			</tr>

			<tr>
				<td>
					<p class="submit">
						<input type="hidden" name="action" value="update" />
						<input type="hidden" name="page_options" value="wp_admin_mobile,wp_sms_mcc,wp_webservice,wp_username,wp_password,wp_number,wp_unit_money,wp_subscribes_status,wp_subscribes_activation,wp_subscribes_send,wp_call_jquery,wp_suggestion_status,wp_notification_new_wp_version,wp_notification_wpcf7" />
						<input type="submit" class="button-primary" name="Submit" value="<?php _e('Update', 'wp-sms'); ?>" />
					</p>
				</td>
			</tr>
		</form>	
	</table>
</div>