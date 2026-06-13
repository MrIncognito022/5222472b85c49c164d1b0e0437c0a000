<?php
/**
 * Search results template.
 *
 * @package TradePulse
 */

get_header();
?>

<main id="primary" class="archive-shell">
	<header class="archive-header">
		<span class="eyebrow"><?php esc_html_e( 'Search the journal', 'tradepulse' ); ?></span>
		<h1 class="page-title">
			<?php printf( esc_html__( 'Results for "%s"', 'tradepulse' ), esc_html( get_search_query() ) ); ?>
		</h1>
	</header>

	<?php if ( have_posts() ) : ?>
		<div class="grid grid--two">
			<?php
			while ( have_posts() ) :
				the_post();
				tradepulse_card();
			endwhile;
			?>
		</div>
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<div class="empty-state">
			<h2><?php esc_html_e( 'No matching analysis found.', 'tradepulse' ); ?></h2>
			<p><?php esc_html_e( 'Try a broader phrase or browse another topic.', 'tradepulse' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	<?php endif; ?>
</main>

<?php get_footer();
