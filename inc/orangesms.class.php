<?php
	class orangesms
	{
		private $wsdl_link = "http://www.orangesms.net/webservice/smsService.php?wsdl";
		public $tariff = "http://www.orangesms.net/fullmode/register.html";
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
			$receiver = array();
			foreach($this->to as $number)
			{
				$receiver[] = "$number";
			}
			$result = new SoapClient($this->wsdl_link);
			return $result->send_sms($this->user, $this->pass, $this->from, implode($receiver, ","), $this->msg);
		}

		function get_credit()
		{
			$result = new SoapClient($this->wsdl_link);
			return $result->sms_credit($this->user, $this->pass);
		}
	}
?>