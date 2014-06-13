<script type="text/javascript">
	jQuery(document).ready(function($) {
		$("#wpsms-submit").click(function() {
		
			$("#wpsms-result").html('');
			
			var get_subscribe_name = $("#wpsms-name").val();
			var get_subscribe_mobile = $("#wpsms-mobile").val();
			var get_subscribe_group = $("#wpsms-groups").val();
			var get_subscribe_type = $('input[name=subscribe_type]:checked').val();
			
			$("#wpsms-subscribe").ajaxStart(function(){
				$("#wpsms-subscribe").css('opacity', '0.4');
				$("#wpsms-subscribe-loading").show();
			});
			
			$("#wpsms-subscribe").ajaxComplete(function(){
				$("#wpsms-subscribe").css('opacity', '1');
				$("#wpsms-subscribe-loading").hide();
			});
			
			$.get("<?php echo WP_SMS_DIR_PLUGIN; ?>includes/admin/wp-sms-subscribe.php", {name:get_subscribe_name, mobile:get_subscribe_mobile, group:get_subscribe_group, type:get_subscribe_type}, function(data, status){
				switch(data) {
					case 'success-1':
						$("#wpsms-subscribe table").hide();
						$("#wpsms-result").html('<p class="wps-success-message"><?php _e('You will join the newsletter!', 'wp-sms'); ?></p>');
					break;
					
					case 'success-2':
						$("#wpsms-subscribe table").hide();
						$("#wpsms-result").html('<p class="wps-error-message"><?php _e('Your subscription was canceled.', 'wp-sms'); ?></p>');
					break;
					
					case 'success-3':
						$("#wpsms-subscribe table").hide();
						$("#wpsms-activation").fadeIn();
						$("#wpsms-result").html('<?php _e('You will join the newsletter, Activation code sent to your number.', 'wp-sms'); ?>');
					break;
					
					default:
						$("#wpsms-result").html(data);
				}
			});
		});

		<?php if(get_option('wp_subscribes_activation')) { ?>
		$("#activation").live('click', function() {
		
			$("#wpsms-activation-result").html('');
			
			var get_subscribe_mobile = $("#wpsms-mobile").val();
			var get_activation = $("#wpsms-ativation-code").val();
			
			$.get("<?php echo WP_SMS_DIR_PLUGIN; ?>includes/admin/wp-sms-subscribe-activation.php", {mobile:get_subscribe_mobile, activation:get_activation}, function(data, status){
				switch(data) {
					case 'success-1':
						$("#wpsms-result").hide();
						$("#wpsms-activation").hide();
						$("#wpsms-activation-result").html('<p class="wps-success-message"><?php _e('Your membership in the complete newsletter!', 'wp-sms'); ?></p>');
					break;
					
					default:
						$("#wpsms-activation-result").html(data);
				}
			});
		});
		<?php } ?>
	});
</script>
<div id="wpsms-subscribe">
	<?php if(get_option('wp_subscribes_status')) { ?>
	<div id="wpsms-subscribe-loading"></div>
	<table>
		<tr>
			<td colspan="2"><?php _e('Enter your information for SMS Subscribe', 'wp-sms'); ?></td>
		</tr>

		<tr>
			<td><?php _e('Name', 'wp-sms'); ?>:</td>
			<td><input class="wpsms-input" type="text" id="wpsms-name"/></td>
		</tr>

		<tr>
			<td><?php _e('Mobile', 'wp-sms'); ?>:</td>
			<td><input class="wpsms-input" type="text" id="wpsms-mobile"/></td>
		</tr>
		
		<tr>
			<td><?php _e('Group', 'wp-sms'); ?>:</td>
			<td>
				<select class="wpsms-input" name="wpsms_grop_name" id="wpsms-groups">
					<?php foreach($get_group_result as $items): ?>
					<option value="<?php echo $items->ID; ?>"><?php echo $items->name; ?></option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>

		<tr>
			<td colspan="2">
				<input type="radio" name="subscribe_type" id="wpsms-type-subscribe" value="subscribe" checked="checked"/>
				<label for="wpsms-type-subscribe"><?php _e('Subscribe', 'wp-sms'); ?></label>

				<input type="radio" name="subscribe_type" id="wpsms-type-unsubscribe" value="unsubscribe"/>
				<label for="wpsms-type-unsubscribe"><?php _e('Unsubscribe', 'wp-sms'); ?></label>
			</td>
		</tr>

		<tr>
			<td colspan="2">
				<button class="wpsms-submit" id="wpsms-submit"><?php _e('Subscribe', 'wp-sms'); ?></button>
			</td>
		</tr>
	</table>

	<div id="wpsms-result"></div>
	<div id="wpsms-activation">
		<?php _e('Please enter the activation code:', 'wp-sms'); ?>
		<input type="text" id="wpsms-ativation-code" name="get_activation"/>
		<button class="wpsms-submit" id="activation"><?php _e('Activation', 'wp-sms'); ?></button>
	</div>
	<div id="wpsms-activation-result"></div>
	
	<?php } else { ?>
	<div class="wpsms-deactive">
		<?php _e('Subscribe is Deactive!', 'wp-sms'); ?>
	</div>
	<?php } ?>
</div>