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

<?php function wpsms_group_pointer() { ?>
<script type="text/javascript">
jQuery(document).ready( function($) {
	$('#wpsms_groups').pointer({
		content: '<h3><?php _e('Group', 'wp-sms'); ?></h3><p><?php _e('Outset Create group to better manage the subscribers.', 'wp-sms'); ?></p>',
		position: {
			my: '<?php echo is_rtl() ? 'right':'left'; ?> top',
			at: 'center bottom',
			offset: '-25 0'
		},
		/*close: function() {
			setusernameSetting('wpsms_p1', '1');
		}*/
	}).pointer('open');
});
</script>
<?php } ?>

<div class="wrap">
	<?php if(!isset($_GET['action']) == 'edit') { ?>
	<h2>
		<?php _e('Members Newsletter', 'wp-sms'); ?>
		<a class="add-new-h2" href="?page=wp-sms/subscribe&action=import"><?php _e('Import', 'wp-sms'); ?></a>
		<a class="add-new-h2" href="?page=wp-sms/subscribe&action=export"><?php _e('Export', 'wp-sms'); ?></a>
		<?php if(isset($_POST['s'])) { ?><span class="subtitle"><?php echo sprintf(__('Search result for %s', 'wp-sms'), $_POST['s']); ?></span><?php } ?>
	</h2>
	
	
	<ul class="subsubsub">
		<li class="all"><a <?php if(isset($_GET['group']) == false) { echo 'class="current" '; } ?>href="admin.php?page=wp-sms/subscribe"><?php _e('All', 'wp-sms'); ?> <span class="count">(<?php echo $total; ?>)</span></a> |</li>
		<?php
			$i = null;
			foreach($get_group_result as $groups) {
				
				$current = null;
				if(isset($_GET['group']) == $groups->ID) {
					$current = "class='current' ";
				}
				
				$line = ' |';
				$i++;
				if( $i == count($get_group_result) ) {
					$line = null;
				}
				
				$result = $wpdb->get_col("SELECT * FROM {$table_prefix}sms_subscribes WHERE `group_ID` = '{$groups->ID}'");
				
				$count = count($result);
				
				echo "<li><a {$current} href='admin.php?page=wp-sms/subscribe&group={$groups->ID}'>{$groups->name} <span class='count'>({$count})</span></a>{$line}</li>";
			}
		?>
	</ul>
	
	<form method="post" action="" id="posts-filter">
		<p class="search-box">
			<label for="post-search-input" class="screen-reader-text"><?php _e('Search subscribers', 'wp-sms'); ?></label>
			<input type="search" value="" name="s" id="post-search-input">
			<input type="submit" value="<?php _e('Search subscribers', 'wp-sms'); ?>" class="button" id="search-submit" name="search">
		</p>
	</form>
	
	<form action="" method="post">
		<table class="widefat fixed" cellspacing="0">
			<thead>
				<tr>
					<th id="cb" scope="col" class="manage-column column-cb check-column"><input type="checkbox" name="checkAll" value=""/></th>
					<th scope="col" class="manage-column column-name" width="30%"><?php _e('Register date', 'wp-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="30%"><?php _e('Name', 'wp-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="20%"><?php _e('Mobile', 'wp-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="20%"><?php _e('Group', 'wp-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="10%"><?php _e('Status', 'wp-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="10%"><?php _e('Edit', 'wp-sms'); ?></th>
				</tr>
			</thead>
		

			<tbody>
			<?php
				// Retrieve MySQL data
				if(isset($_GET['group'])) {
					$get_result = $wpdb->get_results("SELECT * FROM `{$table_prefix}sms_subscribes` WHERE `group_ID` = '{$_GET['group']}' ORDER BY `{$table_prefix}sms_subscribes`.`ID` DESC  LIMIT {$start}, {$end}");
				} else {
					$get_result = $wpdb->get_results("SELECT * FROM `{$table_prefix}sms_subscribes` ORDER BY `{$table_prefix}sms_subscribes`.`ID` DESC  LIMIT {$start}, {$end}");
				}
				
				if(isset($_POST['search'])) {
					$get_result = $wpdb->get_results("SELECT * FROM `{$table_prefix}sms_subscribes` WHERE `name` LIKE '%{$_POST['s']}%' OR `mobile` LIKE '%{$_POST['s']}%' ORDER BY `{$table_prefix}sms_subscribes`.`ID` DESC  LIMIT {$start}, {$end}");
				}
				
				if(count($get_result ) > 0)
				{
					foreach($get_result as $gets)
					{
						$i++;
				?>
				<tr class="<?php echo $i % 2 == 0 ? 'alternate':'author-self'; ?>" valign="middle" id="link-2">
					<th class="check-column" scope="row"><input type="checkbox" name="column_ID[]" value="<?php echo $gets->ID ; ?>" /></th>
					<td class="column-name"><?php echo $gets->date; ?></td>
					<td class="column-name"><?php echo $gets->name; ?></td>
					<td class="column-name"><?php echo $gets->mobile; ?></td>
					<td class="column-name">
						<?php
							$result = $wpdb->get_row("SELECT * FROM {$table_prefix}sms_subscribes_group WHERE `ID` = '{$gets->group_ID}'");
							
							echo "<a href='admin.php?page=wp-sms/subscribe&group={$result->ID}'>{$result->name}</a>";
						?>
					</td>
					<td class="column-name"><img src="<?php echo WP_SMS_DIR_PLUGIN . '/assets/images/' . $gets->status; ?>.png" align="middle"/></td>
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
					<th scope="col" class="manage-column column-name" width="30%"><?php _e('Register date', 'wp-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="30%"><?php _e('Name', 'wp-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="20%"><?php _e('Mobile', 'wp-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="20%"><?php _e('Group', 'wp-sms'); ?></th>
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
	
	<?php if($get_result) { ?>
	<div class="pagination-log">
		<?php echo $Pagination->display(); ?>
		<p id="result-log">
			<?php echo ' ' . __('Page', 'wp-sms') . ' ' . $Pagination->getCurrentPage() . ' ' . __('From', 'wp-sms') . ' ' . $Pagination->getTotalPages(); ?>
		</p>
	</div>
	<?php } ?>
	
	<?php if($get_group_result) : ?>
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
				<td><span class="label_td" for="wpsms_group_name"><?php _e('Group', 'wp-sms'); ?>:</span></td>
				<td>
					<select name="wpsms_group_name" id="wpsms_group_name">
						<?php foreach($get_group_result as $items): ?>
						<option value="<?php echo $items->ID; ?>"><?php echo $items->name; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>

			<tr>
				<td colspan="2"><input type="submit" class="button-primary" name="wp_add_subscribe" value="<?php _e('Add', 'wp-sms'); ?>" /></td>
			</tr>
		</table>
	</form>
	<?php endif; ?>
	
	<form action="" method="post">
		<table>
			<tr><td colspan="2"><h3 id="wpsms_groups"><?php _e('Add new Group:', 'wp-sms'); ?></h4></td></tr>
			<tr>
				<td><span class="label_td" for="wpsms_group_name"><?php _e('Group name', 'wp-sms'); ?>:</span></td>
				<td><input type="text" id="wpsms_group_name" name="wpsms_group_name"/></td>
			</tr>
			
			<tr>
				<td colspan="2"><input type="submit" class="button-primary" name="wpsms_add_group" value="<?php _e('Add', 'wp-sms'); ?>" /></td>
			</tr>
		</table>
	</form>
	
	<?php if($get_group_result) : ?>
	<form action="" method="post">
		<table>
			<tr><td colspan="2"><h3><?php _e('Delete Group:', 'wp-sms'); ?></h4></td></tr>
			<tr>
				<td><span class="label_td" for="wpsms_group_name"><?php _e('Group name', 'wp-sms'); ?>:</span></td>
				<td>
					<select name="wpsms_group_name" id="wpsms_group_name">
						<?php foreach($get_group_result as $items): ?>
						<option value="<?php echo $items->ID; ?>"><?php echo $items->name; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			
			<tr>
				<td colspan="2"><input type="submit" class="button-primary" name="wpsms_delete_group" value="<?php _e('Remove', 'wp-sms'); ?>" /></td>
			</tr>
		</table>
	</form>
	
	<?php endif; ?>
	<?php } else { ?>
	<?php $get_result = $wpdb->get_results("SELECT * FROM {$table_prefix}sms_subscribes WHERE ID = '".$_GET['ID']."'"); ?>
	
	<div class="clear"></div>
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
				<td><span class="label_td" for="wpsms_group_name"><?php _e('Group name', 'wp-sms'); ?>:</span></td>
				<td>
					<select name="wpsms_group_name" id="wpsms_group_name">
						<?php foreach($get_group_result as $items): ?>
						<option value="<?php echo $items->ID; ?>" <?php selected($get_result[0]->group_ID, $items->ID); ?>><?php echo $items->name; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
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