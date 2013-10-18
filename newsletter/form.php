<script type="text/javascript">
	jQuery(document).ready(function($) {
		$("#wpsms-submit").click(function() {
			var get_subscribe_name = $("#wpsms-name").val();
			var get_subscribe_mobile = $("#wpsms-mobile").val();
			var get_subscribe_group = $("#wpsms-groups").val();
			var get_subscribe_type = $('input[name=subscribe_type]:checked').val();
			
			$("#wpsms-result").html('<img src="<?php bloginfo('url'); ?>/wp-content/plugins/wp-sms/images/loading.gif"/>');
			$("#wpsms-result").load('<?php echo plugin_dir_url(__FILE__); ?>/newsletter.php', {name:get_subscribe_name, mobile:get_subscribe_mobile, group:get_subscribe_group, type:get_subscribe_type});
		});

		<?php if(get_option('wp_subscribes_activation')) { ?>
		$("#activation").live('click', function() {
			var get_subscribe_mobile = $("#wpsms-mobile").val();
			var get_activation = $("#wpsms-ativation").val();

			$("#show_result_activation").html('<img src="<?php bloginfo('url'); ?>/wp-content/plugins/wp-sms/images/loading.gif"/>');
			$("#show_result_activation").load('<?php echo plugin_dir_url(__FILE__); ?>/activation.php', {mobile:get_subscribe_mobile, activation:get_activation});
		});
		<?php } ?>
	});
</script>
<table id="wpsms-subscribe">
	<?php if(get_option('wp_subscribes_status')) { ?>
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
			<div id="wpsms-result"></div>
			<div id="show_result_activation"></div>
		</td>
	</tr>
	<?php } else { ?>
	<tr>
		<td colspan="2">
		<p align="center"><img src="<?php bloginfo('url'); ?>/wp-content/plugins/wp-sms/images/close.png"/></p>
		<?php _e('Subscribe is Deactive!', 'wp-sms'); ?>
		</td>
	</tr>
	<?php } ?>
</table>