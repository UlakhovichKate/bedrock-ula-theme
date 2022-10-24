<?php
/**
 * The Template for the sidebar containing the main widget area
 *
 * @package  WordPress
 * @subpackage  Timber
 */

use Timber\Timber;

$context = array();
$context['widget'] = dynamic_sidebar( 'sidebar-1' );

Timber::render('sidebar.twig', $context);
