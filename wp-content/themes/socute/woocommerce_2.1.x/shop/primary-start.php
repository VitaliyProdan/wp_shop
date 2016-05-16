<?php
/**
 * Content Wrappers
 */
?>

<div id="primary" class="<?php if ( yit_get_option('product-single-layout') == 'layout-1' ) yit_sidebar_layout() ?>">
    <div class="container group">
	    <div class="row">
	        <?php

                do_action( 'yit_before_content' ); ?>