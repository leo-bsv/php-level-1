<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Галерея
 *
 */

class ControllerGalaryIndex extends Controller implements InterfaceGalaryIndex
{
    public function __construct($params)
    {
        parent::__construct($params);
        $this->view->addVar('title', self::TITLE);
        $this->view->addVar('h1', self::TITLE);
        $this->view->addVar('images', (new ModelGalary())->getImages());
        
        // разрешим только зарегистрированным пользователям загружать картинки в галерею
        if (App::$access >= InterfaceGalaryUpload::ACCESS) {
            $this->view->addVar('galary_upload', $this->view->render('galary_upload'));
        }
        
        $this->view->addVar('content', $this->view->renderPage('galary'));
    }    
}
