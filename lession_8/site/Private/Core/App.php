<?php
/**
*
* Автор: Бурков Сергей aka Leo.
*
* Класс приложения
*
*/

class App implements InterfaceConfiguration
{      
    // ссылка на объект базы данных
    public static $db;
    
    // ссылка на объект главного меню
    public static $menu;
    
    // уровень доступа запроса
    public static $access;
    
    // сообщения приложения
    private static $messages = [];
    
    // конструктор приложения
    function __construct()
    {
        // применяем настройки
        $this->configurate();
        // подключаемся к базе данных
        new DbConnector();
        // получаем уровень доступа запроса
        new Access();
    }

    // конфигуратор приложения
    private function configurate()
    {
        // установка временной зоны по-умолчанию
        date_default_timezone_set(self::TIMEZONE);
        // установка локали
        setlocale(LC_ALL, self::LOCALE);   
        // отображение ошибок в браузер
        ini_set('display_errors', (int) self::DEBUG_MODE);
        // логирование ошибок в файл
        if (self::ERROR_LOGGING) 
        {
            error_reporting(E_ALL);
            ini_set('error_log', self::ERRORS_LOG_FILENAME);
        }        
    }    
    
    // маршрутизация
    public function routing()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = str_replace(['.php','.phtml','.html','.htm'], '', $uri);
        
        $action = 'Index';
        $params = [];        
        if ($uri == '/') {
            $controller_name = 'Index';
        } else {
            $routes = explode('/', $uri);        
            $routes = array_slice($routes, 1);
            $routes = array_map('ucfirst', $routes);
            $controller_name = $routes[0];
            if (isset($routes[1])) $action = $routes[1];
            if (count($routes) > 2) $params = array_slice($routes, 2);
        }
        
        $full_controller_class_name = 'Controller' . $controller_name . $action;
        
        // если сущность является одной из главнх страниц, то 
        // сгенерируем меню сайта
        if ($full_controller_class_name::ENTITY == InterfaceEntity::PRIME_PAGE) {
            App::$menu = (new ModelMenu())->buildMenu();
        }              
        
        try {
            $controller = new $full_controller_class_name($params);
            //$controller->$action($params);
        } catch (Exception $ex) {
            self::Msg('Ошибка 404. Нет такой страницы.');
        }
    }

    // добавление нового сообщения в стек сообщений
    public static function Msg($text)
    {
        self::$messages[] = $text;
    }

}