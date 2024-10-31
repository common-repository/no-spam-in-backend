<?php
/*
Plugin Name: No Spam In Backend
Description: It removes the spam added by other plugins in the backend
Author: Jose Mortellaro
Author URI: https://josemortellaro.com
Domain Path: /languages/
Text Domain: no-spam-in-backend
Version: 0.0.1
*/
/*  This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

//Definitions
define( 'NO_SPAM_IN_BACKEND_PLUGIN_DIR', untrailingslashit( dirname( __FILE__ ) ) );

class No_Spam_In_Bsckend{

  public $plugins = array();

  function __construct(){
    add_action( 'admin_init',array( $this,'admin_init' ) );
    add_action( 'admin_print_styles',array( $this,'print_styles' ) );
  }

  public function admin_init(){
    $active_plugins = get_option( 'active_plugins' );
    if( $active_plugins && is_array( $active_plugins ) ){
      foreach( $active_plugins as $plugin ){
        if( file_exists( NO_SPAM_IN_BACKEND_PLUGIN_DIR.'/spam-plugins/'.dirname( $plugin ).'.php' ) ){
          $this->plugins[] = dirname( $plugin );
          require  NO_SPAM_IN_BACKEND_PLUGIN_DIR.'/spam-plugins/'.sanitize_title( dirname( $plugin ) ).'.php';
        }
      }
    }
  }

  public function print_styles(){
    ?><style id="no-spam-in-backend"><?php do_action( 'no_spam_in_backend_admin_style' ); ?></style><?php
  }
}

$no_spam = new No_Spam_In_Bsckend();
