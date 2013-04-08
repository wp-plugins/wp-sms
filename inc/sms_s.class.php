<?php
	class sms_s
	{
		private $wsdl_link = "http://webservice.smscall.ir/index.php?wsdl";
		public $tariff = "http://www.smscall.ir/?page_id=63";
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
			
			return $client->Send_Group_SMS($this->user, $this->pass, implode(',', $this->to), $this->msg, $this->from, 1);
		}

		function get_credit() {
		
			$client = new SoapClient($this->wsdl_link);
			
			return $client->CREDIT_LINESMS($this->user, $this->pass, $this->from);
		}
	}
?>