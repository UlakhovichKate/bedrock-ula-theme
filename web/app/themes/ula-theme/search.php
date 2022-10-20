<?php
/**
 * Search results page
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

//$templates = array( 'search.twig', 'archive.twig', 'index.twig' );
//
//$context          = Timber::context();
//$context['title'] = 'Search results for ' . get_search_query();
//$context['posts'] = new Timber\PostQuery();
//
//Timber::render( $templates, $context );


use Timber\Timber;

defined( 'ABSPATH' ) || exit;

global $wp_query;

$context = new Ula\Timber\Context( ['search.twig'] );

$context->add( 'search', [
    'query' => get_search_query(),
    'count' => $wp_query->found_posts
] );

$context->render();
