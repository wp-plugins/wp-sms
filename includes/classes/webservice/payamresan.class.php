<?php
	class payamresan
	{
		private $wsdl_link = "http://www.payam-resan.com/";
		public $tariff = "http://www.payam-resan.com/CMS/";
		public $unitrial = false;
		public $unit;
		public $flash = "enable";
		public $user;
		public $pass;
		public $from;
		public $to;
		public $msg;
		public $isflash = false;
		
		public function send_sms() {
		
			$to = implode(',', $this->to);
			
			$message = urlencode($this->msg);
			
			$client = file_get_contents("{$this->wsdl_link}APISend.aspx?Username={$this->user}&Password={$this->pass}&From={$this->from}&To={$to}&Text={$message}");
			
			return $client;
		}

		public function get_credit() {
		
			$client = file_get_contents("{$this->wsdl_link}Credit.aspx?Username={$this->user}&Password={$this->pass}");
			
			if( $client == 'ERR' )
				return false;
			
			return $client;
		}
	}
?>