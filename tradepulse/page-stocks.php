<?php
/**
 * Stocks page.
 *
 * @package TradePulse
 */

$tradepulse_market = array(
	'category'         => 'stocks',
	'category_label'   => 'Stocks',
	'eyebrow'          => __( 'Equities desk', 'tradepulse' ),
	'title'            => __( 'Stocks', 'tradepulse' ),
	'description'      => __( 'Company news, earnings reactions, sector strength, and technical setups for active equity traders.', 'tradepulse' ),
	'symbol'           => 'SPX',
	'feed_title'       => __( 'Latest Stock Analysis', 'tradepulse' ),
	'feed_description' => __( 'The newest equity ideas and market context, ordered by publication date.', 'tradepulse' ),
);

require get_template_directory() . '/template-parts/market-page.php';
