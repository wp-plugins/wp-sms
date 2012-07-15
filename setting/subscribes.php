<div class="wrap">
		<h2><?php _e('Subscribes list', 'wp-sms'); ?></h2>
		<form action="" method="post">
			<table class="widefat fixed" cellspacing="0">
				<thead>
					<tr>
						<th id="cb" scope="col" class="manage-column column-cb check-column"><input type="checkbox" name="checkAll" value=""/></th>
						<th scope="col" class="manage-column column-name" width="20%"><?php _e('ID', 'wp-sms'); ?></th>
						<th scope="col" class="manage-column column-name" width="20%"><?php _e('Register date', 'wp-sms'); ?></th>
						<th scope="col" class="manage-column column-name" width="20%"><?php _e('Name', 'wp-sms'); ?></th>
						<th scope="col" class="manage-column column-name" width="20%"><?php _e('Mobile', 'wp-sms'); ?></th>
						<th scope="col" class="manage-column column-name" width="20%"><?php _e('Status', 'wp-sms'); ?></th>
					</tr>
				</thead>
			

				<tbody>
					<?php
					global $wpdb, $table_prefix;
					$get_result = $wpdb->get_results("SELECT * FROM {$table_prefix}subscribes");

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
					</tr>
					<?php
						}
					} else { ?>
						<tr>
							<td colspan="5"><?php _e('Not Found!', 'wp-sms'); ?></td>
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
						<th scope="col" class="manage-column column-name" width="20%"><?php _e('Status', 'wp-sms'); ?></th>
					</tr>
				</tfoot>
			</table>

			<div class="tablenav">
				<div class="alignleft actions">
					<select name="action">
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
				<tr>
					<td><span class="label_td"><?php _e('Name', 'wp-sms'); ?>:</span><input type="text" name="wp_subscribe_name"/></td>
					<td><span class="label_td"><?php _e('Mobile', 'wp-sms'); ?>:</span><input type="text" name="wp_subscribe_mobile" class="ltr_td"/></td>
					<td><input type="submit" class="button-primary" name="wp_add_subscribe" value="<?php _e('Add', 'wp-sms'); ?>" /></td>
				</tr>
			</table>
		</form>
	</div>