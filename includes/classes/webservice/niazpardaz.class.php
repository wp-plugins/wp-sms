<?php
	class niazpardaz
	{
		private $wsdl_link = "http://sms.niazpardaz.com/post/send.asmx?wsdl";
		public $tariff = "http://www.niazpardaz.com/sms/SmsPrice.aspx";
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
			try
			{
				$client = new SoapClient($this->wsdl_link);
				$parameters['username'] = $this->user;
				$parameters['password'] = $this->pass;
				$parameters['from'] = $this->from;
				$parameters['to'] = $this->to;
				$parameters['text'] = $this->msg;
				$parameters['isflash'] = $this->isflash;
				$parameters['udh'] = "";
				$parameters['recId'] = array(0);
				$parameters['status'] = 0x0;
				return $client->SendSms($parameters)->SendSmsResult;
				echo $status;
			}
			catch(SoapFault $ex)
			{
				echo $ex->faultstring;
			}
		}

		function get_credit()
		{
			try
			{
				$client = new SoapClient($this->wsdl_link);
				return $client->GetCredit(array("username"=>$this->user,"password"=>$this->pass))->GetCreditResult;
			}
			catch(SoapFault $ex)
			{
				echo $ex->faultstring;
			}
		}
	}
?>