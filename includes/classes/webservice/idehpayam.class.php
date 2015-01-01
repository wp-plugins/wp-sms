<?php
	class idehpayam extends WP_SMS {
		private $wsdl_link = "http://www.idehpayam.com/WsSms.asmx?WSDL";
		public $tariff = "http://www.idehpayam.com";
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
			
			$value = array(
				'username'	=> $this->username,
				'password'	=> $this->password,
				'to'		=> implode(',', $this->to),
				'text'		=> $this->msg,
				'from'		=> $this->from,
				'api'		=> '22'
			);
			
			$result = $client->sendsms($value);
			
			if($result->sendsmsResult->long) {
				$this->InsertToDB($this->from, $this->msg, $this->to);
				$this->Hook('wp_sms_send', $result);
			}
			
			return $result->sendsmsResult->long;
		}

		public function GetCredit() {
			$client = new SoapClient($this->wsdl_link);
			$result = $client->Credites(array('username' => $this->username, 'password' => $this->password));
			
			return $result->CreditesResult;
		}
	}
?>