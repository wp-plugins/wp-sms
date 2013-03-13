<?php
	class persianSMS
	{
		private $wsdl_link = "http://persian-sms.com/API/SendSMS.asmx?WSDL";
		public $tariff = "http://www.persian-sms.com/";
		public $unitrial = false;
		public $unit;
		public $flash = "enable";
		public $user;
		public $pass;
		public $from;
		public $to;
		public $msg;
		public $api;
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
				$parameters['USERNAME']	= $this->user;
				$parameters['PASSWORD']	= $this->pass;
				$parameters['TO']	= $this->to;
				$parameters['FROM'] = $this->from;
				$parameters['TEXT'] = $this->msg;
				$parameters['API']	= $this->api;
				$parameters['API_CHANGE_ALLOW'] = 1;
				$parameters['FLASH']	= $this->isflash;
				$parameters['Internation']	= false;
				
				return $client->Send_Sms4($parameters)->Send_Sms4Result;
			}
			catch(SoapFault $ex)
			{
				return $ex->faultstring;
			}
		}

		public function get_credit()
		{
			try
			{
				$client = new SoapClient($this->wsdl_link);
				return $client->CHECK_CREDIT(array("USERNAME"=>$this->user,"PASSWORD"=>$this->pass))->CHECK_CREDITResult;
			}
			catch(SoapFault $ex)
			{
				return $ex->faultstring;
			}

		}
	}
?>