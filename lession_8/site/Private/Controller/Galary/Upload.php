<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Контроллер загрузки
 *
 */

class ControllerGalaryUpload implements InterfaceGalaryUpload
{ 
    
    public function __construct()
    {
        if (empty($_FILES)) return;
        // если пользователь отправил файл
        $filetype = $_FILES['img']['type'];
        $filename = $_FILES['img']['name'];
        $tmpfile = $_FILES['img']['tmp_name'];
        $filesize = $_FILES['img']['size'];            
        $galary = new ModelGalary();
        $galary->saveImage($filetype, $filename, $tmpfile, $filesize);
        unset($galary);
        App::$appHandler->routing(InterfaceGalaryIndex::LINK);
    }
}
