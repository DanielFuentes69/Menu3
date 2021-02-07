<?php
define("MAX_NUM_BOXES", 10);
define("MAX_NUM_SHORTCUTS", 50);

class Moon2_Pagination_Pager {
    private $_from;
    private $_total;
    private $_xhtml;
    private $_numberPages;
    private $_currentPage;
    private $_limitNumrows;
    private $_tmp_limit;
    private $_tmp_params;
    
public function __construct($total, $limit_numrows, $from, $Parameters){
    $xhtml = "";
    $this->_from = 0;
    $this->_total = $total;
    if ($total > 0){
        $this->_from = (int)$from + 1;
    }
    
    $this->_limitNumrows = $limit_numrows;
    $this->_tmp_params = clone $Parameters;
    $parametersTOdelete = array ("msg");
    $tmp_clean = $this->cleanCode($this->_tmp_params->get_parameters());
    $this->_tmp_params->set_parameters($tmp_clean);
    foreach($parametersTOdelete as $key => $value){
        $this->_tmp_params->delete_param($value);
    }
    
    if ($total<=0) return $xhtml;
    $this->_numberPages = ceil($total/$this->_limitNumrows);
    $this->_tmp_limit = $this->_numberPages;
    $more = "";
    if ($this->_numberPages > MAX_NUM_BOXES){
        $this->_tmp_limit = MAX_NUM_BOXES;
        $title = "Entre 1 y ".$this->_numberPages;
        $links = $this->generateShortcuts();
        $more = "<a class='btn btn-success' title='{$title}' data-container='body' data-placement='right' data-toggle='popover' href='#' data-html='true' data-content=\"{$links}\">Ir a</a>\n";
    }
    if ($total >= $this->_limitNumrows){
        $counter = 0;
        $xhtml.= "<div class=\"btn-group\">\n";

        $first = 1;
        $last = $this->_tmp_limit;
        if($this->_from > ($this->_limitNumrows * MAX_NUM_BOXES)){
            $selected_page = ceil($this->_from / $this->_limitNumrows);
            $last = $this->get_last($selected_page);
            $first = $last - MAX_NUM_BOXES + 1;
            $counter = (($last - MAX_NUM_BOXES) * $this->_limitNumrows);
            if ($last > $this->_numberPages){
                $last = $this->_numberPages;
            }
        }

        $xhtml.= $this->get_backward($first);
        for ($i = $first; $i <= $last; $i++){
            $class = " class=\"btn btn-success\"";
            $this->_tmp_params->add("npage",$counter);
            //$this->_tmp_params->show();
            $tmp_clean = $this->cleanCode($this->_tmp_params->get_parameters());
            $this->_tmp_params->set_parameters($tmp_clean);
            $url_params = $this->_tmp_params->keyGen(false, true);
            if ($counter == $from){
                $this->_currentPage = $i;
                $class = " class=\"btn btn-info active\"";
            }
            $counter = $counter + $this->_limitNumrows;
            $xhtml.= "<a {$class} href=\"".$_SERVER['PHP_SELF']."?".$url_params."\">{$i}</a> \n"; 
        }
        $xhtml.= $this->get_forward($first);
        $xhtml.= $more;
        $xhtml.= "</div>\n";
    }
    $this->_xhtml = $xhtml;
}

public function cleanCode($arr) {
    $arr_par = array();
    foreach ($arr as $key => $value){
        $arr_par[$key] = urldecode($value);
    } 
    return $arr_par;
}

public function showDetails(){
    $to = (int)$this->_from + (int)$this->_limitNumrows - 1;
    if ($to > $this->_total){
        $to = $this->_total;
    }
    $xhtml = "<strong>".$this->_total."</strong> registros encontrados en <strong>";
    $xhtml.= $this->_numberPages."</strong> páginas, mostrando del registro ";
    $xhtml.= $this->_from." al ".$to;
    return $xhtml;
}

public function showNavigation(){
    return $this->_xhtml;
}


//Private methods start
//***********************************************************************************************
private function get_forward($first){
    $xhtml = "";
    $forward= (($first + MAX_NUM_BOXES) - 1) * $this->_limitNumrows;
    $this->_tmp_params->add("npage",$forward);
    $tmp_clean = $this->cleanCode($this->_tmp_params->get_parameters());
    $this->_tmp_params->set_parameters($tmp_clean);
    $url_params = $this->_tmp_params->keyGen(false, true);
    if ($this->_numberPages >= ($first + MAX_NUM_BOXES)){
        $class = "class=\"btn btn-success\"";
        $xhtml = "<a {$class} href=\"".$_SERVER['PHP_SELF']."?".$url_params."\"><i class=\"fa fa-chevron-right\"></i></a>";
    }
    return $xhtml;
}

private function get_backward($first){
    $xhtml = "";
    $backward = (($first - MAX_NUM_BOXES) - 1) * $this->_limitNumrows;
    $this->_tmp_params->add("npage",$backward);
    $tmp_clean = $this->cleanCode($this->_tmp_params->get_parameters());
    $this->_tmp_params->set_parameters($tmp_clean);
    $url_params = $this->_tmp_params->keyGen(false, true);
    if ($first > 1){
        $class = "class=\"btn btn-success\"";
        $xhtml.= "<a {$class} href=\"".$_SERVER['PHP_SELF']."?".$url_params."\"><i class=\"fa fa-chevron-left\"></i></a>";
    }
    return $xhtml;
}

private function get_last($value){
    $last = 0;
    while ($last < $value){
        $last = $last + MAX_NUM_BOXES;
    }
    return $last;
}

private function generateShortcuts(){
    $tmp_clean = $this->cleanCode($this->_tmp_params->get_parameters());
    $this->_tmp_params->set_parameters($tmp_clean);
    $xhtml = "<form id='pagingfrm' name='pagingfrm' method='post' action='moon24.php'  onSubmit='javascript:return managedProccess(this);'>\n";
    $xhtml.= " <input type='hidden' id='limnum' name='limnum' value='".$this->_limitNumrows."' />\n";
    $xhtml.= " <input type='hidden' id='action' name='action' value='goTopage' />\n";
    $xhtml.= " <input type='hidden' id='page_from' name='page_from' value='".$_SERVER['PHP_SELF']."' />\n";
    $xhtml.= " <input type='hidden' id='controller' name='controller' value='moon2/pagination/PagerController' />\n";
    foreach($this->_tmp_params->get_parameters() as $key => $value){
        $xhtml.= "<input id='{$key}' name='{$key}' type='hidden' value='{$value}' />\n";
    }
						    
    $xhtml.= "  <div>\n";
    $xhtml.= "      <div>";
    $xhtml.= "          <input type='text' name='pg' id='pg' maxlength='6' class='validate[required,custom[integer],min[1],max[".$this->_numberPages."]]' size='4'/>\n";
    $xhtml.= "          <input class='btn-success' type='submit' name='btngp' id='btngp' value='Ir' />";
    $xhtml.= "      </div>";
    $xhtml.= "  </div>";
    
    $xhtml.= "</form>\n";
    return $xhtml;
}
//***********************************************************************************************
//Private methods end

}//End class
?>