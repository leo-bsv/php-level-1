<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Класс галереи для комментирования изображений
 *
 */

class ControllerGalaryComment implements InterfaceGalaryComment
{
    public function __construct($params)
    {
        $comment = Request::getValAsStr('comment');
        if (!empty($comment)) {
            $imageId = $params[0];
            $viewerUri = InterfaceGalaryViewer::LINK . '/';
            $galary = new ModelGalary($params);        
            if (!$galary->addImageComment($comment)) {
                App::Msg('Ошибка при добавлении комментария.');
            }
        }
        App::$appHandler->routing($viewerUri . $imageId);
    }    
}
