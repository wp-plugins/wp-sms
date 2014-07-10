<?php
	class irsmsland extends WP_SMS {
		private $wsdl_link = "http://sms.irsmsland.ir/webservice/wsdl.wsdl";
		public $tariff = "http://irsmsland.ir";
		public $unitrial = false;
		public $unit;
		public $flash = "enable";
		public $isflash = false;
		
		public function __construct() {
			parent::__construct();
		}
		
		public function SendSMS() {
			$client = new SoapClient($this->wsdl_link);
			$result = $client->send($this->username, $this->password, $this->to, $this->from, $this->msg);
			
			if($result) {
				$this->InsertToDB($this->from, $this->msg, $this->to);
				$this->Hook('wp_sms_send', $result);
			}
			
			return $result;
		}
		
		public function GetCredit() {
			$client = new SoapClient($this->wsdl_link);
			return $client->getCredit($this->username, $this->password);
		}
	}
?>