<link rel="stylesheet" type="text/css" href="<?php bloginfo('url'); ?>/wp-content/plugins/wp-sms/css/style.css" />
<?php if(get_option('wp_call_jquery')) { ?>
<script src="<?php bloginfo('url'); ?>/wp-content/plugins/wp-sms/js/jquery.js" type="text/javascript"></script>
<?php } ?>
<script type="text/javascript">
	$(document).ready(function()
	{
		$("#submit_newsletter").click(function()
		{
			var get_subscribe_name = $("#subscribe_name").val();
			var get_subscribe_mobile = $("#subscribe_mobile").val();
			var get_subscribe_type = $('input[name=subscribe_type]:checked').val();

			$("#show_result").html('<img src="<?php bloginfo('url'); ?>/wp-content/plugins/wp-sms/images/loading.gif"/>');
			$("#show_result").load('<?php echo plugin_dir_url(__FILE__); ?>/newsletter.php', {name:get_subscribe_name, mobile:get_subscribe_mobile, type:get_subscribe_type});
		});

		<?php if(get_option('wp_subscribes_activation')) { ?>
		$("#activation").live('click', function()
		{
			var get_subscribe_mobile = $("#subscribe_mobile").val();
			var get_activation = $("#get_activation").val();

			$("#show_result_activation").html('<img src="<?php echo plugin_dir_url(__FILE__); ?>loading.gif"/>');
			$("#show_result_activation").load('<?php echo plugin_dir_url(__FILE__); ?>/activation.php', {mobile:get_subscribe_mobile, activation:get_activation});
		});
		<?php } ?>
	});
</script>
<table id="subscribe">
	<?php if(get_option('wp_subscribes_status')) { ?>
	<tr class="register-tr">
		<td colspan="2"><?php _e('Enter your information for SMS Subscribe', 'wp-sms'); ?></td>
	</tr>

	<tr class="register-tr">
		<td><?php _e('Your name', 'wp-sms'); ?>:</td>
		<td><input type="text" id="subscribe_name"/></td>
	</tr>

	<tr class="register-tr">
		<td><?php _e('Your mobile', 'wp-sms'); ?>:</td>
		<td><input type="text" id="subscribe_mobile"/></td>
	</tr>

	<tr class="register-tr">
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
			<span id="show_result_activation"></span>
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