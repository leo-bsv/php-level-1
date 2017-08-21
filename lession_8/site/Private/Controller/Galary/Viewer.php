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
        
        $galary = new ModelGalary($params);
        $imageInfo = $galary->getImageInfoById();
        $imageComments = $galary->getImageComments();
        
        $this->view->addVar('title', self::TITLE);
        $this->view->addVar('h1', self::TITLE);        
        $this->view->addVar('imagePath', $imageInfo['path']);        
        $this->view->addVar('imageViews', $imageInfo['views']);        
        $this->view->addVar('imageComments', $imageComments);
        // разрешим только зарегистрированным пользователям оставлять комментарии
        // под картинками
        if (in_array(App::$access, InterfaceGalaryComment::ACCESS)) {
            $imageId = $params[0];
            $this->view->addVar('action', InterfaceGalaryComment::LINK . '/' . $imageId);
            $this->view->addVar('imageCommentForm', $this->view->render('galary_comment'));
        } else {
            $this->view->addVar('imageCommentForm', '');
        }        
        $this->view->addVar('content', $this->view->renderPage('galary_viewer'));
    }    
}
