<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Контроллер калькулятора
 *
 */

class ControllerCalcIndex extends Controller implements InterfaceCalcIndex 
{
    public function __construct($params)
    {
        parent::__construct($params);
        
        // получим переданные данные
        $value1 = Request::getValAsInt('value1');
        $operator1 = Request::getValAsInt('operator1');
        $value2 = Request::getValAsInt('value2');
        
        // если нажата кнопка операции, то выберем соответствующую операцию,
        // игнорируя значение списка операций
        $submitOperation = Request::getValAsStr('submit-operation'); 
        
        $calc = new ModelCalc();
        $result1 = $calc->calculate($value1, $operator1, $value2, $submitOperation);
        
        // отметим в списке операций текущую операцию
        $selected1 = ['','','',''];
        $selected1[$operator1] = 'selected';
        
        // выведем результат
        $this->view->addVar('title', self::TITLE);
        $this->view->addVar('h1', self::TITLE);
        
        $this->view->addVar('value1', $value1);
        $this->view->addVar('operator1', $operator1);
        $this->view->addVar('value2', $value2);
        $this->view->addVar('selected1', $selected1);
        $this->view->addVar('result1', $result1);
        
        $this->view->addVar('content', $this->view->renderPage('calc'));
    }   
}
