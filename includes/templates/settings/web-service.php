<script type="text/javascript">
	function openwin() {
		var url=document.form.wp_webservice.value;
		if(url==1) {
			document.location.href="<?php echo $sms_page['about']; ?>";
		}
	}
</script>

<style>
	p.register{
		float: <?php echo is_rtl() == true? "right":"left"; ?> 
	}
</style>

<div class="wrap">
	<h2 class="nav-tab-wrapper">
		<a href="?page=wp-sms/setting" class="nav-tab<?php if($_GET['tab'] == '') { echo " nav-tab-active";} ?>"><?php _e('General', 'wp-sms'); ?></a>
		<a href="?page=wp-sms/setting&tab=web-service" class="nav-tab<?php if($_GET['tab'] == 'web-service') { echo " nav-tab-active"; } ?>"><?php _e('Web Service', 'wp-sms'); ?></a>
		<a href="?page=wp-sms/setting&tab=newsletter" class="nav-tab<?php if($_GET['tab'] == 'newsletter') { echo " nav-tab-active"; } ?>"><?php _e('Newsletter', 'wp-sms'); ?></a>
		<a href="?page=wp-sms/setting&tab=features" class="nav-tab<?php if($_GET['tab'] == 'features') { echo " nav-tab-active"; } ?>"><?php _e('Features', 'wp-sms'); ?></a>
		<a href="?page=wp-sms/setting&tab=notification" class="nav-tab<?php if($_GET['tab'] == 'notification') { echo " nav-tab-active"; } ?>"><?php _e('Notification', 'wp-sms'); ?></a>
	</h2>
	
	<form method="post" action="options.php" name="form">
		<table class="form-table">
			<?php wp_nonce_field('update-options');?>
			<tr>
				<th><?php _e('Web Service', 'wp-sms'); ?>:</th>
				<td>
					<select name="wp_webservice" id="wp-webservice" onChange="javascript:openwin()">
						<option value=""><?php _e('Select your Web Service', 'wp-sms'); ?></option>
						
						<optgroup label="<?php _e('Iran', 'wp-sms'); ?>">
							<option value="parandhost" <?php selected(get_option('wp_webservice'), 'parandhost'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'Parandhost.com'); ?>
							</option>
							<option value="iransmspanel" <?php selected(get_option('wp_webservice'), 'iransmspanel'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'iransmspanel.ir'); ?>
							</option>
							<option value="hostiran" <?php selected(get_option('wp_webservice'), 'hostiran'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'Hostiran.net'); ?>
							</option>
							<option value="adpdigital" <?php selected(get_option('wp_webservice'), 'adpdigital'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'adpdigital.com'); ?>
							</option>
							<option value="smsde" <?php selected(get_option('wp_webservice'), 'smsde'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'smsde.ir'); ?>
							</option>
							<option value="payamakde" <?php selected(get_option('wp_webservice'), 'payamakde'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'payamakde.ir'); ?>
							</option>
							<option value="payameavval" <?php selected(get_option('wp_webservice'), 'payameavval'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'payameavval.com'); ?>
							</option>
							<option value="smsclick" <?php selected(get_option('wp_webservice'), 'smsclick'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'smsclick.ir'); ?>
							</option>
							<option value="persiansms" <?php selected(get_option('wp_webservice'), 'persiansms'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'persiansms.com'); ?>
							</option>
							<option value="ariaideh" <?php selected(get_option('wp_webservice'), 'ariaideh'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'sms.ariaideh.com'); ?>
							</option>
							<option value="panizsms" <?php selected(get_option('wp_webservice'), 'panizsms'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'panizsms.ir'); ?>
							</option>
							<option value="sms_s" <?php selected(get_option('wp_webservice'), 'sms_s'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'SMS-S.ir'); ?>
							</option>
							<option value="sadat24" <?php selected(get_option('wp_webservice'), 'sadat24'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'sadat24.ir'); ?>
							</option>
							<option value="smscall" <?php selected(get_option('wp_webservice'), 'smscall'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'smscall.ir'); ?>
							</option>
							<option value="tablighsmsi" <?php selected(get_option('wp_webservice'), 'tablighsmsi'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'tablighsmsi.com'); ?>
							</option>
							<option value="paaz" <?php selected(get_option('wp_webservice'), 'paaz'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'paaz.ir'); ?>
							</option>
							<option value="textsms" <?php selected(get_option('wp_webservice'), 'textsms'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'textsms.ir'); ?>
							</option>
							<option value="jahanpayamak" <?php selected(get_option('wp_webservice'), 'jahanpayamak'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'jahanpayamak.info'); ?>
							</option>
							<option value="opilo" <?php selected(get_option('wp_webservice'), 'opilo'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'opilo.com'); ?>
							</option>
							<option value="barzinsms" <?php selected(get_option('wp_webservice'), 'barzinsms'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'barzinsms.ir'); ?>
							</option>
							<option value="smsmart" <?php selected(get_option('wp_webservice'), 'smsmart'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'smsmart.info'); ?>
							</option>
							<option value="imencms" <?php selected(get_option('wp_webservice'), 'imencms'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'imencms.com'); ?>
							</option>
							<option value="tcisms" <?php selected(get_option('wp_webservice'), 'tcisms'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'tcisms.com'); ?>
							</option>
							<option value="caffeweb" <?php selected(get_option('wp_webservice'), 'caffeweb'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'caffeweb.com'); ?>
							</option>
							<option value="nasrpayam" <?php selected(get_option('wp_webservice'), 'nasrpayam'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'NasrPayam.ir'); ?>
							</option>
							<option value="smsbartar" <?php selected(get_option('wp_webservice'), 'smsbartar'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'sms-bartar.com'); ?>
							</option>
							<option value="fayasms" <?php selected(get_option('wp_webservice'), 'fayasms'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'fayasms.ir'); ?>
							</option>
							<option value="payamresan" <?php selected(get_option('wp_webservice'), 'payamresan'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'payam-resan.com'); ?>
							</option>
							<option value="mdpanel" <?php selected(get_option('wp_webservice'), 'mdpanel'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'ippanel.com'); ?>
							</option>
							<option value="payameroz" <?php selected(get_option('wp_webservice'), 'payameroz'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'payameroz.ir'); ?>
							</option>
							<option value="niazpardaz" <?php selected(get_option('wp_webservice'), 'niazpardaz'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'niazpardaz.com'); ?>
							</option>
							<option value="hisms" <?php selected(get_option('wp_webservice'), 'hisms'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'hi-sms.ir'); ?>
							</option>
							<option value="joghataysms" <?php selected(get_option('wp_webservice'), 'joghataysms'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'joghataysms.ir'); ?>
							</option>
							<option value="mediana" <?php selected(get_option('wp_webservice'), 'mediana'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'mediana.ir'); ?>
							</option>
							<option value="aradsms" <?php selected(get_option('wp_webservice'), 'aradsms'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'arad-sms.ir'); ?>
							</option>
							<option value="asiapayamak" <?php selected(get_option('wp_webservice'), 'asiapayamak'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'payamak.asia'); ?>
							</option>
							<option value="sharifpardazan" <?php selected(get_option('wp_webservice'), 'sharifpardazan'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), '2345.ir'); ?>
							</option>
							<option value="sarabsms" <?php selected(get_option('wp_webservice'), 'sarabsms'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'sarabsms.ir'); ?>
							</option>
							<option value="ponishasms" <?php selected(get_option('wp_webservice'), 'ponishasms'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'ponishasms.ir'); ?>
							</option>
							<option value="payamakalmas" <?php selected(get_option('wp_webservice'), 'payamakalmas'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'payamakalmas.ir'); ?>
							</option>
							<option value="sms" <?php selected(get_option('wp_webservice'), 'sms'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'sms.ir'); ?>
							</option>
							<option value="popaksms" <?php selected(get_option('wp_webservice'), 'popaksms'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'popaksms.ir'); ?>
							</option>
							<option value="novin1sms" <?php selected(get_option('wp_webservice'), 'novin1sms'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'novin1sms.ir'); ?>
							</option>
							<option value="hamyaarsms" <?php selected(get_option('wp_webservice'), 'hamyaarsms'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'hamyaarsms.ir'); ?>
							</option>
							<option value="matinsms" <?php selected(get_option('wp_webservice'), 'matinsms'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'smspanel.mat-in.ir'); ?>
							</option>
							<option value="iranspk" <?php selected(get_option('wp_webservice'), 'iranspk'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'iranspk.ir'); ?>
							</option>
							<option value="freepayamak" <?php selected(get_option('wp_webservice'), 'freepayamak'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'freepayamak.ir'); ?>
							</option>
							<option value="itpayamak" <?php selected(get_option('wp_webservice'), 'itpayamak'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'itpayamak.ir'); ?>
							</option>
							<option value="irsmsland" <?php selected(get_option('wp_webservice'), 'irsmsland'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'irsmsland.ir'); ?>
							</option>
							<option value="avalpayam" <?php selected(get_option('wp_webservice'), 'avalpayam'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'avalpayam.com'); ?>
							</option>
							<option value="smstoos" <?php selected(get_option('wp_webservice'), 'smstoos'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'smstoos.ir'); ?>
							</option>
						</optgroup>
						
						<optgroup label="<?php _e('Australia', 'wp-sms'); ?>">
							<option value="smsglobal" <?php selected(get_option('wp_webservice'), 'smsglobal'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'smsglobal.com'); ?>
							</option>
						</optgroup>
						
						<optgroup label="<?php _e('New Zealand', 'wp-sms'); ?>">
							<option value="unisender" <?php selected(get_option('wp_webservice'), 'unisender'); ?>>
								&nbsp;&nbsp;-&nbsp;
								<?php echo sprintf(__('Web Service (%s)', 'wp-sms'), 'unisender.com'); ?>
							</option>
						</optgroup>
						
						<!--Option information-->
						<option value="1" id="option-information"><?php _e('For more information about adding Web Service', 'wp-sms'); ?></option>
						<!--Option information-->
					</select>
					
					<?php if(!get_option('wp_webservice')) { ?>
					<p class="description"><?php echo sprintf(__('If you do not have a web service, <a href="%s" target="_blank">click here.</a>', 'wp-sms'), 'http://www.parandhost.com/sms/webservice-for-wordpress-sms-plugin/'); ?></p>
					<p class="description"><?php echo sprintf(__('If your Web service is not on the top list, <a href="%s" target="_blank">click here.</a>', 'wp-sms'), $sms_page['about']); ?></p>
					<?php } ?>
				</td>
			</tr>

			<?php if(get_option('wp_webservice')) { ?>
			<tr>
				<th><?php _e('Username', 'wp-sms'); ?>:</th>
				<td>
					<input type="text" dir="ltr" style="width: 200px;" name="wp_username" value="<?php echo get_option('wp_username'); ?>"/>
					<p class="description"><?php _e('Your username in', 'wp-sms'); ?>: <?php echo get_option('wp_webservice'); ?></p>
					
					<?php if(!get_option('wp_username')) { ?>
						<p class="register"><?php echo sprintf(__('If you do not have a username for this service <a href="%s">click here..</a>', 'wp-sms'), $sms->tariff) ?></p>
					<?php } ;?>
				</td>
			</tr>

			<tr>
				<th><?php _e('Password', 'wp-sms'); ?>:</th>
				<td>
					<input type="password" dir="ltr" style="width: 200px;" name="wp_password" value="<?php echo get_option('wp_password'); ?>"/>
					<p class="description"><?php _e('Your password in', 'wp-sms'); ?>: <?php echo get_option('wp_webservice'); ?></p>
					
					<?php if(!get_option('wp_password')) { ?>
						<p class="register"><?php echo sprintf(__('If you do not have a password for this service <a href="%s">click here..</a>', 'wp-sms'), $sms->tariff) ?></p>
					<?php } ?>
				</td>
			</tr>

			<tr>
				<th><?php _e('Number', 'wp-sms'); ?>:</th>
				<td>
					<input type="text" dir="ltr" style="width: 200px;" name="wp_number" value="<?php echo get_option('wp_number'); ?>"/>
					<p class="description"><?php _e('Your SMS sender number in', 'wp-sms'); ?>: <?php echo get_option('wp_webservice'); ?></p>
				</td>
			</tr>

			<tr>
				<th><?php _e('Credit', 'wp-sms'); ?>:</th>
				<td>
				<?php global $sms; echo $sms->GetCredit() . " " . $sms->unit; ?>
				</td>
			</tr>

			<tr>
				<th><?php _e('Status', 'wp-sms'); ?>:</th>
				<td>
					<?php if($sms->GetCredit() > 0) { ?>
						<img src="<?php echo WP_SMS_DIR_PLUGIN; ?>assets/images/1.png" alt="Active" align="absmiddle"/><span style="font-weight: bold;"><?php _e('Active', 'wp-sms'); ?></span>
					<?php } else { ?>
						<img src="<?php echo WP_SMS_DIR_PLUGIN; ?>assets/images/0.png" alt="Deactive" align="absmiddle"/><span style="font-weight: bold;"><?php _e('Deactive', 'wp-sms'); ?></span>
					<?php } ?>
				</td>
			</tr>
			<?php } ?>
			
			<tr>
				<td>
					<p class="submit">
						<input type="hidden" name="action" value="update" />
						<input type="hidden" name="page_options" value="wp_webservice,wp_username,wp_password,wp_number" />
						<input type="submit" class="button-primary" name="Submit" value="<?php _e('Update', 'wp-sms'); ?>" />
					</p>
				</td>
			</tr>
		</table>
	</form>	
</div>