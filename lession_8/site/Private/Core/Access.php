<?php
class Access implements InterfaceAccess
{    
    public function __construct()
    {        
        App::$access = self::USER;
    }        
}