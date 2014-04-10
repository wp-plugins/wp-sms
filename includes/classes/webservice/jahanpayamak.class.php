<?php
	class jahanpayamak {
		private $wsdl_link = "http://jahanpayamak.ir/API/SendSMS.asmx?WSDL";
		public $tariff = "http://www.jahanpayamak.info/";
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

		function __construct() {
			ini_set("soap.wsdl_cache_enabled", "0");
		}

		function send_sms() {
		
			if( substr($this->from, 0, 4) == '1000' ) {
				$this->api = 11;
			} else if( substr($this->from, 0, 4) == '2000' ) {
				$this->api = 22;
			} else if( substr($this->from, 0, 4) == '3000' ) {
				$this->api = 13;
			}
			
			try {
				$client = new SoapClient($this->wsdl_link);
				
				$parameters['USERNAME']	= $this->user;
				$parameters['PASSWORD']	= $this->pass;
				$parameters['TO'] = implode(',', $this->to);
				$parameters['FROM'] = $this->from;
				$parameters['TEXT'] = $this->msg;
				$parameters['API']	= $this->api;
				$parameters['API_CHANGE_ALLOW'] = 1;
				$parameters['FLASH'] = $this->isflash;
				$parameters['Internation']	= false;
				
				return $client->Send_Sms4($parameters)->Send_Sms4Result;
				
			} catch(SoapFault $ex) {
				return $ex->faultstring;
			}
		}

		public function get_credit() {
			try {
				$client = new SoapClient($this->wsdl_link);
				return $client->CHECK_CREDIT(array("USERNAME"=>$this->user,"PASSWORD"=>$this->pass))->CHECK_CREDITResult;
			} catch(SoapFault $ex) {
				return $ex->faultstring;
			}

		}
	}
?>