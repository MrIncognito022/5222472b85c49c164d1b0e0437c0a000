<?php
/**
 * Main posts index template.
 *
 * @package TradePulse
 */

get_header();
$posts_title = single_post_title( '', false );
?>

<main id="primary" class="archive-shell">
	<header class="archive-header">
		<span class="eyebrow"><?php esc_html_e( 'TradePulse Journal', 'tradepulse' ); ?></span>
		<h1 class="page-title"><?php echo esc_html( $posts_title ? $posts_title : __( 'Latest Analysis', 'tradepulse' ) ); ?></h1>
		<p><?php esc_html_e( 'Fresh market commentary, chart setups, and practical risk notes.', 'tradepulse' ); ?></p>
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
		<div class="empty-state"><p><?php esc_html_e( 'No posts found.', 'tradepulse' ); ?></p></div>
	<?php endif; ?>
</main>

<?php get_footer();
