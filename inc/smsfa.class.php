<?php
	class smsfa {
		private $wsdl_link = "http://www.smsfa.co/API/Send.asmx?WSDL";
		public $tariff = "http://www.smsfa.us/tarefeha.html";
		public $unitrial = false;
		public $unit;
		public $flash = "enable";
		public $user;
		public $pass;
		public $from;
		public $to;
		public $msg;
		public $isflash = false;

		function __construct() {
			ini_set("soap.wsdl_cache_enabled", "0");
		}

		function send_sms() {
			$client = new SoapClient($this->wsdl_link);
			
			$result= $client->SendSms(array(
				'username'	=> $this->user,
				'password'	=> $this->pass,
				'from'		=> $this->from,
				'to'		=> $this->to,
				'text'		=> $this->msg,
				'flash'		=> false,
				'udh'		=> ''
			));
			
			return $result;
		}

		function get_credit() {
			$client = new SoapClient($this->wsdl_link);

			$result = $client->Credit(array('username' => $this->user, 'password' => $this->pass));

			return $result->CreditResult;
		}
	}
?>