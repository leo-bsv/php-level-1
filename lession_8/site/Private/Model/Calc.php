<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Класс калькулятора
 *
 */

class ModelCalc
{
    const OP_PLUS = 0;
    const OP_MINUS = 1;
    const OP_MULTIPLY = 2;
    const OP_DIVIDE = 3;  
    private $assocOperations = ['Сложение' => self::OP_PLUS,
                                'Вычитание' => self::OP_MINUS,
                                'Умножение' => self::OP_MULTIPLY,
                                'Деление' => self::OP_DIVIDE];
    
    public function calculate($value1, &$operator1, $value2, $submitOperation)
    {
        if ($submitOperation) $operator1 = $this->assocOperations[$submitOperation];
        $result1 = '';
        // выполним расчёты
        switch ($operator1) {
            case self::OP_PLUS:
                $result1 = $value1 + $value2;
                break;
            case self::OP_MINUS:
                $result1 = $value1 - $value2;
                break;
            case self::OP_MULTIPLY:
                $result1 = $value1 * $value2;
                break;
            case self::OP_DIVIDE:
                if (!empty($value2))
                    $result1 = $value1 / $value2;
                else 
                    App::Msg ("Деление на ноль невозможно.");
                break;
        }        
        return $result1;
    }
}
