<?php
	class adpdigital extends WP_SMS {
		private $wsdl_link = "http://ws2.adpdigital.com/url/";
		public $tariff = "http://adpdigital.com/services/";
		public $unitrial = true;
		public $unit;
		public $flash = "disable";
		public $isflash = false;

		public function __construct() {
			parent::__construct();
			ini_set("soap.wsdl_cache_enabled", "0");
		}

		public function SendSMS() {
			$to = str_replace("09", "989", implode($this->to, ","));
			
			$result = file_get_contents("{$this->wsdl_link}send?username={$this->username}&password={$this->password}&dstaddress={$to}&body={$this->msg}&clientid={$this->from}&type=text&unicode=1");
			
			if( strstr($result, 'ERR') ) {
				return 0;
			} else {
				$this->InsertToDB($this->from, $this->msg, $this->to);
				$this->Hook('wp_sms_send', $result);
				
				return preg_replace('/[^0-9]/', '', $result);
			}
		}

		public function GetCredit() {
			$result = file_get_contents("{$this->wsdl_link}balance?username={$this->username}&password={$this->password}&facility=send");
			
			if( strstr($result, 'ERR') ) {
				return 0;
			} else {
				return preg_replace('/[^0-9]/', '', $result);
			}
		}
	}
?>