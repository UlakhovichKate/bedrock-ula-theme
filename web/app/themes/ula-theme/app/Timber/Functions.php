<?php
/**
 * Timber Functions
 * --------
 * @category Timber
 * @version 1.0
 * @package Lydia
 */

namespace Ula\Timber;

defined('ABSPATH') || exit;

use Twig as Twig;

class Functions
{

    public function __construct() {
        add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
    }

    /** This is where you can add your own functions to twig.
     *
     * @param string $twig get extension.
     */
    public function add_to_twig( $twig ) {
        $twig->addExtension( new Twig\Extension\StringLoaderExtension() );

        /** This Would return 'foo bar!'.
         * @param string $text being 'foo', then returned 'foo bar!'.
         */
        $twig->addFilter( new Twig\TwigFilter( 'myfoo', function (
            $text
        ) {
            $text .= ' bar!';
            return $text;
        } ) );

        /**
         * Icon
         */
        $twig->addFunction( new Twig\TwigFunction( 'icon', function (
            $type = 'far',
            $icon = null,
            $class = null
        ) {
            return '<i class="c-icon '. $type .' fa-'. $icon .' '. $class .'"></i>';
        }));

        /**
         * CompClass
         */
        $twig->addFunction( new Twig\TwigFunction( 'component', function ($class = null) {
            return $class ? ' ' . $class : '';
        }));


        return $twig;
    }

}
