<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Каталог
 *
 */

class ControllerCatalogIndex extends Controller implements InterfaceCatalogIndex 
{
    public function __construct($params)
    {
        parent::__construct($params);
        
        $catalog = new ModelCatalog($params);
        $products = $catalog->getProducts();
        
        $this->view->addVar('title', self::TITLE);
        $this->view->addVar('h1', self::TITLE);
        $this->view->addVar('products', $products);
        $this->view->addVar('content', $this->view->renderPage('catalog'));
    }   
}
