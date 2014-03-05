# Fuel LbMenu Module

This module is used to manage the Lb Fuel Menu Package with Db Driver
You can install the Fuel LbMenu Menu package here : [Click here](https://github.com/jhuriez/fuel-lbMenu-package)

You may have bugs on this module, it's not completely finished. Furthermore, it's difficult to automatically adapted a module on an existing project.
This module can  be used as a basis to create your own section to manage the Fuel LbMenu Package with Db Driver.

# Installation

1. Clone or download the fuel-menu repository
2. Move it into your module folder, and rename it to "menu"
3. Open your oil console
4. Run 'oil refine menu::menu:install [your_public_folder] [your_theme]' to generate needed files (copy js and css files in assets folder). 
* [your_public_folder] is optionnally if your public folder is not named "public"
* [your_theme] is if you use a theme other than the default theme

# Configuration

## Base controller

This module is not securised, i've not added a ACL or Auth security. You need to attach this module on your base admin controller :

In `modules/menu/classes/controller/backend.php` at line 5 :

```php
  class Controller_Backend extends \Controller_Base_Backend
```

## Theme

It uses the Theme class from FuelPHP, consequently you need to have a theme for your administration.

## Implementation

All variables used in the template file from theme :

* $pageTitle : For the title of the page in any action
* $partials['content'] : The partial for the content
* "<?= \Theme::instance()->asset->render('css_plugin'); ?>" in the head
* "<?= \Theme::instance()->asset->render('js_core'); ?>" in the head
* "<?= \Theme::instance()->asset->render('js_plugin'); ?>" in the footer
* Your need to load jQuery and jQuery UI, and optionnaly Twitter Bootstrap v3

You can see an example of template here : `menu/example/template.php`

## Config file

file menu.php in `app/config` :

```php
return array(
	...,
	'module' => array(
		'force_jquery' => false, // Load jQuery library
		'force_bootstrap' => false, // Load Bootstrap library (js and css)
		'force_font-awesome' => false, // Load FontAwesome library
		'assets' => array(
			'css_plugin' => 'css', // Set the asset group "css" instead of "css_plugin",
		),
	),
	...,
);
```

## Change assets groups name

In your theme you don't want to use the asset group "css_plugin", but just "css" ? No problem, you can change it in the config file !

## External library

The module load automatically 2 js libraries :

* dynatree => For generate a tree ui
* bootbox => For modal confirmation

### jQuery

The module need jQuery et jQuery UI external libraries. If you have already these libraries in your theme, it's good.

But if you want to force to load the jquery library, you need to set "force_jquery" at true in the menu config file.

### Bootstrap & FontAwesome

This is the same for Bootstrap and Fontawesome librairies 

# Usage

Access the backoffice at : http://your-fuel-url/menu/backend

# Error

* "Fuel\Core\ThemeException [ Error ]: Theme "default" could not be found." It's because this module uses Themes for better flexibility. You must create a theme folder, by default it's DOCROOT/themes/default.

# Override Theme

Views module use Twitter bootstrap 3 tags for the UI. And FontAwesome

You can override them easily. For example for override the view 'menu/views/backend/index.php', you need to create the same file here "DOCROOT/themes/[your_theme]/menu/backend/index.php"
