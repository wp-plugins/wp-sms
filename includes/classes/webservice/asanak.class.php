<?php
	class asanak extends WP_SMS {
		private $wsdl_link = "http://ws.asanak.ir:8082/services/CompositeSmsGateway?wsdl";
		public $tariff = "http://asanak.ir/";
		public $unitrial = false;
		public $unit;
		public $flash = "enable";
		public $isflash = false;

		function __construct() {
			parent::__construct();
			$this->validateNumber = "09xxxxxxxx";
			ini_set("soap.wsdl_cache_enabled", "0");
		}
		
		function SendSMS() {
			$client = new SoapClient($this->wsdl_link);
			$result = $client->sendSms(array('userCredential'=>array('username' => $this->user, 'password' => $this->pass),'srcAddresses' => $this->from, 'destAddresses' => $this->to, 'msgBody' => $this->msg, 'msgEncoding' => 8));
			return $result;
		}
		
		function GetCredit() {
			try {
				$client = new SoapClient($this->wsdl_link);
				
				$result = $client->getUserCredit(array('userCredential' => array('username' => $this->user, 'password' => $this->pass)));
				return $result->return->credit;

			} catch (SoapFault $ex) {
				exit($ex->faultstring);
			}
		}
	}