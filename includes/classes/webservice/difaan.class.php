<?php
	class difaan extends WP_SMS {
		private $wsdl_link = "http://119.152.247.218:9710/";
		public $tariff = "http://119.152.247.218:9710/";
		public $unitrial = false;
		public $unit;
		public $flash = "enable";
		public $isflash = false;
		
		public function __construct() {
			parent::__construct();
		}
		
		public function SendSMS() {
			
			$msg = urlencode($this->msg);
			
			foreach($this->to as $number) {
				$result = file_get_contents("{$this->wsdl_link}http/send-message?username={$this->username}&password={$this->password}&to={$number}&message-type=sms.automatic&message={$msg}");
			}
			
			if ($result) {
				$this->InsertToDB($this->from, $this->msg, $this->to);
				$this->Hook('wp_sms_send', $result);
			}
			
			return $result;
		}
		
		public function GetCredit() {
			if(fsockopen(preg_replace('#^https?://#', '', $this->wsdl_link), 80))
				return 1;
			else
				return false;
		}
	}
?>