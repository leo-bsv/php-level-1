<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса калькулятора
 *
 */

interface InterfaceCalcIndex extends InterfaceEntity
{
    const MENU_ITEM = 'Калькулятор';
    const TITLE = 'Интернет-калькулятор';
    const LINK = 'calc';
    const ENTITY = self::PRIME_PAGE;
    const ACCESS = self::GUEST;
}
