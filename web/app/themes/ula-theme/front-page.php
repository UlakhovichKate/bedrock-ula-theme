<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

use Timber\Timber;

defined( 'ABSPATH' ) || exit;

$context = new Ula\Timber\Context( ['front-page.twig'] );

$context->add( 'posts', Timber::get_posts( [
    'post_type'   => 'post',
    'numberposts' => 3,
    'orderby'     => 'date',
    'order'       => 'DESC',
] ) );

$post = $context->getValue('post');
$slider = [];
array_push($slider, $post->slider_slide_1, $post->slider_slide_2, $post->slider_slide_3);

$context->add('slider', $slider);
$context->add('contacts', get_field('contacts', $post));

$context->render();
