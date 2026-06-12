<?php
/**
 * Single post template.
 *
 * @package TradePulse
 */

get_header();
?>

<main class="page-shell">
  <div class="wrap">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <?php if ( has_post_thumbnail() ) : ?>
          <div class="post-featured-image"><?php the_post_thumbnail( 'large' ); ?></div>
        <?php endif; ?>

        <header class="entry-header">
          <h1 class="entry-title"><?php the_title(); ?></h1>
          <div class="article-meta"><?php tradepulse_posted_meta(); ?></div>
        </header>

        <div class="entry-content">
          <?php the_content(); ?>
        </div>

        <?php comments_template(); ?>
      </article>
    <?php endwhile; else: ?>
      <p><?php esc_html_e( 'No content found.', 'tradepulse' ); ?></p>
    <?php endif; ?>
  </div>
</main>

<?php get_footer();
