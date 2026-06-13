<?php
/**
 * Futures page.
 *
 * @package TradePulse
 */

$tradepulse_market = array(
	'category'         => 'futures',
	'category_label'   => 'Futures',
	'eyebrow'          => __( 'Futures desk', 'tradepulse' ),
	'title'            => __( 'Futures', 'tradepulse' ),
	'description'      => __( 'Index, commodity, energy, and metals futures with session context and disciplined risk levels.', 'tradepulse' ),
	'symbol'           => 'ES',
	'feed_title'       => __( 'Latest Futures Analysis', 'tradepulse' ),
	'feed_description' => __( 'Recent futures commentary and setups, with the newest research shown first.', 'tradepulse' ),
);

require get_template_directory() . '/template-parts/market-page.php';
