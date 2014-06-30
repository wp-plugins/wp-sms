<?php
	class matinsms extends WP_SMS {
		private $wsdl_link = "http://smspanel.mat-in.ir/webservice/index.php?wsdl";
		public $tariff = "http://smspanel.mat-in.ir";
		public $unitrial = true;
		public $unit;
		public $flash = "enable";
		public $isflash = false;

		public function __construct() {
			parent::__construct();
			ini_set("soap.wsdl_cache_enabled", "0");
		}

		public function SendSMS() {
			$client = new SoapClient($this->wsdl_link);
			
			$result = $client->sendsms($this->username, $this->password, $this->to, $this->from, $this->msg);
			
			if($result) {
				$this->InsertToDB($this->from, $this->msg, $this->to);
				$this->Hook('wp_sms_send', $result);
			}
			
			return $result;
		}

		public function GetCredit() {
			$client = new SoapClient($this->wsdl_link);
			
			$result = $client->balance($this->username, $this->password);
			
			return $result;
		}
	}
?>