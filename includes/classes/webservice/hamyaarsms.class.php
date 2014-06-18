<?php
	class hamyaarsms extends WP_SMS {
		private $wsdl_link = "http://www.hamyaarsms.ir/webservice/smsService.php?wsdl";
		public $tariff = "http://www.hamyaarsms.ir/";
		public $unitrial = true;
		public $unit;
		public $flash = "disable";
		public $isflash = false;

		public function __construct() {
			parent::__construct();
			ini_set("soap.wsdl_cache_enabled", "0");
		}

		public function SendSMS() {
			$receiver = array();
			foreach($this->to as $number) {
				$receiver[] = "$number";
			}
			$client = new SoapClient($this->wsdl_link);
			$result = $client->send_sms($this->username, $this->password, $this->from, implode($receiver, ","), $this->msg);
			
			if($result) {
				$this->InsertToDB($this->from, $this->msg, $this->to);
				$this->Hook('wp_sms_send', $result);
			}
			
			return $result;
		}

		public function GetCredit() {
			$client = new SoapClient($this->wsdl_link);
			return $client->sms_credit($this->username, $this->password);
		}
	}
?>