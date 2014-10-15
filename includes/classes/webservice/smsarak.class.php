<?php
	class smsarak extends WP_SMS {
		private $wsdl_link = "http://smsarak.ir/webservice/index.php?wsdl";
		public $tariff = "http://smsarak.ir/";
		public $unitrial = true;
		public $unit;
		public $flash = "disable";
		public $isflash = false;

		public function __construct() {
			parent::__construct();
			ini_set("soap.wsdl_cache_enabled", "0");
		}

		public function SendSMS() {
			$client = new SoapClient($this->wsdl_link);
			$result =  $client->multiSend($this->username, $this->password, $this->to, $this->from, array($this->msg));
			
			if($result['status'] == '0') {
				$this->InsertToDB($this->from, $this->msg, $this->to);
				$this->Hook('wp_sms_send', $result);
			}
			
			return $result;
		}

		public function GetCredit() {
			$client = new SoapClient($this->wsdl_link);
			$result =  $client->accountInfo($this->username, $this->password);
			
			return $result['balance'];
		}
	}
?>