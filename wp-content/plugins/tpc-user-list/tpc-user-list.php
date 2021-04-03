<?php
/*
Plugin Name: The Portfolio Collective User List
Plugin URI: https://www.anasalmasri.net/
Description: Simple plugin with shortcode to list down WordPress users.
Author: Anas Al-Masri
Version: 1.0.0
Author URI: https://www.anasalmasri.net/
License: GPL2
Text Domain: user-list
*/

include_once('TPC_User_List.class.php');

// Launch the whole plugin.
global $tpc_user_list;
$tpc_user_list = TPC_User_List::get_instance();
