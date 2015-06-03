<div class="wrap">
	<h2><?php _e('Addons page', 'wp-sms'); ?></h2>
	<p><?php _e('Addons extend and expand the functionality of WP SMS Plugin.', 'wp-sms'); ?></p>
	<?php if($json->response == 'success') { ?>
	<div class="wp-list-table widefat plugin-install">
		<div id="the-list">
			<?php foreach($json->items as $item) { ?>
			<div class="plugin-card">
				<div class="plugin-card-top">
					<a href="<?php echo $item->link; ?>" class="thickbox plugin-icon"><img src="<?php echo $item->thumb; ?>"></a>
					<div class="name column-name">
						<h4><a href="<?php echo $item->link; ?>" class="thickbox"><?php echo $item->name; ?></a></h4>
					</div>
					
					<div class="action-links">
						<ul class="plugin-action-buttons">
							<li><a class="install-now button" href="<?php echo $item->link; ?>"><?php _e('Purchase', 'wp-sms'); ?></a></li>
							<li><a href="<?php echo $item->link; ?>" class="thickbox"><?php _e('More Details', 'wp-sms'); ?></a></li>
						</ul>
					</div>
					
					<div class="desc column-description">
						<p><?php echo $item->description; ?></p>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	
	<?php } else { ?>
	<p><?php _e('There are no item for sale, please try again.', 'wp-sms'); ?></p>
	<?php } ?>
</div>