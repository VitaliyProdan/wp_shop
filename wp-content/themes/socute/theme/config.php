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

//define area
define( 'YIT_THEME_NAME', 'socute' );
define( 'YIT_THEME_NOTIFIER_URL', 'http://update.yithemes.com/' . YIT_THEME_NAME . '-free.xml');
define( 'YIT_DOCUMENTATION_URL', 'http://yithemes.com/docs-free/' . YIT_THEME_NAME . '/');
define( 'YIT_DOCUMENTATION_ZIP_URL', 'http://yithemes.com/docs-free/documentation-' . YIT_THEME_NAME . '.zip');
define( 'YIT_SUPPORT_URL', 'http://support.yithemes.com' );

define( 'YIT_DASHBOARD_LINK', 'http://cdn.yithemes.com/themes/free/'. YIT_THEME_NAME .'.php' );

define( 'YIT_FREE_THEMES_URL', 'http://yithemes.com/' );
define( 'YIT_MARKETPLACE', 'free' ); // ( tf | yit | free )

define( 'YIT_EXTERNAL_PLUGINS', 1 );
define( 'YIT_IS_SHOP', 1 );

define( 'YIT_SHOW_PANEL_HEADER', 1 );
define( 'YIT_SHOW_PANEL_HEADER_LINKS', 1 );

if( !defined( 'YIT_DEBUG' ) ) { define( 'YIT_DEBUG', false ); }
if( !defined( 'YIT_SHOW_UPDATES' ) ) { define( 'YIT_SHOW_UPDATES', true ); }

if( is_admin() && in_array( 'theme-check/theme-check.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    set_time_limit( 0 );
}