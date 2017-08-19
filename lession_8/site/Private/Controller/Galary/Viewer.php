<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Галерея
 *
 */

class ControllerGalaryViewer extends Controller implements InterfaceGalaryViewer
{
    public function __construct($params)
    {
        parent::__construct($params);
        $this->view->addVar('title', self::TITLE);
        $this->view->addVar('h1', self::TITLE);        
        $this->view->addVar('content', $this->view->renderPage('galary_viewer'));
    }    
}
