<?php
/**
 * Trading topics hub.
 *
 * @package TradePulse
 */

get_header();

$markets = array(
	array( 'slug' => 'stocks', 'symbol' => 'SPX', 'title' => __( 'Stocks', 'tradepulse' ), 'description' => __( 'Earnings, sectors, company news, and equity setups.', 'tradepulse' ) ),
	array( 'slug' => 'forex', 'symbol' => 'FX', 'title' => __( 'Forex', 'tradepulse' ), 'description' => __( 'Currency pairs, central banks, and macro-driven levels.', 'tradepulse' ) ),
	array( 'slug' => 'future', 'symbol' => 'ES', 'title' => __( 'Futures', 'tradepulse' ), 'description' => __( 'Indices, commodities, energy, and session-based ideas.', 'tradepulse' ) ),
	array( 'slug' => 'crypto', 'symbol' => 'BTC', 'title' => __( 'Crypto', 'tradepulse' ), 'description' => __( 'Digital-asset structure, liquidity, and risk-aware setups.', 'tradepulse' ) ),
);
?>

<main id="primary" class="topic-page">
	<section class="firm-hero firm-hero--rankings">
		<div class="firm-hero__inner firm-hero__inner--centered">
			<div class="firm-hero__content">
				<span class="eyebrow"><?php esc_html_e( 'Choose your market', 'tradepulse' ); ?></span>
				<h1><?php esc_html_e( 'Trading Analysis by Market', 'tradepulse' ); ?></h1>
				<p><?php esc_html_e( 'Move directly to the latest analysis, chart setups, and practical risk notes for the market you trade.', 'tradepulse' ); ?></p>
			</div>
		</div>
	</section>

	<section class="section market-directory">
		<div class="wrap market-directory__grid">
			<?php foreach ( $markets as $market ) : ?>
				<a class="market-directory__card" href="<?php echo esc_url( home_url( '/' . $market['slug'] . '/' ) ); ?>">
					<span><?php echo esc_html( $market['symbol'] ); ?></span>
					<h2><?php echo esc_html( $market['title'] ); ?></h2>
					<p><?php echo esc_html( $market['description'] ); ?></p>
					<strong><?php esc_html_e( 'View latest analysis', 'tradepulse' ); ?> &rarr;</strong>
				</a>
			<?php endforeach; ?>
		</div>
	</section>
</main>

<?php get_footer();
