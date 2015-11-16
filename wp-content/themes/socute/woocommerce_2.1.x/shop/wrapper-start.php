<?php
/**
 * Content Wrappers
 */
 
$is_full_width = (bool)( yit_get_sidebar_layout() == 'sidebar-no' || yit_get_option('product-single-layout') == 'layout-2' );
 
?>
	        <!-- START CONTENT -->
	        <div id="content-shop" class="span<?php echo $is_full_width ? 12 : 9 ?> content group">