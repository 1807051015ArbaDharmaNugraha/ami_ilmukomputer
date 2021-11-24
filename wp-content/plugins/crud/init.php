<?php
/*
Plugin Name: User List
Description: A simple user list for CRUD
Version: 1.0
Author: phpcoder.tech
Author URI: http://phpcoder.tech
*/
// Add action to the Admin Menu</strong></span>
add_action('admin_menu','phpcodertech_modifymenu');
// On time of activation of the plugin, add the "Users" option</span></strong>
function phpcodertech_modifymenu() {
// The main item for the menu</strong></span>
add_menu_page('users','users','read','phpcodertech_list','phpcodertech_list' );

add_submenu_page(null,'Add New users','Add New','read','phpcodertech_create','phpcodertech_create'
);

add_submenu_page(null,'Update users',
'Update','read','phpcodertech_update','phpcodertech_update' );}

define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'list.php');
require_once(ROOTDIR . 'create.php');
require_once(ROOTDIR . 'update.php');