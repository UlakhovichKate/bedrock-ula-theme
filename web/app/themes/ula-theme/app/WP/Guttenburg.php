<?php
/**
 * Guttenburg
 * --------
 *
 * @category WP
 * @version 1.0
 * @package Lydia
 */

namespace Ula\WP;

defined( 'ABSPATH' ) || exit;

class Guttenburg
{
    /**
     * @var array
     */
    public $social = [];

    public function __construct()
    {
        $this->add_actions();
        $this->remove_unwanted_features();
    }

    public static function add_actions()
    {
        add_action( 'enqueue_block_editor_assets', [__CLASS__, 'enqueue_guttenberg_overides'], 10 );
        add_action( 'wp_enqueue_scripts', [__CLASS__, 'dequeue_guttenberg_styles'], 10 );
        //add_filter( 'allowed_block_types_all', [__CLASS__, 'allowed_blocks'], 10, 2 );
    }

    public static function enqueue_guttenberg_overides()
    {

        if ( file_exists( get_stylesheet_directory() . '/admin/lydia-blocks.min.js' ) ) {
            wp_enqueue_script('lydia-guttenburg-script',
                get_template_directory_uri() . '/admin/lydia-blocks.min.js',
                ['wp-blocks', 'wp-dom-ready', 'wp-edit-post'],
                filemtime( get_stylesheet_directory() . '/admin/lydia-blocks.min.js' )
            );
        }

    }

    public static function dequeue_guttenberg_styles()
    {
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' ); // Wordpress core
        wp_dequeue_style( 'wc-block-style' );         // WooCommerce
        wp_dequeue_style( 'global-styles' );
    }

    public static function remove_unwanted_features()
    {
        add_theme_support( 'disable-custom-colors' );
        add_theme_support( 'disable-custom-font-sizes' );
        add_theme_support( 'disable-custom-gradients' );
        add_theme_support( 'align-wide' );
        add_theme_support( 'responsive-embeds' );
        remove_theme_support( 'core-block-patterns' );
        remove_theme_support( 'widgets-block-editor' );
    }

    /**
     * @param $allowed_blocks
     */
    public static function allowed_blocks( $allowed_blocks, $context )
    {

        if ( ! ( $context instanceof \WP_Block_Editor_Context ) ) {
            return $allowed_blocks;
        }

        return apply_filters('guttenberg_allowed_blocks', [
            'core/paragraph',
            'core/heading',
            'core/list',
            'core/audio',
            'core/file',
            'core/video',
            'core/code',
            'core/html',
            'core/separator',
            'core/spacer',
            'core/shortcode'
        ]);

    }

    /**
     * @param $content
     * @param $blockName
     * @return mixed
     */
    public static function get_blocks_by_type(
        $content,
        $blockName = ''
    ) {

        if ( has_blocks( $content ) ) {

            $blocks  = parse_blocks( $content );
            $content = '';

            foreach ( $blocks as $block ) {
                if ( $block['blockName'] == $blockName ) {
                    $content .= $block['innerHTML'];
                }
            }
        }

        return $content;
    }

    /**
     * @param $content
     * @param $blockName
     * @return mixed
     */
    public static function get_blocks_by_type_array(
        $content,
        $blockName = ''
    ) {

        if ( has_blocks( $content ) ) {

            $blocks  = parse_blocks( $content );
            $content = [];

            foreach ( $blocks as $block ) {
                if ( $block['blockName'] == $blockName ) {
                    $content[] = $block['innerHTML'];
                }
            }
        }

        return $content;
    }
}
