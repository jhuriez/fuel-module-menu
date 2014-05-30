<?php

namespace Fuel\Tasks;

class Menu
{
	public function install($publicPath = null, $theme = null)
	{
        \Lb\ModuleUtility::installAsset('menu', dirname(__FILE__), $publicPath, $theme);
	}

    public function uninstall($publicPath = null, $theme = null)
    {
        \Lb\ModuleUtility::uninstallAsset('menu', $publicPath, $theme);
    }
}