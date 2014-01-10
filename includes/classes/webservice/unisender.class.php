<?php
	class unisender
	{
		private $wsdl_link = "http://api.unisender.com/ru/api/";
		public $tariff = "http://www.unisender.com/en/prices/";
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
			
		}

		function send_sms() {
			
			$to = implode($this->to, ",");
			
			$sms_text = iconv('cp1251', 'utf-8',"salam");
			
			$POST = array (
				'api_key'	=> $this->pass,
				'phone'		=> $to,
				'sender'	=> $this->from,
				'text'		=> $this->msg
			);
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $POST);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_URL, "{$this->wsdl_link}sendSms?format=json");
			$result = curl_exec($ch);

			if ($result) {
				$jsonObj = json_decode($result);
				
				if(null===$jsonObj) {
					echo "Invalid JSON";
				} elseif(!empty($jsonObj->error)) {
					echo "An error occured: " . $jsonObj->error . "(code: " . $jsonObj->code . ")";
				} else {
					echo "SMS message is sent. Message id " . $jsonObj->result[0]->sms_id;
					
					return true;
				}
			} else {
				echo "API access error";
			}
		}

		function get_credit() {
		
			$json = file_get_contents("{$this->wsdl_link}getUserInfo?format=json&api_key={$this->pass}&login={$this->user}");
			
			$result = json_decode($json, true);
			
			if( $result['code'] == 'unspecified' )
				return false;
			
			return $result['result']['balance'];
		}
	}
?>