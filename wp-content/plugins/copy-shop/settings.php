<?php
require_once('site_reader.php');
error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 1);

wp_register_style('style', plugins_url('copy-shop/css/style.css') );
wp_enqueue_style('style');

$site_reader = new SiteReader('http://tiande-shop.net/', 'li.cat-item a');
?>
<h1>Copy Shop</h1>
<hr />
<h3>Categories saved:</h3> <!-- that will be saved:-->
<?//= implode("<br />", $site_reader->get_categories()) ?>
<hr />
<h3>Products saved:</h3>
<?php //$site_reader->get_products(); ?>
