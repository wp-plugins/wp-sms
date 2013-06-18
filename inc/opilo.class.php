<?php
    class opilo
    {
        private $wsdl_link = "http://webservice.opilo.com/WS/";
        public $tariff = "http://cms.opilo.com/?p=179";
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
            foreach($this->to as $number){
                $url = $this->wsdl_link .
                "httpsend/?username=" . $this->user
                . "&password=" . $this->pass . 
                "&from=" .$this->from .
                "&to=" .$number 
                . "&text=" . urlencode($this->msg)
                . "&flash=" . $this->isflash

                ;

                $response = file($url);

                if(!is_numeric($response[1])){ 
                    echo "Error"; 
                    return;

                }    

                if( strlen ($response[1]) > 2){

                    return $response[1];

                }else{

                    echo  "System Error n:" .$response[1] . ' for '. $number;

                }
            }

        }

        function get_credit()
        {
            $url=$this->wsdl_link . "getCredit/?username=" . $this->user
            ."&password=" . $this->pass;
            $response = file($url);
            if(strstr($response[1],"Error")){
                echo $response[1];
                return;
            }

            return $response[1];
        } 
    }

