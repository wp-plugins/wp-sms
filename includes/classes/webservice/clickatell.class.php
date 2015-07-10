<?php
class clickatell extends WP_SMS {
    private $wsdl_link = "http://api.clickatell.com/";
    public $tariff = "http://api.clickatell.com/";
    public $unitrial = false;
    public $unit;
    public $flash = "enable";
    public $isflash = false;
    public $has_key = true;

    public function __construct() {
        parent::__construct();
        $this->validateNumber = "357xxxxxxxx";
    }

    public function SendSMS() {
        $msg = urlencode($this->msg);

        foreach($this->to as $to) {
            $result = file_get_contents($this->wsdl_link."http/sendmsg?user=".$this->username."&password=".$this->password."&api_id=".$this->has_key."&to=".$to."&text=".$msg);
        }

        if (strpos($result,'ID') !== false) {
                $this->InsertToDB($this->from, $this->msg, $this->to);
                $this->Hook('wp_sms_send', $result);
                return true;
        }
        else{
            return false;
        }
    }

    public function GetCredit() {
        if(!$this->username && !$this->password) return;

        return true;
    }
}