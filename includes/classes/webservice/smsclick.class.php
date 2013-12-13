<?php
	class smsclick 
	{
		private $wsdl_link = "http://smsclick.ir/post/send.asmx?wsdl";
		public $tariff = "http://smsclick.info/register";
		public $unitrial = true;
		public $unit;
		public $flash = "disable";
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
				$parameters['username'] = $this->user;
				$parameters['password'] = $this->pass;
				$parameters['from'] = $this->from;
				$parameters['to'] = $this->to;
				$parameters['text'] = $this->msg;
				$parameters['isflash'] = false;
				$parameters['udh'] = "";
				$parameters['recId'] = array(0);
				$parameters['status'] = 0x0;
			
			$result= $client->SendSms($parameters);
			
			return $result;
		}

		function get_credit() {
			$client = new SoapClient($this->wsdl_link);
			
			$result = $client->GetCredit(array('username' => $this->user, 'password' => $this->pass));

			return $result->GetCreditResult;
		}
	}
?>