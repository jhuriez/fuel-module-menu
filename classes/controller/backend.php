<?php

namespace Menu;

class Controller_Backend extends \Controller_Base_Backendtwo
{
    public $module = 'menu';
    public $dataGlobal = array();

    public function before() {
        if (\Input::is_ajax() || \Input::get('content_only'))
        {
            return parent::before();
        }
        else
        {
            parent::before();
        }
        
        // Load language
        \Lang::load('menu', true);

        // Load package
        \Package::load('lbMenu');

        // Load Config
        \Config::load('menu', true);

        // Set Media
        $this->setModuleMedia();
    }
}