<script type="text/javascript">
	var boxId2 = 'wp_get_message';
	var counter = 'wp_counter';
	var part = 'wp_part';
	var max = 'wp_max';
	function charLeft2() {
		checkSMSLength(boxId2, counter, part, max);
	}
	
	jQuery(document).ready(function(){
		jQuery("select#select_sender").change(function(){
			var get_method = "";
			jQuery("select#select_sender option:selected").each(
				function(){
					get_method += jQuery(this).attr('id');
				}
			);
			if(get_method == 'wp_tellephone'){
				jQuery("#wpsms_group_name").hide();
				jQuery("#wp_get_numbers").fadeIn();
				jQuery("#wp_get_number").focus();
			} else {
				jQuery("#wp_get_numbers").hide();
				jQuery("#wpsms_group_name").fadeIn();
				jQuery("#wpsms_group_name").focus();
			}
		});
		
		charLeft2();
		jQuery("#" + boxId2).bind('keyup', function() {
			charLeft2();
		});
		jQuery("#" + boxId2).bind('keydown', function() {
			charLeft2();
		});
		jQuery("#" + boxId2).bind('paste', function(e) {
			charLeft2();
		});
	});
</script>

<div class="wrap">
	<h2><?php _e('Send SMS', 'wp-sms'); ?></h2>
	<?php
	global $sms, $wpdb, $table_prefix, $date;
	if(get_option('wp_webservice')) {
		update_option('wp_last_credit', $sms->GetCredit());
		if($sms->GetCredit()) {
			?>
			<form method="post" action="">
			<table class="form-table">
				<tr>
					<td colspan="2">
					<?php
						if(isset($_POST['SendSMS'])) {

							if($_POST['wp_get_message']) {

								if($_POST['wp_send_to'] == "wp_subscribe_username") {
								
									if( $_POST['wpsms_group_name'] == 'all' ) {
										$sms->to = $wpdb->get_col("SELECT mobile FROM {$table_prefix}sms_subscribes WHERE `status` = '1'");
									} else {
										$sms->to = $wpdb->get_col("SELECT mobile FROM {$table_prefix}sms_subscribes WHERE `status` = '1' AND `group_ID` = '".$_POST['wpsms_group_name']."'");
									}
									
								} else if($_POST['wp_send_to'] == "wp_tellephone") {
								
									$sms->to = explode(",", $_POST['wp_get_number']);
								}
								
								$sms->msg = $_POST['wp_get_message'];

								if($_POST['wp_flash'] == "true") {
									$sms->isflash = true;
								}
								elseif($_POST['wp_flash'] == "false") {
									$sms->isflash = false;
								}

								if($sms->SendSMS()) {
								
									$to = implode($wpdb->get_col("SELECT mobile FROM {$table_prefix}sms_subscribes"), ",");
									
									echo "<div class='updated'><p>" . __('SMS was sent with success', 'wp-sms') . "</p></div>";
									update_option('wp_last_credit', $sms->GetCredit());
								}
							} else {
								echo "<div class='error'><p>" . __('Please enter a message', 'wp-sms') . "</p></div>";
							}
						}
					?>
					</td>
				</tr>
				<?php wp_nonce_field('update-options');?>
				<tr>
					<th><h3><?php _e('Send SMS', 'wp-sms'); ?></h4></th>
				</tr>
				<tr>
					<td><?php _e('Send from', 'wp-sms'); ?>:</td>
					<td><?php echo $sms->from; ?></td>
				</tr>
				<tr>
					<td><?php _e('Send to', 'wp-sms'); ?>:</td>
					<td>
						<select name="wp_send_to" id="select_sender">
							<?php global $wpdb, $table_prefix; ?>
							<option value="wp_subscribe_username" id="wp_subscribe_username">
								<?php _e('Subscribe users', 'wp-sms'); ?>
							</option>
							<option value="wp_tellephone" id="wp_tellephone"><?php _e('Number(s)', 'wp-sms'); ?></option>
						</select>
						
						<select name="wpsms_group_name" id="wpsms_group_name">
							<option value="all">
							<?php
								$username_active = $wpdb->query("SELECT * FROM {$table_prefix}sms_subscribes WHERE status = '1'");
								echo sprintf(__('All (%s subscribers active)', 'wp-sms'), $username_active);
							?>
							</option>
							<?php foreach($get_group_result as $items): ?>
							<option value="<?php echo $items->ID; ?>"><?php echo $items->name; ?></option>
							<?php endforeach; ?>
						</select>
						
						<span id="wp_get_numbers" style="display:none;">
							<input type="text" style="direction:ltr;" id="wp_get_number" name="wp_get_number" value="09"/>
							<span style="font-size: 10px"><?php _e('For example', 'wp-sms'); ?>: 09180000000,09180000001</span>
						</span>
					</td>
				</tr>
				
				<tr>
					<td><?php _e('SMS', 'wp-sms'); ?>:</td>
					<td>
						<textarea name="wp_get_message" id="wp_get_message" style="width:350px; height: 200px; direction:ltr;"></textarea><br />
						<?php _e('The remaining words', 'wp-sms'); ?>: <span id="wp_counter" class="number"></span>/<span id="wp_max" class="number"></span><br />
						<span id="wp_part" class="number"></span> <?php _e('SMS', 'wp-sms'); ?><br />
						<p class="number">
							<?php echo __('Your credit', 'wp-sms') . ': ' . $sms->GetCredit() . ' ' . $sms->unit; ?>
						</p>
					</td>
				</tr>
				<?php if($sms->flash == "enable") { ?>
				<tr>
					<td><?php _e('Send a Flash', 'wp-sms'); ?>:</td>
					<td>
						<input type="radio" id="flash_yes" name="wp_flash" value="true"/>
						<label for="flash_yes"><?php _e('Yes', 'wp-sms'); ?></label>

						<input type="radio" id="flash_no" name="wp_flash" value="false" checked="checked"/>
						<label for="flash_no"><?php _e('No', 'wp-sms'); ?></label>

						<br />
						<p class="description"><?php _e('Flash is possible to send messages without being asked, opens', 'wp-sms'); ?></p>
					</td>
				</tr>
				<?php } ?>
				<tr>
					<td>
						<p class="submit">
							<input type="submit" class="button-primary" name="SendSMS" value="<?php _e('Send SMS', 'wp-sms'); ?>" />
						</p>
					</td>
				</tr>
			</form>
			</table>
			<?php
		} else {
			?>
			<div class="error">
				<?php $get_bloginfo_url = get_admin_url() . "admin.php?page=wp-sms/setting&tab=web-service"; ?>
				<p><?php echo sprintf(__('Please check the <a href="%s">SMS credit</a> the settings', 'wp-sms'), $get_bloginfo_url); ?></p>
			</div>
			<?php
		}
	} else {
		?>
		<div class="error">
			<?php $get_bloginfo_url = get_admin_url() . "admin.php?page=wp-sms/setting&tab=web-service"; ?>
			<p><?php echo sprintf(__('Please check the <a href="%s">SMS credit</a> the settings', 'wp-sms'), $get_bloginfo_url); ?></p>
		</div>
		<?php
	} ?>
</div>