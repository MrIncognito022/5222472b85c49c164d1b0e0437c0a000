<?php
/**
 * Crypto page.
 *
 * @package TradePulse
 */

$tradepulse_market = array(
	'category'         => 'crypto',
	'category_label'   => 'Crypto',
	'eyebrow'          => __( 'Digital assets desk', 'tradepulse' ),
	'title'            => __( 'Crypto', 'tradepulse' ),
	'description'      => __( 'Bitcoin, altcoins, market structure, liquidity, and risk-aware setups across digital assets.', 'tradepulse' ),
	'symbol'           => 'BTC',
	'feed_title'       => __( 'Latest Crypto Analysis', 'tradepulse' ),
	'feed_description' => __( 'The newest digital-asset research, chart ideas, and market updates.', 'tradepulse' ),
);

require get_template_directory() . '/template-parts/market-page.php';
