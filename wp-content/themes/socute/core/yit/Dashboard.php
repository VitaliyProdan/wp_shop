<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Wordpress Admin Dashboard Management
 * 
 * @since 1.0.0
 */
class YIT_Dashboard {
	/**
	 * Products URL
	 * 
	 * @var string
	 * @access protected
	 * @since 1.0.0
	 */
	protected $_productsFeed = 'http://yithemes.com/feed/?post_type=product';
	protected $_blogFeed = 'http://yithemes.com/feed/';


	
	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'wp_dashboard_setup', array($this, 'dashboard_widget_setup' ) );
        add_action('admin_notices', array($this, 'print_banner') );
        add_action('admin_init', array($this, 'dismiss_message') );
	}
	
	/**
	 * Init
	 * 
	 */
	public function init() {
		
	}
	
	/**
	 * Dashboard widget setup
	 * 
	 * @return void
	 * @since 1.0.0
	 * @access public
	 */
	public function dashboard_widget_setup() {
		global $wp_meta_boxes;
		
	    wp_add_dashboard_widget( 'yit_dashboard_products_news', __( 'Our latest themes' , 'yiw' ), array($this, 'dashboard_products_news') );
	    wp_add_dashboard_widget( 'yit_dashboard_blog_news', __( 'News from the YIT Blog' , 'yiw' ), array($this, 'dashboard_blog_news') );  	

		$widgets_on_side = array(
	        'yit_dashboard_products_news',
	        'yit_dashboard_blog_news'
	    );
		
	    foreach( $widgets_on_side as $meta ) {
	        $temp = $wp_meta_boxes['dashboard']['normal']['core'][$meta];
	        unset($wp_meta_boxes['dashboard']['normal']['core'][$meta]);
	        $wp_meta_boxes['dashboard']['side']['core'][$meta] = $temp;
	    }
	}
	
	
	/**
	 * Product news Widget
	 * 
	 * @return void
	 * @since 1.0.0
	 * @access public
	 */
	public function dashboard_products_news() {
		$args = array( 'show_author' => 1, 'show_date' => 1, 'show_summary' => 0, 'items'=>10 );
		wp_widget_rss_output( $this->_productsFeed, $args );
	}	
	
	
	/**
	 * Blog news Widget
	 * 
	 * @return void
	 * @since 1.0.0
	 * @access public
	 */
	public function dashboard_blog_news() {
		$args = array( 'show_author' => 1, 'show_date' => 1, 'show_summary' => 0, 'items'=>10 );
		wp_widget_rss_output( $this->_blogFeed, $args );
	}


    /**
     * Print banner in dashboard pagina
     */
    public function print_banner() {

        global $pagenow;

        if( $pagenow != 'index.php' || get_transient('yit_dashboard_message_dismiss') == 'yes' ) return;

        echo "<div style='position:relative; background: transparent; border: none; padding: 0;' class='yit-dashboard-message updated'>
               <div style='display: inline-block; position: relative;'>
                <a href='" . YIT_DASHBOARD_LINK . "?url' target='_blank'><img style='max-width:100%' src='" . YIT_DASHBOARD_LINK . "' alt='' /></a>
                <a href='". admin_url('?yit_dashboard_message_dismiss') ."' class='dismiss' style='position: absolute; right: 14px; top: 40px; background: url(\"". get_template_directory_uri() ."/images/dismiss.png\") no-repeat; width: 82px; height: 23px;'></a>
               </div>
              </div>";
    }

    /**
     * Dismiss message
     */
    function dismiss_message() {
        if( isset( $_GET['yit_dashboard_message_dismiss'] ) ) {
            set_transient('yit_dashboard_message_dismiss', 'yes', 4 * WEEK_IN_SECONDS);
            wp_redirect( admin_url() );
            exit();
        }
    }
}