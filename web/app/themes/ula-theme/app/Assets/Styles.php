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

class Styles
{
    public function __construct()
    {
        $this->add_actions();
    }

    /**
     * Add Actions Hooks
     *
     * @return void
     */
    public static function add_actions() {
        add_action( 'wp_enqueue_scripts', [__CLASS__, 'ula_style'], 1 );
    }

    /**
     * Add Lydia Styles to Frontend
     *
     * @return void
     */
    public static function ula_style()
    {
        wp_register_style( 'ula-style', get_stylesheet_directory_uri() . '/dist/css/style.css', [], filemtime( get_stylesheet_directory() . '/dist/css/style.css' ), false );
        wp_enqueue_style( 'ula-style' );
    }

}
