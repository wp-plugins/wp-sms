<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
	<script src="<?php bloginfo('url'); ?>/wp-content/plugins/wp-sms/js/functions.js" type="text/javascript"></script>
	<script type="text/javascript">
		var boxId2 = 'wp_get_message';
		var counter = 'wp_counter';
		var part = 'wp_part';
		var max = 'wp_max';
		function charLeft2() {
			checkSMSLength(boxId2, counter, part, max);
		}

		$(document).ready(function(){
			$("select#select_sender").change(function(){
				var get_method = "";
				$("select#select_sender option:selected").each(
					function(){
						get_method += $(this).attr('id');
					}
				);
				if(get_method == 'wp_tellephone'){
					$("#wp_get_numbers").fadeIn();
					$("#wp_get_number").focus();
				} else {
					$("#wp_get_numbers").fadeOut();
				}
			});

			charLeft2();
			$("#" + boxId2).bind('keyup', function() {
				charLeft2();
			});
			$("#" + boxId2).bind('keydown', function() {
				charLeft2();
			});
			$("#" + boxId2).bind('paste', function(e) {
				charLeft2();
			});
		});
	</script>

	<style>
	#wp_get_number:focus{border:1px solid #FF0000;}
	.number{font-weight: bold;}
	</style>
	<div class="wrap">
		<h2><?php _e('Send SMS', 'wp-sms'); ?></h2>
		<?php
		global $obj, $wpdb, $table_prefix;
		if(get_option('wp_webservice')) {
			update_option('wp_last_credit', $obj->get_credit());
			if($obj->get_credit()) {
				?>
				<form method="post" action="">
				<table class="form-table">
					<tr>
						<td colspan="2">
						<?php
							if(isset($_POST['send_sms'])) {

								if($_POST['wp_get_message']) {

									if($_POST['wp_send_to'] == "wp_subscribe_user") {
										$obj->to = $wpdb->get_col("SELECT mobile FROM {$table_prefix}subscribes");
									}
									else if($_POST['wp_send_to'] == "wp_tellephone") {
										$obj->to = explode(",", $_POST['wp_get_number']);
									}

									$obj->msg = $_POST['wp_get_message'];

									if($_POST['wp_flash'] == "true") {
										$obj->isflash = true;
									}
									elseif($_POST['wp_flash'] == "false") {
										$obj->isflash = false;
									}

									if($obj->send_sms()) {
										echo "<div class='updated'><p>" . __('SMS was sent with success', 'wp-sms') . "</p></div>";
										update_option('wp_last_credit', $obj->get_credit());
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
						<td><?php echo $obj->from; ?></td>
					</tr>
					<tr>
						<td><?php _e('Send to', 'wp-sms'); ?>:</td>
						<td>
							<select name="wp_send_to" id="select_sender">
								<?php global $wpdb, $table_prefix; ?>
								<option value="wp_subscribe_user" id="wp_subscribe_user">
									<?php
										$user_active = $wpdb->query("SELECT * FROM {$table_prefix}subscribes WHERE status = '1'");
										echo sprintf(__('Subscribe users (%s) active', 'wp-sms'), $user_active);
									?>
								</option>
								<option value="wp_tellephone" id="wp_tellephone"><?php _e('Numbers', 'wp-sms'); ?></option>
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
								<?php echo __('Your credit', 'wp-sms') . ': ' . number_format($obj->get_credit()) . ' ' . $obj->unit; ?>
							</p>
						</td>
					</tr>
					<?php if($obj->flash == "enable") { ?>
					<tr>
						<td><?php _e('Send a Flash', 'wp-sms'); ?>:</td>
						<td>
							<input type="radio" id="flash_yes" name="wp_flash" value="true"/>
							<label for="flash_yes"><?php _e('Yes', 'wp-sms'); ?></label>

							<input type="radio" id="flash_no" name="wp_flash" value="false" CHECKED/>
							<label for="flash_no"><?php _e('No', 'wp-sms'); ?></label>

							<br />
							<span style="font-size: 10px"><?php _e('Flash is possible to send messages without being asked, opens', 'wp-sms'); ?></span>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<td>
							<p class="submit">
							<input type="submit" class="button-primary" name="send_sms" value="<?php _e('Send SMS', 'wp-sms'); ?>" />
							</p>
						</td>
					</tr>
				</form>
				</table>
				<?php
			} else {
				?>
				<div class="error">
					<?php $get_bloginfo_url = get_admin_url() . "admin.php?page=wp-sms"; ?>
					<p><?php echo sprintf(__('Please check the <a href="%s">SMS credit</a> the settings', 'wp-sms'), $get_bloginfo_url); ?></p>
				</div>
				<?php
			}
		} else {
			?>
			<div class="error">
				<?php $get_bloginfo_url = get_admin_url() . "admin.php?page=wp-sms"; ?>
				<p><?php echo sprintf(__('Please check the <a href="%s">SMS credit</a> the settings', 'wp-sms'), $get_bloginfo_url); ?></p>
			</div>
			<?php
		} ?>
	</div>