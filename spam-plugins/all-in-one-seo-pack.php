<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

add_action( 'no_spam_in_backend_admin_style',function(){
  ?>
  #aioseo-tabbed{display:none}
  <?php
} );
