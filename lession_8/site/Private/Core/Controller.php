<?php
class Controller {
    
    protected $view;

    public function __construct($params)
    {        
        $this->view = new View();    
        $this->view->addCss("style");
    }     
    
    public function __destruct() {
        $this->view->addVar('menu', App::$menu);
        $this->view->addVar('menu_code', $this->view->render('menu'));
        $this->view->addVar('user', App::$username);
        $this->view->addVar('header', $this->view->render('header'));
        $this->view->addVar('messages', App::pullMessages());
        $this->view->addVar('footer', $this->view->render('footer'));        
        echo $this->view->render('layout');
    }
}
