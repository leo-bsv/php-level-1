<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса разделения доступа
 *
 */

interface InterfaceAccess
{
    /**
     * права доступа к сайту
     */
    const GUEST = 0;    // гость
    const USER = 50;    // зарегистрированный пользователь
    const ADMIN = 100;  // админ        
}
