<?php

/**
*
* Автор: Бурков Сергей aka Leo.
*
* Класс позволяющий получать и обновлять данные о галерее картинок
*
*/

class ModelGalary implements InterfaceEntity
{
    private $params;
    
    const GALARY_PATH = App::IMG_PATH . 'galary/';
    const THUMBS_PATH = self::GALARY_PATH . 'thumbs/';
    const UPLOAD_PATH = self::GALARY_PATH . 'uploads/';
    const THUMB_WIDTH = 70;
    const THUMB_HEIGHT = 150;
    const SUPPORTED_IMAGE_TYPES = 'image/jpeg,image/png,image/gif';
    
    public function __construct(... $params)
    {
        $this->params = $params;
        file_exists(self::GALARY_PATH) or mkdir(self::GALARY_PATH);
        file_exists(self::THUMBS_PATH) or mkdir(self::THUMBS_PATH);
        file_exists(self::UPLOAD_PATH) or mkdir(self::UPLOAD_PATH);
    }   

    // получение массива id-filename
    public function getImages() {
        $sql = "select `id`, `filename` from images order by `views` desc;";
        $result = mysqli_query(App::$db, $sql);
        $arr = [];
        if ($result)
            while ($row = mysqli_fetch_assoc($result)) {
                $arr[] = ['id' => $row['id'],
                          'filename' => $row['filename'],
                          'thumb' => self::THUMBS_PATH . $row['filename'],
                          'width' => self::THUMB_WIDTH];
            }
        return $arr;
    }
    
    // добавление информации о новой картинке в базу данных
    private function insertImageToDB($filename, $img_path, $size) {
        $sql = "insert into images (`filename`, `path`, `size`, `views`) "
                . "values ('$filename','$img_path', $size, 0);";
        return mysqli_query(App::$db, $sql);
    }

    // сохраним загружаемую картинку
    public function saveImage($filetype, $filename, $tmpfile, $filesize)
    {
        // если тип файла поддерживается
        if (strpos(self::SUPPORTED_IMAGE_TYPES, $filetype) === false) {
            // сообщим, если тип файла не поддерживается
            App::Msg("Формат файла $filetype не поддерживается");
            return;
        }
        // исправим разрешение файла jpg на jpeg
        $filename_parts = pathinfo($filename);            
        if (strtolower($filename_parts['extension']) == 'jpg') {
            $filename = str_ireplace('jpg', 'jpeg', $filename);
        }
        // создаём имена файлов
        $img_path = self::UPLOAD_PATH . $filename;
        $thumb_path = self::THUMBS_PATH . $filename;
        // сохраняем файл картинки в папку загрузок
        if (move_uploaded_file($tmpfile, $img_path)) { 
            // генерируем миниатюру
            $this->createThumbnail($img_path, 
                    $thumb_path, self::THUMB_WIDTH, self::THUMB_HEIGHT);
        }
        // записываем информацию о картинке в базу данных
        $this->insertImageToDB($filename, $img_path, $filesize);
    }
    
    public function createThumbnail($path, $save, $width, $height) {
        $info = getimagesize($path); //получаем размеры картинки и ее тип
        $size = array($info[0], $info[1]); //закидываем размеры в массив

        //В зависимости от расширения картинки вызываем соответствующую функцию
        if ($info['mime'] == 'image/png') {
            $src = imagecreatefrompng($path); //создаём новое изображение из файла
        } else if ($info['mime'] == 'image/jpeg') {
            $src = imagecreatefromjpeg($path);
        } else if ($info['mime'] == 'image/gif') {
            $src = imagecreatefromgif($path);
        } else {
            return false;
        }

        $thumb = imagecreatetruecolor($width, $height); //возвращает идентификатор изображения, представляющий черное изображение заданного размера
        $src_aspect = $size[0] / $size[1]; //отношение ширины к высоте исходника
        $thumb_aspect = $width / $height; //отношение ширины к высоте аватарки

        if($src_aspect < $thumb_aspect) { 		//узкий вариант (фиксированная ширина) 		$scale = $width / $size[0]; 		$new_size = array($width, $width / $src_aspect); 		$src_pos = array(0, ($size[1] * $scale - $height) / $scale / 2); //Ищем расстояние по высоте от края картинки до начала картины после обрезки 	} else if ($src_aspect > $thumb_aspect) {
            //широкий вариант (фиксированная высота)
            $scale = $height / $size[1];
            $new_size = array($height * $src_aspect, $height);
            $src_pos = array(($size[0] * $scale - $width) / $scale / 2, 0); //Ищем расстояние по ширине от края картинки до начала картины после обрезки
        } else {
            //другое
            $new_size = array($width, $height);
            $src_pos = array(0,0);
        }

        $new_size[0] = max($new_size[0], 1);
        $new_size[1] = max($new_size[1], 1);

        imagecopyresampled($thumb, $src, 0, 0, $src_pos[0], $src_pos[1], $new_size[0], $new_size[1], $size[0], $size[1]);
        //Копирование и изменение размера изображения с ресемплированием

        if($save === false) {
            return imagepng($thumb); //Выводит JPEG/PNG/GIF изображение
        } else {
            return imagepng($thumb, $save);//Сохраняет JPEG/PNG/GIF изображение
        }
    }    
}