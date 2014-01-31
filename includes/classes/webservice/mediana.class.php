<?php
	class mediana
	{
		private $wsdl_link = "http://185.4.28.180/class/sms/wssimple/server.php?wsdl";
		private $client = null;
		public $tariff = "http://mediana.ir/";
		public $unitrial = true;
		public $unit;
		public $flash = "enable";
		public $user;
		public $pass;
		public $from;
		public $to;
		public $msg;
		public $isflash = false;

		function __construct()
		{
			include_once dirname( __FILE__ ) . '/../nusoap.class.php';
			$this->client = new nusoap_client($this->wsdl_link);
			
			$this->client->soap_defencoding = 'UTF-8';
			$this->client->decode_utf8 = true;
		}

		function send_sms()
		{
			$result = $this->client->call("SendSMS", array('Username' => $this->user, 'Password' => $this->pass, 'SenderNumber' => $this->from, 'RecipientNumbers' => $this->to, 'Message' => $this->msg, 'Type' => 'normal'));
			
			print_r( $result );
		}

		function get_credit()
		{
			$result = $this->client->call("GetCredit", array('Username' => $this->user, 'Password' => $this->pass));
			
			return $result;
		}
	}
?>