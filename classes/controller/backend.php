<?php

namespace Menu;

class Controller_Backend extends \Backend\Controller_Backend
{
    public $module = 'menu';
    public $dataGlobal = array();
    public $media = false;

    public function before() {
        if (\Input::is_ajax())
        {
            return parent::before();
        }
        else
        {
            parent::before();
        }
        // Load package
        \Package::load('lbMenu');

        // Load Config
        \Config::load('menu', true);
        
        // Load language
        \Lang::load('menu', true);

        // Message class exist ?
        $this->use_message = class_exists('\Messages');

        // Use Casset ?
        $this->casset = \Config::get('lb.theme.use_casset');

        // Set Media
        $this->setModuleMedia();
    }

    public function setModuleMedia()
    {
        // If media already set
        if ($this->media) return true;

        if ($this->casset)
        {
            $activeTheme = $this->theme->active();
            \Casset::add_path('theme', $activeTheme['asset_base']);
        }

        is_callable('parent::setModuleMedia') and parent::setModuleMedia();

        // Add dynatree, bootbox plugin
        \Lb\Backend::addAsset(array(
            'modules/menu/plugins/dynatree/skin/ui.dynatree.css',
        ), 'css', 'css_plugin', $this->theme, $this->casset);

        \Lb\Backend::addAsset(array(
            'modules/menu/plugins/dynatree/jquery.dynatree.js',
            'modules/menu/plugins/bootbox/bootbox.js',
        ), 'js', 'js_plugin', $this->theme, $this->casset);

        $this->media = true;
    }

}