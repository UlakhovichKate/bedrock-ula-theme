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

class Fonts
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
        add_action( 'wp_enqueue_scripts', [__CLASS__, 'google_fonts'], 10);
    }

    /**
     * Add Lydia Styles to Frontend
     *
     * @return void
     */
    public static function google_fonts()
    {

        wp_enqueue_style( 'fonts-google','//fonts.googleapis.com/css2?family=Inter:wght@300;400;700&family=Playfair+Display:wght@400;700&display=swap', [], null );
    }

}
