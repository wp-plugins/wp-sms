<?php
	class sms77 extends WP_SMS {
		private $wsdl_link = "https://gateway.sms77.de/";
		public $tariff = "http://www.sms77.de";
		public $unitrial = false;
		public $unit;
		public $flash = "enable";
		public $isflash = false;
		
		public function __construct() {
			parent::__construct();
			$this->validateNumber = "0049171999999999 or 0171999999999 or 49171999999999";
		}
		
		public function SendSMS() {
			$result = @file_get_contents($this->wsdl_link.'?u='.urlencode($this->username).'&p='.urlencode($this->password).'&text='.urlencode($this->msg).'&to='.implode($this->to, ",").'&type=quality&from='.urlencode($this->from));
			
			if($result == '100') {
				$this->InsertToDB($this->from, $this->msg, $this->to);
				$this->Hook('wp_sms_send', $result);
				
				return $result;
			}
		}
		
		public function GetCredit() {
			if(!$this->username && !$this->password) return;
			$result = @file_get_contents($this->wsdl_link.'balance.php?u='.urlencode($this->username).'&p='.urlencode($this->password));
			
			return $result;
		}
	}