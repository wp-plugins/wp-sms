<div class="wrap">
		<h2><?php _e('Subscribes list', 'wp-sms'); ?></h2>
		<?php
			$name = trim($_POST['wp_subscribe_name']);
			$mobile = trim($_POST['wp_subscribe_mobile']);
			$date = date('Y-m-d H:i:s' ,current_time('timestamp',0));

			if($_POST['wp_add_subscribe'])
			{
				if($name && $mobile)
				{
					if( (strlen($mobile) >= 11) && (substr($mobile, 0, 2) == '09') && (preg_match("([a-zA-Z])", $mobile) == 0) )
					{
						global $wpdb, $table_prefix;
						$check_mobile = $wpdb->query("SELECT * FROM {$table_prefix}subscribes WHERE mobile='".$mobile."'");

						if(!$check_mobile)
						{
							$check = $wpdb->query("INSERT INTO {$table_prefix}subscribes (date, name, mobile) VALUES ('".$date."', '".$name."', '".$mobile."')");

							if($check)
							{
								echo "<div class='updated'><p>" . __('Number with success was added', 'wp-sms') . "</div></p>";
							}
						} else {
							echo "<div class='error'><p>" . __('Phone number is repeated', 'wp-sms') . "</div></p>";
						}
					} else {
						echo "<div class='error'><p>" . __('Please enter a valid mobile number', 'wp-sms') . "</div></p>";
					}
				} else {
					echo "<div class='error'><p>" . __('Please complete all fields', 'wp-sms') . "</div></p>";
				}
			}

			if($_POST['doaction'])
				{
					$get_IDs = implode(",", $_POST['column_ID']);

					if($_POST['action'] == "trash")
					{
						global $wpdb, $table_prefix;
						$check_ID = $wpdb->query("SELECT * FROM {$table_prefix}subscribes WHERE ID='".$get_IDs."'");
						if($check_ID)
						{
							$test = "DELETE FROM {$table_prefix}subscribes WHERE ID IN (".$get_IDs.")";
							$wpdb->query($test);
							echo "<div class='updated'><p>" . __('With success was removed', 'wp-sms') . "</div></p>";
						} else {
							echo "<div class='error'><p>" . __('Not Found', 'wp-sms') . "</div></p>";
						}
					}
				}
		?>
		<form action="" method="post">
			<table class="widefat fixed" cellspacing="0">
				<thead>
					<tr>
						<th id="cb" scope="col" class="manage-column column-cb check-column"><input type="checkbox" name="checkAll" value=""/></th>
						<th scope="col" class="manage-column column-name" width="10%"><?php _e('ID', 'wp-sms'); ?></th>
						<th scope="col" class="manage-column column-name" width="30%"><?php _e('Register date', 'wp-sms'); ?></th>
						<th scope="col" class="manage-column column-name" width="30%"><?php _e('Name', 'wp-sms'); ?></th>
						<th scope="col" class="manage-column column-name" width="30%"><?php _e('Mobile', 'wp-sms'); ?></th>
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
						<th scope="col" class="manage-column column-name" width="5%"><?php _e('ID', 'wp-sms'); ?></th>
						<th scope="col" class="manage-column column-name" width="20%"><?php _e('Register date', 'wp-sms'); ?></th>
						<th scope="col" class="manage-column column-name" width="20%"><?php _e('Name', 'wp-sms'); ?></th>
						<th scope="col" class="manage-column column-name" width="20%"><?php _e('Mobile', 'wp-sms'); ?></th>
					</tr>
				</tfoot>
			</table>

			<div class="tablenav">
				<div class="alignleft actions">
					<select name="action">
						<option selected="selected"><?php _e('Bulk Actions', 'wp-sms'); ?></option>
						<option value="trash"><?php _e('Remove', 'wp-sms'); ?></option>
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