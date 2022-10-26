<?php
/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

/**
 * If you are installing Timber as a Composer dependency in your theme, you'll need this block
 * to load your dependencies and initialize Timber. If you are using Timber via the WordPress.org
 * plug-in, you can safely delete this block.
 */
$composer_autoload = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $composer_autoload ) ) {
	require_once $composer_autoload;
	$timber = new Timber\Timber();
}

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if ( ! class_exists( 'Timber' ) ) {

	add_action(
		'admin_notices',
		function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		}
	);

	add_filter(
		'template_include',
		function( $template ) {
			return get_stylesheet_directory() . '/static/no-timber.html';
		}
	);
	return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( 'templates', 'views' );

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;


/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */

include( get_stylesheet_directory() . '/app/MySite.php' );
include( get_stylesheet_directory() . '/app/Assets/Fonts.php' );
include( get_stylesheet_directory() . '/app/Assets/Styles.php' );
include( get_stylesheet_directory() . '/app/Assets/Scripts.php' );
include( get_stylesheet_directory() . '/app/Assets/Favicons.php' );
include( get_stylesheet_directory() . '/app/Timber/Functions.php' );
include( get_stylesheet_directory() . '/app/Timber/Context.php' );
include( get_stylesheet_directory() . '/app/Timber/Data.php' );
include( get_stylesheet_directory() . '/app/View/Classes.php' );
include( get_stylesheet_directory() . '/app/WP/Register.php' );
include( get_stylesheet_directory() . '/app/WP/Guttenburg.php' );
include( get_stylesheet_directory() . '/app/Util/Console.php' );
include( get_stylesheet_directory() . '/app/Util/DirectoryLoader.php' );

/**
 * Load all functions
 * ------
 * @version 1.0.0
 */
Ula\Util\DirectoryLoader::load('includes');


new MySite();
new Ula\Assets\Fonts;
new Ula\Assets\Styles;
new Ula\Assets\Scripts;
new Ula\Assets\Favicons;
new Ula\Timber\Functions;
new Ula\View\Classes;
new Ula\Timber\Data;
new Ula\WP\Guttenburg;


Ula\WP\Register::taxonomies( [
    [
        'plural'       => __( 'Education Categories', 'lydia' ),
        'singular'     => __( 'Education Category', 'lydia' ),
        'key'          => 'education_cat',
        'hierarchical' => true,
        'post_types'   => ['education'],
        'rewrite'      => [
            'slug'       => 'education-hub',
            'with_front' => false
        ],
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
    ]
] );

Ula\WP\Register::post_types( [
    [
        'plural'       => __( 'Education', 'lydia' ),
        'singular'     => __( 'Education', 'lydia' ),
        'key'          => 'education',
        'hierarchical' => false,
        'has_archive'  => false,
        'public'       => true,
        'show_in_rest' => true,
        'supports'     => ['title', 'thumbnail', 'excerpt', 'editor', 'custom-fields'],
        'menu_icon'    => 'dashicons-welcome-learn-more',
        'rewrite_slug' => 'education-hub/%education_cat%',
    ]
]);
