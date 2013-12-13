<?php
	class smsglobal
	{
		private $wsdl_link = "http://www.smsglobal.com/mobileworks/soapserver.php?wsdl";
		public $tariff = "http://www.smsglobal.com/global/en/sms/pricing.php";
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
			
			$validation_login = $client->apiValidateLogin($this->user, $this->pass);
			
			$xml_praser = xml_parser_create();
			xml_parse_into_struct($xml_praser, $validation_login, $xml_data, $xml_index);
			xml_parser_free($xml_praser);
			$ticket_id = $xml_data[$xml_index['TICKET'][0]]['value'];
	
			$result = $client->apiSendSms($ticket_id, $this->from, implode(',', $this->to), $this->msg, 'text', '0', '0');
			
			return $result;
		}

		function get_credit() {
		
			$client = new SoapClient($this->wsdl_link);
			
			$validation_login = $client->apiValidateLogin($this->user, $this->pass);
			
			$xml_praser = xml_parser_create();
			xml_parse_into_struct($xml_praser, $validation_login, $xml_data, $xml_index);
			xml_parser_free($xml_praser);
			$ticket_id = $xml_data[$xml_index['TICKET'][0]]['value'];
			
			$credit = $client->apiBalanceCheck($ticket_id, 'IR');
			
			$xml_credit = simplexml_load_string($credit);
	
			return strstr($xml_credit->credit, '.', true);
		}
	}
?>