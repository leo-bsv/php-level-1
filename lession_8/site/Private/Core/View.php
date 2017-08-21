<?php

class View
{
    private $css = [];
    private $js = [];
    private $js_snippets = [];
    public $vars = [];
//    public $updated;

    // первичная инициализация объекта
    public function __construct()
    {
        //
    }

    // добавим запись о внешнем файле стилей css
    public function addCss($css_file)
    {
        $this->css[$css_file] = App::CSS_PATH . $css_file . '.css';
//        $this->css[$css_file] = App::CSS_PATH . $css_file . '.css?upd=' . $this->updated;
    }

    // удалим запись о внешнем файле стилей css
    public function delCss($css_file)
    {
        unset($this->css[$css_file]);
    }

    // удалим записи обо всех внеших файлах стилей css
    public function unsetCss()
    {
        $this->css = [];
    }

    // добавим запись о внешнем файле js
    public function addJs($js_file)
    {
        $this->js[$js_file] = App::JS_PATH . $js_file . '.js';
//        $this->js[$js_file] = App::JS_PATH . $js_file . '.js?upd=' . $this->updated;
    }
    
    // добавим код JS
    public function addJsCode($js_code)
    {
        $this->js_snippets[] = $js_code;
    }
    

    // добавим переменную со значением
    public function addVar($var, $value)
    {
        $this->vars[$var] = $value;
    }

    public function render($template, $path = App::TEMPLATES_BONES_PATH)
    {
        $this->vars['favicon'] = App::FAVICON_PATH;
        $this->vars['view'] = &$this;
        
        if (is_array($this->vars))
        {
            // преобразуем элементы массива в переменные
            extract($this->vars);
        }
        ob_start();
        include $path . $template . '.php';
        $var = ob_get_clean();
        return $var;
    }
    
    public function renderPage($template)
    {
        return $this->render($template, App::TEMPLATES_PAGES_PATH);
    }

    public function __destruct()
    {
        unset($this->css);
        unset($this->js);
        unset($this->js_snippets);
        unset($this->vars);
    }

}
