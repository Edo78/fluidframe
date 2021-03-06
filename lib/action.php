<?php
if (! defined ( 'FLUIDFRAME' )) {
    exit ( 1 );
}
class Action {
    
    var $lang = false;
    var $args = false;
    var $renderParams = array ();
    
    function __construct($lang = false) {
        if($lang)
            $this->setLang($lang);
    }
    
    function prepare($args) {
        $this->args = $args;
        if(isset($this->args['lang'])) {
            $this->setLang($this->args['lang']);
        }
        return false;
    }
    
    function arg($key,$dflt = null) {
        if(isset($this->args[$key])) {
            return $this->args[$key];
        }
        return $dflt;
    }
    function handle() {
    }
    function isPost() {
        return ($_SERVER ['REQUEST_METHOD'] == 'POST');
    }
    function title() {
        return '';
    }
    
    public function render($page, Array $params = array()) {
        
        $params = array_merge ( $this->renderParams, $params );
        $this->handleHreflangs($params);
        $this->handleTitle($params);
        $this->handleStylesheets($params);
        $this->handleJavascripts($params);
        $this->setParams($params);
        require_once INSTALLDIR.'/view/'.$page.'.php';

    }
    private function setLang($lang) {
        $this->lang = $lang;
        $this->renderParams['lang'] = $this->lang;
    }
    private function setParams($params) {
        foreach ($params as $key=>$val) {
            $this->{$key} = $val;
        }
    }
    protected function getJavascripts() {
        return array();
    }
    
    protected function getStylesheet() {
        return array();
    }
    function getHreflangs() {
        return array();
    }
    private function handleHreflangs(&$params = array()) {
        $params['hreflangs'] = $this->getHreflangs() ;
    }
    private function handleStylesheets(&$params = array()) {
        $siteCss = common_template('stylesheets');
        $this->prepareStylesheet($params, $siteCss);
        $pageCss = $this->getStylesheet();
        $this->prepareStylesheet($params, $pageCss);
    }
    
    private function prepareStylesheet(&$params = array(), $stylesheets= array()) {
        foreach ($stylesheets as $css) {
            if(is_array($css)) {
                $params['stylesheets'][] = $css;
            } else {
                $params['stylesheets'][] = array('href'=>$css,'media'=>'all');
            }
        }
    }
    protected function handleJavascripts(&$params = array()) {
        $params['javascripts'] = array_merge(
                common_template('javascripts'),
                $this->getJavascripts());
    }
    private function handleTitle(&$params = array()) {
        
        $title = $this->title();
        $siteTitle = common_config('site', 'title','NO TITLE');
        if(empty($title))
            $params['title'] = $siteTitle;
        else
            $params['title'] = $title . ' | ' . $siteTitle;
        
    }
}
