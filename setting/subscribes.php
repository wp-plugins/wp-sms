<script type="text/javascript">
	jQuery(document).ready(function() {

		jQuery('#doaction').click(function() {
			var action = jQuery('#action').val();
			
			if(action == 'trash') {
				var agree = confirm('<?php _e('Are you sure?', 'wp-sms'); ?>');

				if(agree)
					return true;
				else
					return false;
			}
		})

	});
</script>

<div class="wrap">
	<h2><?php _e('Subscribes list', 'wp-sms'); ?></h2>
	<?php if(!$_GET['action'] == 'edit') { ?>
	<form action="" method="post">
		<table class="widefat fixed" cellspacing="0">
			<thead>
				<tr>
					<th id="cb" scope="col" class="manage-column column-cb check-column"><input type="checkbox" name="checkAll" value=""/></th>
					<th scope="col" class="manage-column column-name" width="20%"><?php _e('ID', 'wp-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="20%"><?php _e('Register date', 'wp-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="20%"><?php _e('Name', 'wp-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="20%"><?php _e('Mobile', 'wp-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="10%"><?php _e('Status', 'wp-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="10%"><?php _e('Edit', 'wp-sms'); ?></th>
				</tr>
			</thead>
		

			<tbody>
				<?php
				global $wpdb, $table_prefix;
				$get_result = $wpdb->get_results("SELECT * FROM {$table_prefix}subscribes ORDER BY `{$table_prefix}subscribes`.`ID` DESC");

				if(count($get_result ) > 0)
				{
					foreach($get_result as $gets)
					{
						$i++;
				?>
				<tr class="<?php echo $i % 2 == 0 ? 'alternate':'author-self'; ?>" valign="middle" id="link-2">
					<th class="check-column" scope="row"><input type="checkbox" name="column_ID[]" value="<?php echo $gets->ID ; ?>" /></th>
					<td class="column-name"><?php echo $i; ?></td>
					<td class="column-name"><?php echo $gets->date; ?></td>
					<td class="column-name"><?php echo $gets->name; ?></td>
					<td class="column-name"><?php echo $gets->mobile; ?></td>
					<td class="column-name"><img src="<?php echo bloginfo('url') . '/wp-content/plugins/wp-sms/images/' . $gets->status; ?>.png" align="middle"/></td>
					<td class="column-name"><a href="?page=wp-sms/subscribe&action=edit&ID=<?php echo $gets->ID; ?>"><?php _e('Edit', 'wp-sms'); ?></a></td>
				</tr>
				<?php
					}
				} else { ?>
					<tr>
						<td colspan="7"><?php _e('Not Found!', 'wp-sms'); ?></td>
					</tr>
				<?php } ?>
			</tbody>

			<tfoot>
				<tr>
					<th id="cb" scope="col" class="manage-column column-cb check-column"><input type="checkbox" name="checkAll" value=""/></th>
					<th scope="col" class="manage-column column-name" width="20%"><?php _e('ID', 'wp-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="20%"><?php _e('Register date', 'wp-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="20%"><?php _e('Name', 'wp-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="20%"><?php _e('Mobile', 'wp-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="10%"><?php _e('Status', 'wp-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="10%"><?php _e('Edit', 'wp-sms'); ?></th>
				</tr>
			</tfoot>
		</table>

		<div class="tablenav">
			<div class="alignleft actions">
				<select name="action" id="action">
					<option selected="selected"><?php _e('Bulk Actions', 'wp-sms'); ?></option>
					<option value="trash"><?php _e('Remove', 'wp-sms'); ?></option>
					<option value="active"><?php _e('Active', 'wp-sms'); ?></option>
					<option value="deactive"><?php _e('Deactive', 'wp-sms'); ?></option>
				</select>
				<input value="<?php _e('Apply', 'wp-sms'); ?>" name="doaction" id="doaction" class="button-secondary action" type="submit"/>
			</div>
			<br class="clear">
		</div>
	</form>

	<form action="" method="post">
		<table>
			<tr><td colspan="2"><h3><?php _e('Add new subscribe:', 'wp-sms'); ?></h4></td></tr>
			<tr>
				<td><span class="label_td" for="wp_subscribe_name"><?php _e('Name', 'wp-sms'); ?>:</span></td>
				<td><input type="text" id="wp_subscribe_name" name="wp_subscribe_name"/></td>
			</tr>

			<tr>
				<td><span class="label_td" for="wp_subscribe_mobile"><?php _e('Mobile', 'wp-sms'); ?>:</span></td>
				<td><input type="text" name="wp_subscribe_mobile" id="wp_subscribe_mobile" class="code"/></td>
			</tr>

			<tr>
				<td colspan="2"><input type="submit" class="button-primary" name="wp_add_subscribe" value="<?php _e('Add', 'wp-sms'); ?>" /></td>
			</tr>
		</table>
	</form>

	<?php } else { ?>

	<?php $get_result = $wpdb->get_results("SELECT * FROM {$table_prefix}subscribes WHERE ID = '".$_GET['ID']."'"); ?>
	<form action="" method="post">
		<table>
			<tr><td colspan="2"><h3><?php _e('Edit subscribe:', 'wp-sms'); ?></h4></td></tr>
			<tr>
				<td><span class="label_td" for="wp_subscribe_name"><?php _e('Name', 'wp-sms'); ?>:</span></td>
				<td><input type="text" id="wp_subscribe_name" name="wp_subscribe_name" value="<?php echo $get_result[0]->name; ?>"/></td>
			</tr>

			<tr>
				<td><span class="label_td" for="wp_subscribe_mobile"><?php _e('Mobile', 'wp-sms'); ?>:</span></td>
				<td><input type="text" name="wp_subscribe_mobile" id="wp_subscribe_mobile" class="code" value="<?php echo $get_result[0]->mobile; ?>"/></td>
			</tr>

			<tr>
				<td><span class="label_td" for="wp_subscribe_mobile"><?php _e('Status', 'wp-sms'); ?>:</span></td>
				<td>
					<select name="wp_subscribe_status">
						<option value="1" <?php selected($get_result[0]->status, '1'); ?>><?php _e('Active', 'wp-sms'); ?></option>
						<option value="0" <?php selected($get_result[0]->status, '0'); ?>><?php _e('Deactive', 'wp-sms'); ?></option>
					</select>
				</td>
			</tr>

			<tr>
				<td colspan="2"><input type="submit" class="button-primary" name="wp_edit_subscribe" value="<?php _e('Edit', 'wp-sms'); ?>" /></td>
			</tr>
		</table>
	</form>

	<h4><a href="<?php echo admin_url(); ?>admin.php?page=wp-sms/subscribe"><?php _e('Back', 'wp-sms'); ?></a></h4>
	
	<?php } ?>
</div>