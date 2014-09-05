<?php
	class smsgateway extends WP_SMS {
		private $wsdl_link = "https://www.sms-gateway.at/sms/";
		public $tariff = "https://www.sms-gateway.at/";
		public $unitrial = false;
		public $unit;
		public $flash = "enable";
		public $isflash = false;
		
		public function __construct() {
			parent::__construct();
		}
		
		public function SendSMS() {
			
			$to = implode(',', $this->to);
			
			$msg = urlencode($this->msg);
			
			$result = file_get_contents("{$this->wsdl_link}sendsms.php?username={$this->username}&absender={$this->from}&validpass={$this->password}&number={$to}&message={$msg}&receipt=1");
			
			if($result) {
				$this->InsertToDB($this->from, $this->msg, $this->to);
				$this->Hook('wp_sms_send', $result);
			}
			
			return $result;
			
		}
		
		public function GetCredit() {
			return true;
		}
	}
?>