<?php
	class difaan extends WP_SMS {
		private $wsdl_link = "http://csmsplus.mobilinkworld.com/";
		public $tariff = "http://csmsplus.mobilinkworld.com/";
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
				//$result = file_get_contents("{$this->wsdl_link}http/send-message?username={$this->username}&password={$this->password}&to={$number}&message-type=sms.automatic&message={$msg}");
				$result = file_get_contents("{$this->wsdl_link}sendsms_url.html?login={$this->username}&pass={$this->password}&from={$this->from}&to={$number}&msg={$msg}");
			}
			
			if ($result) {
				$this->InsertToDB($this->from, $this->msg, $this->to);
				$this->Hook('wp_sms_send', $result);
			}
			
			return $result;
		}
		
		public function GetCredit() {
			return 1;
		}
	}
?>