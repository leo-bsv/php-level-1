<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Класс управляющий каталогом товаров
 *
 */
class ModelCatalog
{
    private $params;
    
    const CATALOG_PATH = App::IMG_PATH . 'catalog/';
    const SUPPORTED_IMAGE_TYPES = 'image/jpeg,image/png,image/gif';    
    
    
    public function __construct($params = [])
    {
        $this->params = $params;
        file_exists(App::PUBLIC_PATH . self::CATALOG_PATH) or mkdir(App::PUBLIC_PATH . self::CATALOG_PATH);
    }   
    
    // получение массива данных о продуктах
    public function getProducts() {
        $sql = "select * from `goods`;";
        $result = mysqli_query(App::$db, $sql);
        $arr = [];
        if ($result)
            while ($row = mysqli_fetch_assoc($result)) {
                $arr[] = $row;
            }
        return $arr;
    }    
    
    // получение данных о продукте по идентификатору
    function getProduct() 
    {
        $productId = $this->params[0];
        $sql = "select * from goods where `goods_id` = '$productId';";
        $result = mysqli_query(App::$db, $sql);
        if ($result)
            while ($row = mysqli_fetch_assoc($result)) {
                return $row;
            }
    }   
    
    // удаление продукта по идентификатору
    function deleteProduct() 
    {
        $productId = $this->params[0];
        $sql = "delete from goods where `goods_id` = '$productId';";
        return mysqli_query(App::$db, $sql);
    }   
    
    // обработка данных поступивших от пользователя
    function processForm($formData)
    {
        if (isset($formData['productImage']) 
                && !empty($formData['productImage']) 
                && is_array($formData['productImage'])) {
            $this->saveImage($formData);
        }
        
        if (isset($this->params[0]) && is_numeric($this->params[0])) { // обновление данных
            $productId = $this->params[0];
            $this->updateProduct($productId, $formData);
        } else { // добавление данных
            $this->addProduct($formData);
        }            
    }
    
    // добавление данных о продукте
    private function addProduct($formData) 
    {        
        $sql = "insert into `goods` (`filename`, `name`, `short_descr`, "
                . "`feature`, `long_descr`, `price`, `count`) values ("
                . "'{$formData['productImage']['name']}', "
                . "'{$formData['productName']}', "
                . "'{$formData['productShortDescr']}', "
                . "'{$formData['productFeature']}', "
                . "'{$formData['productLongDescr']}', "
                . "'{$formData['productPrice']}', "
                . "'{$formData['productCount']}');";
        return mysqli_query(App::$db, $sql);
    }    
    
    // обновление данных о продукте
    private function updateProduct($id, $formData) {        
        if (!isset($id) || !is_numeric($id)) return false;
        if (!isset($formData) || empty($formData) || !is_array($formData)) return false;
        $assoc = ['productName' => 'name',
                  'productShortDescr' => 'short_descr',
                  'productFeature' => 'feature',
                  'productLongDescr' => 'long_descr',
                  'productPrice' => 'price',
                  'productCount' => 'count',
                  'productImage' => 'filename'];
        
        $sql = "update `goods` set";
        $first = true;
        foreach ($formData as $field => $value) {
            if ($field == 'productImage') {
                if (is_array($value)) {
                    if (!$first) $sql .= ',';
                    $first = false;                    
                    $sql .= " `{$assoc[$field]}`='{$value['name']}'";
                }
            } else {
                if (!$first) $sql .= ',';
                $first = false;                
                $sql .= " `{$assoc[$field]}`='$value'";
            }
        }
        $sql .= " where `goods_id`='$id';";        
        return mysqli_query(App::$db, $sql);
    }    
    
    // сохраним загружаемую картинку
    private function saveImage($formData)
    {
        $type = $formData['productImage']['type'];
        $name = $formData['productImage']['name'];
        $tmpfile = $formData['productImage']['tmp_name'];
        
        // если тип файла поддерживается
        if (strpos(self::SUPPORTED_IMAGE_TYPES, $type) === false) {
            // сообщим, если тип файла не поддерживается
            App::Msg("Формат файла $type не поддерживается");
            return;
        }
        // исправим разрешение файла jpg на jpeg
        $nameParts = pathinfo($name);            
        if (strtolower($nameParts['extension']) == 'jpg') {
            $name = str_ireplace('jpg', 'jpeg', $name);
        }
        // создаём имена файлов
        $imgPath = App::PUBLIC_PATH . self::CATALOG_PATH . $name;
        
        // сохраняем файл картинки в папку загрузок
        return move_uploaded_file($tmpfile, $imgPath);
    }    
    
}
