<?php
	class imencms
	{
		private $wsdl_link = "http://www.imencms.com/SMS/SMS.asmx?wsdl";
		public $tariff = "http://www.imencms.com/sms/";
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
			
			$result = $client->SendSMS( array('MobileNo' => $this->to, 'SMSText' => $this->msg, 'AcountID' => $this->pass, 'LineNo' => $this->from) );
			
			return $result->Send_x0020_One_x0020_SMSResult;
		}

		function get_credit() {
		
			$client = new SoapClient($this->wsdl_link);

			$result = $client->GetCredit( array('AcountID' => $this->pass) );

			return $result->GetCreditResult;
		}
	}
?>