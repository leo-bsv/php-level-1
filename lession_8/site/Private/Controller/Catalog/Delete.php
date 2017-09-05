<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Механизм удаления товара из каталога
 *
 */

class ControllerCatalogDelete extends Controller implements InterfaceCatalogDelete
{

    public function __construct($params)
    {
        parent::__construct($params);
      
        $catalog = new ModelCatalog($params);
        $catalog->deleteProduct();
        unset($catalog);
        header('Location: '.InterfaceCatalogIndex::LINK); 
    }   
 
}
