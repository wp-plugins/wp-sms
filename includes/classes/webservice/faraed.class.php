<?php
	class faraed extends WP_SMS {
		private $wsdl_link = "http://panelesms.net/SendMessage.ashx";
		public $tariff = "http://smspanel.faraed.com/";
		public $unitrial = false;
		public $unit;
		public $flash = "disable";
		public $isflash = false;

		public function __construct() {
			parent::__construct();
			$this->validateNumber = "09xxxxxxxx";
			
			ini_set("soap.wsdl_cache_enabled", "0");
		}

		public function SendSMS() {
			$msg = urlencode($this->msg);
			
			foreach($this->to as $number) {
				$result = file_get_contents("{$this->wsdl_link}?user={$this->username}&pass={$this->password}&lineNo={$this->from}&to={$number}&text={$msg}");
			}
			
			if ($result == 'ok') {
				$this->InsertToDB($this->from, $this->msg, $this->to);
				$this->Hook('wp_sms_send', $result);
				
				return true;
			}
		}

		public function GetCredit() {
			if(!$this->username and !$this->password)
				return false;
			
			return 1;
		}
	}