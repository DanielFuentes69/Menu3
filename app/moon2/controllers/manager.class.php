<?php

class Moon2_Controllers_Manager {

    protected $_dom;
    protected $_url;
    protected $_action;
    protected $_parameters;
    protected $_path_config;

    public function __construct($parameters, $dom, $path_config, $externalClass = true) {
        $this->_parameters = $parameters;
        $this->_action = $parameters->get_parameter("action", "");
        $action = $this->_action;
        $this->_dom = $dom;
        $this->_path_config = $path_config;
        if ($externalClass) {
            $rc = new ReflectionClass(get_class($this));
            if ($rc->hasMethod($this->_action)) {

                $this->$action();
            } else {
                $this->stop();
            }
        }
    }

    protected function stop() {
        $message = "<span style=\"color:blue; font-weight: bold\">Jade controller in test</span><br/ >";
        $message .= "Message:<br/><span style=\"color:red;font-weight: bold\">" . $this->_action . "</span> ";
        $message .= "Controller not implemented in class <span style=\"color:red;font-weight: bold\">" . get_class($this) . "</span>";
        echo $message;
        $this->_parameters->show();
        header("Status: 400 Bad request", false, 400);
        exit();
    }

    protected function redirect($component, $view, $params) {
        $this->_url = $component . "/views/" . $view . ".php";
        if (count($params) > 0) {
            $objUrl = new Moon2_Params_Parameters();
            foreach ($params as $campo => $valor) {
                $objUrl->add($campo, $valor);
            }
            $returnLink = $objUrl->keyGen();
            $this->_url = $component . "/views/" . $view . ".php?" . $returnLink;
        }
        header("Location: {$this->_url}");
        exit();
    }

    protected function redirectScript($component, $view, $params) {
        $this->_url = $component . "/views/" . $view . ".php";
        if (count($params) > 0) {
            $objUrl = new Moon2_Params_Parameters();
            foreach ($params as $campo => $valor) {
                $objUrl->add($campo, $valor);
            }
            $returnLink = $objUrl->keyGen();
            $this->_url = $component . "/views/" . $view . ".php?" . $returnLink;
        }
        $script = "<script>\n";
        $script .= "window.parent.location.href = '{$this->_url}';\n";
        $script .= "</script>\n";
        echo $script;
        exit();
    }

}

//End class
?>