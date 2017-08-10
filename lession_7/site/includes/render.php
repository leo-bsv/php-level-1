<?php
/**
 * Минимальная шаблонизация
 */

// функция ренденинга шаблона
function render($template, $params = []) {
    extract($params);
    include TEMPLATES_DIR . $template . '.php';
}
