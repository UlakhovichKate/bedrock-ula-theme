<?php
/**
 * Enqueue
 * --------
 *
 * @category Assets
 * @version 1.0
 * @package BMAS
 */
namespace Ula\Assets;

defined( 'ABSPATH' ) || exit;

class Scripts
{
    public function __construct()
    {
        $this->add_actions();
        $this->add_filters();
    }

    /**
     * Add Action Hooks
     *
     * @return void
     */
    public static function add_actions() {
        add_action( 'wp_enqueue_scripts', [__CLASS__, 'ula_jquery'], 10);
        add_action( 'wp_enqueue_scripts', [__CLASS__, 'ula_js'], 10 );
    }

    /**
     * Add Filters
     *
     * @return void
     */
    public static function add_filters() {
        add_filter( 'script_loader_tag', [__CLASS__, 'add_jquery_attributes'], 10, 2 );
    }


    /**
     * Add Lydia JS to Frontend
     *
     * @return void
     */
    public static function ula_js()
    {

        if (file_exists( get_stylesheet_directory() . '/dist/js/app.js' ) ) {
            wp_enqueue_script( 'ula-js',
                get_template_directory_uri() . '/dist/js/app.js',
                ['jquery'],
                filemtime( get_stylesheet_directory() . '/dist/js/app.js' ),
                true
            );
        }
    }

    /**
     * Replace Worpdress JQuery
     *
     * @return void
     */
    public static function ula_jquery()
    {
        wp_deregister_script( 'jquery' );
        wp_deregister_script( 'jquery-core' );
        wp_deregister_script( 'jquery-migrate' );

        wp_enqueue_script( 'jquery-core', '//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', '3.6.0', false, true );
        wp_register_script( 'jquery', false, ['jquery-core'], null, false );

        wp_enqueue_script( 'jquery' );
    }

    public static function add_jquery_attributes( $tag, $handle ) {
        if ( 'jquery-core' === $handle ) {
            return str_replace( "type='text/javascript'", "type='text/javascript' crossorigin='anonymous'", $tag );
        }
        return $tag;
    }
}
