<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Страница просмотра товара
 *
 */

class ControllerCatalogViewer extends Controller implements InterfaceCatalogViewer 
{
    public function __construct($params)
    {
        parent::__construct($params);
        
        $catalog = new ModelCatalog($params);
        $product = $catalog->getProduct();        
        
        $this->view->addVar('title', self::TITLE);
        $this->view->addVar('h1', self::TITLE);
        $this->view->addVar('productName', $product['name']);
        $this->view->addVar('productShortDescr', $product['short_descr']);
        $this->view->addVar('productFeature', $product['feature']);
        $this->view->addVar('productImageFilename', $product['filename']);
        $this->view->addVar('productLongDescr', $product['long_descr']);
        $this->view->addVar('productId', $product['id']);
        $this->view->addVar('content', $this->view->renderPage('catalog_viewer'));
    }   
}
