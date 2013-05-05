<?php
    class opilo
    {
        private $wsdl_link = "http://webservice.opilo.com/WS/";
        public $tariff = "http://www.opilo.com/?mref=wp";
        public $unitrial = false;
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
            //ini_set("soap.wsdl_cache_enabled", "0");
        }

        function send_sms()
        {
			$url = $this->wsdl_link .
			"httpsend/?username=" . $this->user
			. "&password=" . $this->pass . 
			"&from=" .$this->from .
			"&to=" .$this->to 
			. "&text=" . urlencode($this->msg)
			. "&flash=" . $this->isflash;

			$response = file($url);

			if(!is_numeric($response)) {
				echo "Error"; 
				return;
			}

			if( strlen ($response) > 2){
				return $response;
			} else {
				echo  "System Error n:" .$response;
			}
        }

        function get_credit()
        {
			$url=$this->wsdl_link . "getCredit/?username=" . $this->user
			."&password=" . $this->pass;
			$response = file($url);
			
			if(strstr($response,"Error")){
				echo "System Error n:" . $response;
				return;
			}

			return $response;
        }
}