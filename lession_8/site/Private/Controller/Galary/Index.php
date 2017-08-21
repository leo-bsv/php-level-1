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
        $galary = new ModelGalary($params);
        $images = $galary->getImages();
        
        $this->view->addVar('title', self::TITLE);
        $this->view->addVar('h1', self::TITLE);
        $this->view->addVar('images', $images);
        
        // разрешим только зарегистрированным пользователям загружать картинки в галерею
        if (in_array(App::$access, InterfaceGalaryUpload::ACCESS)) {
            $this->view->addVar('galaryUpload', $this->view->render('galary_upload'));
        } else {
            $this->view->addVar('galaryUpload', '');
        }
        
        $this->view->addVar('content', $this->view->renderPage('galary'));
    }    
}
