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


        // Map Markers
        $twig->addFunction( new Twig\TwigFunction( 'mapMarkers', function (
            $location
        ) {
            $meta = get_field('contact_info');
            $address = $meta['address'];

//            $marker = [
//                'ID' => $location->ID,
//                'name' => $location->title,
//                'lat' => $address['lat'],
//                'lng' => $address['lng'],
//                'address' => $address['address'],
//                'state' => $address['state'],
//            ];
            $marker = [
                'ID' => 12,
                'name' => 'Australian Red Cross Lifeblood',
                'lat' => '53.339688',
                'lng' => '-6.236688',
                'address' => '100/154 Batman St, West Melbourne VIC 3003, Australia',
                'state' => '',
            ];

            return htmlspecialchars(wp_json_encode($marker));

        } ) );


        return $twig;
    }

}
