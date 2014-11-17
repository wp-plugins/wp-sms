<script type="text/javascript">
	function openwin() {
		var url=document.form.wp_webservice.value;
		if(url==1) {
			document.location.href="<?php echo $sms_page['about']; ?>";
		}
	}
	
	jQuery(document).ready(function(){
		jQuery(".chosen-select").chosen();
	});
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
					<select name="wp_webservice" id="wp-webservice" class="chosen-select<?php echo is_rtl() == true? " chosen-rtl":""; ?>" onChange="javascript:openwin()">
						<option value=""><?php _e('Select your Web Service', 'wp-sms'); ?></option>
						
						<optgroup label="<?php _e('Iran', 'wp-sms'); ?>">
							<option value="parandhost" <?php selected(get_option('wp_webservice'), 'parandhost'); ?>>Parandhost.com</option>
							<option value="iransmspanel" <?php selected(get_option('wp_webservice'), 'iransmspanel'); ?>>iransmspanel.ir</option>
							<option value="hostiran" <?php selected(get_option('wp_webservice'), 'hostiran'); ?>>Hostiran.net</option>
							<option value="adpdigital" <?php selected(get_option('wp_webservice'), 'adpdigital'); ?>>adpdigital.com</option>
							<option value="smsde" <?php selected(get_option('wp_webservice'), 'smsde'); ?>>smsde.ir</option>
							<option value="payamakde" <?php selected(get_option('wp_webservice'), 'payamakde'); ?>>payamakde.ir</option>
							<option value="payameavval" <?php selected(get_option('wp_webservice'), 'payameavval'); ?>>payameavval.com</option>
							<option value="smsclick" <?php selected(get_option('wp_webservice'), 'smsclick'); ?>>smsclick.ir</option>
							<option value="persiansms" <?php selected(get_option('wp_webservice'), 'persiansms'); ?>>persiansms.com</option>
							<option value="ariaideh" <?php selected(get_option('wp_webservice'), 'ariaideh'); ?>>ariaideh.com</option>
							<option value="panizsms" <?php selected(get_option('wp_webservice'), 'panizsms'); ?>>panizsms.ir</option>
							<option value="sms_s" <?php selected(get_option('wp_webservice'), 'sms_s'); ?>>modiresms.com</option>
							<option value="sadat24" <?php selected(get_option('wp_webservice'), 'sadat24'); ?>>sadat24.ir</option>
							<option value="smscall" <?php selected(get_option('wp_webservice'), 'smscall'); ?>>smscall.ir</option>
							<option value="tablighsmsi" <?php selected(get_option('wp_webservice'), 'tablighsmsi'); ?>>tablighsmsi.com</option>
							<option value="paaz" <?php selected(get_option('wp_webservice'), 'paaz'); ?>>paaz.ir</option>
							<option value="textsms" <?php selected(get_option('wp_webservice'), 'textsms'); ?>>textsms.ir</option>
							<option value="jahanpayamak" <?php selected(get_option('wp_webservice'), 'jahanpayamak'); ?>>jahanpayamak.info</option>
							<option value="opilo" <?php selected(get_option('wp_webservice'), 'opilo'); ?>>opilo.com</option>
							<option value="barzinsms" <?php selected(get_option('wp_webservice'), 'barzinsms'); ?>>barzinsms.ir</option>
							<option value="smsmart" <?php selected(get_option('wp_webservice'), 'smsmart'); ?>>smsmart.info</option>
							<option value="imencms" <?php selected(get_option('wp_webservice'), 'imencms'); ?>>imencms.com</option>
							<option value="tcisms" <?php selected(get_option('wp_webservice'), 'tcisms'); ?>>tcisms.com</option>
							<option value="caffeweb" <?php selected(get_option('wp_webservice'), 'caffeweb'); ?>>caffeweb.com</option>
							<option value="nasrpayam" <?php selected(get_option('wp_webservice'), 'nasrpayam'); ?>>nasrPayam.ir</option>
							<option value="smsbartar" <?php selected(get_option('wp_webservice'), 'smsbartar'); ?>>sms-bartar.com</option>
							<option value="fayasms" <?php selected(get_option('wp_webservice'), 'fayasms'); ?>>fayasms.ir</option>
							<option value="payamresan" <?php selected(get_option('wp_webservice'), 'payamresan'); ?>>payam-resan.com</option>
							<option value="mdpanel" <?php selected(get_option('wp_webservice'), 'mdpanel'); ?>>ippanel.com</option>
							<option value="payameroz" <?php selected(get_option('wp_webservice'), 'payameroz'); ?>>payameroz.ir</option>
							<option value="niazpardaz" <?php selected(get_option('wp_webservice'), 'niazpardaz'); ?>>niazpardaz.com</option>
							<option value="hisms" <?php selected(get_option('wp_webservice'), 'hisms'); ?>>hi-sms.ir</option>
							<option value="joghataysms" <?php selected(get_option('wp_webservice'), 'joghataysms'); ?>>joghataysms.ir</option>
							<option value="mediana" <?php selected(get_option('wp_webservice'), 'mediana'); ?>>mediana.ir</option>
							<option value="aradsms" <?php selected(get_option('wp_webservice'), 'aradsms'); ?>>arad-sms.ir</option>
							<option value="asiapayamak" <?php selected(get_option('wp_webservice'), 'asiapayamak'); ?>>payamak.asia</option>
							<option value="sharifpardazan" <?php selected(get_option('wp_webservice'), 'sharifpardazan'); ?>>2345.ir</option>
							<option value="sarabsms" <?php selected(get_option('wp_webservice'), 'sarabsms'); ?>>sarabsms.ir</option>
							<option value="ponishasms" <?php selected(get_option('wp_webservice'), 'ponishasms'); ?>>ponishasms.ir</option>
							<option value="payamakalmas" <?php selected(get_option('wp_webservice'), 'payamakalmas'); ?>>payamakalmas.ir</option>
							<option value="sms" <?php selected(get_option('wp_webservice'), 'sms'); ?>>sms.ir</option>
							<option value="popaksms" <?php selected(get_option('wp_webservice'), 'popaksms'); ?>>popaksms.ir</option>
							<option value="novin1sms" <?php selected(get_option('wp_webservice'), 'novin1sms'); ?>>novin1sms.ir</option>
							<option value="hamyaarsms" <?php selected(get_option('wp_webservice'), 'hamyaarsms'); ?>>hamyaarsms.ir</option>
							<option value="matinsms" <?php selected(get_option('wp_webservice'), 'matinsms'); ?>>smspanel.mat-in.ir</option>
							<option value="iranspk" <?php selected(get_option('wp_webservice'), 'iranspk'); ?>>iranspk.ir</option>
							<option value="freepayamak" <?php selected(get_option('wp_webservice'), 'freepayamak'); ?>>freepayamak.ir</option>
							<option value="itpayamak" <?php selected(get_option('wp_webservice'), 'itpayamak'); ?>>itpayamak.ir</option>
							<option value="irsmsland" <?php selected(get_option('wp_webservice'), 'irsmsland'); ?>>irsmsland.ir</option>
							<option value="avalpayam" <?php selected(get_option('wp_webservice'), 'avalpayam'); ?>>avalpayam.com</option>
							<option value="smstoos" <?php selected(get_option('wp_webservice'), 'smstoos'); ?>>smstoos.ir</option>
							<option value="smsmaster" <?php selected(get_option('wp_webservice'), 'smsmaster'); ?>>smsmaster.ir</option>
							<option value="ssmss" <?php selected(get_option('wp_webservice'), 'ssmss'); ?>>ssmss.ir</option>
							<option value="isun" <?php selected(get_option('wp_webservice'), 'isun'); ?>>isun.company</option>
							<option value="idehpayam" <?php selected(get_option('wp_webservice'), 'idehpayam'); ?>>idehpayam.com</option>
							<option value="smsarak" <?php selected(get_option('wp_webservice'), 'smsarak'); ?>>smsarak.ir</option>
							<option value="novinpayamak" <?php selected(get_option('wp_webservice'), 'novinpayamak'); ?>>novinpayamak.com</option>
						</optgroup>
						
						<optgroup label="<?php _e('Australia', 'wp-sms'); ?>">
							<option value="smsglobal" <?php selected(get_option('wp_webservice'), 'smsglobal'); ?>>smsglobal.com</option>
						</optgroup>
						
						<optgroup label="<?php _e('New Zealand', 'wp-sms'); ?>">
							<option value="unisender" <?php selected(get_option('wp_webservice'), 'unisender'); ?>>unisender.com</option>
						</optgroup>
						
						<optgroup label="<?php _e('Austria', 'wp-sms'); ?>">
							<option value="smsgateway" <?php selected(get_option('wp_webservice'), 'smsgateway'); ?>>sms-gateway.at</option>
						</optgroup>
						
						<optgroup label="<?php _e('Pakistan', 'wp-sms'); ?>">
							<option value="difaan" <?php selected(get_option('wp_webservice'), 'difaan'); ?>>difaan</option>
						</optgroup>
						
						<optgroup label="<?php _e('Indian', 'wp-sms'); ?>">
							<option value="shreesms" <?php selected(get_option('wp_webservice'), 'shreesms'); ?>>shreesms.net</option>
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
			
			<?php if($sms->has_key) { ?>
			<tr>
				<th><?php _e('API/Key', 'wp-sms'); ?>:</th>
				<td>
					<input type="text" dir="ltr" style="width: 200px;" name="wps_key" value="<?php echo get_option('wps_key'); ?>"/>
					<p class="description"><?php _e('Your API Key in', 'wp-sms'); ?>: <?php echo get_option('wp_webservice'); ?></p>
				</td>
			</tr>
			<?php } ?>

			<tr>
				<th><?php _e('Number', 'wp-sms'); ?>:</th>
				<td>
					<input type="text" dir="ltr" style="width: 200px;" name="wp_number" value="<?php echo get_option('wp_number'); ?>"/>
					<p class="description"><?php _e('Your SMS sender number in', 'wp-sms'); ?>: <?php echo get_option('wp_webservice'); ?></p>
				</td>
			</tr>
			
			<?php if($sms->GetCredit() > 0) { ?>
			<tr>
				<th><?php _e('Status', 'wp-sms'); ?>:</th>
				<td>
					<img src="<?php echo WP_SMS_DIR_PLUGIN; ?>assets/images/1.png" alt="Active" align="absmiddle"/><span style="font-weight: bold;"><?php _e('Active', 'wp-sms'); ?></span>
				</td>
			</tr>
			
			<tr>
				<th><?php _e('Credit', 'wp-sms'); ?>:</th>
				<td>
					<?php global $sms; echo $sms->GetCredit() . " " . $sms->unit; ?>
				</td>
			</tr>
			<?php } else { ?>
			<tr>
				<th><?php _e('Status', 'wp-sms'); ?>:</th>
				<td>
					<img src="<?php echo WP_SMS_DIR_PLUGIN; ?>assets/images/0.png" alt="Deactive" align="absmiddle"/><span style="font-weight: bold;"><?php _e('Deactive', 'wp-sms'); ?></span>
				</td>
			</tr>
			<?php } ?>
			<?php } ?>
			
			<tr>
				<td>
					<p class="submit">
						<input type="hidden" name="action" value="update" />
						<input type="hidden" name="page_options" value="wp_webservice,wp_username,wp_password,wps_key,wp_number" />
						<input type="submit" class="button-primary" name="Submit" value="<?php _e('Update', 'wp-sms'); ?>" />
					</p>
				</td>
			</tr>
		</table>
	</form>	
</div>