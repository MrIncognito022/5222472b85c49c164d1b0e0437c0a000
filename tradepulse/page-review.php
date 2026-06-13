<?php
/**
 * Reviews landing page.
 *
 * @package TradePulse
 */

get_header();

$paged = max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );
$reviews = new WP_Query( array(
	'post_type'      => 'review',
	'post_status'    => 'publish',
	'posts_per_page' => 6,
	'paged'          => $paged,
) );
?>

<main id="primary" class="reviews-page">
	<section class="section section--white">
		<div class="wrap">
			<div class="section-heading reviews-page__heading">
				<div class="reviews-page__heading-copy">
					<span><?php esc_html_e( 'Trader Research', 'tradepulse' ); ?></span>
					<h1><?php esc_html_e( 'Prop Firm', 'tradepulse' ); ?> <strong><?php esc_html_e( 'Reviews', 'tradepulse' ); ?></strong></h1>
				</div>
				<div class="reviews-page__heading-note">
					<i aria-hidden="true"></i>
					<p><?php esc_html_e( 'Clear, practical reviews of prop firm rules, platforms, payouts, and the complete trading experience.', 'tradepulse' ); ?></p>
				</div>
			</div>

			<?php if ( $reviews->have_posts() ) : ?>
				<div class="grid grid--two reviews-page__grid">
					<?php
					while ( $reviews->have_posts() ) :
						$reviews->the_post();
						tradepulse_review_card();
					endwhile;
					?>
				</div>

				<?php
				echo wp_kses_post( paginate_links( array(
					'total'   => $reviews->max_num_pages,
					'current' => $paged,
					'type'    => 'list',
				) ) );
				?>
			<?php else : ?>
				<div class="empty-state">
					<h2><?php esc_html_e( 'No reviews published yet.', 'tradepulse' ); ?></h2>
					<p><?php esc_html_e( 'Published entries from Reviews in the WordPress dashboard will appear here automatically.', 'tradepulse' ); ?></p>
				</div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</section>
</main>

<?php get_footer();
