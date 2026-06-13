<?php
/**
 * Forex page.
 *
 * @package TradePulse
 */

$tradepulse_market = array(
	'category'         => 'forex',
	'category_label'   => 'Forex',
	'eyebrow'          => __( 'Currency desk', 'tradepulse' ),
	'title'            => __( 'Forex', 'tradepulse' ),
	'description'      => __( 'Major currency pairs, central-bank themes, dollar flows, and clearly defined technical levels.', 'tradepulse' ),
	'symbol'           => 'FX',
	'feed_title'       => __( 'Latest Forex Analysis', 'tradepulse' ),
	'feed_description' => __( 'Fresh currency-market commentary and trade scenarios from the journal.', 'tradepulse' ),
);

require get_template_directory() . '/template-parts/market-page.php';
