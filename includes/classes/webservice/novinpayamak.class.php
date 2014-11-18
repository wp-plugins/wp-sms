<?php
	class novinpayamak extends WP_SMS {
		private $wsdl_link = "http://www.novinpayamak.com/services/SMSBox/wsdl";
		public $tariff = "http://www.smscall.ir/?page_id=63";
		public $unitrial = true;
		public $unit;
		public $flash = "enable";
		public $isflash = false;

		public function __construct() {
			parent::__construct();
			ini_set("soap.wsdl_cache_enabled", "0");
		}

		public function SendSMS() {
			$client = new SoapClient($this->wsdl_link, array('encoding' => 'UTF-8'));
			
			$result = $client->Send(
				array(
					'Auth'			=> array('number' => $this->from, 'pass' => $this->password),
					'Recipients'	=> $this->to,
					'Message'		=> array($this->msg),
					'Flash'			=> $this->isflash
				)
			);
			
			if($result->Status != 1000)
				return false;
			
			if($result) {
				$this->InsertToDB($this->from, $this->msg, $this->to);
				$this->Hook('wp_sms_send', $result);
			}
			
			return $result;
		}

		public function GetCredit() {
			$client = new SoapClient('http://www.novinpayamak.com/services/CISGate/wsdl', array('encoding' => 'UTF-8'));
			
			$result = $client->CheckRealCredit(array('Auth' => array('email' => $this->username, 'password' => $this->password)));
			
			if($result->Status != 1000)
				return false;
			
			return $result->Credit;
		}
	}
?>