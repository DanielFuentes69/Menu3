<?php
class Moon2_Mail_Email {

    private $_to;
    private $_cc;
    private $_bcc;
    private $_from;
    private $_subject;
    private $_message;
    private $_header;

    public function __construct($_from, $_to, $_subject, $_message, $_cc = "", $_bcc = "") {
        $this->_to = $_to;
        $this->_cc = $_cc;
        $this->_bcc = $_bcc;
        $this->_from = $_from;
        $this->_subject = $_subject;
        $this->_message = $_message;
        $this->_header = "";
    }

    public function sendMail() {
        $this->setHeader();
        return mail($this->_to, $this->_subject, $this->_message, $this->_header);;
    }

    private function setHeader() {
        $this->_header = "MIME-Version: 1.0" . "\r\n";
        $this->_header .= "Content-Transfer-Encoding: 8bit \r\n";
        $this->_header .= "Content-type: text/html; charset=utf-8" . "\r\n";
        $this->_header .= "From: {$this->_from}" . "\r\n";
        if (!empty($this->_cc)) {
            $this->_header .= "Cc: {$this->_cc}" . "\r\n";
        }

        if (!empty($this->_bcc)) {
            $this->_header .= "Bcc: {$this->_bcc}" . "\r\n";
        }
    }

}

//End class
?>
