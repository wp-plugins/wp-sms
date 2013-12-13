<?php
	class smsbartar
	{
		private $wsdl_link = "http://sms.sms-bartar.com/webservice/?WSDL";
		public $tariff = "http://www.sms-bartar.com/%D9%BE%D9%86%D9%84-%D8%A7%D8%B3-%D8%A7%D9%85-%D8%A7%D8%B3-%D8%AB%D8%A7%D8%A8%D8%AA";
		public $unitrial = true;
		public $unit;
		public $flash = "disable";
		public $user;
		public $pass;
		public $from;
		public $to;
		public $msg;
		public $isflash = false;

		function __construct()
		{
			ini_set("soap.wsdl_cache_enabled", "0");
		}

		function send_sms()
		{
			$options = array('login' => $this->user, 'password' => $this->pass);
			$client = new SoapClient($this->wsdl_link, $options);

			$result = $client->sendToMany($this->to, $this->msg, $this->from);
			
			return $result;
		}

		function get_credit()
		{
			$options = array('login' => $this->user, 'password' => $this->pass);
			$client = new SoapClient($this->wsdl_link, $options);

			try
			{
				$credit = $client->accountInfo();
				return $credit->remaining;
			}

			catch (SoapFault $sf)
			{
				print $sf->faultcode."\n";
				print $sf->faultstring."\n";
			}
		}
	}
?>