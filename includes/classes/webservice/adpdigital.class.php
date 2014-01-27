<?php
	class adpdigital
	{
		private $wsdl_link = "http://ws2.adpdigital.com/url/";
		public $tariff = "http://adpdigital.com/services/";
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
			$to = str_replace("09", "989", implode($this->to, ","));
			
			$result = file_get_contents("{$this->wsdl_link}send?username={$this->user}&password={$this->pass}&dstaddress={$to}&body={$this->msg}&clientid={$this->from}&type=text&unicode=1");
			
			if( strstr($result, 'ERR') ) {
				return 0;
			} else {
				return preg_replace('/[^0-9]/', '', $result);
			}
		}

		function get_credit()
		{
			$result = file_get_contents("{$this->wsdl_link}balance?username={$this->user}&password={$this->pass}&facility=send");
			
			if( strstr($result, 'ERR') ) {
				return 0;
			} else {
				return preg_replace('/[^0-9]/', '', $result);
			}
		}
	}
?>