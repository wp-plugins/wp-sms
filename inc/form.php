<link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url( __FILE__ ); ?>style.css" />
<script src="<?php echo plugin_dir_url(__FILE__); ?>jquery-1.4.4.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#submit_newsletter").click(function(){
			var get_subscribe_name = $("#subscribe_name").val();
			var get_subscribe_mobile = $("#subscribe_mobile").val();
			var get_subscribe_type = $('input[name=subscribe_type]:checked').val();

			$("#show_result").html('<img src="<?php echo plugin_dir_url(__FILE__); ?>loading.gif"/>');
			$("#show_result").load('<?php echo plugin_dir_url(__FILE__); ?>/newsletter.php', {name:get_subscribe_name, mobile:get_subscribe_mobile, type:get_subscribe_type});
		});
	});
</script>
<table id="subscribe">
	<?php if(get_option('wp_subscribes_status')) { ?>
	<tr>
		<td colspan="2"><?php _e('Enter your information for SMS Subscribe', 'wp-sms'); ?></td>
	</tr>

	<tr>
		<td><?php _e('Your name', 'wp-sms'); ?>:</td>
		<td><input type="text" id="subscribe_name"/></td>
	</tr>

	<tr>
		<td><?php _e('Your mobile', 'wp-sms'); ?>:</td>
		<td><input type="text" id="subscribe_mobile"/></td>
	</tr>

	<tr>
		<td colspan="2">
			<input type="radio" name="subscribe_type" id="type_subscribe" value="subscribe" checked="checked"/>
			<label for="type_subscribe"><?php _e('Subscribe', 'wp-sms'); ?></label>

			<input type="radio" name="subscribe_type" id="type_unsubscribe" value="unsubscribe"/>
			<label for="type_unsubscribe"><?php _e('Unsubscribe', 'wp-sms'); ?></label>
		</td>
	</tr>

	<tr>
		<td colspan="2">
			<button id="submit_newsletter"><?php _e('Subscribe', 'wp-sms'); ?></button>
			<span id="show_result"></span>
		</td>
	</tr>
	<?php } else { ?>
	<tr>
		<td colspan="2">
		<p align="center"><img src="<?php echo plugin_dir_url(__FILE__); ?>close.png"/></p>
		<?php _e('Subscribe is Deactive!', 'wp-sms'); ?>
		</td>
	</tr>
	<?php } ?>
</table>