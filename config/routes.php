<?php


return array(
	'_root_'                     => '/menu/backend/404',
	'_404_'                      => '/menu/backend/404',
	'backend'                    => array('menu/backend/index', 'name' => 'menu_backend_menu'),                          
	'backend/view/:id'           => array('menu/backend/index', 'name' => 'menu_backend_submenu'), 
	'backend/add'                => array('menu/backend/index/add', 'name' => 'menu_backend_add'),                    
	'backend/add/parent/:parent' => array('menu/backend/index/add', 'name' => 'menu_backend_add_to_parent'),
	'backend/add/:id'            => array('menu/backend/index/add', 'name' => 'menu_backend_edit'),                  
	'backend/delete/:id'         => array('menu/backend/index/delete', 'name' => 'menu_backend_delete'),   
);