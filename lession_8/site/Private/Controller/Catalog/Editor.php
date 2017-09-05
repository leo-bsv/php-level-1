<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Страница редактирования товара
 *
 */

class ControllerCatalogEditor extends Controller implements InterfaceCatalogEditor
{
    private $params;


    public function __construct($params)
    {
        parent::__construct($params);
              
        // если в параметрах что-то есть значит это может быть только 
        // id товара и нужно отредактировать данные
        // если в параметрах ничего нет - значит это
        // добавление товара если formSubmitted = false
        // редактирование товара если formSubmitted = true
        
        $this->params = $params;
        
        $formSubmitted = Request::valueExists('productName');
        
        if ($formSubmitted) { // если была отправлена форма
            $this->processProduct();
        } else { 
            if (isset($params[0]) && is_numeric($params[0])) {
                // форма должна быть открыта для редактирования уже имеющегося товара
                $this->showFormToEdit();                
            } else { 
                // форма должна быть открыта для добавления нового товара
                $this->showEmptyForm();
            }
        }
    }   
    
    // обработка поступившых данных
    // в зависимости от наличния идентификатора в свойстве $this-params
    private function processProduct()
    {
        $formData = Request::getValues([
            'productName' => Request::Str,
            'productPrice' => Request::Int,
            'productCount' => Request::Int,
            'productShortDescr' => Request::Str,
            'productLongDescr' => Request::Str,
            'productFeature' => Request::Str,
            'productImage' => Request::File
        ]);

        $catalog = new ModelCatalog($this->params);
        $catalog->processForm($formData);
        unset($catalog);
        header('Location: '.InterfaceCatalogIndex::LINK);        
    }
    
    // открытие формы имеющегося товара для редактирования
    private function showFormToEdit()
    {
        $productId = $this->params[0];
        $catalog = new ModelCatalog($this->params);
        $product = $catalog->getProduct();    
        unset($catalog);     

        $this->view->addVar('h1', "Редактирование данных о товаре");
        $this->view->addVar('title', "Редактирование данных о товаре");
        $this->view->addVar('actionLabel', "Редактирование данных о товаре");
        $this->view->addVar('action', InterfaceCatalogEditor::LINK . '/' . $productId);
        $this->view->addVar('productName', $product['name']);
        $this->view->addVar('productShortDescr', $product['short_descr']);
        $this->view->addVar('productFeature', $product['feature']);
        $this->view->addVar('productLongDescr', $product['long_descr']);
        $this->view->addVar('productPrice', $product['price']);
        $this->view->addVar('productCount', $product['count']);
        $this->view->addVar('content', $this->view->renderPage('catalog_editor'));            
    }
    
    // открытие формы для добавления нового товара
    private function showEmptyForm()
    {
        $this->view->addVar('h1', "Добавление товара");
        $this->view->addVar('title', "Добавление товара");
        $this->view->addVar('actionLabel', "Добавление товара");
        $this->view->addVar('action', InterfaceCatalogEditor::LINK);
        $this->view->addVar('productName', '');
        $this->view->addVar('productShortDescr', '');
        $this->view->addVar('productFeature', '');
        $this->view->addVar('productLongDescr', '');
        $this->view->addVar('productPrice', '');
        $this->view->addVar('productCount', '');
        $this->view->addVar('content', $this->view->renderPage('catalog_editor'));         
    }
}
