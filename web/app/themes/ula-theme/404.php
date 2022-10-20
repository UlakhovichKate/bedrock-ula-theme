<?php
/**
 * 404
 * --------
 * @category Controllers
 * @package Lydia/Controllers
 * @version 1.0
 */

use Ula\Timber\Context;

defined( 'ABSPATH' ) || exit;

$context = new Context( ['404.twig'] );

$context->render();
