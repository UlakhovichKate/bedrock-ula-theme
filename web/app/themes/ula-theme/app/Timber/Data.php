<?php
/**
 * Timber Data
 * --------
 * @category Timber
 * @version 1.0
 * @package Lydia
 */

namespace Ula\Timber;

defined('ABSPATH') || exit;

use Ula\Timber\Context as Context;

class Data
{

    public function __construct() {
        add_filter( 'timber/context', [$this, 'add_global_data'] );
    }

    public function add_global_data( $data )
    {

        $context = new Context( ['no-op'], $data );

        $context->add( [
            'menu'      => [
                'masthead'   => new \Timber\Menu( 'masthead' ),
                'foundation' => new \Timber\Menu( 'foundation' ),
                'cta'    => get_field('masthead', 'components')
            ],
            'style' => 'default',
            'blog'  => get_permalink( get_option( 'page_for_posts' ) ),
            'terms' => '/terms-and-conditions'
        ] );

        if (function_exists('yoast_breadcrumb')) {
            $context->add(
                'breadcrumbs',
                yoast_breadcrumb('<nav class="c-crumbs">', '</nav>', false)
            );
        }

        $this->add_data_post($context);
        $this->add_global_acf($context);

        return $context->get();
    }

    public static function add_data_post( $context )
    {

        if (is_page() || is_singular() || is_home() || is_archive()) {
            $context->add( ['post' => new \Timber\Post()]);
        }

        return $context;
    }

    public function add_global_acf( $context )
    {

        $context->add([
            'foundation' =>  get_field('foundation', 'components'),
            'contact'    =>  get_field( 'contact', 'components' )
        ]);

        return $context;
    }

}
