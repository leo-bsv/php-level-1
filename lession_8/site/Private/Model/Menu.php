<?php

/**
*
* Автор: Бурков Сергей aka Leo.
*
* Класс генерирующий меню
*
*/

class ModelMenu implements InterfaceEntity
{
    private $interfaces = [];

    public function __construct()
    {
        $this->buildList('', App::INTERFACES_PATH);
    }

    private function buildList($prefix, $path)
    {
        $list = array_diff(scandir($path), array('..', '.'));
        foreach ($list as $item) 
        {
            $filename = $path . $item;
            if (is_dir($filename)) {
                $this->buildList($item, $filename . DIRECTORY_SEPARATOR);
            } else { 
                $this->interfaces[] = $prefix . basename($item, '.php');
            }
        }
        sort($this->interfaces);
//        var_dump($this->interfaces);
    }

    public function buildMenu()
    {
        $menu = [];
        foreach ($this->interfaces as $interface)
        {
            $interface = 'Interface' . $interface;            
            
            if (!defined($interface.'::LINK') ||
                !defined($interface.'::MENU_ITEM')) { 
                continue; 
            }
            
            if (!in_array(App::$access, $interface::ACCESS)) continue;
            
            if ($interface::ENTITY !== InterfaceEntity::PRIME_PAGE) continue;
            
            $menu[] = ['link' => $interface::LINK, 
                       'caption' => $interface::MENU_ITEM];
 
        }
        unset($this->interfaces);
        return $menu;
    }

}