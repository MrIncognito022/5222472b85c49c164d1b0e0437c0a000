<?php
/**
 * Page template.
 *
 * @package TradePulse
 */

get_header();
?>

<main id="primary" class="page-shell">
	<div class="article-shell">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'single-article' ); ?> id="post-<?php the_ID(); ?>">
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>

				<div class="entry-content article-content">
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
				</div>
			</article>
		<?php endwhile; else : ?>
			<p><?php esc_html_e( 'No page content found.', 'tradepulse' ); ?></p>
		<?php endif; ?>
	</div>
</main>

<?php get_footer();
