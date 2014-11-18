<?php
	class dot4all extends WP_SMS {
		private $wsdl_link = "http://sms.dot4all.it/sms/";
		public $tariff = "http://sms.dot4all.it/";
		public $unitrial = false;
		public $unit;
		public $flash = "enable";
		public $isflash = false;
		
		public function __construct() {
			parent::__construct();
		}
		
		public function SendSMS() {
			$to = implode(',', $this->to);
			$msg = urlencode($this->msg);
			
			$result = file_get_contents("{$this->wsdl_link}batch.php?user={$this->username}&pass={$this->password}&rcpt={$to}&data={$msg}&sender={$this->from}&qty=n");
			
			if ($result == 1) {
				$this->InsertToDB($this->from, $this->msg, $this->to);
				$this->Hook('wp_sms_send', $result);
			}
			
			return $result;
		}
		
		public function GetCredit() {
			$result = file_get_contents("{$this->wsdl_link}credit.php?user={$this->username}&pass={$this->password}");
			
			if(strchr($result, 'OK')) {
				return preg_replace('/[^0-9]+/', '', $result);
			} else {
				return false;
			}
		}
	}
?>