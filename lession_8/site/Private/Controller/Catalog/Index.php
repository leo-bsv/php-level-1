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
        $this->view->addVar('products', $products);
        
        $addButtonCode = '';
        if (in_array(App::$access, InterfaceCatalogAdd::ACCESS)) {
            $addView = new View();
            $addView->addVars([
                'addProductLink' => InterfaceCatalogAdd::LINK,
                'addProductLabel' => InterfaceCatalogAdd::TITLE
                ]);
            $addButtonCode = $addView->render('catalog_add');
            unset($addView);
        }
        $this->view->addVar('add', $addButtonCode);
        
        $this->view->addVars([
            'title' => self::TITLE,
            'h1' => self::TITLE, 
            'products' => $products, 
            'content' => $this->view->renderPage('catalog')
            ]);
    }   
}
