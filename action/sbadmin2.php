<?php
if (! defined ( 'FLUIDFRAME' )) {
    exit ( 1 );
}
class Sbadmin2Action extends Action {
    protected $renderOptions = array ();
    function prepare($args) {
        parent::prepare ( $args );
        $this->prepareMenu();
    }
    function handle() {
    }
    function prepareMenu() {
        $menu = array (
                array (
                        'class' => 'fa-dashboard',
                        'href' => common_get_route ( 'home', array (
                                'lang' => $this->lang 
                        ) ),
                        'title' => 'Dashboard' 
                ),
                array (
                        'class' => 'fa-bar-chart-o',
                        'href' => '#',
                        'title' => 'File',
                        'items' => array (
                                array (
                                        'href' => common_get_route ( 'home', array (
                                                'lang' => '123' 
                                        ) ),
                                        'title' => 'Images' 
                                ),
                                array (
                                        'href' => common_get_route ( 'home', array (
                                                'lang' => '456' 
                                        ) ),
                                        'title' => 'Attachments' 
                                ) 
                        ) 
                ),
                array (
                        'class' => 'fa-table',
                        'href' => '#',
                        'title'=> 'Tables' 
                ) 
        );
        
        $this->renderOptions ['sidebar'] = $menu;
    }
}