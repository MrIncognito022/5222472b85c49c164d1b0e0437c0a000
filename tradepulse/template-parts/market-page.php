<?php
/**
 * Shared layout for market category pages.
 *
 * @package TradePulse
 */

if ( ! isset( $tradepulse_market ) || ! is_array( $tradepulse_market ) ) {
	return;
}

$market_query = new WP_Query( array(
	'posts_per_page' => 9,
	'category_name'  => $tradepulse_market['category'],
	'post_status'    => 'publish',
) );

get_header();
?>

<main id="primary" class="topic-page">
	<section class="topic-hero topic-hero--<?php echo esc_attr( $tradepulse_market['category'] ); ?>">
		<div class="topic-hero__inner">
			<div>
				<span class="eyebrow"><?php echo esc_html( $tradepulse_market['eyebrow'] ); ?></span>
				<h1><?php echo esc_html( $tradepulse_market['title'] ); ?></h1>
				<p><?php echo esc_html( $tradepulse_market['description'] ); ?></p>
			</div>
			<div class="topic-symbol" aria-hidden="true">
				<strong><?php echo esc_html( $tradepulse_market['symbol'] ); ?></strong>
				<span><?php esc_html_e( 'Latest market coverage', 'tradepulse' ); ?></span>
			</div>
		</div>
	</section>

	<section class="section topic-feed">
		<div class="wrap">
			<div class="section-heading">
				<div>
					<span class="eyebrow"><?php esc_html_e( 'Fresh from the desk', 'tradepulse' ); ?></span>
					<h2><?php echo esc_html( $tradepulse_market['feed_title'] ); ?></h2>
				</div>
				<p><?php echo esc_html( $tradepulse_market['feed_description'] ); ?></p>
			</div>

			<?php if ( $market_query->have_posts() ) : ?>
				<div class="grid grid--three topic-grid">
					<?php
					while ( $market_query->have_posts() ) :
						$market_query->the_post();
						tradepulse_card();
					endwhile;
					?>
				</div>
			<?php else : ?>
				<div class="topic-empty">
					<span><?php echo esc_html( $tradepulse_market['symbol'] ); ?></span>
					<h2><?php echo esc_html( sprintf( __( '%s analysis is coming soon.', 'tradepulse' ), $tradepulse_market['title'] ) ); ?></h2>
					<p><?php echo esc_html( sprintf( __( 'Publish posts in the %s category and the latest articles will appear here automatically.', 'tradepulse' ), $tradepulse_market['category_label'] ) ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
wp_reset_postdata();
get_footer();
