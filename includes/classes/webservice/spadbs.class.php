<?php
	class spadbs extends WP_SMS {
		private $wsdl_link = "http://www.sms.spadbs.ir/webservice-win/index.php?wsdl";
		private $client = null;
		public $tariff = "http://spadsms.ir/";
		public $unitrial = true;
		public $unit;
		public $flash = "enable";
		public $isflash = false;

		public function __construct() {
			parent::__construct();
			$this->validateNumber = "09xxxxxxxx";
		}

		public function SendSMS() {
			$client = new SoapClient($this->wsdl_link);
			$result = $client->send_multiple($this->username, $this->password, $this->to, $this->from, $this->msg);
			
			if($result) {
				$this->InsertToDB($this->from, $this->msg, $this->to);
				$this->Hook('wp_sms_send', $result);
			}
			
			return $result;
		}

		public function GetCredit() {
			if(!$this->username and !$this->password)
				return;
			
			$client = new SoapClient($this->wsdl_link);
			$result = $client->get_credit($this->username, $this->password);
			return $result;
		}
	}
?>