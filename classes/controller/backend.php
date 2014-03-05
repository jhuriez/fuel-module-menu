<?php

namespace Menu;

class Controller_Backend extends \Controller_Base_Backend
{
    public $module = 'menu';
    public $dataGlobal = array();

    public function before() {
        if (\Input::is_ajax())
        {
            return parent::before();
        }
        else
        {
            parent::before();
        }
        
        // Load language
        \Lang::load('menu', true);

        // Message class exist ?
        $this->use_message = class_exists('\Messages');

        // Load package
        \Package::load('lbMenu');

        // Load Config
        \Config::load('menu', true);

        // Set Media
        $this->setModuleMedia();
    }

    public function setModuleMedia()
    {
        // Jquery
        if (\Config::get('menu.module.force_jquery'))
        {
            $this->theme->asset->js(array(
                'modules/' . $this->module . '/jquery.min.js',
                'modules/' . $this->module . '/jquery-ui.min.js',
            ), array(), \Config::get('menu.module.assets.js_core') ? : 'js_core', false); 
        }

        // Bootstrap
        if (\Config::get('menu.module.force_bootstrap'))
        {
            $this->theme->asset->css(array(
                'modules/' . $this->module . '/bootstrap/css/bootstrap.css',
                'modules/' . $this->module . '/bootstrap/css/bootstrap-glyphicons.css',
            ), array(), \Config::get('menu.module.assets.css') ? : 'css_plugin', false);

            $this->theme->asset->js(array(
                'modules/' . $this->module . '/bootstrap.js',
            ), array(), \Config::get('menu.module.assets.js_core') ? : 'js_core', false); 
        }

        // Fontawesome
        if (\Config::get('menu.module.force_font-awesome'))
        {
            $this->theme->asset->css(array(
                'modules/' . $this->module . '/font-awesome/css/font-awesome.css',
            ), array(), \Config::get('menu.module.assets.css') ? : 'css_plugin', false);
        }

        // Add dynatree, bootbox plugin
        $this->theme->asset->css(array(
            'modules/' . $this->module . '/plugins/dynatree/skin/ui.dynatree.css',
        ), array(), \Config::get('menu.module.assets.css') ? : 'css_plugin', false);

        $this->theme->asset->js(array(
            'modules/' . $this->module . '/plugins/dynatree/jquery.dynatree.js',
            'modules/' . $this->module . '/plugins/bootbox/bootbox.js',
        ), array(), \Config::get('menu.module.assets.js_plugin') ? : 'js_plugin', false);
    }
}