<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса сущности
 *
 */

interface InterfaceEntity extends InterfaceAccess
{
    /**
     * сущности приложения
     */
    // первичные страницы сайта, ссылки на которые есть в главном меню
    const PRIME_PAGE = 100;  
    // вторичные страницы сайта, ссылок на которые нет в главном меню
    const EXTRA_PAGE = 90;
    // API-сервисы сайта
    const API_SERVICE = 80;   
}
