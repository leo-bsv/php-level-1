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
        unset($catalog);
        
        $editLinkCode = '';
        if (in_array(App::$access, InterfaceCatalogEdit::ACCESS)) {
            $editView = new View();
            $editView->addVars([
                'editProductLink' => InterfaceCatalogEdit::LINK . $product['goods_id'],
                'editProductLabel' => InterfaceCatalogEdit::TITLE
                ]);
            $editLinkCode = $editView->render('catalog_edit');
            unset($editView);
        }
        $this->view->addVar('editLink', $editLinkCode);
        
        $deleteLinkCode = '';
        if (in_array(App::$access, InterfaceCatalogDelete::ACCESS)) {
            $delView = new View();
            $delView->addVars([
                'delProductLink' => InterfaceCatalogDelete::LINK . $product['goods_id'],
                'delProductLabel' => InterfaceCatalogDelete::TITLE
                ]);
            $delLinkCode = $delView->render('catalog_delete');
            unset($delView);
        }
        $this->view->addVar('deleteLink', $delLinkCode);
        
        $this->view->addVar('title', self::TITLE);
        $this->view->addVar('h1', self::TITLE);
        $this->view->addVar('productName', $product['name']);
        $this->view->addVar('productShortDescr', $product['short_descr']);
        $this->view->addVar('productFeature', $product['feature']);
        $this->view->addVar('productImageFilename', ModelCatalog::CATALOG_PATH . $product['filename']);
        $this->view->addVar('productLongDescr', $product['long_descr']);
        $this->view->addVar('productPrice', $product['price']);
        $this->view->addVar('productCount', $product['count']);
        $this->view->addVar('productId', $product['goods_id']);
        $this->view->addVar('content', $this->view->renderPage('catalog_viewer'));
    }   
}