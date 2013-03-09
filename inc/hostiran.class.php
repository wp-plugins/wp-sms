<?php
	class hostiran
	{
		private $wsdl_link = "http://sms.hostiran.net/webservice/?WSDL";
		public $tariff = "http://sms.hostiran.net";
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