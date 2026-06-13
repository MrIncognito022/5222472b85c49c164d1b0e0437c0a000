<?php
/**
 * Single review template.
 *
 * @package TradePulse
 */

get_header();
?>

<main id="primary" class="page-shell review-detail-page">
	<div class="article-shell">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'single-article' ); ?> id="post-<?php the_ID(); ?>">
				<header class="entry-header">
					<div class="article-meta">
						<span><?php esc_html_e( 'Prop Firm Review', 'tradepulse' ); ?></span>
						<span><?php echo esc_html( get_the_date() ); ?></span>
					</div>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="single-featured-image"><?php the_post_thumbnail( 'large' ); ?></figure>
				<?php endif; ?>

				<div class="entry-content article-content">
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
				</div>

				<nav class="post-navigation" aria-label="<?php esc_attr_e( 'Review navigation', 'tradepulse' ); ?>">
					<div><?php previous_post_link( '%link', '<span>' . esc_html__( 'Previous review', 'tradepulse' ) . '</span>%title' ); ?></div>
					<div><?php next_post_link( '%link', '<span>' . esc_html__( 'Next review', 'tradepulse' ) . '</span>%title' ); ?></div>
				</nav>
			</article>
		<?php endwhile; else : ?>
			<p><?php esc_html_e( 'Review not found.', 'tradepulse' ); ?></p>
		<?php endif; ?>
	</div>
</main>

<?php get_footer();
