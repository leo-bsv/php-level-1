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
    public static $appHandler;
    
    // ссылка на объект базы данных
    public static $db;
    
    // ссылка на объект главного меню
    public static $menu;
    
    // уровень доступа запроса
    public static $access;
    
    // логин пользователя
    public static $username;
    
    // сессия
    public static $session;
      
    // сообщения приложения
    private static $messages = [];
    
    // конструктор приложения
    function __construct()
    {
        self::$appHandler = $this;
        // применяем настройки
        $this->configurate();
        // подключаемся к базе данных
        new DbConnector();
        // поднимаем сессию
        self::$session = new Session();        
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
    public function routing($uri = '')
    {
        if (empty($uri)) $uri = $_SERVER['REQUEST_URI'];
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
        
        // если сущность отсутствует в принципе
        if (!class_exists($full_controller_class_name)) {
            $full_controller_class_name = 'ControllerIndexIndex';
            self::Msg('Запрошенной страницы или сервиса не существует.');
        }
        
        // если сущность является одной из главнх страниц, то 
        // сгенерируем меню сайта
        if ($full_controller_class_name::ENTITY != InterfaceEntity::API_SERVICE) {
            App::$menu = (new ModelMenu())->buildMenu();
        }              
        
        // если доступ к сущности закрыт
        if (!in_array(App::$access, $full_controller_class_name::ACCESS)) {
           self::Msg('Доступ к запрошенной странице или сервису закрыт.'); 
           $full_controller_class_name = 'ControllerIndexIndex';
        }
        
        $controller = new $full_controller_class_name($params);
    }

    // добавление нового сообщения в стек сообщений
    public static function Msg($text)
    {
        self::$messages[] = $text;
    }

    // выгрузка сообщений
    public static function pullMessages()
    {
        $result = '';
        foreach (self::$messages as $message) {
            if (empty($result)) $result .= '"' . $message . '"';
            else $result .= ', "' . $message . '"';
        }
        return $result;
    }

}